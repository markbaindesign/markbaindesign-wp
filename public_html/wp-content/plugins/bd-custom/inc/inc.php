<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

$active_language = array(
    'active_language' => apply_filters('wpml_current_language', null),
);

require_once BD092__PLUGIN_DIR . '/inc/acf.php';
require_once BD092__PLUGIN_DIR . '/inc/helpers/helpers.php';
require_once BD092__PLUGIN_DIR . '/inc/post-types/register.php';
require_once BD092__PLUGIN_DIR . '/inc/clients/business-logic.php';
require_once BD092__PLUGIN_DIR . '/inc/projects/business-logic.php';
require_once BD092__PLUGIN_DIR . '/inc/testimonials/business-logic.php';
require_once BD092__PLUGIN_DIR . '/inc/admin/index.php';
