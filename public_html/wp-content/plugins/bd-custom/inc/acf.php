<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * If ACF not installed, return
 */
if (!class_exists('ACF')) {
    return;
}

/**
 * Local JSON
 */

/**
 * Custom Save Point for ACF Local JSON
 */
function BD092_acf_json_save_point($path)
{
    return BD092__PLUGIN_DIR . '/acf-json/';
}
add_filter('acf/settings/save_json/key=group_5be07d58217fd', 'BD092_acf_json_save_point'); // "Projects"
add_filter('acf/settings/save_json/key=group_68fa5cdda7847', 'BD092_acf_json_save_point'); // "Clients"
add_filter('acf/settings/save_json/key=group_68fb299ce1b4a', 'BD092_acf_json_save_point'); // "Testimonials"
/**
 * Custom Load Point for ACF Local JSON
 */
function BD092_acf_json_load_point($paths)
{
    // Remove the original path (optional).
    // unset($paths[0]);

    // Append the new path and return it.
    $paths[] = BD092__PLUGIN_DIR . '/acf-json/';

    return $paths;
}
add_filter('acf/settings/load_json', 'BD092_acf_json_load_point');

add_action('acf/init', 'my_acf_op_init');
function my_acf_op_init()
{

    // Check function exists.
    if (function_exists('acf_add_options_page')) {

        // Register options page.
        $option_page = acf_add_options_page(array(
           'page_title'      => __('BD Settings'),
           'menu_title'      => __('BD Settings'),
           'menu_slug'       => 'bd-settings',
           'capability'      => 'edit_posts',
           'parent_slug'     => 'options-general.php',
           'redirect'        => false
        ));
    }
}
