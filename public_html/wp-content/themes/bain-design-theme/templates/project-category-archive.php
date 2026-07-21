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

<div class="archive-content portfolio-archive">

	<?php if ( have_posts() ) : ?>

		<div class="portfolio-grid portfolio-grid--archive">

			<?php while ( have_posts() ) : the_post();
				$proj_year  = bain_project_field( 'year', get_the_ID(), get_the_date( 'Y' ) );
				$proj_terms = get_the_terms( get_the_ID(), 'project-category-service' );
				$proj_tag   = ( $proj_terms && ! is_wp_error( $proj_terms ) ) ? $proj_terms[0]->name : '';
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-card' ); ?>>
				<span class="portfolio-card__tick portfolio-card__tick--tl" aria-hidden="true">┌</span>
				<span class="portfolio-card__tick portfolio-card__tick--tr" aria-hidden="true">┐</span>
				<span class="portfolio-card__tick portfolio-card__tick--bl" aria-hidden="true">└</span>
				<span class="portfolio-card__tick portfolio-card__tick--br" aria-hidden="true">┘</span>

				<a href="<?php the_permalink(); ?>" class="portfolio-card__thumb" tabindex="-1" aria-hidden="true">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'medium_large' ); ?>
					<?php else : ?>
						<span class="portfolio-card__placeholder">[project preview]</span>
					<?php endif; ?>
				</a>

				<div class="portfolio-card__body">
					<div class="portfolio-card__meta">
						<?php bain_meta_bracket( trim( $proj_year . ( $proj_tag ? ' / ' . $proj_tag : '' ) ) ); ?>
					</div>
					<h2 class="portfolio-card__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<p class="portfolio-card__excerpt">
						<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
					</p>
					<a class="portfolio-card__link" href="<?php the_permalink(); ?>">
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
			'class'     => 'portfolio-pagination',
		) ); ?>

	<?php else : ?>
		<p class="archive-empty">No projects yet.</p>
	<?php endif; ?>

</div>
