<?php // 

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Vocab item template
 *
 * functionDescription
 * @param $functionParam       functionDescription
 */
if (!function_exists('bd324_get_vocabulary_item')):
   function bd324_get_vocabulary_item($post_id, $value)
   {
      $output = '';
      $title = bd324_convert_asterisks_to_italics($value['raw']);

      if ($post_id) {
         $glossary_url = get_site_url() . '/framework/glossary/';
         $first_letter = strtoupper(substr($value['clean'], 0, 1));
         $link = add_query_arg(array('letter' => $first_letter), $glossary_url) . '#glossary-item-' . $post_id;
         // Truncate the title to 50 characters
         $post_content = get_post_field('post_content', $post_id);
         $truncated_title = mb_strimwidth(strip_tags($post_content), 0, 50, '...');
      }

      if ($post_id) {
         $output = '<a href="' . esc_url($link) . '" title="' . esc_attr($truncated_title) . '">' . $title . '</a>';
      } else {
         $output = $title;
      }

      return apply_filters('bd324_filter_get_vocabulary_item', $output, $post_id, $value);
   }
endif;
