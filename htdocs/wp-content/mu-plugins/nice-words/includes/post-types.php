<?php
/**
 * File for registering custom post types.
 */

/* Register custom post types on the 'init' hook. */
add_action( 'init', 'nw_register_post_types' );

/**
 * Registers post types needed by the plugin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function nw_register_post_types() {

	/* Get the plugin settings. */
	$settings = get_option( 'plugin_nice_words', nw_get_default_settings() );

	/* Set up the arguments for the testimonial item post type. */
	$args = array(
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 12,
		'menu_icon'           => NW_URI . 'images/menu-icon.png',
		'can_export'          => true,
		'delete_with_user'    => false,
		'hierarchical'        => false,
		'has_archive'         => $settings['testimonials_root'],
		'query_var'           => 'testimonial_item',

		/* The rewrite handles the URL structure. */
		'rewrite' => array(
			'slug'       => !empty( $settings['testimonial_item_base'] ) ? "{$settings['testimonials_root']}/{$settings['testimonial_item_base']}" : $settings['testimonials_root'],
			'with_front' => false,
			'pages'      => true,
			'feeds'      => true,
			'ep_mask'    => EP_PERMALINK,
		),

		/* What features the post type supports. */
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail'
		),

		/* Labels used when displaying the posts. */
		'labels' => array(
			'name'               => __( 'Testimonial Items',                   'custom-content-testimonial' ),
			'singular_name'      => __( 'Testimonial Item',                    'custom-content-testimonial' ),
			'menu_name'          => __( 'Testimonials',                         'custom-content-testimonial' ),
			'name_admin_bar'     => __( 'Testimonial Item',                    'custom-content-testimonial' ),
			'add_new'            => __( 'Add New',                           'custom-content-testimonial' ),
			'add_new_item'       => __( 'Add New Testimonial Item',            'custom-content-testimonial' ),
			'edit_item'          => __( 'Edit Testimonial Item',               'custom-content-testimonial' ),
			'new_item'           => __( 'New Testimonial Item',                'custom-content-testimonial' ),
			'view_item'          => __( 'View Testimonial Item',               'custom-content-testimonial' ),
			'search_items'       => __( 'Search Testimonials',                  'custom-content-testimonial' ),
			'not_found'          => __( 'No testimonial items found',          'custom-content-testimonial' ),
			'not_found_in_trash' => __( 'No testimonial items found in trash', 'custom-content-testimonial' ),
			'all_items'          => __( 'Testimonial Items',                   'custom-content-testimonial' ),

			// Custom labels b/c WordPress doesn't have anything to handle this.
			'archive_title'      => __( 'Testimonials',                         'custom-content-testimonial' ),
		)
	);

	/* Register the testimonial item post type. */
	register_post_type( 'testimonial_item', $args );
}

?>
