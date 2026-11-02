<?php
/**
 * The template for displaying all pages.
 *
 * Fallback for any page without a page-{slug}.php template or an assigned
 * page template. Uses the same branded header + content wrapper pattern as
 * page-hire-me.php and page-ui-ux-design.php.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

if ( ! have_posts() ) {
	get_footer();
	exit;
}

the_post();

// Meta bracket label: the top-level ancestor's title for a child page,
// otherwise a plain 'page'.
$bain_ancestors = get_post_ancestors( get_the_ID() );
$bain_label     = $bain_ancestors
	? get_the_title( end( $bain_ancestors ) )
	: 'page';
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( $bain_label ); ?>
		<h1 class="archive-header__title"><?php the_title(); ?></h1>
	</div>
</div>


<div class="bain-section">
	<div class="bain-section__inner">
		<div class="entry-content bain-content">
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bain-design-theme' ),
				'after'  => '</div>',
			) );
			?>
		</div>
	</div>
</div>

<?php get_footer();
