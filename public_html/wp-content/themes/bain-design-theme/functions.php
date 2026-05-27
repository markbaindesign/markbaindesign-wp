<?php
/**
 * Bain Design Theme — functions.php
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* =============================================================================
 * Theme setup
 * ============================================================================= */

add_action( 'after_setup_theme', function () {
	// Localisation
	load_theme_textdomain( 'bain-design-theme', get_template_directory() . '/languages' );

	// Featured images
	add_theme_support( 'post-thumbnails' );

	// HTML5 markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Widgets
	add_theme_support( 'widgets' );

	// Navigation menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Navigation', 'bain-design-theme' ),
		'footer'  => esc_html__( 'Footer Links', 'bain-design-theme' ),
	) );

	// Editor styles
	add_theme_support( 'editor-styles' );
	add_editor_style( array(
		'assets/css/tokens.css',
		'assets/css/base.css',
	) );
} );

/* =============================================================================
 * Google Fonts preconnect + CSS enqueue
 * ============================================================================= */

add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1 );

add_action( 'wp_enqueue_scripts', function () {
	$ver = wp_get_theme()->get( 'Version' );

	// Google Fonts
	wp_enqueue_style(
		'bain-fonts',
		'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=IBM+Plex+Mono:wght@400;500&family=Source+Serif+4:opsz,wght@8..60,400;8..60,500;8..60,600;8..60,700&display=swap',
		array(),
		null
	);

	// Design system CSS
	wp_enqueue_style(
		'bain-tokens',
		get_theme_file_uri( 'assets/css/tokens.css' ),
		array( 'bain-fonts' ),
		$ver
	);

	wp_enqueue_style(
		'bain-base',
		get_theme_file_uri( 'assets/css/base.css' ),
		array( 'bain-tokens' ),
		$ver
	);

	// Theme CSS
	wp_enqueue_style(
		'bain-theme',
		get_theme_file_uri( 'assets/css/theme.css' ),
		array( 'bain-base' ),
		$ver
	);

	// Main JS (interaction effects)
	wp_enqueue_script(
		'bain-main',
		get_theme_file_uri( 'assets/js/dist/main.min.js' ),
		array(),
		$ver,
		true
	);
}, 20 );

/* =============================================================================
 * Body classes
 * ============================================================================= */

add_filter( 'body_class', function ( $classes ) {
	// Apply "letter" layout (generous margins) to long-form content
	// Not used on the about page — it has its own full-width editorial layout.
	if ( is_singular( 'post' ) ) {
		$classes[] = 'bain-letter';
	}
	return $classes;
} );

/* =============================================================================
 * Template tags (design system helpers)
 * ============================================================================= */

require get_theme_file_path( 'inc/bain-design-system.php' );

/* =============================================================================
 * Cleanup
 * ============================================================================= */

// Remove emoji script
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
