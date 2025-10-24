<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Convert Comma Separated String to HTML List
 *
 * Takes a string with items separated by comma and 
 * returns a formated list markup.
 * 
 * @param $text       String to convert
 * @param $separator    Separator
 */
if (!function_exists('bd324_convert_string_to_list')):
   function bd324_convert_string_to_list($text, $separator = '?', $strip_tags = true)
   {
      // Remove structural tags like <p>, <div>, etc., but keep inline tags
      if ($strip_tags) {
         $text = strip_tags($text, '<a><strong><em><b><i><u><span>');
      }

      // Split the string based on the separator
      // Only carry this out on data from the spreadsheet!
      // Data from the database may contain content with commas!
      $items = explode($separator, $text);

      // Start the HTML list with the "list" class
      $output = '<ul class="learning-goal__meta__list list">';

      // Loop through each item
      foreach ($items as $item) {
         $item = trim($item); // Trim whitespace
         if (!empty($item)) { // Skip empty items
            // Add back the separator only if it is '?'
            if ($strip_tags) {
               $item_content = esc_html($item);
            } else {
               $item_content = $item;
            }
            if ($separator === '?') {
               $item_content .= '?';
            }
            $output .= '<li class="learning-goal__meta__list-item">' . $item_content . '</li>';
         }
      }

      // Close the HTML list
      $output .= '</ul>';

      return $output;
   }
endif;

/**
 * Format link-lable pairs
 *
 * e.g. [this is the link title | https://example.com/] 
 * 
 * @param $text         String
 */
if (!function_exists('bd324_convert_links')):
   function bd324_convert_links($text, $external = false)
   {
      /* Vars */
      $output        = '';
      $replacement   = '';
      $pattern = '/\[(.*?)\s*\|\s*(.*?)\]/'; // Regular expression to match the pattern [title | URL]

      // Anchor tag to replace the matched pattern
      $replacement .= '<a target="_blank" class="learning-goal__meta__link converted-link" href="$2"><span>$1</span>';
      $replacement .= '<i class="icon icon--small icon--external"></i>';
      $replacement .= '</a>';

      // Perform the replacement
      $output = preg_replace($pattern, $replacement, $text);
      return $output;
   }
endif;
