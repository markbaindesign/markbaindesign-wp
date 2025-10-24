<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_hierarchical_terms')):
    function bd324_get_hierarchical_terms($post_id, $taxonomy, $label = null)
    {
        $output = '';
        $terms = get_the_terms($post_id, $taxonomy);

        if ($terms && !is_wp_error($terms)) {
            // Filter to only show the deepest terms (avoid showing both parent and child)
            $deepest_terms = [];
            foreach ($terms as $term) {
                $is_deepest = true;
                // Check if any other term in the list is a child of this term
                foreach ($terms as $other_term) {
                    if ($other_term->parent == $term->term_id) {
                        $is_deepest = false;
                        break;
                    }
                }
                if ($is_deepest) {
                    $deepest_terms[] = $term;
                }
            }

            // Build hierarchy with links for deepest terms only
            $hierarchies = [];
            foreach ($deepest_terms as $term) {
                $hierarchy = [];
                $current = $term;

                // Build the full path from root to current term
                $path = [];
                while ($current) {
                    array_unshift($path, $current);
                    if ($current->parent == 0) {
                        break;
                    }
                    $current = get_term($current->parent, $taxonomy);
                    if (is_wp_error($current) || !$current) {
                        break;
                    }
                }

                // Convert path to links
                foreach ($path as $path_term) {
                    $hierarchy[] = sprintf(
                        '<a href="%s">%s</a>',
                        esc_url(get_term_link($path_term)),
                        esc_html($path_term->name)
                    );
                }

                $hierarchies[] = implode(' > ', $hierarchy);
            }
            $content = implode(', ', array_unique($hierarchies));
            // $content = bd324_convert_string_to_list($content, ', ');
        }

        if (!empty($content)) {
            $content = apply_filters('bd324_filter_convert_data', $content, false);
            $id = $taxonomy;
            $icon = bd324_get_icon($id);
            if ($label) {
                $label = __($label, '_BD092_curriculum_plugin');
            } else {
                $label = '';
            }
            $output .= bd324_get_template_learning_goal_meta_list_item($id, $content, $label, $icon);
        }
        return $output;
    }
endif;
