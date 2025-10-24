<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_domain')):
    function bd324_get_template_part_learning_goal_domain($post_id)
    {
        $output = '';
        $output = bd324_get_hierarchical_terms($post_id, 'framework-domain', __('Domain', '_BD092_curriculum_plugin'));
        return $output;
    }
endif;
