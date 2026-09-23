<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

/**
 * Stop non-production servers sending real email.
 *
 * Production and local (DDEV catches mail in Mailpit) send normally. Everywhere else
 * (staging, development), wp_mail() is short-circuited and the message is logged instead.
 *
 * Production must also be on the production host: wp_get_environment_type() defaults to
 * 'production' when WP_ENVIRONMENT_TYPE is missing, e.g. a new staging app with a
 * DB_NAME the wp-config.php switch doesn't know about.
 */
add_filter('pre_wp_mail', 'bd324_block_non_production_mail', 10, 2);

function bd324_block_non_production_mail($return, $atts) {
    if (bd324_mail_allowed()) {
        return $return;
    }

    $to = is_array($atts['to']) ? implode(', ', $atts['to']) : $atts['to'];
    error_log(sprintf(
        '[bd324 mail-guard] Blocked email on %s environment. To: %s | Subject: %s',
        wp_get_environment_type(),
        $to,
        $atts['subject']
    ));

    // Report success so forms behave normally while testing.
    return true;
}

function bd324_mail_allowed() {
    $environment = wp_get_environment_type();

    if ('local' === $environment) {
        return true;
    }

    return 'production' === $environment
        && 'bain.design' === wp_parse_url(home_url(), PHP_URL_HOST);
}
