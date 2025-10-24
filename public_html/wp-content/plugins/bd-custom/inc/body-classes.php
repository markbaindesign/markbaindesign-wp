<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Add body class
 *
 * @param $classes
 */
if (!function_exists('BD092__curriculum_search_body_classes')):
    function BD092__curriculum_search_body_classes($classes)
    {
        if (is_page('curriculum-search')) {
            $classes[] = 'curriculum-search';
        }
        return $classes;
    }
endif;
add_filter('body_class', 'BD092__curriculum_search_body_classes');
