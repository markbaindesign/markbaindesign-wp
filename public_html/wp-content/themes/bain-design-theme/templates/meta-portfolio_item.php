<?php
$data = $args['data_meta'] ?? null;

$context = $data['context'] ?? 'single';
$meta = $data['meta'] ?? [];
$post_type = $data['post_type'] ?? null;

?>

<?php if (! empty($meta)) : ?>
    <ul class="meta meta-list meta-list--<?php echo esc_attr($context); ?>">
        <?php foreach ($meta as $item) : ?>
            <li class="project-meta__item">
                <strong><?= esc_html($item['label']); ?>:</strong>
                <?php if (! empty($item['image'])) : ?>
                    <img src="<?= esc_url($item['image']); ?>" alt="<?= esc_attr($item['value']); ?>">
                <?php endif; ?>

                <?php if (! empty($item['url'])) : ?>
                    <a href="<?= esc_url($item['url']); ?>" target="_blank" rel="noopener">
                    <?= esc_html($item['value']); ?>
                    </a>
                <?php elseif (is_array($item['value'])) : ?>
                    <?= esc_html(implode(', ', $item['value'])); ?>
                <?php else : ?>
                    <?php echo esc_html($item['value']); ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

