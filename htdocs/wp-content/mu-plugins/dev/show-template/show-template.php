<?php

function mbd_show_template() {
	global $template;
 
  echo '<pre>';
	print_r( $template );
	echo '</pre>';
}
add_action( 'wp_head', 'mbd_show_template' );
