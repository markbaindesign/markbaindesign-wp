<?php
/**
 * Single client template — profile page for a client relationship.
 *
 * Self-contained; does not delegate to content-single-bd324_clients.php.
 * Data sourced direct from ACF + CPT helpers.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) :
	the_post();

	$client_id   = get_the_ID();
	$excerpt     = get_the_excerpt();
	$logo_id     = get_post_thumbnail_id();
	$website     = get_field( 'client_external_link' );
	$location    = get_field( 'client_location' );
	$industries  = wp_get_post_terms( $client_id, 'client-industry', array( 'fields' => 'names' ) );
	$industry_label = ( ! is_wp_error( $industries ) && ! empty( $industries ) )
		? implode( ', ', $industries )
		: '';

	$testimonials = get_field( 'related_testimonials' ) ?: array();
	$projects     = bd324_get_projects_by_client( $client_id ) ?: array();

	$archive_link = get_post_type_archive_link( 'bd324_clients' );
	$prev         = bain_client_adjacent( 'prev' );
	$next         = bain_client_adjacent( 'next' );

	$location_label = '';
	if ( ! empty( $location ) ) {
		$city    = $location['city'] ?? '';
		$country = $location['country_short'] ?? $location['country'] ?? '';
		$raw     = $location['address'] ?? '';
		$location_label = $city ? trim( $city . ( $country ? ', ' . $country : '' ) ) : $raw;
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'bain-client' ); ?>>

	<!-- ================================================================ HERO -->
	<section class="bain-client__hero">
		<div class="bain-wrap bain-client__hero-grid">

			<div class="bain-client__hero-body">
				<?php bain_meta_bracket( $industry_label ?: 'Client' ); ?>
				<h1 class="bain-client__title">
					<?php the_title(); ?><span class="bain-client__title-dot" aria-hidden="true">.</span>
				</h1>
				<?php if ( $excerpt ) : ?>
					<p class="bain-client__tagline"><?php echo esc_html( $excerpt ); ?></p>
				<?php endif; ?>

				<dl class="bain-client__meta">
					<?php if ( $website ) : ?>
					<div class="bain-client__meta-row">
						<dt class="bain-client__meta-label">Website</dt>
						<dd class="bain-client__meta-value">
							<a href="<?php echo esc_url( $website ); ?>" target="_blank" rel="noopener noreferrer">
								<?php echo esc_html( preg_replace( '#^https?://(www\.)?#', '', rtrim( $website, '/' ) ) ); ?> &nearr;
							</a>
						</dd>
					</div>
					<?php endif; ?>
					<?php if ( $location_label ) : ?>
					<div class="bain-client__meta-row">
						<dt class="bain-client__meta-label">Location</dt>
						<dd class="bain-client__meta-value"><?php echo esc_html( $location_label ); ?></dd>
					</div>
					<?php endif; ?>
					<?php if ( $industry_label ) : ?>
					<div class="bain-client__meta-row">
						<dt class="bain-client__meta-label">Industry</dt>
						<dd class="bain-client__meta-value"><?php echo esc_html( $industry_label ); ?></dd>
					</div>
					<?php endif; ?>
				</dl>
			</div>

			<?php if ( $logo_id ) : ?>
			<div class="bain-client__logo-wrap">
				<?php echo wp_get_attachment_image( $logo_id, 'medium', false, array(
					'class' => 'bain-client__logo',
					'alt'   => esc_attr( get_the_title() . ' logo' ),
				) ); ?>
			</div>
			<?php endif; ?>

		</div>
	</section>

	<?php bain_ascii_rule(); ?>

	<?php if ( ! empty( $projects ) ) : ?>
	<!-- ============================================================ PROJECTS -->
	<section class="bain-client__projects">
		<div class="bain-wrap">
			<?php bain_client__section_inline( '01', 'Work together' ); ?>
			<div class="bain-client__projects-grid">
				<?php foreach ( $projects as $p ) :
					$p_terms = wp_get_post_terms( $p['ID'], 'project-category-service', array( 'fields' => 'names' ) );
					$p_tag   = ( $p_terms && ! is_wp_error( $p_terms ) ) ? $p_terms[0] : '';
				?>
				<article class="bain-client__project-card">
					<?php if ( $p['thumbnail'] ) : ?>
					<div class="bain-client__project-thumb">
						<img src="<?php echo esc_url( $p['thumbnail'] ); ?>"
							alt="<?php echo esc_attr( $p['title'] ); ?>"
							loading="lazy">
					</div>
					<?php endif; ?>
					<div class="bain-client__project-body">
						<?php bain_meta_bracket( trim( $p['year'] . ( $p_tag ? ' / ' . $p_tag : '' ) ) ); ?>
						<h3 class="bain-client__project-title"><?php echo esc_html( $p['title'] ); ?></h3>
						<?php if ( $p['excerpt'] ) : ?>
						<p class="bain-client__project-excerpt"><?php echo esc_html( $p['excerpt'] ); ?></p>
						<?php endif; ?>
						<a class="bain-client__project-link" href="<?php echo esc_url( $p['permalink'] ); ?>">
							view project &rarr;
						</a>
					</div>
				</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if ( ! empty( $testimonials ) ) : ?>
	<!-- ========================================================= TESTIMONIALS -->
	<section class="bain-client__testimonials">
		<div class="bain-wrap">
			<?php bain_client__section_inline( ( ! empty( $projects ) ? '02' : '01' ), 'Nice words' ); ?>
			<div class="bain-client__quotes">
				<?php foreach ( $testimonials as $t ) :
					if ( ! ( $t instanceof WP_Post ) ) { continue; }
					$t_quote = wp_strip_all_tags( $t->post_content );
					$t_name  = get_the_title( $t );
					$t_role  = get_post_meta( $t->ID, 'testimonial_role', true );
					$t_url   = get_permalink( $t );
					if ( ! $t_quote ) { continue; }
				?>
				<div class="bain-client__quote">
					<blockquote class="bain-client__quote-text">
						&ldquo;<?php echo esc_html( $t_quote ); ?>&rdquo;
					</blockquote>
					<div class="bain-client__quote-attribution">
						&mdash; <?php echo esc_html( $t_name ); ?>
						<?php if ( $t_role ) : ?>
							<span class="bain-client__quote-role"> / <?php echo esc_html( $t_role ); ?></span>
						<?php endif; ?>
					</div>
					<?php if ( $t_url ) : ?>
					<a class="bain-client__quote-link" href="<?php echo esc_url( $t_url ); ?>">
						read full testimonial &rarr;
					</a>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
	$content = get_the_content();
	if ( $content ) : ?>
	<!-- ================================================================ BODY -->
	<section class="bain-client__body">
		<div class="bain-wrap bain-client__body-inner">
			<div class="bain-client__prose">
				<?php the_content(); ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php bain_ascii_rule(); ?>

	<!-- ============================================================= PREV/NEXT -->
	<?php if ( $prev || $next || $archive_link ) : ?>
	<nav class="bain-client__pager" aria-label="<?php esc_attr_e( 'Client navigation', 'bain-design-theme' ); ?>">
		<div class="bain-wrap bain-client__pager-inner">

			<?php if ( $prev ) : ?>
			<a class="bain-client__pager-link" href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
				<span class="bain-client__pager-dir" aria-hidden="true">&larr; prev </span>
				<span class="bain-client__pager-title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
			</a>
			<?php elseif ( $archive_link ) : ?>
			<a class="bain-client__pager-link" href="<?php echo esc_url( $archive_link ); ?>">
				<span class="bain-client__pager-dir" aria-hidden="true">&larr; </span>
				<span class="bain-client__pager-title">All clients</span>
			</a>
			<?php else : ?>
			<span></span>
			<?php endif; ?>

			<?php if ( $next ) : ?>
			<a class="bain-client__pager-link bain-client__pager-link--right" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
				<span class="bain-client__pager-title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
				<span class="bain-client__pager-dir" aria-hidden="true"> next &rarr;</span>
			</a>
			<?php else : ?>
			<span></span>
			<?php endif; ?>

		</div>
	</nav>
	<?php endif; ?>

</article>

<?php
endwhile;

get_footer();


/* -------------------------------------------------------------------------
 * Inline render helpers — client-specific.
 * Promote to bain-design-system.php if used elsewhere.
 * ---------------------------------------------------------------------- */

function bain_client__section_inline( $num, $label ) { ?>
	<header class="bain-client__inline-head">
		<span class="bain-client__inline-num" aria-hidden="true"><?php echo esc_html( $num ); ?> /</span>
		<h2 class="bain-client__inline-label"><?php echo esc_html( $label ); ?></h2>
	</header>
<?php }

function bain_client_adjacent( $direction = 'prev' ) {
	$posts = get_posts( array(
		'post_type'      => 'bd324_clients',
		'posts_per_page' => -1,
		'orderby'        => 'title',
		'order'          => 'ASC',
		'fields'         => 'ids',
	) );

	$current = array_search( get_the_ID(), $posts, true );
	if ( false === $current ) { return null; }

	$target = $direction === 'prev' ? $current - 1 : $current + 1;
	return isset( $posts[ $target ] ) ? $posts[ $target ] : null;
}
