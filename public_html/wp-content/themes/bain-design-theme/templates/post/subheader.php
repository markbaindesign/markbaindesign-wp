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

$client_name = $data['data_client']['client_name'] ?? '';
$client_permalink = $data['data_client']['client_permalink'] ?? '';
$client_image = $data['data_client']['client_logo'] ?? '';
$author_role = $data['author_role'] ?? '';

?>
<div class="subheader subheader--<?php echo esc_attr($context); ?> subheader--<?php echo esc_attr($post_type); ?>">
    <?php if ($context === 'single') : ?>
        <?php get_template_part('templates/meta-list', null, ['data_meta' => $data_meta]); ?>
        <?php if ($post_type === 'testimonial_item' && !empty($client_name)) : ?>
            <div class="role">
                <span class="role__label"><?php esc_html_e('Role:', '_mbbasetheme'); ?></span>
                <span class="role__text"><?php echo esc_html($author_role); ?></span>
            </div>
            <div class="subheader__client">
                <span class="subheader__client-label"><?php esc_html_e('Client:', '_mbbasetheme'); ?></span>
                <?php if (!empty($client_permalink)) : ?>
                    <a href="<?php echo esc_url($client_permalink); ?>" class="subheader__client-name">
                <?php endif; ?>
                <span class="subheader__client-text"><?php echo esc_html($client_name); ?></span>
                <?php if (!empty($client_permalink)) : ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>