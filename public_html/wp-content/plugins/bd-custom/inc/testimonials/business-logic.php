<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

function bd324_get_testimonial_data($testimonial_id, $context = 'single')
{
    $post_type = get_post_type($testimonial_id);

    if (empty($testimonial_id) || $post_type !== 'bd324_testimonials') {
        return null;
    }

    $testimonial_data = [
        'data_base' => bd324_get_testimonial_base_data($testimonial_id) ?? [],
        'data_client' => bd324_get_testimonial_related_client_data($testimonial_id) ?? [],
    ];

    if ($context === 'single') {
        $testimonial_data['data_projects'] = bd324_get_testimonial_related_projects($testimonial_id) ?? [];
    }

    return $testimonial_data;
}

function bd324_get_testimonial_author_name($testimonial_id)
{
    return get_the_title($testimonial_id) ?? '';
}

function bd324_get_testimonial_author_role($testimonial_id)
{
    return get_post_meta($testimonial_id, 'testimonial_role', true) ?: '';
}


/**
 * Retrieve the related client meta for a testimonial.
 *
 * Fetches the single 'related_client' post meta value for the given testimonial
 * post ID. If the meta does not exist or is empty, null is returned.
 *
 * @param int $testimonial_id Post ID of the testimonial to retrieve the related client for.
 * @return int|string|null The stored related client value (commonly an ID or slug) or null if not present.
 * @see get_post_meta()
 */
function bd324_get_testimonial_related_client($testimonial_id)
{
    return get_post_meta($testimonial_id, 'related_client', true) ?: null;
}

function bd324_get_testimonial_related_client_data($testimonial_id)
{
    $related_client_data = [];
    $related_clients = bd324_get_testimonial_related_client($testimonial_id);
    if (empty($related_clients)) {
        return [];
    }
    $related_client = $related_clients[0]; // Assuming single related client

    $client_id = $related_client->ID ?? $related_client;
    $client_name = bd324_get_client_name_by_id($client_id) ?? '';
    $client_logo = bd324_get_client_logo_by_id($client_id) ?? '';
    $client_permalink = bd324_get_client_permalink_by_id($client_id) ?? '';

    if ($client_name) {
        $related_client_data = [
            'client_name' => esc_html($client_name),
            'client_logo' => esc_url($client_logo),
            'client_permalink' => $client_permalink ?? '',
        ];
    }

    return $related_client_data; // array of client IDs
}

function bd324_get_testimonial_base_data($testimonial_id)
{
    $post_type = get_post_type($testimonial_id);
    $archive_link = bd324_get_post_type_archive_link($testimonial_id);
    $archive_name = bd324_get_post_type_archive_name($testimonial_id);
    $author = bd324_get_testimonial_author_name($testimonial_id);
    $author_role = bd324_get_testimonial_author_role($testimonial_id);
    $permalink = get_permalink($testimonial_id);
    $excerpt = get_the_excerpt($testimonial_id);
    $active_language = apply_filters('wpml_current_language', null);
    $post_id = $testimonial_id;
    $thumbnail_url = get_the_post_thumbnail_url($testimonial_id, 'full');
    $breadcrumb_link_label = $archive_name ?? null;
    $breadcrumb_link = $archive_link ?? null;
    $client_data = bd324_get_testimonial_related_client_data($testimonial_id);

    return [
        'author' => $author,
        'author_role' => $author_role,
        'permalink' => $permalink,
        'excerpt' => $excerpt,
        'active_language' => $active_language,
        'post_type' => $post_type ?? null,
        'post_id' => $post_id,
        'thumbnail_url' => $thumbnail_url,
        'breadcrumb_link_label' => $breadcrumb_link_label,
        'breadcrumb_link' => $breadcrumb_link,
    ];
}

function bd324_get_testimonial_related_projects($testimonial_id)
{
    /**
     * Calls a function in Projects business logic to get projects related to a testimonial
     */
    return bd324_get_projects_for_related_posts($testimonial_id, 'related_testimonials');
}
