<?php
$data = $args['data_postcard'] ?? null;
$post_type              = $data['post_type'] ?? null;
$post_id                = $data['post_id'] ?? null;
$context                = $data['context'] ?? 'postcard';
$title                  = $data['title'] ?? '';
$permalink              = $data['permalink'] ?? '';
$excerpt                = $data['excerpt'] ?? '';
$year                   = $data['year'] ?? '';
$image                   = $data['image'] ?? '';
$author                 = $data['author'] ?? '';
$role                   = $data['role'] ?? '';
$company                = $data['company'] ?? '';
?>
<article class="postcard postcard--<?php echo esc_attr($post_type); ?> postcard--<?php echo esc_attr($context); ?>">
    <a class="postcard__link" href="<?php echo esc_url($permalink); ?>">
        <?php if ($image) : ?>
            <div class="postcard__image">
                <img class="postcard__img" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title ?: ''); ?>" loading="lazy">
            </div>
        <?php endif; ?>
        <div class="postcard__content">
            <?php if ($title) : ?>
                <h3 class="postcard__title"><?php echo esc_html($title); ?></h3>
            <?php endif; ?>

            <?php if ($year) : ?>
                <span class="postcard__year"><?php echo esc_html($year); ?></span>
            <?php endif; ?>

            <div class="postcard__excerpt"><?php echo wp_kses_post($excerpt); ?></div>
            
            <?php // Testimonial specific footer?>
            <?php if ($author) : ?>
                <footer class="postcard__footer">
                    <span class="postcard__separator">&mdash;</span>
                    <cite class="postcard__author"><?php echo esc_html($author); ?></cite>
                    <?php if ($role) : ?><span class="postcard__role"><?php echo esc_html($role); ?></span><?php endif; ?>
                    <?php if ($company) : ?><span class="postcard__company"><?php echo esc_html($company); ?></span><?php endif; ?>
                </footer>
            <?php endif; ?>
        </div>
    </a>
</article>