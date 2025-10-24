<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_related')):
    function bd324_get_template_part_learning_goal_related($post_id)
    {
        $output = '';
        $content = '';

        // Get the field value
        // Note: value is serial without letter
        $field = get_field('similar_learning_goals', $post_id);

        // Get the framework-grade taxonomy terms
        $terms = get_the_terms($post_id, 'framework-grade');
        $framework_grade = '';
        if ($terms && !is_wp_error($terms)) {
            // Get the first term's name (or modify as needed)
            $framework_grade = $terms[0]->slug;
        }

        /**
         * Extracts a single uppercase letter (A-E) from the given $field string if it matches the pattern 'band-[A-E]'.
         *
         * @var string $letter The extracted letter from the $field, or an empty string if no match is found.
         * @param string $field The input string to search for the pattern.
         * @var array $matches Stores the results of the regular expression match.
         */
        $letter = '';
        if (preg_match('/^band-([a-e])/', $framework_grade, $matches)) {
            $letter = strtoupper($matches[1]);
        }

        /**
         * Processes a comma-separated string by:
         * - Splitting it into an array using commas as delimiters.
         * - Trimming whitespace from each element.
         * - Filtering out any empty values.
         * - Removing duplicate values.
         *
         * @param string $field The comma-separated string to process.
         * @return array The resulting array of unique, non-empty, trimmed values.
         */
        $array = array_unique(array_filter(array_map('trim', explode(',', $field)), function ($value) {
            return $value !== '';
        }));

        if (!empty($array)) {
            $content .= '<ul class="framework-card-list framework-card-list--compact">';
            foreach ($array as $serial) {
                $goal = bd324_get_goal_by_serial(trim($serial . $letter));
                if ($goal) {
                    $content .= '<li class="framework-card-list__item">' . $goal . '</li>';
                }
            }
            $content .= '</ul>';
        }
        if ($content) {
            $id = 'related';
            $icon = bd324_get_icon($id);
            $label = __('Similar Learning Goals', '_BD092_curriculum_plugin');
            $output .= bd324_get_template_learning_goal_meta_list_item($id, $content, $label, $icon);
        }
        return $output;
    }
endif;
