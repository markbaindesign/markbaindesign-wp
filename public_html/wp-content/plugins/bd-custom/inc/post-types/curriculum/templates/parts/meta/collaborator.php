<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_collaborator')):
    function bd324_get_template_part_learning_goal_collaborator($post_id)
    {
        /* Vars */
        $output = '';
        $content = '';
        $terms = get_the_terms($post_id, 'framework-collaborator');
        if ($terms && !is_wp_error($terms)) {
            $content = '<ul>';
            foreach ($terms as $term) {
                $term_link = get_term_link($term, 'framework-collaborator');
                $content .= '<li>';
                if (!is_wp_error($term_link)) {
                    $content .= '<a href="' . $term_link . '" title="' . esc_attr($term->description) . '">';
                    $content .= esc_html($term->name);
                    $content .= '</a>';
                } else {
                    $content .= esc_html($term->name);
                }
                $content .= '</li>';
            }
            $content .= '</ul>';
        }
        if ($content && ! is_wp_error($content)) {
            $content = apply_filters('bd324_filter_convert_data', $content, false);
            $id = 'collaborator';
            $icon = bd324_get_icon($id);
            $label = __('Featured Partners', '_BD092_curriculum_plugin');
            $output .= bd324_get_template_learning_goal_meta_list_item($id, $content, $label, $icon);
        }
        return $output;
    }
endif;
