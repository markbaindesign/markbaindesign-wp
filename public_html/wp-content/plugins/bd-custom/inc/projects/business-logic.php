<?php

function bd324_get_project_data( $post_id ) {
	$data = [
		'data_base' => bd324_get_project_base_data( $post_id ) ?? [],
	];
	if ( is_singular( 'bd324_projects' ) ) {
		$data['data_meta']        = bd324_get_project_meta( $post_id ) ?? [];
		$data['data_case_study']  = bd324_get_project_case_study( $post_id ) ?? [];
		$data['data_testimonials'] = bd324_get_project_testimonials( $post_id ) ?? [];
	}
	return $data;
}

function bd324_get_project_base_data( $post_id ) {
	$post_type     = get_post_type( $post_id );
	$archive_link  = $post_type ? get_post_type_archive_link( $post_type ) : null;
	$post_type_obj = $post_type ? get_post_type_object( $post_type ) : null;
	$label         = $post_type_obj && ! empty( $post_type_obj->labels->name )
		? $post_type_obj->labels->name
		: ucfirst( (string) $post_type );

	return [
		'title'               => get_the_title( $post_id ),
		'permalink'           => get_permalink( $post_id ),
		'excerpt'             => get_the_excerpt( $post_id ),
		'post_type'           => $post_type ?? null,
		'thumbnail_url'       => get_the_post_thumbnail_url( $post_id, 'full' ),
		'breadcrumb_link_label' => $label,
		'breadcrumb_link'     => $archive_link,
	];
}

function bd324_get_project_meta( $post_id ) {
	$meta = [];

	// Tagline (falls back to excerpt in templates)
	$tagline = get_field( 'tagline', $post_id );

	// Client display name (text field)
	$client_display = get_field( 'client', $post_id );

	// Related client CPT entry (for logo + permalink)
	$related_client_data = bd324_get_related_client_data( $post_id );
	if ( $related_client_data ) {
		$meta['client'] = [
			'label'     => __( 'Client', 'bd-custom' ),
			'value'     => $client_display ?: ( $related_client_data['client_name'] ?? '' ),
			'image'     => esc_url( $related_client_data['client_logo'] ?? '' ),
			'url'       => $related_client_data['client_permalink'] ?? '',
		];
	} elseif ( $client_display ) {
		$meta['client'] = [
			'label' => __( 'Client', 'bd-custom' ),
			'value' => esc_html( $client_display ),
		];
	}

	// Year (number field; falls back to publish year)
	$year = get_field( 'year', $post_id );
	if ( ! $year ) {
		$year = get_the_date( 'Y', $post_id );
	}
	if ( $year ) {
		$meta['year'] = [
			'label' => __( 'Year', 'bd-custom' ),
			'value' => (int) $year,
		];
	}

	// Duration
	$duration = get_field( 'duration', $post_id );
	if ( $duration ) {
		$meta['duration'] = [
			'label' => __( 'Duration', 'bd-custom' ),
			'value' => esc_html( $duration ),
		];
	}

	// Role
	$role = get_field( 'role', $post_id );
	if ( $role ) {
		$meta['role'] = [
			'label' => __( 'Role', 'bd-custom' ),
			'value' => esc_html( $role ),
		];
	}

	// Live URL
	$live_url = get_field( 'live_url', $post_id );
	if ( $live_url ) {
		$meta['live_url'] = [
			'label'  => __( 'Live', 'bd-custom' ),
			'value'  => esc_url( $live_url ),
			'url'    => esc_url( $live_url ),
			'target' => '_blank',
		];
	}

	// Taxonomy: services, tools, stack, profile
	foreach ( [
		'project-category-service'    => 'Services',
		'project-category-tool'       => 'Tools',
		'project-category-tech-stack' => 'Tech Stack',
		'project-category-profile'    => 'Profile',
	] as $taxonomy => $label ) {
		$terms = bd324_get_meta_terms_as_array( $post_id, $taxonomy );
		if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
			$meta[ $taxonomy ] = [
				'label' => $label,
				'value' => $terms,
			];
		}
	}

	// Attach tagline separately so templates can use it without looping meta
	$meta['_tagline'] = $tagline ?: get_the_excerpt( $post_id );

	return $meta;
}

function bd324_get_project_case_study( $post_id ) {
	// Brief / Approach / Outcome
	$brief    = get_field( 'brief', $post_id );
	$approach = get_field( 'approach', $post_id );
	$outcome  = get_field( 'outcome', $post_id );

	// Wins repeater → flat array
	$wins = [];
	if ( function_exists( 'have_rows' ) && have_rows( 'wins', $post_id ) ) {
		while ( have_rows( 'wins', $post_id ) ) {
			the_row();
			$w = get_sub_field( 'win' );
			if ( $w ) { $wins[] = esc_html( $w ); }
		}
	}

	// Approach gallery (up to 2 image IDs)
	$approach_gallery = get_field( 'approach_gallery', $post_id ) ?: [];

	// Showcase gallery (up to 3 image IDs)
	$showcase_gallery = get_field( 'showcase_gallery', $post_id ) ?: [];

	// Inline testimonial
	$testimonial = [];
	$quote = get_field( 'testimonial_quote', $post_id );
	if ( $quote ) {
		$testimonial = [
			'quote'  => $quote,
			'author' => esc_html( get_field( 'testimonial_author', $post_id ) ?? '' ),
			'role'   => esc_html( get_field( 'testimonial_role', $post_id ) ?? '' ),
		];
	}

	// Stack repeater → flat array
	$stack = [];
	if ( function_exists( 'have_rows' ) && have_rows( 'stack', $post_id ) ) {
		while ( have_rows( 'stack', $post_id ) ) {
			the_row();
			$t = get_sub_field( 'tech' );
			if ( $t ) { $stack[] = esc_html( $t ); }
		}
	}

	// Related projects (manual picks, falls back to shared taxonomy)
	$related = bd324_get_project_related( $post_id );

	return [
		'brief'            => $brief,
		'approach'         => $approach,
		'approach_gallery' => $approach_gallery,
		'outcome'          => $outcome,
		'wins'             => $wins,
		'testimonial'      => $testimonial,
		'showcase_gallery' => $showcase_gallery,
		'stack'            => $stack,
		'related'          => $related,
	];
}

