<?php
/**
 * Shortcode functions for the plugin.
 */

// Set up 
	
	add_action( 'init', 'mbd_testimonials_register_shortcodes' );

// Functions 

function mbd_testimonials_register_shortcodes(){
	
	add_shortcode('testimonials', 'mbd_add_testimonials_shortcode');

}

function mbd_add_testimonials_shortcode($atts) {
	
	extract(shortcode_atts(array(
			"id" => '', // Sets up shortcode variable and default
	), $atts));
	
	// The Query
	
	$query = new WP_Query( array( 
		'post_type' => 'testimonial_item', 
		'p' => $id // Post ID
	));
        
	//The Loop
	
    while ( $query->have_posts() ) : $query->the_post(); 
		ob_start(); // http://kovshenin.com/2013/get_template_part-within-shortcodes/
			get_template_part( 'content', 'testimonial_item-insert' );
		return ob_get_clean();
    endwhile; 
 
	//Reset Query
    wp_reset_postdata();   

}
?>
