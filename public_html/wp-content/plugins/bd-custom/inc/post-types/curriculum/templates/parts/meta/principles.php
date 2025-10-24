<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_principles')):
    function bd324_get_template_part_learning_goal_principles($post_id)
    {
        /* Vars */
        $output = '';
        $content = '';
        $terms = get_the_terms($post_id, 'framework-principles');
        $page_url = get_site_url(null, '/framework/guiding-principles/');
        if ($terms && !is_wp_error($terms)) {
            $content = '<ul>';
            foreach ($terms as $term) {
                $content .= '<li><a href="' . $page_url . '" title="' . $term->description . '">' . esc_html($term->name) . '</a></li>';
            }
            $content .= '</ul>';
        }
        if ($content && ! is_wp_error($content)) {
            $content = apply_filters('bd324_filter_convert_data', $content, false);
            $id = 'principles';
            $icon = bd324_get_icon($id);
            $label = __('Guiding Principles', '_BD092_curriculum_plugin');
            $output .= bd324_get_template_learning_goal_meta_list_item($id, $content, $label, $icon);
        }
        return $output;
    }
endif;
