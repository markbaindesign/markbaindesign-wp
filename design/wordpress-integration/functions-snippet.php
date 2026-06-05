<?php
/**
 * Bain Design — theme integration
 *
 * Paste this block into your theme's functions.php (or require it as a
 * separate file: `require get_theme_file_path( 'inc/bain-design.php' );`).
 *
 * Assumes the following structure inside your theme:
 *
 *   assets/css/tokens.css
 *   assets/css/base.css
 *   inc/bain-design-system.php   (template tags — see separate file)
 *
 * Tested against a classic PHP theme (not block / FSE). Drop into a
 * child theme if you're customising a third-party parent.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* ---------------------------------------------------------------------
 * 1. Preconnect to Google Fonts (cuts ~100ms off first paint)
 * ------------------------------------------------------------------ */
add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}, 1 );


/* ---------------------------------------------------------------------
 * 2. Enqueue stylesheets in dependency order:
 *      fonts -> tokens -> base -> theme
 *    The theme's own style.css depends on tokens so var() lookups work.
 * ------------------------------------------------------------------ */
add_action( 'wp_enqueue_scripts', function () {
	$ver = wp_get_theme()->get( 'Version' );

	wp_enqueue_style(
		'bain-fonts',
		'https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700&family=IBM+Plex+Mono:wght@400;500&family=Source+Serif+4:opsz,wght@8..60,400;8..60,500;8..60,600;8..60,700&display=swap',
		array(),
		null
	);

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

	// Re-register the theme's own style.css so it depends on the tokens.
	wp_enqueue_style(
		'bain-theme',
		get_stylesheet_uri(),
		array( 'bain-base' ),
		$ver
	);
}, 20 );


/* ---------------------------------------------------------------------
 * 3. Editor styles — load tokens (and base) inside the classic editor
 *    so authors see something close to front-end output.
 * ------------------------------------------------------------------ */
add_action( 'after_setup_theme', function () {
	add_theme_support( 'editor-styles' );
	add_editor_style( array(
		'assets/css/tokens.css',
		'assets/css/base.css',
	) );
} );


/* ---------------------------------------------------------------------
 * 4. Body classes — opt long-form templates into the "letter" layout
 *    (generous left margin, copy hugs the right gutter).
 * ------------------------------------------------------------------ */
add_filter( 'body_class', function ( $classes ) {
	if (
		is_singular( 'post' ) ||
		is_page_template( 'page-about.php' ) ||
		is_page( array( 'about', 'colophon' ) )
	) {
		$classes[] = 'bain-letter';
	}
	return $classes;
} );


/* ---------------------------------------------------------------------
 * 5. Template tags — pull in the Bain helpers used by templates.
 *    (See inc/bain-design-system.php in this package.)
 * ------------------------------------------------------------------ */
require get_theme_file_path( 'inc/bain-design-system.php' );


/* ---------------------------------------------------------------------
 * 5b. Project CPT + single-project template + ACF field group.
 *     Comment this require out if you don't need the portfolio.
 * ------------------------------------------------------------------ */
require get_theme_file_path( 'inc/cpt-project.php' );


/* ---------------------------------------------------------------------
 * 6. Tame core overrides that fight the brand.
 *    - Disable WP's auto-generated block library CSS variants if you
 *      aren't using blocks for this site. (Keep this commented unless
 *      you're sure.)
 *    - Strip emoji script — Bain doesn't use emoji anywhere except ♥,
 *      and the script is dead weight.
 * ------------------------------------------------------------------ */

// Kill the front-end emoji detector.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Optional: remove the global-styles inline blob added by core block
// styles. Uncomment only if you're sure your theme doesn't render blocks.
// add_action( 'wp_enqueue_scripts', function () {
//     wp_dequeue_style( 'wp-block-library' );
//     wp_dequeue_style( 'wp-block-library-theme' );
//     wp_dequeue_style( 'global-styles' );
// }, 100 );
