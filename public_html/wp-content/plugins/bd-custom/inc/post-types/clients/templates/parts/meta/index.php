<?php

if (!defined('ABSPATH')) {
    die('Invalid request, dude!');
}

$parts = [
   'domain.php',
   'grade.php',
   'dispositions.php',
   'related.php',
   'resources.php',
   'books.php',
   'strand.php',
   'topics.php',
   'path.php',
   'principles.php',
   'vocabulary-item.php',
   'vocabulary.php',
   'collaborator.php',
];

foreach ($parts as $part) {
    require_once BD092__PLUGIN_DIR . '/inc/post-types/curriculum/templates/parts/meta/' . $part;
}
