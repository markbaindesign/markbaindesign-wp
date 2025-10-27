<?php
$terms = $args['term_objects'] ?? null;
$context = $args['context'] ?? null;
?>
<?php if (! empty($terms)) : ?>
    <div class="project-terms project-terms--<?php echo esc_attr($context); ?>">
        <ul class="project-terms-list">
            <?php foreach ($terms as $term) :
                $link = get_term_link($term);
                if (is_wp_error($link)) : ?>
                    <li class="project-term-item"><?php echo esc_html($term->name); ?></li>
                <?php else : ?>
                    <li class="project-term-item">
                        <a href="<?php echo esc_url($link); ?>">
                            <?php echo esc_html($term->name); ?>
                        </a>
                    </li>
                <?php endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif; ?>