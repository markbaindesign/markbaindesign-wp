<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_grade')):
    function bd324_get_template_part_learning_goal_grade($post_id)
    {
        /* Vars */
        $output = '';
        $content = get_the_term_list($post_id, 'framework-grade', '', ', ');
        if ($content && ! is_wp_error($content)) {
            $content = apply_filters('bd324_filter_convert_data', $content, false);
            $id = 'grade';
            $icon = bd324_get_icon($id);
            $label = __('Age', '_BD092_curriculum_plugin');
            $output .= bd324_get_template_learning_goal_meta_list_item($id, $content, $label, $icon);
        }
        return $output;
    }
endif;
