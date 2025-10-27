<?php
/**
 * @package _mbbasetheme
 */

$post_id = get_the_ID();
$related_projects = get_field('related_projects', $post_id);

$related_client_id = $related_client[0]->ID ?: null;
$data_client = bd324_get_client_data($related_client_id);
$data_project = bd324_get_project_data($post_id);
$project_meta = array(
    'active_language' => apply_filters('wpml_current_language', null),
    'post_id' => get_the_ID(),
    'post_type' => get_post_type(),
    'client_name' => $data_client['client_name'],
    'client_permalink' => $data_client['client_permalink'],
    'project_year' => $data_project['project_year'],
    'project_type' => $data_project['project_type'],
    'project_terms_stack' => bd324_get_project_terms($post_id, 'project-category-tech-stack'),
    'project_terms_tools' => bd324_get_project_terms($post_id, 'project-category-tool'),
    'project_terms_services' => bd324_get_project_terms($post_id, 'project-category-service'),
);
$context = 'single';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
        <?php get_template_part('templates/meta-project', null, ['project_meta' => $project_meta, 'context' => $context]); ?>
		<!-- <div class="entry-meta">
<?php mbdmaster_posted_on(); ?>


		</div> --><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
            wp_link_pages(array(
                'before' => '<div class="page-links">' . __('Pages:', '_mbbasetheme'),
                'after'  => '</div>',
            ));
?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">		<?php mbdmaster_posted_on(); ?>			<?php mbdmaster_post_meta(); ?>


		<!-- <?php edit_post_link(__('Edit', '_mbbasetheme'), '<span class="edit-link">', '</span>'); ?> -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