function bd324_get_project_related( $post_id, $limit = 2 ) {
	$picked = get_field( 'related', $post_id );
	if ( ! empty( $picked ) && is_array( $picked ) ) {
		$posts = array_filter( array_map( function ( $p ) {
			return is_object( $p ) ? $p : get_post( (int) $p );
		}, $picked ) );
		return array_slice( array_values( $posts ), 0, $limit );
	}

	// Auto-pick by shared taxonomy
	$terms = wp_get_post_terms( $post_id, 'project-category-service', [ 'fields' => 'ids' ] );
	$args  = [
		'post_type'      => 'bd324_projects',
		'posts_per_page' => $limit,
		'post__not_in'   => [ $post_id ],
		'orderby'        => 'date',
		'order'          => 'DESC',
	];
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$args['tax_query'] = [ [
			'taxonomy' => 'project-category-service',
			'terms'    => $terms,
		] ];
	}
	return get_posts( $args );
}

function bd324_get_project_testimonials( $project_id ) {
	$data_testimonials = [];
	$testimonials = get_field( 'related_testimonials', $project_id );
	if ( empty( $testimonials ) ) {
		return [];
	}
	foreach ( $testimonials as $testimonial ) {
		$testimonial_id   = $testimonial->ID ?? null;
		$author_name      = bd324_get_testimonial_author_name( $testimonial_id ) ?? '';
		$author_role      = bd324_get_testimonial_author_role( $testimonial_id ) ?? '';
		$related_client   = get_field( 'related_client', $testimonial_id ) ?? null;
		$related_client_name = '';
		if ( $related_client && is_array( $related_client ) && count( $related_client ) > 0 ) {
			$related_client_name = $related_client[0]->post_title ?? '';
		}
		$data_testimonials[] = [
			'post_id'   => $testimonial_id,
			'post_type' => $testimonial->post_type ?? null,
			'title'     => esc_html( $testimonial->post_title ?? '' ),
			'content'   => get_the_content( null, false, $testimonial_id ),
			'excerpt'   => get_the_excerpt( $testimonial_id ),
			'permalink' => get_permalink( $testimonial_id ) ?? '',
			'image'     => get_the_post_thumbnail_url( $testimonial_id, 'thumbnail' ) ?: '',
			'author'    => esc_html( $author_name ),
			'role'      => esc_html( $author_role ),
			'company'   => esc_html( $related_client_name ),
		];
	}
	return $data_testimonials;
}

function bd324_get_related_client_data( $post_id ) {
	$related_clients = get_field( 'related_client', $post_id );
	if ( empty( $related_clients ) || ! is_array( $related_clients ) ) {
		return [];
	}
	$related_client = $related_clients[0];
	$client_id      = $related_client->ID ?? null;
	$client_name    = $related_client->post_title ?? '';
	if ( ! $client_name ) {
		return [];
	}
	return [
		'client_name'      => esc_html( $client_name ),
		'client_logo'      => esc_url( get_the_post_thumbnail_url( $client_id, 'full' ) ?: '' ),
		'client_permalink' => get_permalink( $client_id ) ?? '',
	];
}

function bd324_get_project_terms( $project_id, $taxonomy ) {
	$terms = wp_get_post_terms( $project_id, $taxonomy );
	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return [];
	}
	return $terms;
}

function bd324_get_projects_for_related_posts( $post_id, $key ) {
	$args = [
		'post_type'      => 'bd324_projects',
		'posts_per_page' => -1,
		'meta_query'     => [ [
			'key'     => $key,
			'value'   => '"' . $post_id . '"',
			'compare' => 'LIKE',
		] ],
	];

	$query    = new WP_Query( $args );
	$projects = [];

	foreach ( $query->posts ?? [] as $post ) {
		$year = (int) get_field( 'year', $post->ID );
		if ( ! $year ) {
			$year = (int) get_the_date( 'Y', $post->ID );
		}
		$projects[] = [
			'title'     => get_the_title( $post->ID ),
			'permalink' => get_permalink( $post->ID ),
			'excerpt'   => get_the_excerpt( $post->ID ),
			'thumbnail' => get_the_post_thumbnail_url( $post->ID, 'full' ),
			'year'      => $year,
		];
	}
	wp_reset_postdata();
	return $projects;
}
