<?php
/**
 * Template for Tools 2014 page (slug: tools).
 * Same branded header + content wrapper pattern as page-tools-2024.php.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

if ( ! have_posts() ) {
	get_footer();
	exit;
}

the_post();
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( 'about' ); ?>
		<h1 class="archive-header__title"><?php the_title(); ?></h1>
	</div>
</div>

<?php bain_ascii_rule(); ?>

<div class="bain-section">
	<div class="bain-section__inner">
		<div class="entry-content bain-content">
			<?php the_content(); ?>
		</div>
	</div>
</div>

<?php get_footer();
