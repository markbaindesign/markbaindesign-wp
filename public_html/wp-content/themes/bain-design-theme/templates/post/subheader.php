<?php
$data = $args['data_subheader'] ?? null;

$context        = $data['context'] ?? 'single';
$post_type      = $data['post_type'] ?? null;
$meta           = $data['meta'] ?? null;

$data_meta = [
    'context'   => $context,
    'post_type' => $post_type,
    'meta'      => $meta,
];

?>
<div class="subheader">
    <?php if ($context === 'single') : ?>
        <?php get_template_part('templates/meta-list', null, ['data_meta' => $data_meta]); ?>
    <?php endif; ?>
</div>