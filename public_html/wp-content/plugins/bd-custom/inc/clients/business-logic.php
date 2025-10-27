<?php

function bd324_get_client_data($client_id)
{
    if (empty($client_id) || get_post_type($client_id) !== 'clients') {
        return null;
    }

    // $client_name = bd324_get_client_name_by_id($client_id) ?: null;
    // $client_permalink = bd324_get_client_permalink_by_id($client_id) ?: null;
    // $client_external_link = bd324_get_client_external_link_by_id($client_id) ?: null;
    // $client_industries = bd324_get_client_industries($client_id) ?: [];
    // $related_projects = bd324_get_projects_by_client($client_id) ?: [];
    // $related_testimonials = bd324_get_testimonials_by_client($client_id) ?: [];
    //
    // return [
    //     'client_name' => $client_name,
    //     'client_permalink' => $client_permalink,
    //     'client_external_link' => $client_external_link,
    // ];

    $client_data = [
        'data_base' => bd324_get_client_base_data($client_id) ?? [],
    ];
    if (is_singular('clients')) {
        $client_data['data_meta'] = bd324_get_client_meta($client_id) ?? [];
        $client_data['data_testimonials'] = bd324_get_client_testimonials($client_id) ?? [];
    }
    return $client_data;
}

function bd324_get_client_base_data($client_id)
{
    $post_type = get_post_type($client_id);
    if ($post_type) {
        $archive_link = get_post_type_archive_link($post_type);
        $post_type_obj = get_post_type_object($post_type);
        $label = $post_type_obj && ! empty($post_type_obj->labels->name) ? $post_type_obj->labels->name : ucfirst($post_type);
    }

    return [
        'title' => get_the_title($client_id),
        'permalink' => get_permalink($client_id),
        'excerpt' => get_the_excerpt($client_id),
        'active_language' => apply_filters('wpml_current_language', null),
        'post_type' => $post_type ?? null,
        'thumbnail_url' => get_the_post_thumbnail_url($client_id, 'full'),
        'breadcrumb_link_label' => $label ?? null,
        'breadcrumb_link' => $archive_link ?? null,
    ];

}

function bd324_get_client_name_by_id($client_id)
{
    return get_the_title($client_id);
}

function bd324_get_client_industries($client_id)
{
    $industries = get_field('industries', $client_id);
    return $industries ?: [];
}

function bd324_get_client_permalink_by_id($client_id)
{
    return get_the_permalink($client_id);
}

function bd324_get_client_external_link_by_id($client_id)
{
    return get_field('client_external_link', $client_id);
}

function bd324_get_projects_by_client($client_id)
{
    $args = [
        'post_type' => 'project',
        'meta_query' => [
            [
                'key' => 'related_client',
                'value' => '"' . $client_id . '"',
                'compare' => 'LIKE',
            ],
        ],
    ];

    $query = new WP_Query($args);
    return $query->posts;
}

function bd324_get_client_testimonials($client_id)
{
    $testimonials = get_field('project_testimonials', $client_id);
    if (empty($testimonials)) {
        return [];
    }

    return $testimonials; // array of testimonial data
}

function bd324_get_client_meta($client_id)
{
    $meta = [];

    $data_client = bd324_get_related_client_data($client_id);
    if ($data_client) {
        $client_name = $data_client['client_name'] ?? '';
        $client_logo = $data_client['client_logo'] ?? '';
        $client_permalink = $data_client['client_permalink'] ?? '';
        if ($client_name) {
            $meta[] = [
                'label' => __('Client', '_BD092_custom_plugin'),
                'image' => esc_url($client_logo),
                'value' => esc_html($client_name) ?? '',
                'url' => $client_permalink ?? '',
            ];
        }
    }

    // Client Website
    $client_website = get_field('client_external_link', $client_id) ?? '';
    if ($client_website) {
        $meta[] = [
            'label' => 'Website',
            'value' => $client_website,
            'url' => esc_url($client_website),
            'target' => '_blank',
        ];
    }

    // Location
    $client_location = get_field('client_location', $client_id) ?? '';
    if ($client_location) {
        $meta[] = [
            'label' => 'Location',
            'value' => $client_location,
        ];
    }

    // Client Industries
    $client_industries = bd324_get_meta_terms_as_array($client_id, 'client-industry');
    if (!is_wp_error($client_industries) && !empty($client_industries)) {
        $meta[] = [
            'label' => 'Industries',
            'value' => $client_industries,
        ];
    }

    return $meta;
}
