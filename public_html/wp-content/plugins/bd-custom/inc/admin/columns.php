<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

// --- Testimonials admin list columns ---

add_filter('manage_bd324_testimonials_posts_columns', 'bd324_testimonials_columns');
function bd324_testimonials_columns($columns) {
    $reordered = array('cb' => $columns['cb']);
    $reordered['thumbnail']        = __('Image', 'bd-custom');
    $reordered['related_client']   = __('Client', 'bd-custom');
    $reordered['related_projects'] = __('Projects', 'bd-custom');
    unset($columns['cb']);
    return array_merge($reordered, $columns);
}

add_action('manage_bd324_testimonials_posts_custom_column', 'bd324_testimonials_column_content', 10, 2);
function bd324_testimonials_column_content($column, $post_id) {
    switch ($column) {

        case 'thumbnail':
            $thumb = get_the_post_thumbnail($post_id, array(60, 60));
            echo $thumb ? $thumb : '<span style="color:#999;">—</span>';
            break;

        case 'related_client':
            $client = bd324_get_testimonial_related_client($post_id);
            if (!empty($client)) {
                $client_id    = is_object($client[0]) ? $client[0]->ID : $client[0];
                $client_title = get_the_title($client_id);
                $client_url   = get_edit_post_link($client_id);
                echo '<a href="' . esc_url($client_url) . '">' . esc_html($client_title) . '</a>';
            } else {
                echo '<span style="color:#999;">—</span>';
            }
            break;

        case 'related_projects':
            $projects = bd324_get_testimonial_related_projects($post_id);
            if (!empty($projects)) {
                $links = array();
                foreach ($projects as $project) {
                    $project_id  = is_array($project) ? $project['ID'] : $project->ID;
                    $project_url = get_edit_post_link($project_id);
                    $links[]     = '<a href="' . esc_url($project_url) . '">' . esc_html(get_the_title($project_id)) . '</a>';
                }
                echo implode('<br>', $links);
            } else {
                echo '<span style="color:#999;">—</span>';
            }
            break;
    }
}

add_action('admin_head', 'bd324_testimonials_column_styles');
function bd324_testimonials_column_styles() {
    global $typenow;
    if ('bd324_testimonials' !== $typenow) {
        return;
    }
    echo '<style>
        .column-thumbnail { width: 70px; }
        .column-thumbnail img { display:block; width:60px; height:60px; object-fit:cover; border-radius:3px; }
        .column-related_client { width: 160px; }
        .column-related_projects { width: 200px; }
    </style>';
}
