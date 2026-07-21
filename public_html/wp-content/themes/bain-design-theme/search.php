<?php
/**
 * Search results template.
 *
 * Displays search results in a modern grid layout with support for mixed post types.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
$search_query = get_search_query();
$result_count = (int) $GLOBALS['wp_query']->found_posts;
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( 'Search results' ); ?>
		<h1 class="archive-header__title">
			<?php printf( __( 'Results for: %s', 'bain-design-theme' ), '<em>' . esc_html( $search_query ) . '</em>' ); ?>
		</h1>
		<?php if ( $result_count > 0 ) : ?>
		<p class="archive-header__count">
			<?php echo $result_count; ?> result<?php echo $result_count !== 1 ? 's' : ''; ?> found
		</p>
		<?php endif; ?>
	</div>
</div>

<div class="archive-content search-results">

	<?php if ( have_posts() ) : ?>

		<div class="search-results__grid">

			<?php while ( have_posts() ) : the_post();
				$post_type = get_post_type();
				$result_excerpt = get_the_excerpt() ?: wp_trim_words( get_the_content(), 20 );
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result' ); ?>>
				<div class="search-result__header">
					<span class="search-result__type"><?php echo esc_html( get_post_type_object( $post_type )->labels->singular_name ); ?></span>
					<h2 class="search-result__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
				</div>
				<?php if ( $result_excerpt ) : ?>
				<p class="search-result__excerpt">
					<?php echo esc_html( $result_excerpt ); ?>
				</p>
				<?php endif; ?>
				<a class="search-result__link" href="<?php the_permalink(); ?>">
					View more &rarr;
				</a>
			</article>

			<?php endwhile; ?>

		</div>

		<?php the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&larr; prev',
			'next_text' => 'next &rarr;',
			'class'     => 'search-pagination',
		) ); ?>

	<?php else : ?>

		<div class="search-empty">
			<h2><?php _e( 'No results found', 'bain-design-theme' ); ?></h2>
			<p><?php printf( __( 'Sorry, but nothing matched your search term "%s". Please try again with different keywords.', 'bain-design-theme' ), esc_html( $search_query ) ); ?></p>
		</div>

	<?php endif; ?>

</div>

<?php get_footer();
