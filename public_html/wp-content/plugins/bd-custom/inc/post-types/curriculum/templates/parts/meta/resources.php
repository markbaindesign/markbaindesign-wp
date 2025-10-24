<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

function bd324_get_template_part_learning_goal_resources($post_id)
{
    $output = '';
    $output .= bd324_get_template_part_learning_goal_resources_section($post_id, 'teacher', 'Teacher Resources');
    $output .= bd324_get_template_part_learning_goal_resources_section($post_id, 'student', 'Student Resources');
    return $output;
}

/**
 * Generic function to render a resource section (teacher or student).
 *
 * @param int $post_id
 * @param string $type 'teacher' or 'student'
 * @param string $label Section label
 * @return string
 */
if (!function_exists('bd324_get_template_part_learning_goal_resources_section')):
    function bd324_get_template_part_learning_goal_resources_section($post_id, $type, $label = '')
    {
        $output = '';
        $content = '';

        $field_internal = "resources_{$type}_internal";
        $field_external = "resources_{$type}_external";

        $links_internal = bd324_get_learning_goal_resources_internal($post_id, $field_internal);
        $links_external = bd324_get_learning_goal_resources_external($post_id, $field_external);

        $all_links = [];
        if (!empty($links_internal)) {
            $all_links = array_merge($all_links, $links_internal);
        }
        if (!empty($links_external)) {
            $all_links = array_merge($all_links, $links_external);
        }

        $content = mwe_sort_resources_array($all_links);

        // Wrap the sorted links in a list
        if ($content) {
            $content = '<ul><li>' . implode('</li><li>', $content) . '</li></ul>';
        }

        if ($content) {
            $id = "resources-{$type}";
            $icon = bd324_get_icon($id);
            $label = $label ?: ucfirst($type) . ' Resources';
            $output .= bd324_get_template_learning_goal_meta_list_item($id, $content, __($label, '_BD092_curriculum_plugin'), $icon);
        }
        return $output;
    }
endif;
