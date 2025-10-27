<?php
$data = $args['data'] ?? null;
$context = $args['context'] ?? null;
?>

<div class="meta meta-list--client meta--<?php echo esc_attr($context); ?>">
    <ul class="meta meta-list--client meta--<?php echo esc_attr($context); ?>">
        <?php if (! empty($data['client_external_link'])) : ?>
            <li>Website: <a href="<?php echo esc_url($data['client_external_link']); ?>"><?php echo esc_html($data['client_external_link']); ?></a></li>
        <?php endif; ?>
        <li>Industries: <?php echo get_template_part('templates/meta-client-terms', null, ['term_objects' => $data['client_industries'], 'context' => $context]); ?></li>    </ul>
</div>

