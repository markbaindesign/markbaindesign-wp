<?php // 

if (!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

function bd324_render_favs_postcard($goal)
{ ?>
   <?php echo bd324_get_template_part_learning_goal_postcard_mini(
      $goal['id'],
      $goal['serial'],
      $goal['title'],
      $goal['subtitle'],
      $goal['link']
   ); ?>
   <div class="favs__postcard__actions">
      <div class="favs__postcard__actions__content">
         <?php bd324_remove_from_favs($goal); ?>
         <?php bd324_render_goal_print_button($goal); ?>
      </div>
   </div>
<?php }
