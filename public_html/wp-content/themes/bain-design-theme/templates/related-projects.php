<?php
$data = $args['related_projects'] ?? null;
$context = $args['context'] ?? null;
?>
<?php if ($data) : ?>
    <section class="related-projects section-<?php echo esc_attr($context); ?>">
        <h2 class="related-projects__title"><?php esc_html_e('Related Projects', '_mbbasetheme'); ?></h2>
        <div class="related-projects__items">
            <?php foreach ($data as $project) : ?>
                <?php
                $project_id = $project->ID;
                $project_title = get_the_title($project_id);
                $project_permalink = get_permalink($project_id);
                ?>
                <article id="post-<?php echo esc_attr($project_id); ?>" class="related-projects__item">
                    <h3 class="related-projects__item-title">
                        <a href="<?php echo esc_url($project_permalink); ?>">
                            <?php echo esc_html($project_title); ?>
                        </a>
                    </h3>
                    <div class="related-projects__item-excerpt"><?php echo wp_kses_post(get_the_excerpt($project_id)); ?></div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>