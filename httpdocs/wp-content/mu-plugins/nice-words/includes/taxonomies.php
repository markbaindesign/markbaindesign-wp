<?php
/**
 * File for registering custom taxonomies.
 */

/* Register taxonomies on the 'init' hook. */
add_action( 'init', 'nw_register_taxonomies' );

/**
 * Register taxonomies for the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void.
 */


function nw_register_taxonomies() {

	/* Get the plugin settings. */
	$settings = get_option( 'plugin_custom_nice_words', nw_get_default_settings() );

	/* Set up the arguments for the "testimonials" taxonomy. */
	$args = array(
		'public'            => true,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
		'show_admin_column' => true,
		'hierarchical'      => true,
		'query_var'         => 'testimonials',


		/* The rewrite handles the URL structure. */
		'rewrite' => array(
			'slug'         => !empty( $settings['testimonials_base'] ) ? "{$settings['testimonials_root']}/{$settings['testimonials_base']}" : $settings['testimonials_root'],
			'with_front'   => false,
			'hierarchical' => false,
			'ep_mask'      => EP_NONE
		),

		/* Labels used when displaying taxonomy and terms. */
		'labels' => array(
			'name'                       => __( 'Testimonials',                           'custom-content-testimonials' ),
			'singular_name'              => __( 'Testimonials',                            'custom-content-testimonials' ),
			'menu_name'                  => __( 'Testimonials',                           'custom-content-testimonials' ),
			'name_admin_bar'             => __( 'Testimonials',                            'custom-content-testimonials' ),
			'search_items'               => __( 'Search Testimonials',                    'custom-content-testimonials' ),
			'popular_items'              => __( 'Popular Testimonials',                   'custom-content-testimonials' ),
			'all_items'                  => __( 'All Testimonials',                       'custom-content-testimonials' ),
			'edit_item'                  => __( 'Edit Testimonial',                       'custom-content-testimonials' ),
			'view_item'                  => __( 'View Testimonial',                       'custom-content-testimonials' ),
			'update_item'                => __( 'Update Testimonial',                     'custom-content-testimonials' ),
			'add_new_item'               => __( 'Add New Testimonial',                    'custom-content-testimonials' ),
			'new_item_name'              => __( 'New Testimonial Name',                   'custom-content-testimonials' ),
			'separate_items_with_commas' => __( 'Separate Testimonials with commas',      'custom-content-testimonials' ),
			'add_or_remove_items'        => __( 'Add or remove Testimonials',             'custom-content-testimonials' ),
			'choose_from_most_used'      => __( 'Choose from the most used Testimonials', 'custom-content-testimonials' ),
		)
	);

	/* Register the 'testimonials' taxonomy. */
	register_taxonomy( 'testimonials', array( 'testimonial_item' ), $args );
	


}

?>
