<?php

// Nav

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Get adjacent posts by custom field within the same framework-grade taxonomy term.
 *
 * @param string $direction 'next' or 'prev'.
 * @param string $custom_field_key The custom field key to sort by.
 * @param int|null $post_id The current post ID (optional).
 * @return WP_Post|null The adjacent post object or null if not found.
 */
function BD092__get_adjacent_post_by_custom_field($direction = 'next', $custom_field_key = 'serial', $post_id = null)
{
    global $wpdb;

    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $current_post = get_post($post_id);
    if (!$current_post) {
        return null;
    }

    // Get the current post's framework-grade terms
    $current_grade_terms = wp_get_post_terms($post_id, 'framework-grade', ['fields' => 'ids']);
    if (is_wp_error($current_grade_terms) || empty($current_grade_terms)) {
        return null; // No grade terms, can't find adjacent
    }

    $operator = $direction === 'next' ? '>' : '<';
    $order = $direction === 'next' ? 'ASC' : 'DESC';

    // Build term IDs for IN clause
    $term_ids_placeholder = implode(',', array_fill(0, count($current_grade_terms), '%d'));

    $query = $wpdb->prepare(
        "
        SELECT DISTINCT p.*
        FROM $wpdb->posts p
        INNER JOIN $wpdb->postmeta pm ON p.ID = pm.post_id
        INNER JOIN $wpdb->term_relationships tr ON p.ID = tr.object_id
        INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        WHERE p.post_type = %s
          AND p.post_status = 'publish'
          AND p.ID != %d
          AND pm.meta_key = %s
          AND pm.meta_value $operator (
              SELECT meta_value
              FROM $wpdb->postmeta
              WHERE post_id = %d
                AND meta_key = %s
          )
          AND tt.taxonomy = 'framework-grade'
          AND tt.term_id IN ($term_ids_placeholder)
        ORDER BY CAST(pm.meta_value AS DECIMAL(10,3)) $order
        LIMIT 1
        ",
        array_merge(
            [
             $current_post->post_type,
             $post_id,
             $custom_field_key,
             $post_id,
             $custom_field_key
         ],
            $current_grade_terms
        )
    );

    $result = $wpdb->get_row($query);

    return $result ? get_post($result) : null;
}

add_action('wp_footer', function () {
    if (!is_single()) {
        return;
    }
    echo '<div id="nav-spinner" aria-hidden="true"></div>';
});
