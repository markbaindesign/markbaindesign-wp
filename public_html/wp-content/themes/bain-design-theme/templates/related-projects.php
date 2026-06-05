<?php
$data = $args['data_projects'] ?? null;

$context = $data['context'] ?? 'list';
$projects = $data['related'] ?? null;
?>
<?php if ($projects) : ?>
    <section class="related-projects section-<?php echo esc_attr($context); ?>">
        <h2 class="related-projects__title"><?php esc_html_e('Related Projects', '_mbbasetheme'); ?></h2>
        <div class="related-projects__items">
            <?php foreach ($projects as $project) : ?>
                <?php
                $data_postcard = [
                    'context'   => 'postcard',
                    'title'     => $project['title'] ?? '',
                    'permalink' => $project['permalink'] ?? '',
                    'excerpt'   => $project['excerpt'] ?? '',
                    'year'      => $project['year'] ?? '',
                    'thumbnail' => $project['thumbnail'] ?? '',
                ];
                get_template_part('templates/postcard', null, ['data_postcard' => $data_postcard]);

                ?>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>