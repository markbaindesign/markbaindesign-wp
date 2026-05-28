<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

function bd324_register_all_post_types_and_taxonomies()
{
    // Register Post Types
    bd324_register_post_type('bd324_clients', [
        'name' => 'Clients',
        'singular_name' => 'Client',
        'plural_name' => 'Clients',
        'menu_icon' => 'dashicons-tagcloud',
        'menu_name' => 'Clients',
        'rewrite_slug' => 'clients',
        'menu_position' => 5
    ]);

    bd324_register_post_type('bd324_projects', [
        'name' => 'Projects',
        'singular_name' => 'Portfolio Project',
        'plural_name' => 'Portfolio Projects',
        'menu_name' => 'Projects',
        'menu_icon' => 'dashicons-tagcloud',
        'menu_position' => 5,
        'rewrite_slug' => 'portfolio'
    ]);

    bd324_register_post_type('bd324_testimonials', [
        'name' => 'Client Testimonials',
        'singular_name' => 'Client Testimonial',
        'plural_name' => 'Client Testimonials',
        'menu_icon' => 'dashicons-tagcloud',
        'menu_name' => 'Testimonials',
        'rewrite_slug' => 'testimonials',
        'menu_position' => 5
    ]);

    bd324_register_post_type('bd324_services', [
        'name'          => 'Services',
        'singular_name' => 'Service',
        'plural_name'   => 'Services',
        'menu_name'     => 'Services',
        'menu_icon'     => 'dashicons-hammer',
        'menu_position' => 5,
        'rewrite_slug'  => 'services',
        'hierarchical'  => true,
        'has_archive'   => true,
    ]);

    // Register Taxonomies
    bd324_register_taxonomy('client-industry', ['bd324_clients'], [
        'singular_name' => 'Client Industry',
        'plural_name' => 'Client Industries',
        'menu_name' => 'Client Industries'
    ]);

    bd324_register_taxonomy('project-category-service', ['bd324_projects'], [
        'singular_name' => 'Service',
        'plural_name' => 'Services',
        'menu_name' => 'Services',
        'rewrite_slug' => 'project-category/service'
    ]);

    bd324_register_taxonomy('project-category-tool', ['bd324_projects'], [
        'singular_name' => 'Tool or Library',
        'plural_name' => 'Tools & Libraries',
        'menu_name' => 'Tools & Libraries',
        'rewrite_slug' => 'project-category/tool'
    ]);

    bd324_register_taxonomy('project-category-tech-stack', ['bd324_projects'], [
        'singular_name' => 'Tech Stack',
        'plural_name' => 'Tech Stack',
        'menu_name' => 'Tech Stack',
        'rewrite_slug' => 'project-category/tech-stack'
    ]);

    bd324_register_taxonomy('project-category-profile', ['bd324_projects'], [
        'singular_name' => 'Profile',
        'plural_name' => 'Profiles',
        'menu_name' => 'Profiles',
        'rewrite_slug' => 'project-category/profile'
    ]);
}

add_action('init', 'bd324_register_all_post_types_and_taxonomies', 0);
