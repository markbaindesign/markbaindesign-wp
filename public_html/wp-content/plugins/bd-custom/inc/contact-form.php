<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

add_filter('wpcf7_before_send_mail', 'bd324_fix_cf7_from_address', 10, 1);

function bd324_fix_cf7_from_address($contact_form) {
    $domain = wp_parse_url(get_site_url(), PHP_URL_HOST);
    $from_email = 'wordpress@' . $domain;

    $mail = $contact_form->prop('mail');
    if (!empty($mail)) {
        $mail['sender'] = 'Bain Design <' . $from_email . '>';
        $contact_form->set_prop('mail', $mail);
    }

    return $contact_form;
}
