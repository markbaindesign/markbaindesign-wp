<?php
/**
 * Bain Design — Project custom post type
 *
 * Registers:
 *   - `project`     CPT      (single-project.php template, /work/{slug})
 *   - `project_tag` taxonomy (responsive, branding, plugin, …)
 *
 * Field model is ACF Pro — see acf/group_project_fields.json.
 * If ACF isn't installed the template degrades to native fields
 * (title, content, featured image) so nothing fatals.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }


/* ---------------------------------------------------------------------
 * 1. CPT
 * ------------------------------------------------------------------ */
add_action( 'init', function () {

	register_post_type( 'project', array(
		'labels' => array(
			'name'               => 'Projects',
			'singular_name'      => 'Project',
			'add_new_item'       => 'Add new project',
			'edit_item'          => 'Edit project',
			'view_item'          => 'View project',
			'search_items'       => 'Search projects',
			'not_found'          => 'No projects yet.',
			'menu_name'          => 'Work',
		),
		'public'              => true,
		'show_in_rest'         => true,           // Gutenberg + REST; ACF fields are still served
		'menu_icon'            => 'dashicons-portfolio',
		'menu_position'        => 20,
		'has_archive'          => 'work',         // /work/ archive
		'rewrite'              => array( 'slug' => 'work', 'with_front' => false ),
		'supports'             => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
		'hierarchical'         => false,
		'capability_type'      => 'post',
	) );

	register_taxonomy( 'project_tag', 'project', array(
		'labels' => array(
			'name'          => 'Project tags',
			'singular_name' => 'Project tag',
		),
		'public'              => true,
		'hierarchical'         => false,
		'show_in_rest'         => true,
		'rewrite'              => array( 'slug' => 'work/tag', 'with_front' => false ),
	) );
}, 5 );


/* ---------------------------------------------------------------------
 * 2. ACF — load the field-group JSON from acf/ alongside this file.
 *    ACF Pro auto-discovers JSON in `acf-json/` inside the theme by
 *    default; we add an extra path so we can ship the field group
 *    alongside our integration package without colliding.
 * ------------------------------------------------------------------ */
add_filter( 'acf/settings/load_json', function ( $paths ) {
	$paths[] = get_theme_file_path( 'acf' );
	return $paths;
} );


/* ---------------------------------------------------------------------
 * 3. Helpers — every getter falls back gracefully if ACF isn't loaded.
 *    Use these in single-project.php so the template stays clean.
 * ------------------------------------------------------------------ */

/** ACF field with a fallback to post meta. */
function bain_project_field( $key, $post_id = null, $default = '' ) {
	$post_id = $post_id ?: get_the_ID();
	if ( function_exists( 'get_field' ) ) {
		$v = get_field( $key, $post_id );
		if ( $v !== null && $v !== '' && $v !== false ) {
			return $v;
		}
	}
	$meta = get_post_meta( $post_id, $key, true );
	return $meta !== '' ? $meta : $default;
}

/** Two-digit zero-padded project number (uses menu_order, falls back to a stable hash). */
function bain_project_number( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	$order   = (int) get_post_field( 'menu_order', $post_id );
	if ( $order > 0 ) {
		return str_pad( $order, 2, '0', STR_PAD_LEFT );
	}
	// Fall back to a deterministic-but-arbitrary 2-digit derived from the ID
	// so unset projects still get a numeral instead of "00".
	return str_pad( ( $post_id % 99 ) + 1, 2, '0', STR_PAD_LEFT );
}

/** Wins repeater → flat array of strings. */
function bain_project_wins( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( ! function_exists( 'have_rows' ) ) {
		return array_filter( (array) get_post_meta( $post_id, 'wins', true ) );
	}
	$out = array();
	if ( have_rows( 'wins', $post_id ) ) {
		while ( have_rows( 'wins', $post_id ) ) {
			the_row();
			$txt = get_sub_field( 'win' );
			if ( $txt ) { $out[] = $txt; }
		}
	}
	return $out;
}

/** Stack repeater → flat array of strings. */
function bain_project_stack( $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	if ( ! function_exists( 'have_rows' ) ) {
		return array_filter( array_map( 'trim', explode( ',', (string) get_post_meta( $post_id, 'stack', true ) ) ) );
	}
	$out = array();
	if ( have_rows( 'stack', $post_id ) ) {
		while ( have_rows( 'stack', $post_id ) ) {
			the_row();
			$txt = get_sub_field( 'tech' );
			if ( $txt ) { $out[] = $txt; }
		}
	}
	return $out;
}

/**
 * Related projects. Uses the manual `related` ACF relationship field if
 * set; otherwise pulls 2 most-recent projects sharing a project_tag.
 *
 * @return WP_Post[]
 */
function bain_project_related( $post_id = null, $limit = 2 ) {
	$post_id = $post_id ?: get_the_ID();
	$picked  = bain_project_field( 'related', $post_id, array() );
	if ( ! empty( $picked ) && is_array( $picked ) ) {
		return array_slice( array_filter( array_map( function ( $p ) {
			return is_object( $p ) ? $p : get_post( $p );
		}, $picked ) ), 0, $limit );
	}
	// auto-pick by shared tag
	$terms = wp_get_post_terms( $post_id, 'project_tag', array( 'fields' => 'ids' ) );
	$args  = array(
		'post_type'      => 'project',
		'posts_per_page' => $limit,
		'post__not_in'   => array( $post_id ),
		'orderby'        => 'date',
		'order'          => 'DESC',
	);
	if ( ! empty( $terms ) ) {
		$args['tax_query'] = array( array(
			'taxonomy' => 'project_tag',
			'terms'    => $terms,
		) );
	}
	return get_posts( $args );
}

/** Adjacent project nav, scoped to the project CPT, ordered by date. */
function bain_project_adjacent( $direction = 'prev' ) {
	$args = array(
		'post_type'      => 'project',
		'posts_per_page' => 1,
		'orderby'        => 'date',
		'order'          => $direction === 'prev' ? 'DESC' : 'ASC',
		'date_query'     => array( array(
			$direction === 'prev' ? 'before' : 'after' => get_the_date( 'Y-m-d H:i:s' ),
		) ),
	);
	$q = get_posts( $args );
	return $q ? $q[0] : null;
}


/* ---------------------------------------------------------------------
 * 4. Template loader — promote our packaged single-project.php
 *    template over WP's default search when a `project` is requested.
 *    Drop this if you'd rather copy single-project.php into the
 *    theme root yourself (WP will find it there without help).
 * ------------------------------------------------------------------ */
add_filter( 'single_template', function ( $template ) {
	if ( is_singular( 'project' ) ) {
		$candidate = get_theme_file_path( 'templates/single-project.php' );
		if ( file_exists( $candidate ) ) {
			return $candidate;
		}
	}
	return $template;
} );


/* ---------------------------------------------------------------------
 * 5. Enqueue the page-specific stylesheet only on single-project views.
 * ------------------------------------------------------------------ */
add_action( 'wp_enqueue_scripts', function () {
	if ( is_singular( 'project' ) ) {
		wp_enqueue_style(
			'bain-single-project',
			get_theme_file_uri( 'assets/css/single-project.css' ),
			array( 'bain-base' ),
			wp_get_theme()->get( 'Version' )
		);
	}
}, 30 );
