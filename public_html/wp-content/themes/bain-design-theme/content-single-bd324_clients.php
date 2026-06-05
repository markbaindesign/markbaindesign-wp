<?php

$client_id = get_the_ID();
$client_data = bd324_get_client_data($client_id);
$context = 'single';

// Vars: Base
$title                  = $client_data['data_base']['title'] ?? '';
$post_type              = $client_data['data_base']['post_type'] ?? null;
$permalink              = $client_data['data_base']['permalink'] ?? '';
$excerpt                = $client_data['data_base']['excerpt'] ?? '';
$breadcrumb_link_label  = $client_data['data_base']['breadcrumb_link_label'] ?? null;
$breadcrumb_link        = $client_data['data_base']['breadcrumb_link'] ?? null;

// Vars: Meta
$client_meta           = $client_data['data_meta'] ?? [];

// Vars: Related
$related_testimonials  = $client_data['data_testimonials'] ?? [];
$related_projects      = $client_data['data_projects'] ?? [];

// Template: Header
$data_header = array(
    'context'                => $context,
    'post_type'              => $post_type,
    'breadcrumb_link_label'  => $breadcrumb_link_label,
    'breadcrumb_link'        => $breadcrumb_link,
    'title'                  => $title,
    'meta'                   => $client_meta,
    'permalink'              => $permalink,
);

// Template: Projects
$data_projects = array(
    'context'                => $context,
    'related'                => $related_projects,
);

// Template: Testimonials
$data_testimonials = array(
    'context'                => $context,
    'related'                => $related_testimonials,
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

	<footer class="entry-footer">
        <?php get_template_part('templates/related-testimonials', null, ['data_testimonials' => $data_testimonials]); ?>
        <?php if (!empty($data_projects['related'])) : ?>
            <?php get_template_part('templates/related-projects', null, ['data_projects' => $data_projects]); ?>
        <?php endif; ?>
    </footer>
</article><!-- #post-## -->
