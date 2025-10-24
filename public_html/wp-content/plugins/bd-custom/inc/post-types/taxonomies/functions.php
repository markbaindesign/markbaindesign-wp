<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

function display_framework_terms($terms, $taxonomy, $level = 0, $show_action = true)
{
   if (empty($terms) || is_wp_error($terms)) {
      return;
   }
   echo '<ul class="framework-path-list">';
   foreach ($terms as $term) {
      echo '<li>';
      // Heading tag based on level
      if ($level === 0) {
         echo '<h2>' . esc_html($term->name) . '</h2>';
      } else {
         echo '<h3>' . esc_html($term->name) . '</h3>';
      }

      // Get children
      $children = get_terms([
         'taxonomy'   => $taxonomy,
         'hide_empty' => false,
         'parent'     => $term->term_id,
      ]);

      if (!empty($children) && !is_wp_error($children)) {
         display_framework_terms($children, $taxonomy, $level + 1, $show_action);
      } else {
         // Only show posts for leaf terms (terms with no children)
         $posts = get_posts([
            'post_type'      => 'any',
            'posts_per_page' => -1,
            'tax_query'      => [
               [
                  'taxonomy' => $taxonomy,
                  'field'    => 'term_id',
                  'terms'    => $term->term_id,
               ],
            ],
         ]);
         if ($posts) {
            echo '<ul class="framework-card-list framework-path-posts">';
            foreach ($posts as $post) {
               $post_id = $post->ID;
               $serial = get_post_meta($post->ID, 'serial', true);
               $subtitle = $show_action ? strip_tags(get_field('action', $post_id), '<a><span><strong><em><b><i><u>') : false;

               echo '<li class="framework-card-list__item">' . bd324_get_template_part_learning_goal_postcard_mini(
                  $post->ID,
                  $serial,
                  get_the_title($post_id),
                  $subtitle,
                  get_permalink($post_id)
               ) . '</li>';
            }
            echo '</ul>';
         }
      }
      echo '</li>';
   }
   echo '</ul>';
}
