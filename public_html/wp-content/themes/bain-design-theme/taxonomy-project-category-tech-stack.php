<?php
/**
 * Taxonomy archive — project-category-*.
 * Shares markup with archive-bd324_projects.php via templates/project-category-archive.php.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
get_template_part( 'templates/project-category-archive' );
get_footer();
