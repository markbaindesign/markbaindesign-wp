<?php
/**
 * _mbbasetheme theme functions definted in /lib/init.php
 *
 * @package _mbbasetheme
 */


/**
 * Register Widget Areas
 */
function mb_widgets_init() {
	// Main Sidebar
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_mbbasetheme' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	// Footer Sidebar
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', '_mbbasetheme' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s item">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );}

/**
 * Remove Dashboard Meta Boxes
 */
function mb_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

/**
 * Change Admin Menu Order
 */
function mb_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php?post_type=page', // Pages
		// 'edit.php', // Posts
		// 'upload.php', // Media
		// 'gf_edit_forms', // Gravity Forms
		// 'genesis', // Genesis
		// 'edit-comments.php', // Comments
		// 'separator2', // Second separator
		// 'themes.php', // Appearance
		// 'plugins.php', // Plugins
		// 'users.php', // Users
		// 'tools.php', // Tools
		// 'options-general.php', // Settings
		// 'separator-last', // Last separator
	);
}

/**
 * Hide Admin Areas that are not used
 */
function mb_remove_menu_pages() {
	// remove_menu_page( 'link-manager.php' );
}

/**
 * Remove default link for images
 */
function mb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ( $image_set !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}

/**
 * Remove default <p> tag on images
 */
function mbdmaster_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/**
 * Show Kitchen Sink in WYSIWYG Editor
 */
function mb_unhide_kitchensink( $args ) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}

/**
 * Enqueue scripts
 */
function mbdmaster324_scripts() {
	
	global $wp_styles;

	// Load the main stylesheet
	wp_enqueue_style( 'mbdmaster324-style', get_stylesheet_directory_uri() . '/style.css' );

	// Add conditional IE stylesheet
	wp_enqueue_style( 'mbdmaster324-style-ie', get_stylesheet_directory_uri() . "/ie.css", array( 'mbdmaster324' )  );
    $wp_styles->add_data( 'mbdmaster324-style--ie', 'conditional', '(lt IE 9) & (!IEMobile)' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( !is_admin() ) {
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-masonry' );	

		// Typekit script 
		wp_enqueue_script( 'mbdmaster324-typekit', '//use.typekit.net/mfk0trc.js');

		// Temporary IconMoon stylesheet
		// wp_enqueue_style( 'mbdmaster324-iconmoon-temp', '//i.icomoon.io/public/temp/492d787a8a/UntitledProject2/style.css');

		// Enqueue javascript plugins
		/** 
		 * Ensure all plugins you want to enqueue are listed in Gruntfile.js!
		 */
		wp_enqueue_script( 'mbdmaster324-customplugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array(), NULL, true );

		// Masonry
		// wp_register_script( 'masonry-latest', 'http://masonry.desandro.com/masonry.pkgd.min.js', array( 'jquery' ), TRUE);
		// wp_enqueue_script( 'masonry-latest' );

		// Custom scripts
		wp_enqueue_script( 'mbdmaster324_customscripts', get_template_directory_uri() . '/assets/js/main.min.js', array(), NULL, true );
		
		// Dequeue default plugin stylesheets
		wp_dequeue_style( 'contact-form-7' );

		/*
		 * It's not necessary to dequeue this plugin's styles - there's a option.
		 */
		// wp_dequeue_style( 'wp-pagenavi' );

	}
}

/**
 * Add Typekit Webfonts Inline Script
 */	
function mbdmaster324_typekit_inline() {
	
	/* Conditionally loads the Typekit script inline if fonts are enqueued */
	
	if ( wp_script_is( 'mbdmaster324-typekit', 'done' ) ) { 
		echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>'; 
	}
}


/**
 * Remove Query Strings From Static Resources
 */
function mb_remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}

/**
 * Remove Read More Jump
 */
function mb_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ($offset) {
		$end = strpos( $link, '"',$offset );
	}
	if ($end) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}

/**
 * Custom body classes
 */
function mbdmaster_body_classes( $classes ) {

	/*
	 * Since we used 'option' in add_setting arguments array
	 * we retrieve the value by using get_option function
	 */
	$mbdmaster_settings = get_option( 'mbdmaster_settings' );	
	
	$classes[] = $mbdmaster_settings['layout_setting'];
	
	return $classes;

}

