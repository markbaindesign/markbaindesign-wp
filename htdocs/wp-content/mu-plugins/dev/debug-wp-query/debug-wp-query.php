<?php
 
function wp_query_debug() {
  global $wp, $wp_query;
 
  echo '<pre>';
  var_dump($wp->matched_rule);
  print_r($wp_query);
  echo '</pre>';
}
add_action('wp_head', 'wp_query_debug');
