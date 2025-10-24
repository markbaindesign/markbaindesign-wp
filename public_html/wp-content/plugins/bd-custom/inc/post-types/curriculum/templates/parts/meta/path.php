<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_path')):
    function bd324_get_template_part_learning_goal_path($post_id)
    {
        $output = '';
        $output = bd324_get_hierarchical_terms($post_id, 'framework-path', __('Learning Pathways', '_BD092_curriculum_plugin'));
        return $output;
    }
endif;
