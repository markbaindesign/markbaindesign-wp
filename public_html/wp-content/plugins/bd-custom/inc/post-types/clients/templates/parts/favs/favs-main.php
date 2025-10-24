<?php

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Favs section
 *
 * Render the section for the favorites list.
 * @param $functionParam       functionDescription
 */
if (!function_exists('bd324_get_template_part_favorites')):
   function bd324_get_template_part_favorites($postId)
   { ?>
      <section class="favorites">
         <div class="favorites__container">
            <div class="favorites__content">

               <div
                  id="favoritesListContainer" class="favorites__list__container"
                  x-show="favsListExpanded"
                  x-collapse>
                  <ul

                     id="favorites-list"
                     class="favorites__list">
                  </ul>
                  <div class="favorites__list__loading">
                     <div class="progress-bar">
                        <span class="bar">
                           <span class="progress"></span>
                        </span>
                     </div>
                  </div>
                  <?php bd324_show_favs_footer($postId); ?>
               </div>
            </div>
         </div>
      </section>
<?php
   }
endif;
