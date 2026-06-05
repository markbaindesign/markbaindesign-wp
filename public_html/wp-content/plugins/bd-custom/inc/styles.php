<?php

// Styles

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Load styles
 */

if (!function_exists('BD092__load_algolia_styles')) :
    function BD092__load_algolia_styles()
    {

        if (!is_admin()) {

            // CUSTOM Curriculum styles
            wp_enqueue_style('search-styles-curriculum', BD092__STYLES_URL .  '/custom/styles.css', '', BD092__PLUGIN_VERSION, 'all');

            // Tour styles
            wp_enqueue_style('bd-curriculum-tour', BD092__STYLES_URL . '/tour.css', '', BD092__PLUGIN_VERSION, 'all');
        }
    }
endif;
add_action('wp_enqueue_scripts', 'BD092__load_algolia_styles');
