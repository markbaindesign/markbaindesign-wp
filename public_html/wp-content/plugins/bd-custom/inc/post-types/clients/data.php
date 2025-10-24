<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Get learning goal data in a structured array.
 *
 * @param $post_id       The ID of the post to retrieve data for.
 * @return array        An associative array of learning goal data.
 */
if (!function_exists('bd324_get_learning_goal_data')):
    function bd324_get_learning_goal_data($post_id)
    {
        $goal_data = [
            'post_id' => $post_id,
            'serial' => get_field('serial', $post_id),
            'title' => get_the_title($post_id),
            'url' => get_permalink($post_id),
            'priority' => get_field('priority', $post_id),
            'subheader' => get_field('byline', $post_id),
        ];

        // Descriptors
        $descriptors = [];
        $action = get_post_meta($post_id, 'action', true);
        $knowledge = get_post_meta($post_id, 'knowledge', true);
        $understanding = get_post_meta($post_id, 'understanding', true);
        if (isset($knowledge) && !empty($knowledge)) {
            $descriptors['knowledge'] = $knowledge;
        }
        if (isset($understanding) && !empty($understanding)) {
            $descriptors['understanding'] = $understanding;
        }
        if (isset($action) && !empty($action)) {
            $descriptors['action'] = $action;
        }
        // Add $descriptors to $goal_data if needed
        if (!empty($descriptors)) {
            $goal_data['descriptors'] = $descriptors;
        }

        // Taxonomies
        $taxonomies = [
            'framework-domain' => 'framework-domain',
            'framework-level' => 'framework-level',
            'framework-strand' => 'framework-strand',
            'framework-path' => 'framework-path',
            'framework-grade' => 'framework-grade',
            'framework-principles' => 'framework-principles',
        ];
        foreach ($taxonomies as $taxonomy => $key) {
            $terms = get_the_terms($post_id, $taxonomy);
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    if ($term->parent == 0) {
                        $goal_data['taxonomies'][$key] = [
                            'name' => $term->slug,
                            'display' => $term->name,
                        ];
                        break; // Only include the first parent term
                    }
                }
            }
        }
        return $goal_data;
    }
endif;
