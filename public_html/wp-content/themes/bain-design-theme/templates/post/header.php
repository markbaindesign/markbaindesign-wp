<?php
$data = $args['data_header'] ?? null;

$context                = $data['context'] ?? 'single';
$post_type              = $data['post_type'] ?? null;
$breadcrumb_link_label   = $data['breadcrumb_link_label'] ?? null;
$breadcrumb_link           = $data['breadcrumb_link'] ?? null;
$title                  = $data['title'] ?? '';
$meta                   = $data['meta'] ?? [];
$permalink              = $data['permalink'] ?? '';

$data_preheader = [
    'context'           => $context,
    'post_type'         => $post_type,
    'breadcrumb_link_label'  =>  $breadcrumb_link_label,
    'breadcrumb_link'      =>  $breadcrumb_link,
];
$data_subheader = [
    'context'           => $context,
    'post_type'         => $post_type,
    'meta'              => $meta,
];
?>
<header class="entry-header">
    <?php if ($context === 'single'): ?>
        <?php get_template_part('templates/post/preheader', null, ['data_preheader' => $data_preheader]); ?>
    <?php endif; ?>

    <?php if ($context === 'single'): ?>
        <h1 class="entry-title"><?php echo esc_html($title); ?></h1>
    <?php else: ?>
        <h2 class="entry-title"><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a></h2>
    <?php endif; ?>

    <?php if ($context === 'single'): ?>
        <?php get_template_part('templates/post/subheader', null, ['data_subheader' => $data_subheader]); ?>
    <?php endif; ?>
</header>