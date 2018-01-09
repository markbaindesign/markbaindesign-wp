<?php

/**
 * Proper way to enqueue scripts and styles
 */

function mbd_testimonials_styles() {
	wp_register_style('testimonials-plugin-styles', plugins_url('/css/testimonials-styles.css' , __FILE__ ) );
	wp_enqueue_style('testimonials-plugin-styles');
}

add_action( 'wp_enqueue_scripts', 'mbd_testimonials_styles' );

?>