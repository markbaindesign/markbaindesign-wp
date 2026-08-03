<?php
/**
 * Shared archive markup for the project-category-* taxonomies
 * (service, tool, tech-stack, profile). Same grid as archive-bd324_projects.php,
 * scoped to the current term, no featured project.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

$term     = get_queried_object();
$taxonomy = get_taxonomy( $term->taxonomy );
$tax_label = $taxonomy ? $taxonomy->labels->singular_name : '';
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( $tax_label ?: 'Category' ); ?>
		<h1 class="archive-header__title"><?php echo esc_html( $term->name ); ?></h1>
		<?php if ( $term->description ) : ?>
		<p class="archive-header__desc"><?php echo esc_html( $term->description ); ?></p>
		<?php endif; ?>
		<p class="archive-header__count">
			<?php echo (int) $term->count; ?> project<?php echo 1 === (int) $term->count ? '' : 's'; ?>
		</p>
	</div>
</div>

<div class="archive-content case-study-archive">

	<?php if ( have_posts() ) : ?>

		<div class="case-study-grid case-study-grid--archive">

			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'case-study-card' ); ?>>
				<span class="case-study-card__tick case-study-card__tick--tl" aria-hidden="true">┌</span>
				<span class="case-study-card__tick case-study-card__tick--tr" aria-hidden="true">┐</span>
				<span class="case-study-card__tick case-study-card__tick--bl" aria-hidden="true">└</span>
				<span class="case-study-card__tick case-study-card__tick--br" aria-hidden="true">┘</span>

				<a href="<?php the_permalink(); ?>" class="case-study-card__thumb" tabindex="-1" aria-hidden="true">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'medium_large' ); ?>
					<?php else : ?>
						<span class="case-study-card__placeholder">[project preview]</span>
					<?php endif; ?>
				</a>

				<div class="case-study-card__body">
					<h2 class="case-study-card__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<p class="case-study-card__excerpt">
						<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
					</p>
					<a class="case-study-card__link" href="<?php the_permalink(); ?>">
						view project &rarr;
					</a>
				</div>
			</article>

			<?php endwhile; ?>

		</div>

		<?php the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&larr; prev',
			'next_text' => 'next &rarr;',
			'class'     => 'case-study-pagination',
		) ); ?>

	<?php else : ?>
		<p class="archive-empty">No projects yet.</p>
	<?php endif; ?>

</div>
