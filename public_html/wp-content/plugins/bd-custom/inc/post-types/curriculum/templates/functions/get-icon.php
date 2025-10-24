<?php // 

if(!defined('ABSPATH')) {
   die('Invalid request, dude!');
}

/**
 * Get icon
 *
 * Returns a default SVG icon. Can be filter for the specified ID.
 * @param $id
 */
if(!function_exists('bd324_get_icon')):
   function bd324_get_icon($id)
   {
      return apply_filters('bd324_filter_get_icon_' . $id, '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2025 Fonticons, Inc.--><path d="M416 240H32V64c0-17.7 14.3-32 32-32h320c17.7 0 32 14.3 32 32v176zM0 256v192c0 35.3 28.7 64 64 64h320c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64C28.7 0 0 28.7 0 64v192zm416 192c0 17.7-14.3 32-32 32H64c-17.7 0-32-14.3-32-32V272h384v176zM160 96c-17.7 0-32 14.3-32 32v16c0 8.8 7.2 16 16 16s16-7.2 16-16v-16h128v16c0 8.8 7.2 16 16 16s16-7.2 16-16v-16c0-17.7-14.3-32-32-32H160zm0 256c-17.7 0-32 14.3-32 32v16c0 8.8 7.2 16 16 16s16-7.2 16-16v-16h128v16c0 8.8 7.2 16 16 16s16-7.2 16-16v-16c0-17.7-14.3-32-32-32H160z"/></svg></span>');
   }
endif;
