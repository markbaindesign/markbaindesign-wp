<?php
$data = $args['data_testimonials'] ?? null;

$context = $data['context'] ?? 'list';
$testimonials = $data['testimonials'] ?? null;
?>
<?php if ($testimonials) : ?>
    <section class="related-projects section-<?php echo esc_attr($context); ?>">
        <h2 class="related-projects__title"><?php esc_html_e('Nice Words', '_mbbasetheme'); ?></h2>
        <div class="related-projects__items">
            <?php foreach ($testimonials as $testimonial) : ?>
                <?php

                if ($post_type = 'testimonial') {
                    // Get  author data
                    $author = $testimonial['author'] ?? '';
                }

                $data_postcard = [
                    'post_id'   => $testimonial['post_id'] ?? null,
                    'context'   => 'postcard',
                    'post_type' => 'testimonial',
                    'title'     => $testimonial['title'] ?? '',
                    'permalink' => $testimonial['permalink'] ?? '',
                    'excerpt'   => $testimonial['excerpt'] ?? '',
                    'year'      => $testimonial['year'] ?? '',
                    'image'     => $testimonial['image'] ?? '',
                    'author'    => $testimonial['author'] ?? '',
                    'role'      => $testimonial['role'] ?? '',
                    'company'   => $testimonial['company'] ?? '',
                ];
                get_template_part('templates/postcard', null, ['data_postcard' => $data_postcard]);?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>