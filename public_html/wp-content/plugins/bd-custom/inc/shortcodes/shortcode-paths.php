<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_shortcode_learning_paths')):
    function bd324_shortcode_learning_paths($atts = array())
    {
        // Parse shortcode attributes
        $atts = shortcode_atts([
           'priority_terms' => '', // Comma-separated list of term names/slugs to show first
           'exclude_terms' => '',  // Comma-separated list of terms to exclude
           'order_by' => 'serial', // 'serial', 'name', 'custom'
           'include_children' => 'true', // Whether to apply priority to child terms too
           'hierarchy_level' => 'all', // 'parent', 'children', 'all'
        ], $atts, 'mwe-learning-paths');

        // Get terms based on hierarchy preference
        $query_args = [
           'taxonomy'   => 'framework-path',
           'hide_empty' => false,
        ];

        // Only add parent restriction if we want parent-only
        if ($atts['hierarchy_level'] === 'parent') {
            $query_args['parent'] = 0;
        }

        $terms = get_terms($query_args);

        if (is_wp_error($terms) || empty($terms)) {
            return '';
        }

        // Apply exclusions first
        if (!empty($atts['exclude_terms'])) {
            $exclude_list = array_map('trim', explode(',', $atts['exclude_terms']));
            $terms = array_filter($terms, function ($term) use ($exclude_list) {
                return !in_array($term->slug, $exclude_list) && !in_array($term->name, $exclude_list);
            });
        }

        // Sort with priority handling - now supports full hierarchy
        $terms = sort_terms_with_priority_hierarchy($terms, $atts['priority_terms'], $atts['order_by'], $atts['include_children']);

        ob_start();

        // Handle different hierarchy levels properly
        if ($atts['hierarchy_level'] === 'all') {
            // Show full hierarchy with proper H2/H3 headers
            display_sorted_framework_path_terms($terms, 'framework-path');
        } elseif ($atts['hierarchy_level'] === 'parent') {
            // Show only parent terms (filter out children first)
            $parent_terms = array_filter($terms, function ($term) {
                return $term->parent == 0;
            });
            display_sorted_framework_path_terms($parent_terms, 'framework-path');
        } else {
            // 'children' or any other value - show flat list
            display_framework_path_terms_flat($terms);
        }

        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
endif;

/**
 * Sort terms with priority ordering - supports full hierarchy with child ordering
 */
function sort_terms_with_priority_hierarchy($terms, $priority_terms = '', $order_by = 'serial', $include_children = 'true')
{
    if (empty($priority_terms)) {
        return sort_terms_by_serial($terms);
    }

    $priority_list = array_map('trim', explode(',', $priority_terms));

    // Build complete hierarchy map
    $hierarchy = build_term_hierarchy($terms);

    // Sort the hierarchy with priorities
    $sorted_hierarchy = sort_hierarchy_with_priorities($hierarchy, $priority_list, $order_by);

    // Flatten back to array while maintaining order
    return flatten_sorted_hierarchy($sorted_hierarchy);
}

/**
 * Build a hierarchical structure from flat terms array
 */
function build_term_hierarchy($terms)
{
    $hierarchy = [];
    $all_terms = [];

    // Index all terms by ID for quick lookup
    foreach ($terms as $term) {
        $all_terms[$term->term_id] = $term;
    }

    // Build hierarchy structure
    foreach ($terms as $term) {
        if ($term->parent == 0) {
            // This is a parent term
            $hierarchy[$term->term_id] = [
                'term' => $term,
                'children' => []
            ];
        }
    }

    // Add children to their parents
    foreach ($terms as $term) {
        if ($term->parent != 0 && isset($hierarchy[$term->parent])) {
            $hierarchy[$term->parent]['children'][$term->term_id] = [
                'term' => $term,
                'children' => []
            ];
        }
    }

    return $hierarchy;
}

/**
 * Sort hierarchy structure with priorities
 */
function sort_hierarchy_with_priorities($hierarchy, $priority_list, $order_by)
{
    // Sort parent level first
    $sorted_parents = [];
    $priority_parents = [];
    $regular_parents = [];

    // Separate priority and regular parents
    foreach ($hierarchy as $parent_id => $parent_data) {
        $is_priority = false;
        $priority_index = null;

        foreach ($priority_list as $index => $priority_item) {
            if ($parent_data['term']->slug === $priority_item ||
                $parent_data['term']->name === $priority_item) {
                $priority_parents[] = [
                    'data' => $parent_data,
                    'priority_index' => $index
                ];
                $is_priority = true;
                break;
            }
        }

        if (!$is_priority) {
            $regular_parents[] = $parent_data;
        }
    }

    // Sort priority parents by their priority order
    usort($priority_parents, function ($a, $b) {
        return $a['priority_index'] - $b['priority_index'];
    });

    // Sort regular parents
    $regular_parents = sort_parent_terms($regular_parents, $order_by);

    // Combine priority and regular parents
    $all_sorted_parents = array_merge(
        array_column($priority_parents, 'data'),
        $regular_parents
    );

    // Now sort children within each parent
    foreach ($all_sorted_parents as &$parent_data) {
        if (!empty($parent_data['children'])) {
            $parent_data['children'] = sort_children_with_priorities(
                $parent_data['children'],
                $priority_list,
                $order_by
            );
        }
    }

    return $all_sorted_parents;
}

/**
 * Sort children with priority support
 */
function sort_children_with_priorities($children, $priority_list, $order_by)
{
    $priority_children = [];
    $regular_children = [];

    // Separate priority and regular children
    foreach ($children as $child_id => $child_data) {
        $is_priority = false;
        $priority_index = null;

        foreach ($priority_list as $index => $priority_item) {
            if ($child_data['term']->slug === $priority_item ||
                $child_data['term']->name === $priority_item) {
                $priority_children[] = [
                    'data' => $child_data,
                    'priority_index' => $index
                ];
                $is_priority = true;
                break;
            }
        }

        if (!$is_priority) {
            $regular_children[] = $child_data;
        }
    }

    // Sort priority children by their priority order
    usort($priority_children, function ($a, $b) {
        return $a['priority_index'] - $b['priority_index'];
    });

    // Sort regular children
    $regular_children = sort_child_terms($regular_children, $order_by);

    // Combine and return
    return array_merge(
        array_column($priority_children, 'data'),
        $regular_children
    );
}

/**
 * Sort parent terms by specified method
 */
function sort_parent_terms($parents, $order_by)
{
    switch ($order_by) {
        case 'name':
            usort($parents, function ($a, $b) {
                return strcmp($a['term']->name, $b['term']->name);
            });
            break;
        case 'serial':
        default:
            // Use existing serial sorting if available
            $parent_terms = array_column($parents, 'term');
            $sorted_terms = sort_terms_by_serial($parent_terms);

            // Rebuild parent structure with sorted order
            $sorted_parents = [];
            foreach ($sorted_terms as $term) {
                foreach ($parents as $parent_data) {
                    if ($parent_data['term']->term_id === $term->term_id) {
                        $sorted_parents[] = $parent_data;
                        break;
                    }
                }
            }
            return $sorted_parents;
    }

    return $parents;
}

/**
 * Sort child terms by specified method
 */
function sort_child_terms($children, $order_by)
{
    switch ($order_by) {
        case 'name':
            usort($children, function ($a, $b) {
                return strcmp($a['term']->name, $b['term']->name);
            });
            break;
        case 'serial':
        default:
            // Use existing serial sorting if available
            $child_terms = array_column($children, 'term');
            $sorted_terms = sort_terms_by_serial($child_terms);

            // Rebuild child structure with sorted order
            $sorted_children = [];
            foreach ($sorted_terms as $term) {
                foreach ($children as $child_data) {
                    if ($child_data['term']->term_id === $term->term_id) {
                        $sorted_children[] = $child_data;
                        break;
                    }
                }
            }
            return $sorted_children;
    }

    return $children;
}

/**
 * Flatten sorted hierarchy back to linear array
 */
function flatten_sorted_hierarchy($sorted_hierarchy)
{
    $flattened = [];

    foreach ($sorted_hierarchy as $parent_data) {
        // Add parent
        $flattened[] = $parent_data['term'];

        // Add children
        foreach ($parent_data['children'] as $child_data) {
            $flattened[] = $child_data['term'];
        }
    }

    return $flattened;
}

/**
 * Display terms in flat list (for debugging or alternative display)
 */
function display_framework_path_terms_flat($terms)
{
    echo '<div class="framework-paths-flat">';
    foreach ($terms as $term) {
        $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', get_term_depth($term));
        echo '<div class="framework-path-item level-' . get_term_depth($term) . '">';
        echo $indent . '<strong>' . esc_html($term->name) . '</strong>';
        if ($term->description) {
            echo '<br>' . $indent . '<em>' . esc_html($term->description) . '</em>';
        }
        echo '</div>';
    }
    echo '</div>';
}

/**
 * Get term depth in hierarchy
 */
function get_term_depth($term, $depth = 0)
{
    if ($term->parent == 0) {
        return $depth;
    }
    $parent = get_term($term->parent);
    if (is_wp_error($parent)) {
        return $depth;
    }
    return get_term_depth($parent, $depth + 1);
}

add_shortcode('mwe-learning-paths', 'bd324_shortcode_learning_paths');

/**
 * Display sorted terms in hierarchical format with proper headers
 */
function display_sorted_framework_path_terms($sorted_terms, $taxonomy)
{
    if (empty($sorted_terms)) {
        return;
    }

    echo '<ul class="framework-path-list">';

    $i = 0;
    $count = count($sorted_terms);

    while ($i < $count) {
        $current_term = $sorted_terms[$i];

        // Only process parent terms (level 0)
        if ($current_term->parent == 0) {
            echo '<li>';
            echo '<h2>' . esc_html($current_term->name) . '</h2>';

            // Look ahead for children of this parent
            $children = [];
            $j = $i + 1;

            while ($j < $count && isset($sorted_terms[$j]) && $sorted_terms[$j]->parent == $current_term->term_id) {
                $children[] = $sorted_terms[$j];
                $j++;
            }

            if (!empty($children)) {
                // Display children with H3 headers
                echo '<ul class="framework-path-list">';
                foreach ($children as $child) {
                    echo '<li>';
                    echo '<h3>' . esc_html($child->name) . '</h3>';
                    display_framework_path_posts_for_term($child, $taxonomy);
                    echo '</li>';
                }
                echo '</ul>';

                // Skip the children we just processed
                $i = $j;
            } else {
                // No children, show posts for this parent
                display_framework_path_posts_for_term($current_term, $taxonomy);
                $i++;
            }

            echo '</li>';
        } else {
            // Skip orphaned children (shouldn't happen with proper sorting)
            $i++;
        }
    }

    echo '</ul>';
}
