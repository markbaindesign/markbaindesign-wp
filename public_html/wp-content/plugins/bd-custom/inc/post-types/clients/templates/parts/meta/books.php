<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

if (!function_exists('bd324_get_template_part_learning_goal_books')):
    function bd324_get_template_part_learning_goal_books($post_id)
    {
        $output = '';
        $content = '';

        $field_external = "resources_books";

        $links_external = bd324_get_learning_goal_resources_external($post_id, $field_external);

        $content = mwe_sort_resources_array($links_external);

        // Wrap the sorted links in a list
        if ($content) {
            $content = '<ul><li>' . implode('</li><li>', $content) . '</li></ul>';
        }

        if ($content) {
            $id = "books";
            $icon = bd324_get_icon($id);
            $label = 'Books';
            $output .= bd324_get_template_learning_goal_meta_list_item(
                $id,
                $content,
                __($label, '_BD092_curriculum_plugin'),
                $icon
            );
        }
        return $output;
    }
endif;
