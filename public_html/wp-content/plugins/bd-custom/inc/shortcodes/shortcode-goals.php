<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}


/**
 * Plugin fallback function for sorting query args
 * Used when theme function is not available
 */
if (!function_exists('bd324_plugin_get_sort_query_args')):
    function bd324_plugin_get_sort_query_args($sort)
    {
        switch ($sort) {
            case 'title_asc':
            case 'title_desc':
            case 'title_clean_asc':
            case 'title_clean_desc':
                // Title sorting will be handled by custom function, just return basic args
                return [];
            case 'serial_asc':
                return ['meta_key' => 'serial', 'orderby' => 'meta_value_num', 'order' => 'ASC'];
            case 'menu_order':
                return ['orderby' => 'menu_order', 'order' => 'ASC'];
            case 'date_desc':
                return ['orderby' => 'date', 'order' => 'DESC'];
            case 'date_asc':
                return ['orderby' => 'date', 'order' => 'ASC'];
            default:
                return [];
        }
    }
endif;

/**
 * Custom sorting function to ignore asterisks and special characters
 */
if (!function_exists('bd324_sort_posts_by_clean_title')):
    function bd324_sort_posts_by_clean_title($posts, $order = 'ASC')
    {
        usort($posts, function ($a, $b) use ($order) {
            // Clean titles by removing asterisks, extra spaces, and trimming
            $title_a = trim(preg_replace('/[\*\s]+/', ' ', $a->post_title));
            $title_b = trim(preg_replace('/[\*\s]+/', ' ', $b->post_title));

            $comparison = strcasecmp($title_a, $title_b);

            return ($order === 'DESC') ? -$comparison : $comparison;
        });

        return $posts;
    }
endif;

/**
 * Learning Goals Shortcode
 *
 * Displays a list of learning goals.
 *
 * @param array $atts Shortcode attributes:
 *   - terms: Comma-separated list of taxonomy terms
 *   - tax: Taxonomy name
 *   - id: Comma-separated list of post IDs
 *   - template: Display template ('list' or default)
 *   - show_serial: Show serial number (true/false)
 *   - show_title: Show title (true/false)
 *   - show_subtitle: Show subtitle (true/false)
 *   - show_permalink: Show permalink (true/false)
 *   - show_favorite: Show favorite button (true/false)
 *   - show_content: Show content excerpt (true/false)
 *   - sort: Sorting option (title_asc, title_desc, serial_asc, menu_order, date_desc, date_asc) - title sorting always ignores asterisks
 *
 * @return string HTML content of the learning goals list
 */

