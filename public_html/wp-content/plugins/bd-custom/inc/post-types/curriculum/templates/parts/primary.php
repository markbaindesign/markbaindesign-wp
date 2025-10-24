<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Generates the primary content for the learning goal.
 *
 * @param int $post_id The ID of the post.
 */
if (!function_exists('bd324_generate_learning_goal_primary_content')):
    function bd324_generate_learning_goal_primary_content($post_id)
    {
        // Vars
        $output = '';
        $knowledge = make_clickable(get_field('knowledge', $post_id));
        $understanding = make_clickable(get_field('Understanding', $post_id));
        $experience = make_clickable(get_field('Experience', $post_id));
        $action = make_clickable(get_field('action', $post_id));
        $assessment = make_clickable(get_field('assessment', $post_id));
        $implementation = make_clickable(get_field('implementation', $post_id));

        // Get Teacher Experience from Lesson Group tax term
        $experience_teacher = '';
        $group_terms = get_the_terms($post_id, 'framework-group');
        if ($group_terms && !is_wp_error($group_terms)) {
            // Use the first group term found
            $group_term = $group_terms[0];
            $teacher_experience = get_field('teacher_experience', 'framework-group_' . $group_term->term_id);
            if ($teacher_experience) {
                $experience_teacher = make_clickable($teacher_experience);
            }
        }

        // Guiding Questions
        $guiding_questions = make_clickable(get_field('guiding_questions', $post_id));
        if ($guiding_questions) {
            $guiding_questions = bd324_convert_string_to_list($guiding_questions, '?');
            // To do: restore question marks
        }

        $term_obj_list_domain = get_the_terms($post_id, 'framework-domain');
        $terms_string_domain = join(', ', wp_list_pluck($term_obj_list_domain, 'name'));

        $output .= '<div class="content__primary">';
        $output .= '<ul class="descriptors-list">';
        $descriptors = [

           'experience_teacher' => [
              'title' => esc_html__('Teacher Experience', '_BD092_curriculum_plugin'),
              'subheader' => esc_html__('A contemplative invitation for educators to reflect on before teaching.', '_BD092_curriculum_plugin'),
              'content' => $experience_teacher,
           ],

           'experience' => [
              'title' => esc_html__('Student Experience', '_BD092_curriculum_plugin'),
              'subheader' => esc_html__('A contemplative invitation for students to connect with this learning goal.', '_BD092_curriculum_plugin'),
              'content' => $experience,
           ],

           'understanding' => [
              'title' => esc_html__('Understanding', '_BD092_curriculum_plugin'),
              'subheader' => esc_html__('Students will understand...', '_BD092_curriculum_plugin'),
              'content' => $understanding
           ],

           'action' => [
              'title' => esc_html__('Action', '_BD092_curriculum_plugin'),
              'subheader' => esc_html__('Students are able to...', '_BD092_curriculum_plugin'),
              'content' => $action
           ],

           'knowledge' => [
              'title' => esc_html__('Content Knowledge', '_BD092_curriculum_plugin'),
              'subheader' => esc_html__('Students will know...', '_BD092_curriculum_plugin'),
              'content' => $knowledge
           ],

           'guiding_questions' => [
              'title' => esc_html__('Guiding Questions', '_BD092_curriculum_plugin'),
              'content' => $guiding_questions,
           ],

           'implementation' => [
              'title' => esc_html__('Implementation Possibilities', '_BD092_curriculum_plugin'),
              'content' => $implementation,
           ],

           'assessment' => [
              'title' => esc_html__('Assessment Ideas', '_BD092_curriculum_plugin'),
              'content' => $assessment,
           ],
        ];

        foreach ($descriptors as $key => $descriptor) {
            if ($descriptor['content']) {
                $header_class = 'descriptor--' . sanitize_title($descriptor['title']);
                $output .= '<li class="descriptor ' . esc_attr($header_class) . '">';
                $output .= '<h3 class="descriptor__header">' . $descriptor['title'] . '</h3>';
                $output .= '<div class="descriptor__subheader students-will">' . $descriptor['subheader'] . '</div>';
                $output .= '<div class="descriptor__body">' . apply_filters('BD092__filter_descriptor_body', $descriptor['content']);
                if (isset($descriptor['extra'])) {
                    $output .= $descriptor['extra'];
                }
                $output .= '</div>';
                $output .= '</li>';
            }
        }


        $output .= '</ul>';
        $output .= '</div>';
        return $output;
    }
endif;
