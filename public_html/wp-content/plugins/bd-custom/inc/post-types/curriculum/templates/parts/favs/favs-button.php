<?php // 

if(!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Display the like button for a post.
 *
 * @param int $post_id The ID of the post.
 * @return string The HTML output for the like button.
 */
function bd324_get_template_part_like($post_id)
{
   $output = '';
   $output .= '<div class="favorite-button-container">';
   $output .= '<a 
      class="favorite-btn" 
      :class="isFavorited(' . $post_id . ') ? \'favorited\' : \'notFavorited\'" 
      @click="toggleFavorite(' . $post_id . ')"
      @clear-favorites.window="clear(' . $post_id . ')"
      style="cursor: pointer;"
      data-post-id="' . $post_id . '"
      data-post-title="' . htmlspecialchars(get_the_title($post_id), ENT_QUOTES) . '"
      x-bind:title="isFavorited(' . $post_id . ') ? \'Remove from favorites\' : \'Add to favorites\'"
   >';
   $output .= '<span
      class="visually-hidden"
      x-text="isFavorited(' . $post_id . ') ? \'Remove from favorites\' : \'Add to favorites\'"

   ></span>';
   $output .= '</a>';
   $output .= '</div>';

   return $output;
}