function lfstyle_add_favicon() {
    	echo '<!-- Custom Favicons -->';
    	echo '<link rel="shortcut icon" href="' . get_bloginfo('wpurl') . '/favicon.ico"/>';
    	echo '<link rel="icon" href="' . get_bloginfo('wpurl') . '/favicon-32.png" sizes="32x32">';
			echo '<meta name="msapplication-TileImage" content="' . get_bloginfo('wpurl') . '/favicon-144.png">';
}

function lfstyle_social_sharing() {
	global $wp_query;
	$postid = $wp_query->post->ID;
	
	// vars
	$my_title = get_the_title();
	$my_link = urlencode( get_permalink() );
	$my_image = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'full' );
	
	echo '<p class="social-title">Share this article</p>';
	echo '<ul class="social-media social-media--share">';
	echo '<li><a href="http://twitter.com/share?url=' . $my_link . '&text=' . $my_title . '" class="js-link-popup icon-twitter-circle"><span class="visuallyhidden">Twitter</span></a></li>';
	echo '<li><a href="http://www.facebook.com/sharer.php?u=' . $my_link . '&t=' . $my_title . '#" class="js-link-popup icon-facebook-circle"><span class="visuallyhidden">Facebook</span></a></li>';
	echo '<li><a href="http://www.pinterest.com/pin/create/button/?url=' . $my_link . '&media=' . $my_image[0] . '&description=' . $my_title . '" class="js-link-popup icon-pinterest-circle"><span class="visuallyhidden">LinkedIn</span></a></li>';
	echo '<li><a href="https://apis.google.com/_/+1/fastbutton?usegapi=1&size=large&hl=en&url=' . $my_link . '"" class="js-link-popup icon-googleplus-circle"><span class="visuallyhidden">GooglePlus</span></a></li>';
	echo '</ul>';

	wp_reset_query();
}

function lfstyle_custom_media_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'full-width' => __('Full width image'),
		  'sq3' => __('Square x3'),
		  'rec' => __('Rectangle'),
		  'letterbox' => __('Letterbox'),
    ) );
}

function html5_img_caption_shortcode($string, $attr, $content = null) {
    extract(shortcode_atts(array(
        'id'    => '',
				'width' => '',
				'align' => 'alignnone',
        'caption' => ''
    ), $attr)
    );
    if ( 1 > (int) $width || empty($caption) )
        return $content;
    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
 
    return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '">' .
        do_shortcode( $content ) .
        '<figcaption class="wp-caption-text">' . $caption . '</figcaption>'.
        '</figure>';
}

/*
 * Build the <picture> element in our theme
 *
 * http://www.taupecat.com/2014/05/picturefill-js-wordpress/
 *
 */

function mbdmaster324_picture() {

if ( get_the_post_thumbnail() != '' ):
	
	$image_small_1  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured_small_1' );
   $image_small_2  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured_small_2' );
   $image_medium_1 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured_medium_1' );
   $image_medium_2 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured_medium_2' );	 
  	$image_large_1  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured_large_1' );
   $image_large_2  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'featured_large_2' );

?>

<picture>
    <!--[if IE 9]><video style="display: none;"><![endif]-->
	<source srcset="<?php echo esc_url( $image_small_1[0] ); ?>" media="(max-width: 20em)">
   <source srcset="<?php echo esc_url( $image_small_2[0] ); ?>" media="(max-width: 30em)">
   <source srcset="<?php echo esc_url( $image_medium_1[0] ); ?>" media="(max-width: 48em)">
   <source srcset="<?php echo esc_url( $image_medium_2[0] ); ?>" media="(max-width: 64em)">
	<source srcset="<?php echo esc_url( $image_large_1[0] ); ?>" media="(max-width: 70em)">	 
	<source srcset="<?php echo esc_url( $image_large_2[0] ); ?>">    

    <!--[if IE 9]></video><![endif]-->
    <img srcset="<?php echo esc_url( $image_large_2[0] ); ?>" alt="" class="banner__image">
</picture>

<?php 
	endif;
}
