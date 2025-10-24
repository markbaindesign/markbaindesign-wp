<?php

//

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Load a template part from the plugin or theme override.
 *
 * @param string $template_name The template file name (e.g. 'my-template.php').
 * @param array  $vars          Optional associative array of variables to pass to the template.
 * @param bool   $return        If true, return the template content instead of echoing it.
 * @return void|string
 */
function BD092__get_template($template_name, $vars = [], $return = false)
{
    // Look in theme first for override: /wp-content/themes/your-theme/my-plugin/{template_name}
    $theme_path = locate_template('mwe-curriculum/' . $template_name);

    if ($theme_path) {
        $template_path = $theme_path;
    } else {
        // Fall back to plugin templates folder
        $template_path = BD092__PLUGIN_DIR . '/templates/' . $template_name;
    }

    if (! file_exists($template_path)) {
        if ($return) {
            return '';
        } else {
            return;
        }
    }

    // Extract variables for use inside template safely
    if (! empty($vars) && is_array($vars)) {
        extract($vars, EXTR_SKIP);
    }

    if ($return) {
        ob_start();
        include $template_path;
        return ob_get_clean();
    } else {
        include $template_path;
    }
}

add_action('wp_footer', function () {
    BD092__get_template('ai-helper/ai-helper.php');
});

/* Messages */
add_filter('bd324_learning_goal_header_messages', function ($messages, $post_id) {
    $is_advanced = has_term('advanced', 'framework-level', $post_id);
    $message_advanced = get_field('Advanced_Topics_Warning_Label', 'option');
    if ($is_advanced) {
        $messages[] = __($message_advanced, 'mwe-curriculum');
    }
    return $messages;
}, 10, 2);
