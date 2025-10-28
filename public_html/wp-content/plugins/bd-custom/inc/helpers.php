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

/**
 * Get post type archive link
 *
 * @param $post_type       Post type
 */
if (!function_exists('bd324_get_post_type_archive_link')):
    function bd324_get_post_type_archive_link($post_id)
    {
        $post_type = get_post_type($post_id);
        if ($post_type) {
            return get_post_type_archive_link($post_type);
        }
        return null;
    }
endif;

/**
 * Get post type archive name
 *
 * @param $post_type       Post type
 */
if (!function_exists('bd324_get_post_type_archive_name')):
    function bd324_get_post_type_archive_name($post_id)
    {
        $post_type = get_post_type($post_id);
        if ($post_type) {
            $post_type_obj = get_post_type_object($post_type);
            return $post_type_obj && !empty($post_type_obj->labels->name) ? $post_type_obj->labels->name : ucfirst($post_type);
        }
        return null;
    }
endif;
