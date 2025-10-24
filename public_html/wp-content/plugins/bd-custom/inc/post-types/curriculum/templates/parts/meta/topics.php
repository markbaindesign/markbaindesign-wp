<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_topics')):
    function bd324_get_template_part_learning_goal_topics($post_id)
    {
        $output = '';
        $content = get_the_term_list($post_id, 'framework-topic', '', ', ');
        // $content = get_field('related_topics', $post_id);
        if ($content && ! is_wp_error($content)) {
            $content = apply_filters('bd324_filter_convert_data', $content, false);
            $id = 'topics';
            $icon = bd324_get_icon($id);
            $label = __('Tags', '_BD092_curriculum_plugin');
            $output .= bd324_get_template_learning_goal_meta_list_item($id, $content, $label, $icon);
        }
        return $output;
    }
endif;
