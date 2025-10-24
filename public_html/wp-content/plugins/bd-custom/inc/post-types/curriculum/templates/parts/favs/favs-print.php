<?php // 

if(!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Render Print Button
 *
 * This function renders a print button for a specific goal.
 *
 * @param array $goal An associative array containing 'id' and 'title' of the goal.
 */
if (!function_exists('bd324_render_goal_print_button')) {
   function bd324_render_goal_print_button($goal)
   {
      $output = '';
      $output .= bd324_goal_print($goal);
      echo $output;
   }
}
