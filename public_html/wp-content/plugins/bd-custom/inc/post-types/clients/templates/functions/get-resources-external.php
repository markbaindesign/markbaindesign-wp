<?php // 

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

if (!function_exists('bd324_get_learning_goal_resources_external')):
   function bd324_get_learning_goal_resources_external($post_id, $field)
   {
      $output = [];
      $content = get_field($field, $post_id);

      if ($content) {
         // Remove any wrapper tags, e.g. p, div, span
         $content = preg_replace('/<(p|div|span)\b[^>]*>(.*?)<\/\1>/is', '$2', $content);

         // Convert data with options
         $output = bd324_filter_convert_data_with_options($content, false);

         // Split string into array if needed
         if (is_string($output) && strpos($output, ',') !== false) {
            $output = array_map('trim', explode(',', $output));
         }

         // Remove empty items
         if (is_array($output)) {
            foreach ($output as &$item) {
               if (isset($item['content'])) {
                  $item['content'] = preg_replace('/<p\b[^>]*>(.*?)<\/p>/is', '$1', $item['content']);
               }
            }
            unset($item);
         }

         // Ensure output is an array
         if (!is_array($output)) {
            $output = (array) $output;
         }
      }
      return $output;
   }
endif;
