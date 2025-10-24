<?php

// Scripts

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

function bd324_algolia_register_scripts_favs()
{
    // Register script
    wp_register_script(
        'bd-curriculum-favs',
        BD092__SCRIPTS_URL . '/custom/fav.js',
        array(),
        BD092__PLUGIN_VERSION,
        array(
          'in_footer' => true,
          'strategy'  => 'defer',
      )
    );

    // Enqueue script
    wp_enqueue_script('bd-curriculum-favs');
}

add_action('wp_enqueue_scripts', 'bd324_algolia_register_scripts_favs');

function bd324_enqueue_alpine_js()
{
    // Register Alpine.js
    wp_register_script(
        'alpine-js',
        'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js',
        array(),
        BD092__PLUGIN_VERSION,
        array(
          'in_footer' => true,
          'strategy'  => 'defer',
      )
    );

    // Register Alpine.js
    wp_register_script(
        'alpine-js-collapse',
        'https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js',
        array(),
        BD092__PLUGIN_VERSION,
        array(
          'in_footer' => true,
          'strategy'  => 'defer',
      )
    );

    // Enqueue Alpine.js globally
    wp_enqueue_script('alpine-js-collapse');
    wp_enqueue_script('alpine-js');
}
add_action('wp_enqueue_scripts', 'bd324_enqueue_alpine_js');
add_action('wp_enqueue_scripts', 'bd324_enqueue_curriculum_filters');

function bd324_enqueue_curriculum_tour()
{
    // Register curriculum tour script
    wp_register_script(
        'bd-curriculum-tour',
        BD092__SCRIPTS_URL . '/custom/tour.js',
        array(),
        BD092__PLUGIN_VERSION,
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );

    // Enqueue script
    wp_enqueue_script('bd-curriculum-tour');

    // Get tour data from ACF options
    $tour_data = bd324_get_tour_data_from_acf();

    // Pass data to JavaScript
    wp_localize_script(
        'bd-curriculum-tour',
        'curriculumTourData',
        [
            'tours' => $tour_data,
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('curriculum_tour_nonce'),
            'debugMode' => WP_DEBUG,
            'isAdmin' => current_user_can('manage_options')
        ]
    );
}

add_action('wp_enqueue_scripts', 'bd324_enqueue_curriculum_tour');

/**
 * Enqueues the navigation JavaScript file for the theme or plugin.
 *
 * This function registers a JavaScript file named 'nav-js' using the `wp_register_script` function.
 * The script is located at the URL defined by the constant `BD092__SCRIPTS_URL` and the path `/custom/nav.js`.
 * It is versioned using the constant `BD092__PLUGIN_VERSION` and is configured to load in the footer
 * with a `defer` loading strategy.
 *
 * @return void
 */
function bd324_enqueue_nav_js()
{
    // Register
    wp_register_script(
        'nav-js',
        BD092__SCRIPTS_URL . '/custom/nav.js',
        array(),
        BD092__PLUGIN_VERSION,
        array(
          'in_footer' => true,
          'strategy'  => 'defer',
      )
    );
    // Enqueue
    wp_enqueue_script('nav-js');
}

add_action('wp_enqueue_scripts', 'bd324_enqueue_nav_js');

/**
 * Enqueue Highlight.js for code highlighting in AI Helper modal,
 * only on 'curriculum' post type.
 */
function bd324_enqueue_highlight_js()
{
    if (is_singular('curriculum')) {
        // Register Highlight.js CSS
        wp_register_style(
            'highlight-js-github',
            'https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.11.1/build/styles/default.min.css',
            array(),
            BD092__PLUGIN_VERSION
        );
        wp_enqueue_style('highlight-js-github');

        // Register theme for Highlight.js
        wp_register_style(
            'highlight-js-theme',
            'https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.11.1/build/styles/atom-one-dark.min.css',
            array(),
            BD092__PLUGIN_VERSION
        );
        wp_enqueue_style('highlight-js-theme');

        // Register Highlight.js JS
        wp_register_script(
            'highlight-js',
            'https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.11.1/build/highlight.min.js',
            array(),
            BD092__PLUGIN_VERSION,
            array(
              'in_footer' => true,
              'strategy'  => 'defer',
         )
        );
        wp_enqueue_script('highlight-js');
    }
}
add_action('wp_enqueue_scripts', 'bd324_enqueue_highlight_js');
