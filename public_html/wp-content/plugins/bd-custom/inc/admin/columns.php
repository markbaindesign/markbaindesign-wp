<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

// --- Testimonials admin list columns ---

add_filter('manage_bd324_testimonials_posts_columns', 'bd324_testimonials_columns');
function bd324_testimonials_columns($columns) {
    $reordered = array('cb' => $columns['cb']);
    $reordered['thumbnail'] = __('Image', 'bd-custom');
    unset($columns['cb']);
    return array_merge($reordered, $columns);
}

add_action('manage_bd324_testimonials_posts_custom_column', 'bd324_testimonials_column_content', 10, 2);
function bd324_testimonials_column_content($column, $post_id) {
    if ('thumbnail' !== $column) {
        return;
    }
    $thumb = get_the_post_thumbnail($post_id, array(60, 60));
    if ($thumb) {
        echo $thumb;
    } else {
        echo '<span style="color:#999;">—</span>';
    }
}

add_action('admin_head', 'bd324_testimonials_column_styles');
function bd324_testimonials_column_styles() {
    global $typenow;
    if ('bd324_testimonials' !== $typenow) {
        return;
    }
    echo '<style>.column-thumbnail { width: 70px; } .column-thumbnail img { display:block; width:60px; height:60px; object-fit:cover; border-radius:3px; }</style>';
}
