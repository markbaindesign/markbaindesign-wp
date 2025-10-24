<?php

// Register Custom Taxonomy
function BD092__register_custom_taxonomy_tools()
{

    $labels = array(
       'name'                       => _x('Tools & Libraries', 'Taxonomy General Name', '_BD092_curriculum_plugin'),
       'singular_name'              => _x('Tool or Library', 'Taxonomy Singular Name', '_BD092_curriculum_plugin'),
       'menu_name'                  => __('Tools & Libraries', '_BD092_curriculum_plugin'),
       'all_items'                  => __('All Tools & Libraries', '_BD092_curriculum_plugin'),
       'parent_item'                => __('Parent Tools & Libraries', '_BD092_curriculum_plugin'),
       'parent_item_colon'          => __('Parent Tools & Libraries:', '_BD092_curriculum_plugin'),
       'new_item_name'              => __('New Tool or Library Name', '_BD092_curriculum_plugin'),
       'add_new_item'               => __('Add New Tool or Library', '_BD092_curriculum_plugin'),
       'edit_item'                  => __('Edit Tool or Library', '_BD092_curriculum_plugin'),
       'update_item'                => __('Update Tool or Library', '_BD092_curriculum_plugin'),
       'view_item'                  => __('View Tool or Library', '_BD092_curriculum_plugin'),
       'separate_items_with_commas' => __('Separate items with commas', '_BD092_curriculum_plugin'),
       'add_or_remove_items'        => __('Add or remove items', '_BD092_curriculum_plugin'),
       'choose_from_most_used'      => __('Choose from the most used', '_BD092_curriculum_plugin'),
       'popular_items'              => __('Popular Tools & Libraries', '_BD092_curriculum_plugin'),
       'search_items'               => __('Search Tools & Libraries', '_BD092_curriculum_plugin'),
       'not_found'                  => __('Not Found', '_BD092_curriculum_plugin'),
       'no_terms'                   => __('No items', '_BD092_curriculum_plugin'),
       'items_list'                 => __('Tools & Libraries list', '_BD092_curriculum_plugin'),
       'items_list_navigation'      => __('Tools & Libraries list navigation', '_BD092_curriculum_plugin'),
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
          'slug' => 'project-category/tool',
          'with_front' => true
       ),
    );
    register_taxonomy('project-category-tool', array('portfolio_item'), $args);
}
add_action('init', 'BD092__register_custom_taxonomy_tools', 0);
