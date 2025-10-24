<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}



if (!function_exists('BD092__register_cpt_clients')) :
    function BD092__register_cpt_clients()
    {
        /**
         * Create Member Post Type
         */

        $labels = array(
           'name'                  => _x('Clients', 'Post Type General Name', '_BD092_curriculum_plugin'),
           'singular_name'         => _x('Client', 'Post Type Singular Name', '_BD092_curriculum_plugin'),
           'menu_name'             => __('Clients', '_BD092_curriculum_plugin'),
           'name_admin_bar'        => __('Clients', '_BD092_curriculum_plugin'),
           'archives'              => __('Clients Archives', '_BD092_curriculum_plugin'),
           'attributes'            => __('Clients Attributes', '_BD092_curriculum_plugin'),
           'parent_item_colon'     => __('Parent Clients:', '_BD092_curriculum_plugin'),
           'all_items'             => __('All Clients', '_BD092_curriculum_plugin'),
           'add_new_item'          => __('Add New Client', '_BD092_curriculum_plugin'),
           'add_new'               => __('Add New', '_BD092_curriculum_plugin'),
           'new_item'              => __('New Client', '_BD092_curriculum_plugin'),
           'edit_item'             => __('Edit Client', '_BD092_curriculum_plugin'),
           'update_item'           => __('Update Client', '_BD092_curriculum_plugin'),
           'view_item'             => __('View Client', '_BD092_curriculum_plugin'),
           'view_items'            => __('View Clients', '_BD092_curriculum_plugin'),
           'search_items'          => __('Search Clients', '_BD092_curriculum_plugin'),
           'not_found'             => __('Not found', '_BD092_curriculum_plugin'),
           'not_found_in_trash'    => __('Not found in Trash', '_BD092_curriculum_plugin'),
           'featured_image'        => __('Featured Image', '_BD092_curriculum_plugin'),
           'set_featured_image'    => __('Set featured image', '_BD092_curriculum_plugin'),
           'remove_featured_image' => __('Remove featured image', '_BD092_curriculum_plugin'),
           'use_featured_image'    => __('Use as featured image', '_BD092_curriculum_plugin'),
           'insert_into_item'      => __('Insert into Client', '_BD092_curriculum_plugin'),
           'uploaded_to_this_item' => __('Uploaded to this Client', '_BD092_curriculum_plugin'),
           'items_list'            => __('Clients list', '_BD092_curriculum_plugin'),
           'items_list_navigation' => __('Clients list navigation', '_BD092_curriculum_plugin'),
           'filter_items_list'     => __('Filter Clients list', '_BD092_curriculum_plugin'),
        );
        $args = array(
           'label'                 => __('Clients', '_BD092_curriculum_plugin'),
           'description'           => __(''),
           'labels'                => $labels,
           'supports'              => array('excerpt', 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
           'taxonomies'            => array(),
           'hierarchical'          => false,
           'rewrite'               => array(
              'slug' => 'clients',
              'with_front' => false
           ),
           'public'                => true,
           'show_ui'               => true,
           'show_in_menu'          => true,
           'menu_position'         => 5,
           'menu_icon'             => 'dashicons-tagcloud',
           'show_in_admin_bar'     => true,
           'show_in_nav_menus'     => true,
           'can_export'            => true,
           'has_archive'           => 'clients',
           'exclude_from_search'   => false,
           'publicly_queryable'    => true,
           'capability_type'       => 'page',
           'show_in_rest'          => true,
           'rest_base'             => 'clients',
           'rest_controller_class' => 'WP_REST_Posts_Controller',

        );
        register_post_type('clients', $args);
    }
endif;

add_action('init', 'BD092__register_cpt_clients', 0);
