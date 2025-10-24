<?php

if(!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

if(!function_exists('bd324_get_goal_by_serial')):
   function bd324_get_goal_by_serial($serial)
   {
      /* Vars */
      $output = '';
      $args = array(
         'post_type'  => 'curriculum',
         'meta_query' => array(
         array(
            'key'     => 'serial',
            'value'   => $serial,
            'compare' => '='
         )
         )
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) {
         while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();
            $title = get_the_title( $post_id );
            $subtitle = get_field('byline', $post_id);
            $permalink = get_permalink($post_id);
            $output .= bd324_get_template_part_learning_goal_postcard_mini(
               $post_id,
               $serial,
               $title,
               $subtitle,
               $permalink
            );
         }
         wp_reset_postdata();
      }

      return $output;
   }
endif;
