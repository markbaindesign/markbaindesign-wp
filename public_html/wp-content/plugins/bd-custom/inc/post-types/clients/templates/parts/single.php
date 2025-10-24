<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Get Learning Goal Template
 *
 * Return the full template for a single Learning Goal
 * @param $functio$post_id
 */
if (!function_exists('bd324_get_template_learning_goal_single')):
   function bd324_get_template_learning_goal_single($post_id)
   {
      $output = '';
      $output .= '<div class="content content__curriculum">';
      if (function_exists('bd324_get_template_part_learning_goal_header')):
         $output .= bd324_get_template_part_learning_goal_header($post_id);
      endif;
      if (function_exists('bd324_get_template_part_learning_goal_quote')):
         $output .= bd324_get_template_part_learning_goal_quote($post_id);
      endif;
      if (function_exists('bd324_generate_learning_goal_primary_content')):
         $output .= bd324_generate_learning_goal_primary_content($post_id);
      endif;
      if(function_exists('bd324_generate_learning_goal_secondary_content')):
         $output .= bd324_generate_learning_goal_secondary_content($post_id);
      endif;
      $output .= '</div>';

      return $output;
   }
endif;
