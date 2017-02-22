<?php
/**
 * Various functions, filters, and actions used by the plugin.
 */

/* Filter the post type archive title. */
add_filter( 'post_type_archive_title', 'nw_post_type_archive_title' );

/* Filter the post type permalink. */
add_filter( 'post_type_link', 'nw_post_type_link', 10, 2 );

/* Filter the breadcrumb trail items (Breadcrumb Trail script/plugin). */
add_filter( 'breadcrumb_trail_items', 'nw_breadcrumb_trail_items' );

/**
 * Returns the default settings for the plugin.
 *
 * @since  0.1.1
 * @access public
 * @return array
 */
function nw_get_default_settings() {

	$settings = array(
		'testimonials_root'      => 'testimonials', 
		'testimonials_base'      => 'topics',          // defaults to 'testimonials_root'
		'testimonial_item_base' => 'items'

	);

	return $settings;
}

/**
 * Filter on 'post_type_archive_title' to allow for the use of the 'archive_title' label that isn't supported 
 * by WordPress.  That's okay since we can roll our own labels.
 *
 * @since  0.1.0
 * @access public
 * @param  string $title
 * @return string
 */
function nw_post_type_archive_title( $title ) {

	if ( is_post_type_archive( 'testimonial_item' ) ) {
		$post_type = get_post_type_object( 'testimonial_item' );
		$title = isset( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $title;
	}

	return $title;
}

/**
 * Filter on 'post_type_link' to allow users to use '%testimonial%' (the 'testimonial' taxonomy) in their 
 * testimonial item URLs.
 *
 * @since  0.1.0
 * @access public
 * @param  string $post_link
 * @param  object $post
 * @return string
 */
function nw_post_type_link( $post_link, $post ) {

	if ( 'testimonial_item' !== $post->post_type )
		return $post_link;

	/* Allow %testimonials% in the custom post type permalink. */
	if ( false !== strpos( $post_link, '%testimonials%' ) ) {
	
		/* Get the terms. */
		$terms = get_the_terms( $post, 'testimonials' ); // @todo apply filters to tax name.

		/* Check that terms were returned. */
		if ( $terms ) {

			usort( $terms, '_usort_terms_by_ID' );

			$post_link = str_replace( '%testimonials%', $terms[0]->slug, $post_link );

		} else {
			$post_link = str_replace( '%testimonials%', 'item', $post_link );
		}
	}

	return $post_link;
}

/**
 * Filters the 'breadcrumb_trail_items' hook from the Breadcrumb Trail plugin and the script version 
 * included in the Hybrid Core framework.  At best, this is a neat hack to add the testimonials to the 
 * single view of testimonials items based off the '%testimonials%' rewrite tag.  At worst, it's potentially 
 * a huge management nightmare in the long term.  A better solution is definitely needed baked right 
 * into Breadcrumb Trail itself that takes advantage of its built-in features for figuring out this type 
 * of thing.
 *
 * @since  0.1.0
 * @access public
 * @param  array  $items
 * @return array
 */
function nw_breadcrumb_trail_items( $items ) {

	if ( is_singular( 'testimonial_item' ) ) {

		$settings = get_option( 'plugin_nice_words', nw_get_default_settings() );

		if ( false !== strpos( $settings['testimonial_item_base'], '%testimonials%' ) ) {
			$post_id = get_queried_object_id();

			$terms = get_the_terms( $post_id, 'testimonials' );

			if ( !empty( $terms ) ) {

				usort( $terms, '_usort_terms_by_ID' );
				$term = get_term( $terms[0], 'testimonials' );
				$term_id = $term->term_id;

				$parents = array();

				while ( $term_id ) {

					/* Get the parent term. */
					$term = get_term( $term_id, 'testimonials' );

					/* Add the formatted term link to the array of parent terms. */
					$parents[] = '<a href="' . get_term_link( $term, 'testimonials' ) . '" title="' . esc_attr( $term->name ) . '">' . $term->name . '</a>';

					/* Set the parent term's parent as the parent ID. */
					$term_id = $term->parent;
				}

				$items   = array_splice( $items, 0, -1 );
				$items   = array_merge( $items, array_reverse( $parents ) );
				$items[] = single_post_title( '', false );
			}
		}
	}

	return $items;
}

?>
