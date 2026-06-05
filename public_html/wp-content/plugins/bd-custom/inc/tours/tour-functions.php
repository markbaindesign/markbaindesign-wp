<?php

function bd324_get_tour_data_from_acf()
{
    $tours = [];

    // Get the tour configurations from ACF options page
    if (function_exists('get_field')) {
        $tour_configs = get_field('tour_configurations', 'option');

        if ($tour_configs) {
            foreach ($tour_configs as $tour_config) {
                $tour_name = $tour_config['tour_name'];
                $tour_classes = $tour_config['tour_classes'] ?? 'curriculum-tour-step';
                $steps = [];

                // Get steps from the flexible content field
                if (isset($tour_config['tour_steps']) && is_array($tour_config['tour_steps'])) {
                    foreach ($tour_config['tour_steps'] as $step) {
                        $step_data = [
                            'title' => $step['step_title'] ?? '',
                            'text' => $step['step_text'] ?? '',
                        ];

                        // Handle attachTo
                        if (!empty($step['attach_to_element'])) {
                            $step_data['attachTo'] = [
                                'element' => $step['attach_to_element'],
                                'on' => $step['attach_position'] ?? 'bottom'
                            ];
                        }

                        // Handle buttons
                        if (isset($step['step_buttons']) && is_array($step['step_buttons'])) {
                            $buttons = [];
                            foreach ($step['step_buttons'] as $button) {
                                $buttons[] = [
                                    'text' => $button['button_text'],
                                    'action' => $button['button_action'] ?? 'next',
                                    'classes' => $button['button_classes'] ?? 'btn btn-primary'
                                ];
                            }
                            $step_data['buttons'] = $buttons;
                        }

                        $steps[] = $step_data;
                    }
                }

                $tours[$tour_name] = [
                    'name' => $tour_name,
                    'classes' => $tour_classes,
                    'steps' => $steps,
                    'public' => $tour_config['public'] ?? true
                ];
            }
        }
    }

    return $tours;
}

function bd324_enqueue_tour_scripts()
{
    // Enqueue the config file first
    wp_enqueue_script(
        'tour-config',
        plugin_dir_url(__FILE__) . '../../assets/js/custom/tour-config.js',
        [],
        '1.0.0',
        true
    );

    // Then enqueue the main tour script with config as dependency
    wp_enqueue_script(
        'curriculum-tour',
        plugin_dir_url(__FILE__) . '../../assets/js/custom/tour.js',
        ['tour-config'],
        '1.0.0',
        true
    );

    // Localize the tour data
    wp_localize_script('curriculum-tour', 'curriculumTourData', [
        'tours' => bd324_get_tour_data_from_acf(),
        'isAdmin' => current_user_can('manage_options')
    ]);
}
add_action('wp_enqueue_scripts', 'bd324_enqueue_tour_scripts');
