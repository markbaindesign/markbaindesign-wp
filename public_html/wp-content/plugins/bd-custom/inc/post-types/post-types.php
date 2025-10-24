<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

require_once BD092__PLUGIN_DIR . '/inc/post-types/clients/index.php';
require_once BD092__PLUGIN_DIR . '/inc/post-types/taxonomies/index.php';

function remove_post_type_menus()
{
    remove_menu_page('edit.php'); // Posts
    remove_menu_page('edit.php?post_type=course');
    remove_menu_page('edit.php?post_type=certificate');
    remove_menu_page('edit.php?post_type=coupon');
    remove_menu_page('edit.php?post_type=quiz');
}
// add_action('admin_menu', 'remove_post_type_menus');
