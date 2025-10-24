<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}



if (!function_exists('BD092__register_cpt_curriculum')) :
    function BD092__register_cpt_curriculum()
    {
        /**
         * Create Member Post Type
         */

        $labels = array(
           'name'                  => _x('Curriculum', 'Post Type General Name', '_BD092_curriculum_plugin'),
           'singular_name'         => _x('Curriculum Item', 'Post Type Singular Name', '_BD092_curriculum_plugin'),
           'menu_name'             => __('Curriculum', '_BD092_curriculum_plugin'),
           'name_admin_bar'        => __('Curriculum', '_BD092_curriculum_plugin'),
           'archives'              => __('Curriculum Items Archives', '_BD092_curriculum_plugin'),
           'attributes'            => __('Curriculum Items Attributes', '_BD092_curriculum_plugin'),
           'parent_item_colon'     => __('Parent Curriculum Items:', '_BD092_curriculum_plugin'),
           'all_items'             => __('All Curriculum Items', '_BD092_curriculum_plugin'),
           'add_new_item'          => __('Add New Curriculum Items', '_BD092_curriculum_plugin'),
           'add_new'               => __('Add New', '_BD092_curriculum_plugin'),
           'new_item'              => __('New Curriculum Items', '_BD092_curriculum_plugin'),
           'edit_item'             => __('Edit Curriculum Items', '_BD092_curriculum_plugin'),
           'update_item'           => __('Update Curriculum Items', '_BD092_curriculum_plugin'),
           'view_item'             => __('View Curriculum Items', '_BD092_curriculum_plugin'),
           'view_items'            => __('View Curriculum Items', '_BD092_curriculum_plugin'),
           'search_items'          => __('Search Curriculum Items', '_BD092_curriculum_plugin'),
           'not_found'             => __('Not found', '_BD092_curriculum_plugin'),
           'not_found_in_trash'    => __('Not found in Trash', '_BD092_curriculum_plugin'),
           'featured_image'        => __('Featured Image', '_BD092_curriculum_plugin'),
           'set_featured_image'    => __('Set featured image', '_BD092_curriculum_plugin'),
           'remove_featured_image' => __('Remove featured image', '_BD092_curriculum_plugin'),
           'use_featured_image'    => __('Use as featured image', '_BD092_curriculum_plugin'),
           'insert_into_item'      => __('Insert into Curriculum Items', '_BD092_curriculum_plugin'),
           'uploaded_to_this_item' => __('Uploaded to this Curriculum Items', '_BD092_curriculum_plugin'),
           'items_list'            => __('Curriculum Items list', '_BD092_curriculum_plugin'),
           'items_list_navigation' => __('Curriculum Items list navigation', '_BD092_curriculum_plugin'),
           'filter_items_list'     => __('Filter Curriculum Items list', '_BD092_curriculum_plugin'),
        );
        $args = array(
           'label'                 => __('Curriculum', '_BD092_curriculum_plugin'),
           'description'           => __(''),
           'labels'                => $labels,
           'supports'              => array('excerpt', 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes'),
           'taxonomies'            => array(),
           'hierarchical'          => false,
           'rewrite'               => array(
              'slug' => 'goal/%framework-grade%',
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
           'has_archive'           => 'learning-goals',
           'exclude_from_search'   => false,
           'publicly_queryable'    => true,
           'capability_type'       => 'page',
           'show_in_rest'          => true,
           'rest_base'             => 'learning-goals',
           'rest_controller_class' => 'WP_REST_Posts_Controller',

        );
        register_post_type('curriculum', $args);
    }
endif;

add_action('init', 'BD092__register_cpt_curriculum', 0);


function BD092__add_framework_grade_rewrite_tag()
{
    add_rewrite_tag('%framework-grade%', '([^/]+)', 'framework-grade=');
}
add_action('init', 'BD092__add_framework_grade_rewrite_tag', 11);

function BD092__curriculum_permalink($post_link, $post)
{
    if ($post->post_type !== 'curriculum') {
        return $post_link;
    }

    $terms = get_the_terms($post, 'framework-grade');
    if (!empty($terms) && !is_wp_error($terms)) {
        $slug = $terms[0]->slug;
    } else {
        $slug = 'no-grade';
    }

    return str_replace('%framework-grade%', $slug, $post_link);
}
add_filter('post_type_link', 'BD092__curriculum_permalink', 10, 2);

function BD092__curriculum_archive_rewrite()
{
    add_rewrite_rule(
        '^learning-goals/?$', // archive URL
        'index.php?post_type=curriculum', // query
        'top'
    );
}
add_action('init', 'BD092__curriculum_archive_rewrite', 20);
