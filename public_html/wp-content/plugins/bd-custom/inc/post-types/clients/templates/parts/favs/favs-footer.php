<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Fa vs footer
 *
 * Render the footer for the favorites list.
 * @param $functionParam       functionDescription
 */
if (!function_exists('bd324_show_favs_footer')):
   function bd324_show_favs_footer($postId)
   { ?>
      <footer class="favorites__footer">
         <a
            class="icon-label clear-favorites-btn"
            @click="clearFavorites()"
            :class="{ 'disabled': $store.favoritesCount.count === 0 }"
            :aria-disabled="$store.favoritesCount.count === 0"
            style="cursor: pointer;"
            x-bind:style="$store.favoritesCount.count === 0 ? 'pointer-events: none; opacity: 0.5;' : ''"
            x-bind:title="$store.favoritesCount.count > 0 ? 'Click here to clear your ' + $store.favoritesCount.count + ' favorites.' : 'You have no favs'"

            >
            <span class="label--icon">
               <i class="icon icon--small icon--delete"><?php echo bd324_get_icon('clear_favorites'); ?></i></span>
            <?php echo esc_html__('Clear All Favorites', 'text-domain'); ?>
            (<span x-text="$store.favoritesCount.count"></span>)
         </a>
      </footer>
<?php
   }
endif;
