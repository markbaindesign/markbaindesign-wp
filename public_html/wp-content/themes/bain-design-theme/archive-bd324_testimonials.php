<?php
/**
 * Nice Words — testimonials archive
 * Matches NiceWordsArchive.jsx: header → featured → wall of cards → counters → CTA.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

// Collect posts from the main query directly (avoids loop overhead)
global $wp_query;
$all_posts = $wp_query->posts ?: array();
$total     = count( $all_posts );

// Featured: post with _nw_featured meta, or first post
$featured   = null;
$wall_posts = array();
foreach ( $all_posts as $p ) {
	if ( $featured === null && get_post_meta( $p->ID, '_nw_featured', true ) ) {
		$featured = $p;
	} else {
		$wall_posts[] = $p;
	}
}
if ( $featured === null && ! empty( $all_posts ) ) {
	$featured   = $all_posts[0];
	$wall_posts = array_slice( $all_posts, 1 );
}

// Distribute wall posts into 3 columns (round-robin = deterministic order)
$cols = array( array(), array(), array() );
foreach ( $wall_posts as $i => $p ) {
	$cols[ $i % 3 ][] = $p;
}

// Stats strip (design data — update as portfolio grows)
$nice_numbers = array(
	array( 'n' => '47',     'label' => 'Projects shipped',   'sub' => 'since 2012' ),
	array( 'n' => $total,   'label' => 'Nice words logged',  'sub' => 'this page' ),
	array( 'n' => '14',     'label' => 'Repeat clients',     'sub' => '60% retention' ),
	array( 'n' => '6',      'label' => 'Referrals returned', 'sub' => 'thanks Common Lot' ),
);

// Helper: short quote from a post (excerpt or trimmed content)
function bain_nw_short_quote( $post ) {
	if ( $post->post_excerpt ) {
		return $post->post_excerpt;
	}
	return wp_trim_words( wp_strip_all_tags( $post->post_content ), 30 );
}
?>

<!-- ============================================================= PAGE HEADER -->
<div class="nw-page-header">
	<div class="bain-wrap">
		<div class="nw-page-header__grid">

			<div class="nw-page-header__monogram" aria-hidden="true">NW</div>

			<div class="nw-page-header__body">
				<?php bain_meta_bracket( $total . ' reviews / since 2014 / unedited', array( 'tag' => 'div' ) ); ?>
				<h1 class="nw-page-header__title">Nice words<span class="nw-dot">.</span></h1>
				<p class="nw-page-header__lead">Written by people who paid me money and would, in theory, do it again. Lightly trimmed for length, never for content. Sorted newest first.</p>
			</div>

			<div class="nw-terminal">
				<div class="nw-terminal__path">~ /reviews</div>
				<div class="nw-terminal__cmd"><span class="nw-clay">$</span> grep -ri <span class="nw-highlight">kind</span> .</div>
				<div class="nw-terminal__result"><?php echo esc_html( $total ); ?> matches in <?php echo esc_html( $total ); ?> files</div>
				<div class="nw-terminal__prompt"><span class="nw-clay">$</span> _<span class="nw-cursor" aria-hidden="true"></span></div>
			</div>

		</div>
	</div>
</div>

<?php bain_ascii_rule(); ?>

<!-- ============================================================= FEATURED -->
<?php if ( $featured ) :
	$f_id    = $featured->ID;
	$f_name  = get_the_title( $f_id );
	$f_role  = get_post_meta( $f_id, 'testimonial_role', true );
	$f_year  = get_the_date( 'Y', $f_id );
	$f_url   = get_permalink( $f_id );
	$f_quote = bain_nw_short_quote( $featured );
	$f_org   = '';
	if ( function_exists( 'bd324_get_testimonial_related_client_data' ) ) {
		$f_client = bd324_get_testimonial_related_client_data( $f_id );
		$f_org    = $f_client['client_name'] ?? '';
	}
?>
<section class="nw-featured">
	<div class="bain-wrap">
		<div class="nw-featured__grid">

			<div>
				<?php bain_meta_bracket( 'featured', array( 'tag' => 'div' ) ); ?>
				<div class="nw-featured__openquote" aria-hidden="true">"</div>
			</div>

			<div>
				<blockquote class="nw-featured__quote"><?php echo esc_html( $f_quote ); ?></blockquote>
				<a class="nw-featured__link" href="<?php echo esc_url( $f_url ); ?>">read the full review &rarr;</a>
			</div>

			<div class="nw-featured__author">
				<div class="nw-featured__author-header">
					<?php bain_nw_initials( $f_name, 'ink', true, $f_id ); ?>
					<div>
						<div class="nw-featured__author-name"><?php echo esc_html( $f_name ); ?></div>
						<?php if ( $f_role ) : ?>
						<div class="nw-featured__author-role"><?php echo esc_html( $f_role ); ?></div>
						<?php endif; ?>
					</div>
				</div>
				<div class="nw-featured__author-meta">
					<?php if ( $f_org ) : ?>
					<div class="nw-mini-row">
						<span class="nw-mini-row__label">Org</span>
						<span class="nw-mini-row__value"><?php echo esc_html( $f_org ); ?></span>
					</div>
					<?php endif; ?>
					<div class="nw-mini-row">
						<span class="nw-mini-row__label">Year</span>
						<span class="nw-mini-row__value"><?php echo esc_html( $f_year ); ?></span>
					</div>
					<div class="nw-mini-row">
						<span class="nw-mini-row__label">Verb.</span>
						<span class="nw-mini-row__value">Unedited</span>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<?php endif; ?>

<?php bain_ascii_rule(); ?>

<!-- ============================================================= WALL -->
<div class="bain-wrap">
	<div class="nw-wall-header">
		<div class="nw-wall-header__left">
			<span class="nw-wall-header__label" aria-hidden="true">01 /</span>
			<h2 class="nw-wall-header__h2">The whole archive</h2>
		</div>
	</div>
</div>

<div class="bain-wrap">
	<div class="nw-wall">
		<?php if ( ! empty( $wall_posts ) ) : ?>
		<div class="nw-wall__grid">
			<?php foreach ( $cols as $col ) : ?>
			<div class="nw-wall__col">
				<?php foreach ( $col as $card ) :
					$c_id     = $card->ID;
					$c_name   = get_the_title( $c_id );
					$c_role   = get_post_meta( $c_id, 'testimonial_role', true );
					$c_year   = get_the_date( 'Y', $c_id );
					$c_url    = get_permalink( $c_id );
					$c_pinned = (bool) get_post_meta( $c_id, '_nw_featured', true );
					$c_quote  = bain_nw_short_quote( $card );
					$c_long   = strlen( $card->post_content ) > 600;

					$card_class = 'nw-card';
					if ( $c_pinned ) { $card_class .= ' nw-card--pinned'; }
					if ( $c_long )   { $card_class .= ' nw-card--long'; }
				?>
				<article id="nw-<?php echo esc_attr( $c_id ); ?>" class="<?php echo esc_attr( $card_class ); ?>">

					<div class="nw-card__header">
						<div class="nw-card__num">[ <?php echo esc_html( $c_year ); ?> ]</div>
						<?php if ( $c_pinned ) : ?>
						<div class="nw-card__pin" aria-hidden="true">&#x2605; pinned</div>
						<?php endif; ?>
					</div>

					<blockquote class="nw-card__quote">
						<span class="nw-card__quote-mark" aria-hidden="true">"</span><?php echo esc_html( $c_quote ); ?><span class="nw-card__quote-mark" aria-hidden="true">"</span>
					</blockquote>

					<div class="nw-card__attribution">
						<?php bain_nw_initials( $c_name, $c_pinned ? 'paper' : 'ink', false, $c_id ); ?>
						<div class="nw-card__attr-info">
							<div class="nw-card__attr-name"><?php echo esc_html( $c_name ); ?></div>
							<?php if ( $c_role ) : ?>
							<div class="nw-card__attr-role"><?php echo esc_html( $c_role ); ?></div>
							<?php endif; ?>
						</div>
					</div>

					<div class="nw-card__footer">
						<a class="nw-card__read-link" href="<?php echo esc_url( $c_url ); ?>">read in full &rarr;</a>
					</div>

				</article>
				<?php endforeach; ?>
			</div>
			<?php endforeach; ?>
		</div>
		<?php else : ?>
		<p style="color:var(--pencil);padding:var(--space-7) 0;">No further testimonials.</p>
		<?php endif; ?>
	</div>
</div>

<!-- ============================================================= COUNTERS -->
<div class="nw-counters">
	<div class="bain-wrap">
		<div class="nw-counters__grid">
			<?php foreach ( $nice_numbers as $stat ) : ?>
			<div class="nw-counters__item">
				<div class="nw-counters__n"><?php echo esc_html( $stat['n'] ); ?></div>
				<div class="nw-counters__label"><?php echo esc_html( $stat['label'] ); ?></div>
				<div class="nw-counters__sub">[ <?php echo esc_html( $stat['sub'] ); ?> ]</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<!-- ============================================================= CTA -->
<section class="nw-archive-cta">
	<div class="bain-wrap">
		<div class="nw-archive-cta__band">
			<div>
				<?php bain_meta_bracket( 'want one of these', array( 'tag' => 'div' ) ); ?>
				<h3 class="nw-archive-cta__heading">I&rsquo;m taking on two more projects in 2026<span class="nw-dot">.</span></h3>
				<p class="nw-archive-cta__sub">If yours is the sort of brief these clients describe &mdash; small, well-scoped, run by humans you&rsquo;d want to share an espresso with &mdash; start with an email.</p>
			</div>
			<a class="nw-archive-cta__btn" href="mailto:mark@bain.design">
				<span>Arrange a chat</span>
				<span class="nw-archive-cta__btn-arrow" aria-hidden="true">&rarr;</span>
			</a>
		</div>
	</div>
</section>

<?php get_footer();
