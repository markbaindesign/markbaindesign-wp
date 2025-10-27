<?php

$post_id = get_the_ID();
$data = bd324_get_project_data($post_id);
$context = 'single';

// Vars

$title                  = $data['data_base']['title'] ?? '';
$post_type              = $data['data_base']['post_type'] ?? null;
$permalink              = $data['data_base']['permalink'] ?? '';
$excerpt                = $data['data_base']['excerpt'] ?? '';
$breadcrumb_link_label  = $data['data_base']['breadcrumb_link_label'] ?? null;
$breadcrumb_link        = $data['data_base']['breadcrumb_link'] ?? null;

$meta                   = $data['data_meta'] ?? [];

$data_header = array(
    'context'                => $context,
    'post_type'              => $post_type,
    'breadcrumb_link_label'  => $breadcrumb_link_label,
    'breadcrumb_link'        => $breadcrumb_link,
    'title'                  => $title,
    'meta'                   => $meta,
    'permalink'              => $permalink,
);

$data_testimonials = array(
        $context                = $context,
    'base' => $data_project['data_base'] ?? [],
    'meta' => $data_project['data_meta'] ?? [],
    'testimonials' => $data_project['data_testimonials'] ?? [],
);
$data_related = array(
        $context                = $context,
    'base' => $data_project['data_base'] ?? [],
    'related' => $data_project['data_related'] ?? [],
);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php get_template_part('templates/post/header', null, ['data_header' => $data_header]); ?>

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
