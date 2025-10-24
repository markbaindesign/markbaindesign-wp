<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Display navigation links for adjacent posts based on a custom field.
 *
 * @param string $custom_field_key The custom field key to sort by.
 * @return string The HTML output for the adjacent posts navigation.
 */
function BD092__display_adjacent_posts_navigation($custom_field_key)
{
    $prev_post = BD092__get_adjacent_post_by_custom_field('prev', $custom_field_key);
    $next_post = BD092__get_adjacent_post_by_custom_field('next', $custom_field_key);

    // Prev post data
    $prev_vars = $prev_post ? [
       'id' => $prev_post->ID,
       'title' => get_the_title($prev_post->ID),
       'link' => get_permalink($prev_post->ID),
       'serial' => get_field('serial', $prev_post->ID),
       'subtitle' => get_field('byline', $prev_post->ID)
    ] : null;

    // Next post data
    $next_vars = $next_post ? [
       'id' => $next_post->ID,
       'title' => get_the_title($next_post->ID),
       'link' => get_permalink($next_post->ID),
       'serial' => get_field('serial', $next_post->ID),
       'subtitle' => get_field('byline', $next_post->ID)
    ] : null;

    $output = '<nav class="adjacent-posts-navigation">';

    if ($prev_vars) {
        $output .= '<div class="prev-post">';
        $output .= '<span class="label label--arrow label--arrow--left"><i></i> ' . esc_html__('Previous', 'text-domain') . '</span>';
        $output .= bd324_get_template_part_learning_goal_postcard_mini(
            $prev_vars['id'],
            $prev_vars['serial'],
            $prev_vars['title'],
            $prev_vars['subtitle'],
            $prev_vars['link']
        );
        $output .= '</div>';
    }

    if ($next_vars) {
        $output .= '<div class="next-post">';
        $output .= '<span class="label label--arrow">' . esc_html__('Next', 'text-domain') . ' <i></i></span>';
        $output .= bd324_get_template_part_learning_goal_postcard_mini(
            $next_vars['id'],
            $next_vars['serial'],
            $next_vars['title'],
            $next_vars['subtitle'],
            $next_vars['link']
        );
        $output .= '</div>';
    }

    $output .= '</nav>';

    return $output;
}
