<?php

if(!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

if(!function_exists('bd324_filter_convert_data_with_options')):
   /**
    * Filters and converts data based on the provided parameters.
    * @param string $content The content to be filtered and converted.
    * @param bool $to_list Whether to convert the content to a list.
    * @param bool $links Whether to convert URLs in the content to links.
    * @param bool $clickable Whether to make URLs in the content clickable.
    * @return string The filtered and converted content.
    */
   function bd324_filter_convert_data_with_options($content, $to_list = true, $links = true, $clickable = true)
   {
      if ($to_list === true && function_exists('bd324_convert_string_to_list')) {
         $content = bd324_convert_string_to_list($content, ', ');
      }
      if ($links && function_exists('bd324_convert_links')) {
         $content = bd324_convert_links($content, true);
      }
      if ($clickable && function_exists('make_clickable')) {
         $content = make_clickable($content);
      }
      // Convert asterisks to italics
      if (function_exists('bd324_convert_asterisks_to_italics')) {
         $content = bd324_convert_asterisks_to_italics($content);
      }
      return $content;
   }
endif;

// Adds a filter to convert data with the specified options.
add_filter('bd324_filter_convert_data', 'bd324_filter_convert_data_with_options', 10, 4);

