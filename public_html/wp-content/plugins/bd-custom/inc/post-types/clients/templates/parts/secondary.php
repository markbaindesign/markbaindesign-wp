<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * bd324_generate_secondary_content
 *
 * This function generates the secondary content for a curriculum post.
 *
 * @param mixed $post_id The ID of the post to be processed.
 */

if (!function_exists('bd324_generate_learning_goal_secondary_content')):
    function bd324_generate_learning_goal_secondary_content($post_id)
    {
        $output = '';
        $output .= '<div class="content__secondary">';
        $output .= '<div class="gdlr-portfolio-style2">';
        $output .= '<div class="gdlr-portfolio-info">';

        $template_parts = [
           'bd324_get_template_part_learning_goal_quote',
           'bd324_get_template_part_learning_goal_domain',
           'bd324_get_template_part_learning_goal_grade',
           'bd324_get_template_part_learning_goal_related',
           'bd324_get_template_part_learning_goal_topics',
           'bd324_get_template_part_learning_goal_vocabulary',
           'bd324_get_template_part_learning_goal_resources',
           'bd324_get_template_part_learning_goal_books',
           'bd324_get_template_part_learning_goal_strand',
           'bd324_get_template_part_learning_goal_path',
           'bd324_get_template_part_learning_goal_principles',
           'bd324_get_template_part_learning_goal_dispositions',
        ];

        // Quote is outside the <ul>
        if (function_exists($template_parts[0])) {
            $output .= call_user_func($template_parts[0], $post_id);
        }

        $output .= '<ul class="">';

        // The rest go inside the <ul>
        foreach (array_slice($template_parts, 1) as $func) {
            if (function_exists($func)) {
                $output .= call_user_func($func, $post_id);
            }
        }
        $output .= bd324_get_template_part_footer_sidebar($post_id);
        $output .= '</ul>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';

        return $output;
    }
endif;
