<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}


/**
 * Domains Shortcode
 *
 * Displays a list of domains.
 * @param array $atts Shortcode attributes
 * @return string HTML content of the domains list
 */

if (!function_exists('bd324_shortcode_domains')):
   function bd324_shortcode_domains($atts = array())
   {
      extract(shortcode_atts(array(
         'filter_by_tax' => null,
         'filter_by_term' => null,
      ), $atts));

      $terms = get_terms([
         'taxonomy'   => 'framework-domain',
         'hide_empty' => false,
         'parent'     => 0,
      ]);

      if (is_wp_error($terms) || empty($terms)) {
         return;
      }
      
      $terms = sort_terms_by_serial($terms);
      ob_start();

      // Call with initial level 0
      display_framework_path_terms($terms, 'framework-domain', 0, false, $atts['filter_by_tax'], $atts['filter_by_term']);

      $content =  ob_get_contents();
      ob_clean();
      return $content;
   }
endif;

add_shortcode('mwe-domains', 'bd324_shortcode_domains');