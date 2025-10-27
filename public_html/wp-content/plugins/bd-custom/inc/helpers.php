<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

function bd324_get_meta_terms_as_array($post_id, $taxonomy)
{
    $terms = wp_get_post_terms($post_id, $taxonomy);
    if (is_wp_error($terms) || empty($terms)) {
        return [];
    }

    $terms_data = array_map(function ($term) {
        return [
            'value' => $term->name,
            'url' => get_term_link($term)
        ];
    }, $terms);

    return $terms_data;
}
