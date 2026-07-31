<?php
/**
 * Services CPT archive — archive-bd324_services.php
 *
 * Landing page for the /services/ section: high-level copy in the main
 * column, the service tree as a left sidebar.
 *
 * The copy comes from the page with the slug "services", which is otherwise
 * unreachable — a CPT archive URL always beats a page of the same slug (see
 * CLAUDE.md). Editing that page in WP edits this landing copy.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$services_intro = get_page_by_path( 'services' );
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( 'What I do' ); ?>
		<h1 class="archive-header__title">Services<span class="archive-header__dot">.</span></h1>
	</div>
</div>

<div class="bain-wrap bain-section">
	<div class="services-layout">

		<?php bain_service_sidebar(); ?>

		<div class="services-main bain-body-copy">
			<?php
			if ( $services_intro && trim( $services_intro->post_content ) !== '' ) {
				echo apply_filters( 'the_content', $services_intro->post_content );
			}
			?>
		</div>

	</div>
</div>

<?php get_footer();
