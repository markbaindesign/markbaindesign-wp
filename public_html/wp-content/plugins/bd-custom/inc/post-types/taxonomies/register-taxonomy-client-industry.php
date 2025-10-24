<?php

// Register Custom Taxonomy
function BD092__register_custom_taxonomy_client_industry()
{

    $labels = array(
       'name'                       => _x('Client Industries', 'Taxonomy General Name', '_BD092_curriculum_plugin'),
       'singular_name'              => _x('Client Industry', 'Taxonomy Singular Name', '_BD092_curriculum_plugin'),
       'menu_name'                  => __('Client Industries', '_BD092_curriculum_plugin'),
       'all_items'                  => __('All Client Industries', '_BD092_curriculum_plugin'),
       'parent_item'                => __('Parent Client Industry', '_BD092_curriculum_plugin'),
       'parent_item_colon'          => __('Parent Client Industry:', '_BD092_curriculum_plugin'),
       'new_item_name'              => __('New Client Industry Name', '_BD092_curriculum_plugin'),
       'add_new_item'               => __('Add New Client Industry', '_BD092_curriculum_plugin'),
       'edit_item'                  => __('Edit Client Industry', '_BD092_curriculum_plugin'),
       'update_item'                => __('Update Client Industry', '_BD092_curriculum_plugin'),
       'view_item'                  => __('View Client Industry', '_BD092_curriculum_plugin'),
       'separate_items_with_commas' => __('Separate items with commas', '_BD092_curriculum_plugin'),
       'add_or_remove_items'        => __('Add or remove items', '_BD092_curriculum_plugin'),
       'choose_from_most_used'      => __('Choose from the most used', '_BD092_curriculum_plugin'),
       'popular_items'              => __('Popular Client Industries', '_BD092_curriculum_plugin'),
       'search_items'               => __('Search Client Industries', '_BD092_curriculum_plugin'),
       'not_found'                  => __('Not Found', '_BD092_curriculum_plugin'),
       'no_terms'                   => __('No items', '_BD092_curriculum_plugin'),
       'items_list'                 => __('Client Industries list', '_BD092_curriculum_plugin'),
       'items_list_navigation'      => __('Client Industries list navigation', '_BD092_curriculum_plugin'),
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
          'slug' => 'client-industry',
          'with_front' => true
       ),
    );
    register_taxonomy('client-industry', array('clients'), $args);
}
add_action('init', 'BD092__register_custom_taxonomy_client_industry', 0);
