<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Get header part for LG template
 *
 * @param $post_id
 */
if (!function_exists('bd324_get_template_part_learning_goal_header')):
    function bd324_get_template_part_learning_goal_header($post_id)
    {
        // Set context and post ID for unified template
        set_query_var('header_context', 'single');
        set_query_var('header_post_id', $post_id);

        // Buffer the unified template output
        ob_start();
        get_template_part('inc/templates/curriculum/shared/header-unified');
        $output = ob_get_clean();

        return $output;
    }
endif;
