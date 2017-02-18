<?php
/**
 * Admin functions for the plugin.
 *
 * @package    CustomContentTestimonials
 * @subpackage Admin
 * @since      0.1.0
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2013, Justin Tadlock
 * @link       http://themehybrid.com/plugins/nice-words
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Set up the admin functionality. */
add_action( 'admin_menu', 'mbd_admin_setup' );

/**
 * Adds actions where needed for setting up the plugin's admin functionality.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function mbd_admin_setup() {

	// Waiting on @link http://core.trac.wordpress.org/ticket/9296
	//add_action( 'admin_init', 'ccp_admin_setup' );

	/* Custom columns on the edit portfolio items screen. */
	add_filter( 'manage_testimonials_posts_columns', 'mbd_edit_testimonials_columns' );
	add_action( 'manage_testimonials_posts_custom_column', 'mbd_manage_testimonials_columns', 10, 2 );

	/* Add meta boxes and save metadata. */
	add_action( 'add_meta_boxes', 'mbd_add_meta_boxes' );
	add_action( 'save_post', 'mbd_testimonials_info_meta_box_save', 10, 2 );

	/* Add 32px screen icon. */
	add_action( 'admin_head', 'mbd_admin_head_style' );
}

/**
 * Sets up custom columns on the portfolio items edit screen.
 *
 * @since  0.1.0
 * @access public
 * @param  array  $columns
 * @return array
 */
function mbd_edit_testimonials_columns( $columns ) {

	unset( 
		$columns['title'],
		$columns['author'],
		$columns['comments'] // No Comma on last item!
		);

	$new_columns = array(
		'cb' => '<input type="checkbox" />',
		'id' => __( 'ID', 'nice-words' ),
		'title' => __( 'Testimonial Item', 'nice-words' ),
		'name' => __( 'Name', 'nice-words' ),
		'nationality' => __( 'Nationality', 'nice-words' ),
		'date_of_course' => __( 'Date', 'nice-words' ),
	);

	if ( current_theme_supports( 'post-thumbnails' ) )
		$new_columns['thumbnail'] = __( 'Thumbnail', 'nice-words' );


	return array_merge( $new_columns, $columns );
}

/**
 * Displays the content of custom portfolio item columns on the edit screen.
 *
 * @since  0.1.0
 * @access public
 * @param  string  $column
 * @param  int     $post_id
 * @return void
 */
function mbd_manage_testimonials_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		case 'thumbnail' :

			if ( has_post_thumbnail() )
				the_post_thumbnail( array( 40, 40 ) );

			elseif ( function_exists( 'get_the_image' ) )
				get_the_image( array( 'image_scan' => true, 'width' => 40, 'height' => 40 ) );

			break;
		
		case "name":
			$custom = get_post_custom();
			echo $custom["full_name"][0];
		break;

		case "nationality":
			$custom = get_post_custom();
			echo $custom["nationality"][0];
		break;
		
		case "date_of_course":
			$custom = get_post_custom();
			$date = $custom["date_of_course"][0];
			echo date('M Y', strtotime($date));
		break;
		
		case 'id':
			echo $post_id;
		break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

/**
 * Registers new meta boxes for the 'portfolio_item' post editing screen in the admin.
 *
 * @since  0.1.0
 * @access public
 * @param  string  $post_type
 * @return void
 */
function mbd_add_meta_boxes( $post_type ) {

	if ( 'testimonials' === $post_type ) {

		add_meta_box( 
			'ccp-item-info', 
			__( 'Client Info', 'nice-words' ), 
			'mbd_testimonials_info_meta_box_display', 
			$post_type, 
			'side', 
			'core'
		);
		

	}
}

/**
 * Displays the content of the portfolio item info meta box.
 *
 * @since  0.1.0
 * @access public
 * @param  object  $post
 * @param  array   $metabox
 * @return void
 */
function mbd_testimonials_info_meta_box_display( $post, $metabox ) {

	wp_nonce_field( basename( __FILE__ ), 'ccp-portfolio-item-info-nonce' ); ?>

	<p>
		<label for="mbd-testimonials-client"><?php _e( 'Name', 'nice-words' ); ?></label>
		<br />
		<input type="text" name="mbd-testimonials-client" id="mbd-testimonials-client-name" value="<?php echo( get_post_meta( $post->ID, 'full_name', true ) ); ?>" size="30" tabindex="30" style="width: 99%;" />
	</p>
	<p>
		<label for="mbd-testimonials-nationality"><?php _e( 'Nationality', 'nice-words' ); ?></label>
		<br />
		<input type="text" name="mbd-testimonials-nationality" id="mbd-testimonials-nationality" value="<?php echo ( get_post_meta( $post->ID, 'nationality', true ) ); ?>" size="30" tabindex="30" style="width: 99%;" />
	</p>
	<p>
		<label for="mbd-testimonials-date"><?php _e( 'Date (mm/yy)', 'nice-words' ); ?></label>
		<br />
		<input type="text" name="mbd-testimonials-date" id="mbd-testimonials-date" value="<?php echo ( get_post_meta( $post->ID, 'date_of_course', true ) ); ?>" size="30" tabindex="30" style="width: 99%;" />
	</p>
	<?php

	/* Allow devs to hook in their own stuff here. */
	do_action( 'nw_item_info_meta_box', $post, $metabox );
}

