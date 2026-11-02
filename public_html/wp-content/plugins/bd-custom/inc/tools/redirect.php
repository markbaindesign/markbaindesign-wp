<?php

if (!defined('ABSPATH')) {
    die('Invalid request.');
}

/**
 * Single tool pages have no public use case.
 *
 * The tools timeline lives entirely on the bd324_tools archive (/tools/),
 * rendered by archive-bd324_tools.php and its D3 gantt. There is no
 * single-bd324_tools.php and no content-single-bd324_tools.php, so a single
 * tool URL renders a structurally valid but completely empty page — an
 * indexable blank 200 (BD-167).
 *
 * Note on the approach: registering bd324_tools with
 * 'publicly_queryable' => false removes the single pages, but it also breaks
 * the archive. WP::parse_request() drops the post_type query var for any type
 * that is not publicly queryable, so the /tools/ archive rewrite resolves to
 * nothing and canonical redirect sends it to the home page. Verified locally.
 * A redirect is therefore the only way to drop the singles while keeping the
 * timeline.
 */
if (!function_exists('bd324_redirect_single_tools')) :
    function bd324_redirect_single_tools()
    {
        if (!is_singular('bd324_tools')) {
            return;
        }

        $destination = get_post_type_archive_link('bd324_tools');

        if (!$destination) {
            return;
        }

        nocache_headers();
        wp_safe_redirect($destination, 301, 'bd324_redirect_single_tools');
        exit;
    }
endif;
add_action('template_redirect', 'bd324_redirect_single_tools');

/**
 * Keep single tools out of site search results, since they redirect anyway.
 */
if (!function_exists('bd324_exclude_tools_from_search')) :
    function bd324_exclude_tools_from_search($query)
    {
        if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
            return;
        }

        $types = $query->get('post_type');

        if (empty($types)) {
            $types = array_values(get_post_types(['exclude_from_search' => false]));
        }

        $types = array_diff((array) $types, ['bd324_tools']);
        $query->set('post_type', $types);
    }
endif;
add_action('pre_get_posts', 'bd324_exclude_tools_from_search');
