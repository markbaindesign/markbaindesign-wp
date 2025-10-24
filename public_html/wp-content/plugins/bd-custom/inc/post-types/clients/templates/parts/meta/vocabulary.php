<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_vocabulary')):
    function bd324_get_template_part_learning_goal_vocabulary($post_id)
    {
        /* Vars */
        $output = '';
        $content = '';
        $vocab = get_field('vocabulary', $post_id); // Returns comma separated list of glossary terms

        // Convert string to array
        if (is_string($vocab)) {
            $vocab = explode(',', $vocab);
        }
        // Clean up the array: remove empty values, duplicates, and trim whitespace
        if (is_array($vocab)) {
            $vocab = array_unique(array_filter(array_map('trim', $vocab)));
        }

        /**
         * For each item in $vocab, add an entry to $query_vocab where the key is the original key,
         * and the value is an array with both 'formatted' (original) and 'unformatted' (asterisks removed) values.
         */
        $query_vocab = [];
        if (is_array($vocab)) {
            foreach ($vocab as $key => $term) {
                // Remove asterisks from start/end of term
                $clean_term = trim($term, '*');
                $query_vocab[$key] = [
                   'raw' => $term,
                   'clean' => $clean_term,
                ];
            }
        }

        // For each vocab item in the array, get the matching glossary post
        // if it exists.
        if (is_array($query_vocab)) {
            // Collect all 'clean' values for slug matching
            $slugs = array_map(function ($item) {
                return sanitize_title($item['clean']);
            }, $query_vocab);

            $args = [
            'post_type' => 'glossary',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'post_name__in' => $slugs, // Only return posts where the slug matches
            'orderby' => 'title',
            'order' => 'ASC',
            ];

            $query = new WP_Query($args);

            /**
             * Iterates through a list of vocabulary terms and matches them with post titles from a WP_Query result.
             * For each vocabulary term that matches a post title (case-insensitive), replaces the term in the $vocab array
             * with the result of bd324_get_vocabulary_item() for the matched post.
             *
             * @param WP_Query $query The WP_Query object containing posts to search for matching vocabulary terms.
             * @param array $vocab An array of vocabulary terms to match against post titles.
             * @return void Modifies the $vocab array in place, replacing matched terms with their corresponding vocabulary items.
             */
            if ($query->have_posts()) {
                $posts = $query->posts;
                $matching_glossary_items = [];
                foreach ($query_vocab as $key => $value) {
                    foreach ($posts as $post_id) {
                        $glossary_item_title = get_the_title($post_id);
                        /*
                           * Check if the title matches the value (case-insensitive).
                           * If it does, replace the value in $vocab with the vocabulary item.
                           * Break out of the loop once a match is found to avoid duplicates.
                           */
                        if (strcasecmp($glossary_item_title, $value['clean']) === 0) {
                            $matching_glossary_items[$key] = bd324_get_vocabulary_item($post_id, $value);
                            break;
                        } else {
                            $matching_glossary_items[$key] = bd324_get_vocabulary_item(null, $value);
                        }
                    }
                }
            } else {
                // If no posts were found, use the original vocabulary terms
                $matching_glossary_items = [];
                foreach ($query_vocab as $key => $value) {
                    $matching_glossary_items[$key] = bd324_get_vocabulary_item(null, $value);
                }
            }
        }

        // Convert array to HTML list
        if (is_array($matching_glossary_items) && !empty($matching_glossary_items)) {
            $content = '<ul class="learning-goal__meta__list list">';
            foreach ($matching_glossary_items as $item) {
                $content .= '<li class="learning-goal__meta__list-item">' . $item . '</li>';
            }
            $content .= '</ul>';
        } else {
            $content = '';
        }

        if ($content) {
            $id = 'vocabulary';
            $icon = bd324_get_icon($id);
            $label = __('Vocabulary', '_BD092_curriculum_plugin');
            $output .= bd324_get_template_learning_goal_meta_list_item($id, $content, $label, $icon);
        }
        return $output;
    }
endif;
