<?php
$data = $args['data_postcard'] ?? null;

$context                = $data['context'] ?? 'postcard';
$title                  = $data['title'] ?? '';
$permalink              = $data['permalink'] ?? '';
$excerpt                = $data['excerpt'] ?? '';
$year                   = $data['year'] ?? '';
$thumbnail              = $data['thumbnail'] ?? '';
?>
<article class="postcard postcard--<?php echo esc_attr($context); ?>">
    <a class="postcard__link" href="<?php echo esc_url($permalink); ?>">
        <?php if ($thumbnail) : ?>
            <div class="postcard__image" style="background-image: url('<?php echo esc_url($thumbnail); ?>');"></div>
        <?php endif; ?>
        <div class="postcard__content">
            <h3 class="postcard__title"><?php echo esc_html($title); ?></h3>
            <?php if ($year) : ?>
                <span class="postcard__year"><?php echo esc_html($year); ?></span>
            <?php endif; ?>
            <div class="postcard__excerpt"><?php echo wp_kses_post($excerpt); ?></div>
        </div>
    </a>
</article>