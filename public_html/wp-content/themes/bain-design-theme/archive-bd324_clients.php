<?php
/**
 * Clients archive — bd324_clients.
 *
 * A directory index rather than a card grid. A client record carries a name,
 * an industry and sometimes a website; there are no logos and no copy, so a
 * grid of cards would be mostly empty boxes. Leader dots and letter groups
 * suit the data and the monospace face.
 *
 * The query is widened to every client, ordered by title, in
 * bd-custom/inc/clients/business-logic.php.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

global $wp_query;
$clients = $wp_query->posts ?: array();
$total   = count( $clients );

$industry_terms = get_terms( array(
	'taxonomy'   => 'client-industry',
	'hide_empty' => true,
) );
$industry_total = is_wp_error( $industry_terms ) ? 0 : count( $industry_terms );

/**
 * Group the clients by the first character of their name, so the index can be
 * scanned the way a directory is. Anything that is not a letter collects under
 * a single "#" heading at the top.
 */
$groups = array();
foreach ( $clients as $client ) {
	$initial = strtoupper( mb_substr( get_the_title( $client ), 0, 1 ) );
	if ( ! preg_match( '/^[A-Z]$/', $initial ) ) {
		$initial = '#';
	}
	$groups[ $initial ][] = $client;
}

$eyebrow = sprintf(
	/* translators: 1: number of clients, 2: number of industries */
	_n( '%1$s client / %2$s industries', '%1$s clients / %2$s industries', $total, 'bain-design-theme' ),
	number_format_i18n( $total ),
	number_format_i18n( $industry_total )
);
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( $eyebrow ); ?>
		<h1 class="archive-header__title">Clients</h1>
		<p class="archive-header__desc">Everyone I've built something for. Each name opens that client's page, with their industry and any case studies I've written up.</p>
	</div>
</div>

<div class="archive-content client-archive">

	<?php if ( $total ) : ?>

		<div class="client-index">
			<?php foreach ( $groups as $initial => $members ) : ?>

			<section class="client-index__group" aria-labelledby="clients-<?php echo esc_attr( '#' === $initial ? 'other' : strtolower( $initial ) ); ?>">
				<h2 class="client-index__letter" id="clients-<?php echo esc_attr( '#' === $initial ? 'other' : strtolower( $initial ) ); ?>">
					<?php echo esc_html( $initial ); ?>
				</h2>

				<ul class="client-index__rows" role="list">
					<?php foreach ( $members as $client ) :
						$client_id  = $client->ID;
						$industries = wp_get_post_terms( $client_id, 'client-industry', array( 'fields' => 'names' ) );
						$industry   = ( ! is_wp_error( $industries ) && ! empty( $industries ) ) ? implode( ', ', $industries ) : '';
						$projects   = function_exists( 'bd324_get_projects_by_client' ) ? bd324_get_projects_by_client( $client_id ) : array();
						$work_count = is_array( $projects ) ? count( $projects ) : 0;
					?>
					<li class="client-index__item">
						<a class="client-index__row" href="<?php echo esc_url( get_permalink( $client_id ) ); ?>">
							<span class="client-index__name"><?php echo esc_html( get_the_title( $client_id ) ); ?></span>
							<span class="client-index__leader" aria-hidden="true"></span>
							<?php if ( $industry ) : ?>
							<span class="client-index__industry"><?php echo esc_html( $industry ); ?></span>
							<?php endif; ?>
							<span class="client-index__work<?php echo $work_count ? '' : ' client-index__work--none'; ?>">
								<?php
								if ( $work_count ) {
									printf(
										/* translators: %s: number of case studies */
										esc_html( _n( '%s case study', '%s case studies', $work_count, 'bain-design-theme' ) ),
										esc_html( number_format_i18n( $work_count ) )
									);
								} else {
									// En dash, not an em dash: this is a "no data" marker in a
									// column, and em dashes are out in public-facing copy.
									echo '&ndash;';
								}
								?>
							</span>
							<span class="client-index__arrow" aria-hidden="true">&rarr;</span>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</section>

			<?php endforeach; ?>
		</div>

	<?php else : ?>
		<p class="archive-empty">No clients yet.</p>
	<?php endif; ?>

</div>

<?php get_footer();
