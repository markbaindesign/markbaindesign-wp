<?php // 

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

function bd324_get_template_part_favorites()
{
   $output = '<div class="favorites">';

   // Favorites list header
   $output .= '<h5 
      class="favorites__header" 
      x-bind:title="$store.favorites.count > 0 ? \'You have \' + $store.favorites.count + \' favs\' : \'You have no favs\'"
   >';
   $output .= esc_html__('Your Favorites', 'text-domain') . ' (<span x-text="$store.favorites.count"></span>)</h5>';

   $output .= '<div class="favorites__list__container">';
   $output .= '<ul id="favorites-list" class="favorites__list"></ul>';

   $output .= '<div class="favorites__footer">';
   $output .= '<a 
      class="clear-favorites-btn" 
      @click="clearFavorites()" 
      :class="{ \'disabled\': $store.favorites.count === 0 }" 
      :aria-disabled="$store.favorites.count === 0"
      style="cursor: pointer;"
      x-bind:style="$store.favorites.count === 0 ? \'pointer-events: none; opacity: 0.5;\' : \'\'"
      x-bind:title="$store.favorites.count > 0 ? \'Click here to clear your \' + $store.favorites.count + \' favorites.\' : \'You have no favs\'"
   >
      Clear All Favorites
   </a>';
   $output .= '<a 
      class="print-favorites-btn" 
      @click="printPages($store.favorites.ids)" 
      :class="{ \'disabled\': $store.favorites.count === 0 }" 
      :aria-disabled="$store.favorites.count === 0"
      style="cursor: pointer;"
      x-bind:style="$store.favorites.count === 0 ? \'pointer-events: none; opacity: 0.5;\' : \'\'"
      x-bind:title="$store.favorites.count > 0 ? \'Click here to print your \' + $store.favorites.count + \' favorites.\' : \'You have no favs\'"
   >
      Print Favorites
   </a>';
   $output .= '</div>';
   $output .= '</div>';

   return $output;
}


