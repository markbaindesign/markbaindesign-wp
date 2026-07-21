<?php
/**
 * Template for legacy "WordPress Plugin Development" service page (slug: wordpress-plugin-development).
 * Superseded by the bd324_services CPT, but restyled to match the design system
 * in case it's still reached externally.
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
		<?php bain_meta_bracket( 'service' ); ?>
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
