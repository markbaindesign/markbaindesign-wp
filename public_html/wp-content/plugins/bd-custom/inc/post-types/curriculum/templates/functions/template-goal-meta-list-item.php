<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}


if (!function_exists('bd324_get_template_learning_goal_meta_list_item')):
    /**
     * Generates a list item for a learning goal meta with optional header and icon.
     *
     * @param string $id The unique identifier for the learning goal meta.
     * @param string $content The content to be displayed within the list item.
     * @param string|null $header Optional. The header text for the list item. Default is null.
     * @param string|null $icon Optional. The icon to be displayed alongside the header. Default is null.
     * @param array|null $extra_icon Optional. An associative array with 'url' and 'text' for an extra icon link. Default is null.
     * @return string The generated HTML for the learning goal meta list item.
     */
    function bd324_get_template_learning_goal_meta_list_item($id, $content, $header = null, $icon = null, $extra_icon = null)
    {
        $output = '';
        $output .= '<li class="learning-goal__meta learning-goal__meta--' . esc_attr($id) . '">';
        if ($header) {
            $output .= '<h2 class="learning-goal__meta__header">';
            if ($icon) {
                $output .= '<i class="icon icon--small icon--' . esc_attr($id) . '">';
                $output .= $icon;
                $output .= '</i>';
            }
            // Extra icon with link and text
            if ($extra_icon && is_array($extra_icon) && !empty($extra_icon['url']) && !empty($extra_icon['text'])) {
                $output .= '<a href="' . esc_url($extra_icon['url']) . '" class="icon-link icon--extra" target="_blank" rel="noopener">';
                $output .= '<i class="icon icon--small icon--extra"></i> ';
                $output .= '<span class="icon-text">' . esc_html($extra_icon['text']) . '</span>';
                $output .= '</a>';
            }
            $output .= '<span>' . __($header, '_BD092_curriculum_plugin') . '</span>';
            if (apply_filters('bd324_show_generic_icon', true, $id)) {
                $output .= '<i class="icon icon--small icon--generic"></i>';
            }
            $output .= '</h2>';
        }
        $output .= '<div class="learning-goal__meta__content">' . $content . '</div>';
        $output .= '</li>';
        return $output;
    }
endif;
