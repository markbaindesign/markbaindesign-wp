<?php
/**
 * Main template — used for blog archive and fallback.
 */
get_header(); ?>

<div class="archive-content">

	<?php if ( have_posts() ) : ?>

		<div class="bain-stack-lg">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
					<div class="entry-meta">
						<span class="meta-bracket"><?php echo get_the_date(); ?></span>
					</div>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>

		<?php the_posts_navigation(); ?>

	<?php else : ?>
		<p><?php esc_html_e( 'Nothing here yet.', 'bain-design-theme' ); ?></p>
	<?php endif; ?>

</div>

<?php get_footer(); ?>
