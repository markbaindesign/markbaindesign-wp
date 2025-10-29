<?php

function bd324_register_post_type($post_type_key, $config)
{
    $defaults = [
        'name' => ucfirst($post_type_key),
        'singular_name' => ucfirst($post_type_key),
        'plural_name' => ucfirst($post_type_key),
        'menu_name' => ucfirst($post_type_key),
        'description' => '',
        'menu_icon' => 'dashicons-admin-post',
        'menu_position' => 5,
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'page-attributes'],
        'taxonomies' => [],
        'public' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'rewrite_slug' => $post_type_key,
        'capability_type' => 'page'
    ];

    $config = wp_parse_args($config, $defaults);

    $labels = [
        'name' => _x($config['name'], 'Post Type General Name', '_BD092_custom_plugin'),
        'singular_name' => _x($config['singular_name'], 'Post Type Singular Name', '_BD092_custom_plugin'),
        'plural_name' => _x($config['plural_name'], 'Post Type Plural Name', '_BD092_custom_plugin'),
        'menu_name' => __($config['menu_name'], '_BD092_custom_plugin'),
        'name_admin_bar' => __($config['menu_name'], '_BD092_custom_plugin'),
        'archives' => __($config['plural_name'] . ' Archives', '_BD092_custom_plugin'),
        'attributes' => __($config['plural_name'] . ' Attributes', '_BD092_custom_plugin'),
        'parent_item_colon' => __('Parent ' . $config['singular_name'] . ':', '_BD092_custom_plugin'),
        'all_items' => __('All ' . $config['plural_name'], '_BD092_custom_plugin'),
        'add_new_item' => __('Add New ' . $config['singular_name'], '_BD092_custom_plugin'),
        'add_new' => __('Add New', '_BD092_custom_plugin'),
        'new_item' => __('New ' . $config['singular_name'], '_BD092_custom_plugin'),
        'edit_item' => __('Edit ' . $config['singular_name'], '_BD092_custom_plugin'),
        'update_item' => __('Update ' . $config['singular_name'], '_BD092_custom_plugin'),
        'view_item' => __('View ' . $config['singular_name'], '_BD092_custom_plugin'),
        'view_items' => __('View ' . $config['plural_name'], '_BD092_custom_plugin'),
        'search_items' => __('Search ' . $config['plural_name'], '_BD092_custom_plugin'),
        'not_found' => __('Not found', '_BD092_custom_plugin'),
        'not_found_in_trash' => __('Not found in Trash', '_BD092_custom_plugin'),
        'featured_image' => __('Featured Image', '_BD092_custom_plugin'),
        'set_featured_image' => __('Set featured image', '_BD092_custom_plugin'),
        'remove_featured_image' => __('Remove featured image', '_BD092_custom_plugin'),
        'use_featured_image' => __('Use as featured image', '_BD092_custom_plugin'),
        'insert_into_item' => __('Insert into ' . $config['singular_name'], '_BD092_custom_plugin'),
        'uploaded_to_this_item' => __('Uploaded to this ' . $config['singular_name'], '_BD092_custom_plugin'),
        'items_list' => __($config['plural_name'] . ' list', '_BD092_custom_plugin'),
        'items_list_navigation' => __($config['plural_name'] . ' list navigation', '_BD092_custom_plugin'),
        'filter_items_list' => __('Filter ' . $config['plural_name'] . ' list', '_BD092_custom_plugin'),
    ];

    $args = [
        'label' => __($config['plural_name'], '_BD092_custom_plugin'),
        'description' => __($config['description'], '_BD092_custom_plugin'),
        'labels' => $labels,
        'supports' => $config['supports'],
        'taxonomies' => $config['taxonomies'],
        'hierarchical' => $config['hierarchical'],
        'public' => $config['public'],
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => $config['menu_position'],
        'menu_icon' => $config['menu_icon'],
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => $config['has_archive'],
        'exclude_from_search' => $config['exclude_from_search'],
        'publicly_queryable' => true,
        'capability_type' => $config['capability_type'],
        'show_in_rest' => $config['show_in_rest'],
        'rest_base' => $post_type_key,
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'rewrite' => [
            'slug' => $config['rewrite_slug'],
            'with_front' => false
        ]
    ];

    register_post_type($post_type_key, $args);
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

function bd324_register_taxonomy($taxonomy_key, $post_types, $config)
{
    $defaults = [
        'singular_name' => ucfirst(str_replace('-', ' ', $taxonomy_key)),
        'plural_name' => ucfirst(str_replace('-', ' ', $taxonomy_key)),
        'menu_name' => ucfirst(str_replace('-', ' ', $taxonomy_key)),
        'description' => '',
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'show_in_rest' => true,
        'rewrite_slug' => $taxonomy_key,
        'with_front' => true
    ];

    $config = wp_parse_args($config, $defaults);

    $labels = [
        'name' => _x($config['plural_name'], 'Taxonomy General Name', '_BD092_custom_plugin'),
        'singular_name' => _x($config['singular_name'], 'Taxonomy Singular Name', '_BD092_custom_plugin'),
        'menu_name' => __($config['menu_name'], '_BD092_custom_plugin'),
        'all_items' => __('All ' . $config['plural_name'], '_BD092_custom_plugin'),
        'parent_item' => __('Parent ' . $config['singular_name'], '_BD092_custom_plugin'),
        'parent_item_colon' => __('Parent ' . $config['singular_name'] . ':', '_BD092_custom_plugin'),
        'new_item_name' => __('New ' . $config['singular_name'] . ' Name', '_BD092_custom_plugin'),
        'add_new_item' => __('Add New ' . $config['singular_name'], '_BD092_custom_plugin'),
        'edit_item' => __('Edit ' . $config['singular_name'], '_BD092_custom_plugin'),
        'update_item' => __('Update ' . $config['singular_name'], '_BD092_custom_plugin'),
        'view_item' => __('View ' . $config['singular_name'], '_BD092_custom_plugin'),
        'separate_items_with_commas' => __('Separate items with commas', '_BD092_custom_plugin'),
        'add_or_remove_items' => __('Add or remove items', '_BD092_custom_plugin'),
        'choose_from_most_used' => __('Choose from the most used', '_BD092_custom_plugin'),
        'popular_items' => __('Popular ' . $config['plural_name'], '_BD092_custom_plugin'),
        'search_items' => __('Search ' . $config['plural_name'], '_BD092_custom_plugin'),
        'not_found' => __('Not Found', '_BD092_custom_plugin'),
        'no_terms' => __('No items', '_BD092_custom_plugin'),
        'items_list' => __($config['plural_name'] . ' list', '_BD092_custom_plugin'),
        'items_list_navigation' => __($config['plural_name'] . ' list navigation', '_BD092_custom_plugin'),
    ];

    $args = [
        'labels' => $labels,
        'description' => __($config['description'], '_BD092_custom_plugin'),
        'hierarchical' => $config['hierarchical'],
        'public' => $config['public'],
        'show_ui' => $config['show_ui'],
        'show_admin_column' => $config['show_admin_column'],
        'show_in_nav_menus' => $config['show_in_nav_menus'],
        'show_tagcloud' => $config['show_tagcloud'],
        'show_in_rest' => $config['show_in_rest'],
        'rewrite' => [
            'slug' => $config['rewrite_slug'],
            'with_front' => $config['with_front']
        ]
    ];

    register_taxonomy($taxonomy_key, $post_types, $args);
}
