<?php
/**
 * @package _mbbasetheme
 */

$post_id = get_the_ID();
$related_projects = get_field('related_projects', $post_id);
$client_meta = array(
    'active_language' => apply_filters('wpml_current_language', null),
    'client_external_link' => bd324_get_client_external_link_by_id($post_id),
    'client_industries' => bd324_get_project_terms($post_id, 'client-industry'),
);
$context = 'single';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php get_template_part('templates/post/header', null, ['data_header' => $client_meta, 'context' => $context]); ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', '_mbbasetheme'),
                'after'  => '</div>',
            ));
?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
        <?php get_template_part('templates/related-testimonials', null, ['related_projects' => $related_testimonials, 'context' => $context]); ?>
        <?php get_template_part('templates/related-projects', null, ['related_projects' => $related_projects, 'context' => $context]); ?>
    </footer>
</article><!-- #post-## -->
