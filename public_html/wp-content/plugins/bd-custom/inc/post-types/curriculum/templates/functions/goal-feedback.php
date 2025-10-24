<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Get Feedback for a Learning Goal
 *
 * This function retrieves feedback for a specific learning goal.
 * @param $post_id       The ID of the post for which feedback is to be retrieved.
 * @return string       The feedback content for the learning goal.
 */
if (!function_exists('bd324_get_learning_goal_feedback')):
    function bd324_get_learning_goal_feedback($post_id)
    {
        /* Vars */
        $output = '';
        $serial = get_field('serial', $post_id);
        $url = 'https://docs.google.com/forms/d/e/1FAIpQLScOSs9Wrzxgorv6IZ-6zu5lgHuFqXeS0_h_scd_pzVIaMNHZw/viewform?usp=pp_url&entry.1640393996=' . urlencode($serial);
        $output .= '<div class="feedback">';
        $output .= '<span class="label--icon">';
        $output .= '<a href="' . $url . '" class="learning-goal-feedback-link" data-post-id="' . $post_id . '" data-post-title="' . esc_attr(get_the_title($post_id)) . '" target=_blank>';
        $output .= '<i class="icon icon--small">';
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">';
        $output .= '<!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->';
        $output .= '<path d="M256 64C125.8 64 32 148.6 32 240c0 37.1 15.5 70.6 40 100c5.2 6.3 8.4 14.8 7.4 23.9c-3.1 27-11.4 52.5-25.7 76.3c-.5 .9-1.1 1.8-1.6 2.6c11.1-2.9 22.2-7 32.7-11.5L91.2 446l-6.4-14.7c17-7.4 33-16.7 48.4-27.4c8.5-5.9 19.4-7.5 29.2-4.2C193 410.1 224.1 416 256 416c130.2 0 224-84.6 224-176s-93.8-176-224-176zM0 240C0 125.2 114.5 32 256 32s256 93.2 256 208s-114.5 208-256 208c-36 0-70.5-6.7-103.8-17.9c-.2-.1-.5 0-.7 .1c-16.9 11.7-34.7 22.1-53.9 30.5C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.8s-1.1-12.8 3.4-17.4c8.1-8.2 15.2-18.2 21.7-29c11.7-19.6 18.7-40.6 21.3-63.1c0 0-.1-.1-.1-.2C19.6 327.1 0 286.6 0 240z"/>';
        $output .= '</svg>';
        $output .= '</i>';
        $output .= '<span class="label__text">' . __('Offer Feedback on this Learning Goal', '_BD092_curriculum_plugin') . '</span>';
        $output .= ' <span class="icon icon--small icon--external">';
        $output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">';
        $output .= '<!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.-->';
        $output .= '<path d="M384 64c17.7 0 32 14.3 32 32v320c0 17.7-14.3 32-32 32H64c-17.7 0-32-14.3-32-32V96c0-17.7 14.3-32 32-32h320zm64 32c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96v320c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V96zm-280 64c-8.8 0-16 7.2-16 16s7.2 16 16 16h97.4L132.7 324.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L288 214.6V320c0 8.8 7.2 16 16 16s16-7.2 16-16V176c0-8.8-7.2-16-16-16H168z"/>';
        $output .= '</svg>';
        $output .= '</span>';
        $output .= '</a>';
        $output .= '</span>';
        $output .= '</div>';
        // Return the output
        return $output;
    }
endif;