/**
 * Saves the metadata for the portfolio item info meta box.
 *
 * @since  0.1.0
 * @access public
 * @param  int     $post_id
 * @param  object  $post
 * @return void
 */
function mbd_testimonials_info_meta_box_save( $post_id, $post ) {

	if ( !isset( $_POST['nw-portfolio-item-info-nonce'] ) || !wp_verify_nonce( $_POST['nw-portfolio-item-info-nonce'], basename( __FILE__ ) ) )
		return;

	$meta = array(
		'full_name' =>  $_POST['mbd-testimonials-client'] ,
		'nationality' => $_POST['mbd-testimonials-nationality'] ,
		'date_of_course' => $_POST['mbd-testimonials-date'] ,

	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If there is no new meta value but an old value exists, delete it. */
		if ( current_user_can( 'delete_post_meta', $post_id, $meta_key ) && '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		/* If a new meta value was added and there was no previous value, add it. */
		elseif ( current_user_can( 'add_post_meta', $post_id, $meta_key ) && $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		/* If the new meta value does not match the old value, update it. */
		elseif ( current_user_can( 'edit_post_meta', $post_id, $meta_key ) && $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );
	}
}

/**
 * Adds plugin settings.  At the moment, this function isn't being used because we're waiting for a bug fix
 * in core.  For more information, see: http://core.trac.wordpress.org/ticket/9296
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function nw_plugin_settings() {

	/* Register settings for the 'permalink' screen in the admin. */
	register_setting(
		'permalink',
		'plugin_nice_words',
		'nw_validate_settings'
	);

	/* Adds a new settings section to the 'permalink' screen. */
	add_settings_section(
		'nw-permalink',
		__( 'Portfolio Settings', 'nice-words' ),
		'nw_permalink_section',
		'permalink'
	);

	/* Get the plugin settings. */
	$settings = get_option( 'plugin_nice_words', nw_get_default_settings() );

	add_settings_field(
		'nw-root',
		__( 'Testimonial archive', 'nice-words' ),
		'nw_root_field',
		'permalink',
		'nw-permalink',
		$settings
	);
	add_settings_field(
		'nw-base',
		__( 'Testimonial taxonomy slug', 'nice-words' ),
		'nw_base_field',
		'permalink',
		'nw-permalink',
		$settings
	);
	add_settings_field(
		'nw-item-base',
		__( 'Testimonial item slug', 'nice-words' ),
		'nw_item_base_field',
		'permalink',
		'nw-permalink',
		$settings
	);
}

/**
 * Validates the plugin settings.
 *
 * @since  0.1.0
 * @access public
 * @param  array  $settings
 * @return array
 */
function nw_validate_settings( $settings ) {

	// @todo Sanitize for alphanumeric characters
	// @todo Both the portfolio_base and portfolio_item_base can't match.

	$settings['testimonials_base'] = $settings['testimonials_base'];

	$settings['testimonial_item_base'] = $settings['testimonial_item_base'];

	$settings['testimonials_root'] = !empty( $settings['testimonials_root'] ) ? $settings['testimonials_root'] : 'testimonials';

	return $settings;
}

/**
 * Adds the portfolio permalink section.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function nw_permalink_section() { ?>
	<table class="form-table">
		<?php do_settings_fields( 'permalink', 'nice-words' ); ?>
	</table>
<?php }

/**
 * Adds the testimonial root settings field.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function nw_root_field( $settings ) { ?>
	<input type="text" name="plugin_nw[testimonials_root]" id="nw-testimonials-root" class="regular-text code" value="<?php echo esc_attr( $settings['testimonials_root'] ); ?>" />
	<code><?php echo home_url( $settings['testimonials_root'] ); ?></code> 
<?php }

/**
 * Adds the coursetype (taxonomy) base settings field.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function nw_base_field( $settings ) { ?>
	<input type="text" name="plugin_nw[coursetype_base]" id="nw-coursetype-base" class="regular-text code" value="<?php echo esc_attr( $settings['coursetype_base'] ); ?>" />
	<code><?php echo trailingslashit( home_url( "{$settings['coursetype_root']}/{$settings['coursetype_base']}" ) ); ?>%coursetype%</code> 
<?php }

/**
 * Adds the testimonials (post type) base settings field.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function nw_item_base_field( $settings ) { ?>
	<input type="text" name="plugin_nw[testimonials_base]" id="nw-testimonials-base" class="regular-text code" value="<?php echo esc_attr( $settings['testimonials_base'] ); ?>" />
	<code><?php echo trailingslashit( home_url( "{$settings['testimonials_root']}/{$settings['testimonials_base']}" ) ); ?>%postname%</code> 
<?php }

/**
 * Overwrites the screen icon for portfolio screens in the admin.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function mbd_admin_head_style() {
        global $post_type;

	if ( 'testimonials' === $post_type ) { ?>
		<style type="text/css">
			#icon-edit.icon32-posts-testimonials {
				background: transparent url( '<?php echo CCP_URI . 'images/screen-icon.png'; ?>' ) no-repeat;
			}
		</style>
	<?php }
}

?>
