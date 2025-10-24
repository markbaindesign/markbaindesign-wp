<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Get Quote
 *
 * Retrieves a quote associated with a given post ID.
 *
 * @param int $post_id The ID of the post to retrieve the quote from.
 * @return string The quote associated with the given post ID.
 */
if (!function_exists('bd324_get_template_part_learning_goal_quote')):
   function bd324_get_template_part_learning_goal_quote($post_id)
   {
      $output = '';
      $field = get_field('quotes', $post_id);
      if ($field) {
         $output .= '<div class="quote">';
         $field = bd324_convert_links($field);
         $field = make_clickable($field);
         $field = bd324_convert_asterisks_to_italics($field);

         // Wrap text including mdash in a span
         $field = preg_replace('/(—.*)/', '<span class="attr">$1</span>', $field);

         $output .= $field;
         $output .= '</div>';
      }
      return $output;
   }
endif;
