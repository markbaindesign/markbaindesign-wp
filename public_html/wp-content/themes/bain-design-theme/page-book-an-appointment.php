<?php
/**
 * Template for "Book an appointment" page (slug: book-an-appointment).
 * Same branded header + content wrapper pattern as page-open-source-contributions.php.
 * Content includes a live Google Calendar scheduling embed — passed through unchanged.
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
		<?php bain_meta_bracket( 'booking' ); ?>
		<h1 class="archive-header__title"><?php the_title(); ?></h1>
	</div>
</div>


<div class="bain-section">
	<div class="bain-section__inner">
		<div class="entry-content bain-content">
			<?php the_content(); ?>
		</div>
	</div>
</div>

<?php get_footer();