if (!function_exists('bd324_lg_shortcode')):
    function bd324_lg_shortcode($atts = array())
    {
        extract(shortcode_atts(array(
            'terms' => '',
            'tax' => '',
            'id' => '',
            'template' => 'list',
            'show_serial' => true,
            'show_title' => true,
            'show_subtitle' => true,
            'show_permalink' => true,
            'show_favorite' => true,
            'show_content' => true,
            'sort' => 'title_asc',      // Add sorting parameter
            'debug' => false,           // Debug parameter to show query info
            'priority_terms' => '',     // Comma-separated list of terms to prioritize at the top
            'term_order' => 'default',
        ), $atts));

        // Default query args
        $args = array(
            'post_type' => 'curriculum',
            'posts_per_page' => -1, // Show all posts
        );

        if (isset($atts["id"])) {
            // Allow for a comma-separated list of IDs
            $ids = array_map('trim', explode(',', $atts["id"]));
            if (count($ids) === 1) {
                $args['p'] = $ids[0]; // Single post by ID
            } else {
                $args['post__in'] = $ids; // Multiple posts by IDs
            }
        } elseif (isset($atts["tax"]) && isset($atts["terms"])) {
            $tax = $atts["tax"];
            $terms = $atts["terms"];
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => explode(',', $terms), // Convert comma-separated string to array
                    'operator' => 'IN', // Match any of the terms
                ),
            );
        } else {
            return;
        }

        // Apply sorting to query args
        if (isset($atts['sort'])) {
            if (function_exists('bd324_get_sort_query_args')) {
                $sort_args = bd324_get_sort_query_args($atts['sort']);
                $args = array_merge($args, $sort_args);
            } else {
                // Fallback sorting if theme function isn't available
                $sort_args = bd324_plugin_get_sort_query_args($atts['sort']);
                $args = array_merge($args, $sort_args);
            }
        }

        // Debug output if requested
        $debug_info = '';
        if (filter_var($atts['debug'], FILTER_VALIDATE_BOOLEAN)) {
            $debug_info = '<div style="background: #f1f1f1; padding: 10px; margin: 10px 0; font-family: monospace; font-size: 12px;">';
            $debug_info .= '<strong>Shortcode Debug Info:</strong><br>';
            $debug_info .= 'Sort parameter: ' . ($atts['sort'] ?? 'not set') . '<br>';
            $debug_info .= 'Query args: <pre>' . print_r($args, true) . '</pre>';
            $debug_info .= 'bd324_sort_posts_by_clean_title function exists: ' . (function_exists('bd324_sort_posts_by_clean_title') ? 'YES' : 'NO') . '<br>';
            $debug_info .= '<strong>Note:</strong> Shortcode shows ALL posts (no pagination) - posts_per_page = -1<br>';
            $debug_info .= '</div>';
        }

        // Create a new WP_Query instance
        $query = new WP_Query($args);

        // Check if there are posts
        if (!$query->have_posts()) {
            return $debug_info . '<p>No posts found.</p>';
        }

        // Apply custom sorting for all title sorting (always ignore asterisks)
        if (isset($atts['sort']) && in_array($atts['sort'], ['title_asc', 'title_desc', 'title_clean_asc', 'title_clean_desc'])) {
            $order = (in_array($atts['sort'], ['title_desc', 'title_clean_desc'])) ? 'DESC' : 'ASC';

            // Debug output for sorting
            if (filter_var($atts['debug'], FILTER_VALIDATE_BOOLEAN)) {
                $debug_info .= '<div style="background: orange; padding: 10px; margin: 10px 0; font-family: monospace; font-size: 12px;">';
                $debug_info .= '<strong>Shortcode Sorting Debug:</strong><br>';
                $debug_info .= 'Applying custom title sorting with order: ' . $order . '<br>';
                $debug_info .= 'Posts before sorting: ' . count($query->posts) . '<br>';
                if (count($query->posts) > 0) {
                    $debug_info .= 'First post title before: ' . $query->posts[0]->post_title . '<br>';
                }
                $debug_info .= '</div>';
            }

            $query->posts = bd324_sort_posts_by_clean_title($query->posts, $order);
            $query->post_count = count($query->posts);

            // Debug output after sorting
            if (filter_var($atts['debug'], FILTER_VALIDATE_BOOLEAN)) {
                $debug_info .= '<div style="background: lightgreen; padding: 10px; margin: 10px 0; font-family: monospace; font-size: 12px;">';
                $debug_info .= '<strong>After Sorting:</strong><br>';
                $debug_info .= 'Posts after sorting: ' . count($query->posts) . '<br>';
                if (count($query->posts) > 0) {
                    $debug_info .= 'First post title after: ' . $query->posts[0]->post_title . '<br>';
                }
                $debug_info .= '</div>';
            }
        }

        // Vars
        $content = '';
        $terms = '';
        $template = '';

        if (isset($atts["template"])) {
            $template = $atts["template"];
        }
        if (isset($atts["show_serial"])) {
            $show_serial = filter_var($atts["show_serial"], FILTER_VALIDATE_BOOLEAN);
        }
        if (isset($atts["show_title"])) {
            $show_title = filter_var($atts["show_title"], FILTER_VALIDATE_BOOLEAN);
        }
        if (isset($atts["show_subtitle"])) {
            $show_subtitle = filter_var($atts["show_subtitle"], FILTER_VALIDATE_BOOLEAN);
        }
        if (isset($atts["show_permalink"])) {
            $show_permalink = filter_var($atts["show_permalink"], FILTER_VALIDATE_BOOLEAN);
        }
        if (isset($atts["show_content"])) {
            $show_content = filter_var($atts["show_content"], FILTER_VALIDATE_BOOLEAN);
        }

        // Classes
        $classes = array(
            'framework-card-list',
        );
        if ($template) {
            $classes[] = 'framework-card-list--' . $template;
        }

        $classes = apply_filters('bd324_filter_lg_shortcode_classes', $classes, $atts);
        $classes = implode(' ', $classes);

        ob_start();

        ?>
        <?php echo $debug_info; ?>
        <ul class="<?php echo esc_attr($classes); ?>">
            <?php while ($query->have_posts()) {
                $query->the_post();
                $post_id = get_the_ID();
                ?>
                <li class="framework-card-list__item">
                    <?php
                    if ($template === 'list') {
                        $goal_data = bd324_get_learning_goal_data($post_id);
                        get_template_part('inc/templates/curriculum/cards/card', null, ['goal_data' => $goal_data]);
                    } else {
                        if (function_exists('bd324_get_template_part_learning_goal_postcard_mini')) {
                            echo bd324_get_template_part_learning_goal_postcard_mini(
                                $post_id,
                                $show_serial ? get_field('serial', $post_id) : '',
                                $show_title ? get_the_title($post_id) : '',
                                $show_subtitle ? get_field('byline', $post_id) : '',
                                $show_permalink ? get_permalink($post_id) : '',
                                $show_content ? strip_tags(get_field('action', $post_id), '<a><span><strong><em><b><i><u>') : ''
                            );
                        }
                    }
                ?>
                </li>
            <?php } ?>
        </ul>
<?php
        $content =  ob_get_contents();
        ob_clean();
        return $content;
    }
endif;
add_shortcode('mwe-learning-goals', 'bd324_lg_shortcode');
