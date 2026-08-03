<?php
/**
 * Portfolio archive — bd324_projects.
 *
 * 3-column grid of project cards with cursor-tilt hover effect (JS).
 * ASCII corner ticks appear on hover (CSS).
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$pub_count = (int) wp_count_posts( 'bd324_projects' )->publish;
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( 'Selected work' ); ?>
		<h1 class="archive-header__title">Case Studies</h1>
		<p class="archive-header__count">
			<?php echo $pub_count; ?> projects shipped
		</p>
	</div>
</div>

<div class="archive-content portfolio-archive">

	<?php if ( have_posts() ) : ?>

		<div class="portfolio-grid portfolio-grid--archive">

			<?php while ( have_posts() ) : the_post(); ?>

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

<?php get_footer();
