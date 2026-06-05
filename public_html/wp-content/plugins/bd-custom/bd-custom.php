<?php

/*
 Plugin Name: BD Custom
 Description: Adds custom functionality.
 Author: Bain Design
 Version: 0.0.0
 Author URI: http://bain.design
 License: GNU General Public License v2.0
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
 Text Domain: _BD092_custom_plugin
 Domain Path: /languages/
 */

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

define('BD092__PLUGIN_FILE', __FILE__);
define('BD092__PLUGIN_HANDLE', 'bd934-custom');
define('BD092__PLUGIN_NAME', 'BD Custom Plugin');
define('BD092__PLUGIN_VERSION', '0.0.0');
define('BD092__PLUGIN_DIR', untrailingslashit(dirname(BD092__PLUGIN_FILE)));
define('BD092__PLUGIN_DIR_NAME', untrailingslashit(dirname(plugin_basename(BD092__PLUGIN_FILE))));

$plugin_dir_url = plugin_dir_url(__FILE__);
define('BD092__PLUGIN_URL', $plugin_dir_url);
define('BD092__SCRIPTS_URL', BD092__PLUGIN_URL . 'assets/js');
define('BD092__STYLES_URL', BD092__PLUGIN_URL . 'assets/css');
define('BD092__IMAGES_URL', BD092__PLUGIN_URL . 'assets/images');

/* Includes */
require_once BD092__PLUGIN_DIR . '/inc/inc.php';
