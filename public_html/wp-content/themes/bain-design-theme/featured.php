<?php
/**
 * The template for displaying the latest post
 */
?>

<div id="featured-content" class="section featured-content" >
	<div class="featured-content-inner container">
	<?php

if (is_post_type_archive('bd324_projects')) {
    $args = array(
        'posts_per_page' => 1,
        'post_type' => 'bd324_projects',
        'post_not_in' => get_option('sticky_posts')
    );
} else {
    $args = array(
        'posts_per_page' => 1,
        'post_not_in' => get_option('sticky_posts')
    );
}

$query1 = new WP_Query($args);

if ($query1->have_posts()) {
    while ($query1->have_posts()) {
        $query1->the_post();
        get_template_part('content', 'featured');
    }
}

wp_reset_postdata();

?>
</div><!-- .featured-content-inner -->
</div><!-- #featured-content .featured-content -->
