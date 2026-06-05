<?php
$data = $args['data_testimonial'] ?? null;

$context                = $data['context'] ?? 'single';
$testimonial_name       = $data['testimonial_name'] ?? '';
$testimonial_role       = $data['testimonial_role'] ?? '';
$permalink              = $data['permalink'] ?? '';
$excerpt                = $data['excerpt'] ?? '';
$content                = $data['content'] ?? '';
$related_project        = $data['related_project'] ?? '';
$testimonial_image      = $data['testimonial_image'] ?? '';
$related_client         = $data['related_client'] ?? '';
?>
<article class="postcard postcard--testimonial postcard--<?php echo esc_attr($context); ?>">
    <a class="postcard__link" href="<?php echo esc_url($permalink); ?>">
        <?php if ($testimonial_image) : ?>
            <div class="postcard__image" style="background-image: url('<?php echo esc_url($testimonial_image); ?>');"></div>
        <?php endif; ?>
        <div class="postcard__content">
            <h3 class="postcard__title"><?php echo esc_html($title); ?></h3>
            <?php if ($related_project) : ?>
                <span class="postcard__year"><?php echo esc_html($related_project); ?></span>
            <?php endif; ?>
            <div class="postcard__excerpt"><?php echo wp_kses_post($excerpt); ?></div>
        </div>
    </a>
</article>