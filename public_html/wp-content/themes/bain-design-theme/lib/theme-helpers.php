<?php
/**
 * Helper functions for use in other areas of the theme
 *
 * @package _mbbasetheme
 */

/**
 * Add capabilities for a custom post type
 *
 * @return void
 */
function mb_add_capabilities( $posttype ) {
	// gets the author role
	$role = get_role( 'administrator' );

	// adds all capabilities for a given post type to the administrator role
	$role->add_cap( 'edit_' . $posttype . 's' );
	$role->add_cap( 'edit_others_' . $posttype . 's' );
	$role->add_cap( 'publish_' . $posttype . 's' );
	$role->add_cap( 'read_private_' . $posttype . 's' );
	$role->add_cap( 'delete_' . $posttype . 's' );
	$role->add_cap( 'delete_private_' . $posttype . 's' );
	$role->add_cap( 'delete_published_' . $posttype . 's' );
	$role->add_cap( 'delete_others_' . $posttype . 's' );
	$role->add_cap( 'edit_private_' . $posttype . 's' );
	$role->add_cap( 'edit_published_' . $posttype . 's' );
}
/**
 * Getter function for Featured Content Plugin.
 *
 * @return array An array of WP_Post objects.
 */
function mbdmaster_get_featured_posts() {
	return apply_filters( 'mbdmaster_get_featured_posts', array() );
}

// tell WordPress about our new query var
function wpse52480_query_vars( $query_vars ){
    $query_vars[] = 'my_special_query';
    return $query_vars;
}
add_filter( 'query_vars', 'wpse52480_query_vars' );

/**
 * A helper conditional function that returns a boolean value.
 *
 *
 * @return bool Whether there are featured posts.
 */
function mbdmaster_has_featured_posts() {
	return ! is_paged() && (bool) apply_filters( 'mbdmaster_get_featured_posts', false );
}

add_action('pre_get_posts', 'mbdmaster_query_offset', 1 );
function mbdmaster_query_offset(&$query) {

    //Before anything else, make sure this is the right query...
   if( ! isset( $query->query_vars['my_special_query'] ) ) {
		 return;
    }
	
    //First, define your desired offset...
    $offset = 1;
    
    //Next, determine how many posts per page you want (we'll use WordPress's settings)
    $ppp = get_option('posts_per_page');

    //Next, detect and handle pagination...
    if ( $query->is_paged ) {

        //Manually determine page query offset (offset + current page (minus one) x posts per page)
        $page_offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );

        //Apply adjust page offset
        $query->set('offset', $page_offset );

    }
    else {

        //This is the first page. Just use the offset...
        $query->set('offset',$offset);

    }
}


add_filter('found_posts', 'mbdmaster_adjust_offset_pagination', 1, 2 );
function mbdmaster_adjust_offset_pagination($found_posts, $query) {

    //Define our offset again...
    $offset = 1;

    //Ensure we're modifying the right query object...
    if( isset( $query->query_vars['my_special_query'] ) ) {
        //Reduce WordPress's found_posts count by the offset... 
			return $found_posts - $offset;
    }
    return $found_posts;
}
