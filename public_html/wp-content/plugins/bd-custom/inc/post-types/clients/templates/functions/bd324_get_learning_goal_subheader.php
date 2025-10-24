<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Get the learning goal subheader
 * @param $post_id
 */
if(!function_exists('bd324_get_learning_goal_subheader')):
   function bd324_get_learning_goal_subheader($post_id)
   {
      $output = '';
      $output .= get_field('byline', $post_id);
      return $output;
   }
endif;
