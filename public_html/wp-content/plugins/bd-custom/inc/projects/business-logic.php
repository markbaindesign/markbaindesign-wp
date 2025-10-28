<?php

function bd324_get_project_data($post_id)
{

    $data = [
        'data_base' => bd324_get_project_base_data($post_id) ?? [],
    ];
    if (is_singular('portfolio_item')) {
        $data['data_meta'] = bd324_get_project_meta($post_id) ?? [];
        $data['data_testimonials'] = bd324_get_project_testimonials($post_id) ?? [];
    }
    return $data;
}

function bd324_get_projects_by_type_and_year($project_type, $project_year)
{
    $args = [
        'post_type' => 'project',
        'meta_query' => [
            [
                'key' => 'project_type',
                'value' => $project_type,
                'compare' => '=',
            ],
            [
                'key' => 'project_year',
                'value' => $project_year,
                'compare' => '=',
            ],
        ],
    ];

    $query = new WP_Query($args);
    return $query->posts;
}

function bd324_get_project_terms($project_id, $taxonomy)
{
    $terms = wp_get_post_terms($project_id, $taxonomy);
    if (is_wp_error($terms) || empty($terms)) {
        return [];
    }

    return $terms; // array of WP_Term objects
}

function bd324_get_project_base_data($post_id)
{
    $post_type = get_post_type($post_id);
    if ($post_type) {
        $archive_link = get_post_type_archive_link($post_type);
        $post_type_obj = get_post_type_object($post_type);
        $label = $post_type_obj && ! empty($post_type_obj->labels->name) ? $post_type_obj->labels->name : ucfirst($post_type);
    }

    return [
        'title' => get_the_title($post_id),
        'permalink' => get_permalink($post_id),
        'excerpt' => get_the_excerpt($post_id),
        'active_language' => apply_filters('wpml_current_language', null),
        'post_type' => $post_type ?? null,
        'thumbnail_url' => get_the_post_thumbnail_url($post_id, 'full'),
        'breadcrumb_link_label' => $label ?? null,
        'breadcrumb_link' => $archive_link ?? null,
    ];

}

function bd324_get_project_testimonials($project_id)
{
    $data_testimonials = [];

    $testimonials = get_field('related_testimonials', $project_id);
    if (empty($testimonials)) {
        return [];
    }
    foreach ($testimonials as $testimonial) {
        $testimonial_id = $testimonial->ID ?? null;
        $related_client = get_field('related_client', $testimonial_id);
        $author_name = bd324_get_testimonial_author_name($testimonial_id) ?? '';
        $author_role = bd324_get_testimonial_author_role($testimonial_id) ?? '';

        // Related
        $related_client = get_field('related_client', $testimonial_id)  ?? null;
        if ($related_client && is_array($related_client) && count($related_client) > 0) {
            $related_client = $related_client[0]; // Assuming single related client
            $related_client_name = $related_client->post_title ?? '';
        } else {
            $related_client_name = '';
        }

        $data_testimonials[] = [
            'post_id' => $testimonial_id,
            'post_type' => $testimonial->post_type ?? null,

            'title' => esc_html($testimonial->title ?? ''),
            'content' => get_the_content(null, false, $testimonial->ID ?? null),
            'excerpt' => get_the_excerpt($testimonial->ID ?? null),
            'permalink' => get_the_permalink($testimonial->ID ?? null) ?? '',

            'image' => get_the_post_thumbnail($testimonial->ID ?? null, 'full') ? get_the_post_thumbnail_url($testimonial->ID ?? null, 'thumbnail') : '',

            'author' => esc_html($author_name),
            'role' => esc_html($author_role),
            'company' => esc_html($related_client_name),
        ];
    }
    return $data_testimonials;
}

function bd324_get_related_client_data($post_id)
{
    $related_client_data = [];
    $related_clients = get_field('related_client', $post_id);
    if (empty($related_clients)) {
        return [];
    }
    $related_client = $related_clients[0]; // Assuming single related client

    $client_id = $related_client->ID ?? null;
    $client_name = $related_client->post_title ?? '';
    $client_logo = get_the_post_thumbnail_url($client_id, 'full') ?? '';
    $client_permalink = get_the_permalink($client_id) ?? '';

    if ($client_name) {
        $related_client_data = [
            'client_name' => esc_html($client_name),
            'client_logo' => esc_url($client_logo),
            'client_permalink' => $client_permalink ?? '',
        ];
    }

    return $related_client_data; // array of client IDs
}

function bd324_get_project_meta($post_id)
{
    $meta = [];

    $data_client = bd324_get_related_client_data($post_id);
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

    // Project Website
    $project_website = get_field('website', $post_id) ?? '';
    if ($project_website) {
        $meta[] = [
            'label' => 'Website',
            'value' => $project_website,
            'url' => esc_url($project_website),
            'target' => '_blank',
        ];
    }

    // Project Year
    $project_year = get_field('project_end', $post_id) ?? '';
    if ($project_year instanceof DateTime) {
        $project_year = $project_year->format('Y');
    }
    if ($project_year) {
        $meta[] = [
            'label' => 'Year',
            'value' => $project_year,
        ];
    }

    // Project Type
    $project_type = get_field('project_type', $post_id) ?? '';
    if ($project_type) {
        $meta[] = [
            'label' => 'Type',
            'value' => $project_type,
        ];
    }

    // Project Services
    $project_services = bd324_get_meta_terms_as_array($post_id, 'project-category-service');
    if (!is_wp_error($project_services) && !empty($project_services)) {
        $meta[] = [
            'label' => 'Services',
            'value' => $project_services,
        ];
    }

    // Project Tools
    $project_tools = bd324_get_meta_terms_as_array($post_id, 'project-category-tool');
    if (!is_wp_error($project_tools) && !empty($project_tools)) {
        $meta[] = [
            'label' => 'Tools',
            'value' => $project_tools,
        ];
    }

    // Project Tech Stack
    $project_stack = bd324_get_meta_terms_as_array($post_id, 'project-category-tech-stack');
    if (!is_wp_error($project_stack) && !empty($project_stack)) {
        $meta[] = [
            'label' => 'Tech Stack',
            'value' => $project_stack,
        ];
    }

    // Profile
    $project_profile = bd324_get_meta_terms_as_array($post_id, 'project-category-profile');
    if (!is_wp_error($project_profile) && !empty($project_profile)) {
        $meta[] = [
            'label' => 'Profile',
            'value' => $project_profile,
        ];
    }

    return $meta;
}

function bd324_get_projects_for_related_posts($post_id, $key)
{
    $args = [
        'post_type' => 'portfolio_item',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => $key,
                'value' => '"' . $post_id . '"',
                'compare' => 'LIKE',
            ],
        ],
    ];

    $query = new WP_Query($args);
    $posts = $query->posts ?? [];

    $projects = [];
    if ($posts) {
        foreach ($posts as $post) {

            // Get the year
            $year = get_field('project_end', $post->ID) ?? '';
            $formatted_year = '';
            if ($year) {
                $formatted_year = date('Y', strtotime($year));
            }
            $projects[] = [
                'title' => get_the_title($post->ID),
                'permalink' => get_permalink($post->ID),
                'excerpt' => get_the_excerpt($post->ID),
                'thumbnail' => get_the_post_thumbnail_url($post->ID, 'full'),
                'year' => $formatted_year,
            ];
        }
        wp_reset_postdata();
    }
    return $projects;
}
