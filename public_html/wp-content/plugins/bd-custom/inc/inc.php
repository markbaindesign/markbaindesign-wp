<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

$active_language = array(
    'active_language' => apply_filters('wpml_current_language', null),
);

/* Requires */
require_once BD092__PLUGIN_DIR . '/inc/acf.php';
// require_once BD092__PLUGIN_DIR . '/inc/admin/index.php';
// require_once BD092__PLUGIN_DIR . '/inc/body-classes.php';
// require_once BD092__PLUGIN_DIR . '/inc/data.php';
require_once BD092__PLUGIN_DIR . '/inc/post-types/post-types.php';
// require_once BD092__PLUGIN_DIR . '/inc/redirect.php';
// require_once BD092__PLUGIN_DIR . '/inc/scripts.php';
// require_once BD092__PLUGIN_DIR . '/inc/shortcodes/shortcodes.php';
// require_once BD092__PLUGIN_DIR . '/inc/styles.php';
// require_once BD092__PLUGIN_DIR . '/inc/nav.php';
// require_once BD092__PLUGIN_DIR . '/inc/templates.php';
// require_once BD092__PLUGIN_DIR . '/inc/tours/index.php';
