<?php

// Taxonomies

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

$path = BD092__PLUGIN_DIR . '/inc/post-types/taxonomies';
$taxonomies = [
   'functions.php',
   'register-taxonomy-tools.php',
    'register-taxonomy-profile.php',
    'register-taxonomy-stack.php',
    'register-taxonomy-services.php',
    'register-taxonomy-client-industry.php',
];

foreach ($taxonomies as $taxonomy_file) {
    require_once $path . '/' . $taxonomy_file;
}
