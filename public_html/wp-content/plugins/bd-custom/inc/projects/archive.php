<?php

/**
 * Modify portfolio archive query to respect custom ordering from BD Settings
 */
function bd324_portfolio_archive_orderby( $query ) {
	if ( ! is_admin() && is_post_type_archive( 'bd324_projects' ) && $query->is_main_query() ) {
		$custom_order = get_field( 'portfolio_custom_order', 'option' );

		if ( ! empty( $custom_order ) && is_array( $custom_order ) ) {
			// Extract project IDs in order from the repeater
			$project_ids = array_filter( array_map( function( $row ) {
				return isset( $row['project'] ) ? (int) $row['project'] : 0;
			}, $custom_order ) );

			if ( ! empty( $project_ids ) ) {
				// Set the query to show only these projects in custom order
				$query->set( 'post__in', $project_ids );
				$query->set( 'orderby', 'post__in' );
				$query->set( 'order', 'ASC' );
			}
		}
	}
}
add_action( 'pre_get_posts', 'bd324_portfolio_archive_orderby' );

/**
 * Get adjacent project respecting custom portfolio order if configured
 */
function bd324_get_adjacent_project( $current_project_id, $direction = 'next' ) {
	$custom_order = get_field( 'portfolio_custom_order', 'option' );

	if ( ! empty( $custom_order ) && is_array( $custom_order ) ) {
		$project_ids = array_filter( array_map( function( $row ) {
			return isset( $row['project'] ) ? (int) $row['project'] : 0;
		}, $custom_order ) );

		if ( ! empty( $project_ids ) ) {
			$current_index = array_search( $current_project_id, $project_ids, true );

			if ( false !== $current_index ) {
				$next_index = $direction === 'next' ? $current_index + 1 : $current_index - 1;

				if ( isset( $project_ids[ $next_index ] ) ) {
					return get_post( $project_ids[ $next_index ] );
				}
			}

			return null;
		}
	}

	// Fallback to default date-based adjacent post
	return get_adjacent_post( false, '', $direction === 'prev' );
}
