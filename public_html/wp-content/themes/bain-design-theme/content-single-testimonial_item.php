<?php

$post_id = get_the_ID();
$data = bd324_get_testimonial_data($post_id);
$context = 'single';

// Vars
$title                  = $data['data_base']['author'] ?? '';
$post_type              = $data['data_base']['post_type'] ?? null;
$permalink              = $data['data_base']['permalink'] ?? '';
$excerpt                = $data['data_base']['excerpt'] ?? '';
$breadcrumb_link_label  = $data['data_base']['breadcrumb_link_label'] ?? null;
$breadcrumb_link        = $data['data_base']['breadcrumb_link'] ?? null;
$role                   = $data['data_base']['author_role'] ?? '';
$meta                   = $data['data_meta'] ?? [];
$client_name            = $data['data_base']['related_client']['client_name'] ?? '';
$client_permalink       = $data['data_base']['related_client']['client_permalink'] ?? '';
$client_image           = $data['data_base']['related_client']['client_logo'] ?? '';


$data_header = array(
    'context'                => $context,
    'post_type'              => $post_type,
    'breadcrumb_link_label'  => $breadcrumb_link_label,
    'breadcrumb_link'        => $breadcrumb_link,
    'title'                  => $title,
    'role'                   => $role,
    'meta'                   => $meta,
    'permalink'              => $permalink,
    'client_name'            => $client_name,
    'client_permalink'       => $client_permalink,
    'client_image'           => $client_image,

);

$data_testimonials = array(
    'context'                => $context,
    'base' => $data['data_base'] ?? [],
    'meta' => $data['data_meta'] ?? [],
    'testimonials' => $data['data_testimonials'] ?? [],
);
$data_related = array(
    'context'                => $context,
    'base' => $data_project['data_base'] ?? [],
    'related' => $data_project['data_related'] ?? [],
);

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
        <?php if (!empty($data_projects['related'])) : ?>
            <?php get_template_part('templates/related-projects', null, ['data_projects' => $data_projects]); ?>
        <?php endif; ?>
    </footer>
</article><!-- #post-## -->
