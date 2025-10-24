<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * bd324_generate_footer_sidebar_content
 *
 * This function generates the footer sidebar content for a curriculum post.
 *
 * @param mixed $post_id The ID of the post to be processed.
 */

/**
 * Get the Curriculum Footer Sidebar Content
 *
 * This function generates the footer sidebar content for a curriculum post.
 * @param $functionParam       functionDescription
 */
if (!function_exists('bd324_get_template_part_footer_sidebar')):
    function bd324_get_template_part_footer_sidebar($post_id)
    {
        $output = '';
        $goal['id'] = $post_id;
        $goal['title'] = get_the_title($post_id);
        $output .= '<ul class="footer-sidebar">';
        $output .= '<li class="footer-sidebar__item footer-sidebar__item--printer">' . bd324_goal_print($goal) . '</li>';
        $output .= '<li class="footer-sidebar__item footer-sidebar__item--feedback">' . bd324_get_learning_goal_feedback($post_id) . '</li>';
        $output .= '<li class="footer-sidebar__item footer-sidebar__item--ai_helper"><div class="ai_helper"><button type="button" class="ai-helper-modal-trigger" @click.prevent="$store.aiHelperModal.show = true" data-post-id="' . get_the_ID() . '" data-post-title="' . esc_attr(get_the_title()) . '">' . bd324_get_icon('ai') . ' Generate AI Lesson Planning Data</button></div></li>';
        $output .= '</ul>';
        return $output;
    }
endif;
