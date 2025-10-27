<?php

function bd324_get_client_data($client_id)
{
    if (empty($client_id) || get_post_type($client_id) !== 'clients') {
        return null;
    }

    $client_name = get_the_title($client_id) ?: null;
    $client_permalink = bd324_get_client_permalink_by_id($client_id) ?: null;
    $client_external_link = bd324_get_client_external_link_by_id($client_id) ?: null;

    return [
        'client_name' => $client_name,
        'client_permalink' => $client_permalink,
        'client_external_link' => $client_external_link,
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
