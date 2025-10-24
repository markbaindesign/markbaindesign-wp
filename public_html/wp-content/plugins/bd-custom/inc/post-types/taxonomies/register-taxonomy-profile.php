<?php

// Register Custom Taxonomy
function BD092__register_custom_taxonomy_profile()
{

    $labels = array(
       'name'                       => _x('Profiles', 'Taxonomy General Name', '_BD092_curriculum_plugin'),
       'singular_name'              => _x('Profile', 'Taxonomy Singular Name', '_BD092_curriculum_plugin'),
       'menu_name'                  => __('Profiles', '_BD092_curriculum_plugin'),
       'all_items'                  => __('All Profiles', '_BD092_curriculum_plugin'),
       'parent_item'                => __('Parent Profiles', '_BD092_curriculum_plugin'),
       'parent_item_colon'          => __('Parent Profiles:', '_BD092_curriculum_plugin'),
       'new_item_name'              => __('New Profile Name', '_BD092_curriculum_plugin'),
       'add_new_item'               => __('Add New Profile', '_BD092_curriculum_plugin'),
       'edit_item'                  => __('Edit Profile', '_BD092_curriculum_plugin'),
       'update_item'                => __('Update Profile', '_BD092_curriculum_plugin'),
       'view_item'                  => __('View Profile', '_BD092_curriculum_plugin'),
       'separate_items_with_commas' => __('Separate items with commas', '_BD092_curriculum_plugin'),
       'add_or_remove_items'        => __('Add or remove items', '_BD092_curriculum_plugin'),
       'choose_from_most_used'      => __('Choose from the most used', '_BD092_curriculum_plugin'),
       'popular_items'              => __('Popular Profiles', '_BD092_curriculum_plugin'),
       'search_items'               => __('Search Profiles', '_BD092_curriculum_plugin'),
       'not_found'                  => __('Not Found', '_BD092_curriculum_plugin'),
       'no_terms'                   => __('No items', '_BD092_curriculum_plugin'),
       'items_list'                 => __('Profiles list', '_BD092_curriculum_plugin'),
       'items_list_navigation'      => __('Profiles list navigation', '_BD092_curriculum_plugin'),
    );
    $args = array(
       'labels'                     => $labels,
       'hierarchical'               => true,
       'public'                     => true,
       'show_ui'                    => true,
       'show_admin_column'          => true,
       'show_in_nav_menus'          => true,
       'show_tagcloud'              => true,
       'rewrite' => array(
          'slug' => 'project-category/profile',
          'with_front' => true
       ),
    );
    register_taxonomy('project-category-profile', array('portfolio_item'), $args);
}
add_action('init', 'BD092__register_custom_taxonomy_profile', 0);
