<?php // 

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

if (!function_exists('bd324_get_learning_goal_resources_internal')):
   function bd324_get_learning_goal_resources_internal($post_id, $field)
   {
      $output = [];
      $posts = get_field($field, $post_id);
      if (is_array($posts)) {
         foreach ($posts as $post) {
            if (is_object($post) && isset($post->ID)) {
               $post_id = $post->ID;
            } else {
               $post_id = $post;
            }
            $title = get_the_title($post_id);
            $permalink = get_permalink($post_id);
            if ($title && $permalink) {
               $output[] = '<a href="' . esc_url($permalink) . '">' . esc_html($title) . '</a>';
            }
         }
      }
      return $output;
   }
endif;