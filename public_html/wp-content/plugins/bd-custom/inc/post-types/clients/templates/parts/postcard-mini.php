<?php

use WPDM\__\Apply;

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Get Quote
 *
 * Retrieves a quote associated with a given post ID.
 *
 * @param int $post_id The ID of the post to retrieve the quote from.
 * @return string The quote associated with the given post ID.
 */
if (!function_exists('bd324_get_template_part_learning_goal_postcard_mini')):
    function bd324_get_template_part_learning_goal_postcard_mini(
        $post_id,
        $serial = false,
        $title = false,
        $subtitle = false,
        $permalink = false,
        $content = false
    ) {

        if ($serial) {
            $serial = apply_filters('bd324_filter_lg_mini_postcard_param_serial', $serial, $post_id);
        }
        if ($title) {
            $title = apply_filters('bd324_filter_lg_mini_postcard_param_title', $title, $post_id);
        }
        if ($subtitle) {
            $subtitle = apply_filters('bd324_filter_lg_mini_postcard_param_subtitle', $subtitle, $post_id);
        }
        if ($permalink) {
            $permalink = apply_filters('bd324_filter_lg_mini_postcard_param_permalink', $permalink, $post_id);
        }
        if ($content) {
            $content = apply_filters('bd324_filter_lg_mini_postcard_param_content', $content, $post_id);
        }
        $output = '<div class="learning-goal__postcard--mini">';

        if ($serial) {
            $output .= apply_filters('bd324_filter_lg_mini_postcard_serial', sprintf('<span class="serial">%s</span>', $serial), $post_id);
        }

        if ($title) {
            $output .= '<span class="title">';
            if ($permalink) {
                $output .= sprintf(
                    '<a href="%s" title="%s">',
                    apply_filters('bd324_filter_lg_mini_postcard_link', $permalink, $post_id),
                    apply_filters('bd324_filter_lg_mini_postcard_link_title', __('Visit this learning goal', '_BD092_curriculum_plugin'), $post_id)
                );
            }
            $output .= apply_filters('bd324_filter_lg_mini_postcard_link_label', bd324_convert_asterisks_to_italics($title), $post_id);
            if ($permalink) {
                $output .= '</a>';
            }
            $output .= apply_filters('bd324_filter_lg_mini_postcard_link_favorite', bd324_get_template_part_like($post_id), $post_id);
            $output .= '</span>';
        }

        if ($subtitle) {
            $output .= apply_filters('bd324_filter_lg_mini_postcard_subtitle', sprintf('<span class="subtitle">%s</span>', bd324_convert_asterisks_to_italics($subtitle)), $post_id);
        }

        if ($content) {
            $output .= apply_filters('bd324_filter_lg_mini_postcard_content', sprintf('<span class="content">%s</span>', bd324_convert_asterisks_to_italics($content)), $post_id);
        }

        $output .= '</div>';
        $output = apply_filters('bd324_filter_lg_mini_postcard', $output, $post_id, $serial, $title, $subtitle, $permalink, $content);
        return $output;
    }
endif;
