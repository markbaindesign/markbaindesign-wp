<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

$parts = [
   'header.php',
   'nav.php',
   'postcard-mini.php',
   'primary.php',
   'quote.php',
   'secondary.php',
   'single.php',
   'footer-sidebar.php',
   'favs/index.php',
   'meta/index.php',
];

foreach ($parts as $part) {
    require_once BD092__PLUGIN_DIR . '/inc/post-types/curriculum/templates/parts/' . $part;
}
