<?php // 

if(!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

function get_favorite_posts_callback()
{
   $ids = isset($_POST['ids']) ? array_map('intval', $_POST['ids']) : [];
   $posts = get_posts([
      'post__in' => $ids,
      'post_type' => 'curriculum',
      'order'     => 'ASC',
      'meta_key' => 'serial',
      'orderby'   => 'meta_value_num',
      'posts_per_page' => 300,
   ]);
   foreach ($posts as $post) :
      $goal = [
         'id' => $post->ID,
         'title' => get_the_title($post->ID),
         'link' => get_permalink($post->ID),
         'serial' => get_field('serial', $post->ID),
         'subtitle' => get_field('byline', $post->ID)
      ]; 
   ?>
      <li>
         <?php bd324_render_favs_postcard($goal); ?>
      </li>
   <?php endforeach; ?>
   <?php wp_die(); ?>
   <?php
}
add_action('wp_ajax_nopriv_get_favorite_posts', 'get_favorite_posts_callback');
add_action('wp_ajax_get_favorite_posts', 'get_favorite_posts_callback');
