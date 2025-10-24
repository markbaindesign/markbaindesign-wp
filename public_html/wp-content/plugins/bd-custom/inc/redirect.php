<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Redirect Post Type archive
 *
 * We don't need a post archive, so redirect
 * it to our page with the search shortcode.
 *
 */
if (!function_exists('bd324_redirect_curriculum_post_archive')):
    function bd324_redirect_curriculum_post_archive()
    {
        /* Destination Page */
        $destination = get_site_url(null, '/browse-the-curriculum/');
        if (is_post_type_archive('curriculum')) {
            // Redirect post archive
            nocache_headers();
            wp_redirect($destination, 301, 'WordPress - MWE Theme - bd324_redirect_curriculum_post_archive');
            exit;
        }
    }
endif;
// add_action('template_redirect', 'bd324_redirect_curriculum_post_archive');
