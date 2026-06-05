<?php
/**
 * Bain Design — Single project template
 *
 * Drop at theme root as `single-project.php`, or let
 * inc/cpt-project.php's `single_template` filter pick it up from
 * `templates/` inside the theme.
 *
 * Mirrors the React mock in ui_kits/website/SingleProject.jsx —
 * variant A · editorial long-scroll. All copy is pulled from ACF
 * fields (see acf/group_project_fields.json) with post-meta fallback.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) :
	the_post();

	$num     = bain_project_number();
	$client  = bain_project_field( 'client',     null, '—' );
	$year    = bain_project_field( 'year',       null, get_the_date( 'Y' ) );
	$duration = bain_project_field( 'duration',   null, '' );
	$role    = bain_project_field( 'role',       null, '' );
	$live    = bain_project_field( 'live_url',   null, '' );
	$tagline = bain_project_field( 'tagline',    null, get_the_excerpt() );
	$brief   = bain_project_field( 'brief',      null, '' );
	$approach = bain_project_field( 'approach',   null, '' );
	$outcome = bain_project_field( 'outcome',    null, '' );
	$cover   = get_post_thumbnail_id();
	$gallery = bain_project_field( 'approach_gallery', null, array() );
	$wins    = bain_project_wins();
	$stack   = bain_project_stack();
	$tq      = bain_project_field( 'testimonial_quote',  null, '' );
	$ta      = bain_project_field( 'testimonial_author', null, '' );
	$tr      = bain_project_field( 'testimonial_role',   null, '' );
	$related = bain_project_related();
	$prev    = bain_project_adjacent( 'prev' );
	$next    = bain_project_adjacent( 'next' );
	$archive = get_post_type_archive_link( 'project' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'bain-project' ); ?>>

	<!-- ============ HERO ============ -->
	<section class="bain-project__hero">
		<div class="bain-project__hero-grid">
			<div class="bain-project__num" aria-hidden="true"><?php echo esc_html( $num ); ?></div>

			<div>
				<div class="bain-project__bracket">
					[ <?php echo esc_html( $year ); ?> / <?php echo esc_html( $client ); ?> ]
				</div>
				<h1 class="bain-project__title">
					<?php the_title(); ?><span class="bain-project__title-dot">.</span>
				</h1>
				<?php if ( $tagline ) : ?>
					<p class="bain-project__tagline"><?php echo esc_html( $tagline ); ?></p>
				<?php endif; ?>
			</div>

			<dl class="bain-project__meta">
				<?php bain_project__meta_row( 'Client',   $client ); ?>
				<?php bain_project__meta_row( 'Year',     $year ); ?>
				<?php if ( $duration ) { bain_project__meta_row( 'Duration', $duration ); } ?>
				<?php if ( $role     ) { bain_project__meta_row( 'Role',     $role ); } ?>
				<?php if ( $live     ) { bain_project__meta_row( 'Live',     $live, true ); } ?>
			</dl>
		</div>
	</section>

	<!-- ============ COVER ============ -->
	<?php if ( $cover ) : ?>
		<section class="bain-project__cover">
			<?php echo wp_get_attachment_image( $cover, 'large', false, array(
				'class' => 'bain-project__cover-img',
				'alt'   => esc_attr( get_the_title() . ' — cover' ),
			) ); ?>
		</section>
	<?php endif; ?>

	<!-- ============ BRIEF / APPROACH / OUTCOME ============ -->
	<section class="bain-project__body">

		<?php if ( $brief ) : ?>
		<div class="bain-project__block">
			<?php bain_project__section_rail( '01', 'Brief' ); ?>
			<div class="bain-project__prose">
				<?php echo wp_kses_post( wpautop( $brief ) ); ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $approach ) : ?>
		<div class="bain-project__block">
			<?php bain_project__section_rail( '02', 'Approach' ); ?>
			<div class="bain-project__prose">
				<?php echo wp_kses_post( wpautop( $approach ) ); ?>

				<?php if ( ! empty( $gallery ) ) : ?>
					<div class="bain-project__approach-grid">
						<?php foreach ( array_slice( (array) $gallery, 0, 2 ) as $img ) :
							$id = is_array( $img ) ? ( $img['ID'] ?? 0 ) : (int) $img;
							if ( $id ) {
								echo wp_get_attachment_image( $id, 'large', false, array(
									'class' => 'bain-project__approach-img',
								) );
							}
						endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $outcome || $wins ) : ?>
		<div class="bain-project__block">
			<?php bain_project__section_rail( '03', 'Outcome' ); ?>
			<div class="bain-project__prose">
				<?php if ( $outcome ) { echo wp_kses_post( wpautop( $outcome ) ); } ?>

				<?php if ( $wins ) {
					bain_check_list( $wins, 'bain-project__wins' );
				} ?>
			</div>
		</div>
		<?php endif; ?>

	</section>

	<!-- ============ TESTIMONIAL ============ -->
	<?php if ( $tq ) : ?>
	<section class="bain-project__quote">
		<div class="bain-project__quote-inner">
			<div class="bain-project__quote-eyebrow">
				<span class="bain-project__quote-mark">"</span>
				Nice words
				<span class="bain-project__quote-mark">"</span>
			</div>
			<blockquote class="bain-project__quote-text">
				&ldquo;<?php echo esc_html( $tq ); ?>&rdquo;
			</blockquote>
			<?php if ( $ta || $tr ) : ?>
				<div class="bain-project__quote-attribution">
					— <?php echo esc_html( $ta ); ?>
					<?php if ( $tr ) : ?>
						<span class="bain-project__quote-role"> / <?php echo esc_html( $tr ); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<!-- ============ GALLERY ============ -->
	<?php
	$showcase = bain_project_field( 'showcase_gallery', null, array() );
	if ( ! empty( $showcase ) ) :
		$showcase = array_values( array_filter( (array) $showcase ) );
		// take up to 3 — first is big, two stacked on the right
		$big   = $showcase[0] ?? null;
		$right = array( $showcase[1] ?? null, $showcase[2] ?? null );
	?>
	<section class="bain-project__gallery">
		<?php bain_project__section_inline( '04', 'Selected screens' ); ?>
		<div class="bain-project__gallery-grid">
			<?php if ( $big ) {
				$id = is_array( $big ) ? ( $big['ID'] ?? 0 ) : (int) $big;
				if ( $id ) { echo wp_get_attachment_image( $id, 'full', false, array( 'class' => 'bain-project__gallery-big' ) ); }
			} ?>
			<div class="bain-project__gallery-stack">
				<?php foreach ( $right as $img ) {
					if ( ! $img ) { continue; }
					$id = is_array( $img ) ? ( $img['ID'] ?? 0 ) : (int) $img;
					if ( $id ) { echo wp_get_attachment_image( $id, 'large', false, array( 'class' => 'bain-project__gallery-small' ) ); }
				} ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ============ STACK ============ -->
	<?php if ( $stack ) : ?>
	<section class="bain-project__stack">
		<?php bain_project__section_inline( '05', 'Stack' ); ?>
		<ul class="bain-project__stack-list">
			<?php foreach ( $stack as $s ) : ?>
				<li class="bain-project__stack-pill"><?php echo esc_html( $s ); ?></li>
			<?php endforeach; ?>
		</ul>
	</section>
	<?php endif; ?>

	<!-- ============ RELATED ============ -->
	<?php if ( $related || $archive ) : ?>
	<section class="bain-project__related">
		<?php bain_project__section_inline( '06', 'Related' ); ?>
		<div class="bain-project__related-grid">
			<?php foreach ( $related as $r ) :
				$rtag = wp_get_post_terms( $r->ID, 'project_tag', array( 'fields' => 'names' ) );
				$rtag = $rtag ? $rtag[0] : 'Project';
			?>
				<article class="bain-project__related-card">
					<div class="bain-project__bracket">
						[ <?php echo esc_html( get_the_date( 'Y', $r ) ); ?> / <?php echo esc_html( $rtag ); ?> ]
					</div>
					<h4 class="bain-project__related-title"><?php echo esc_html( get_the_title( $r ) ); ?></h4>
					<a class="bain-project__related-link" href="<?php echo esc_url( get_permalink( $r ) ); ?>">view project &rarr;</a>
				</article>
			<?php endforeach; ?>

			<a class="bain-project__related-card bain-project__related-card--all" href="<?php echo esc_url( $archive ); ?>">
				<div class="bain-project__bracket bain-project__bracket--inverse">
					[ <?php $count = wp_count_posts( 'project' ); echo (int) $count->publish; ?> projects shipped ]
				</div>
				<div>
					<h4 class="bain-project__related-title">See all work</h4>
					<div class="bain-project__related-cta">cat portfolio.md &rarr;</div>
				</div>
			</a>
		</div>
	</section>
	<?php endif; ?>

	<!-- ============ PREV / NEXT ============ -->
	<?php if ( $prev || $next ) : ?>
	<nav class="bain-project__pager" aria-label="Project navigation">
		<?php if ( $prev ) : ?>
			<a class="bain-project__pager-link" href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
				<span class="bain-project__pager-dir">&larr; prev </span>
				<span class="bain-project__pager-title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
			</a>
		<?php else: ?>
			<span></span>
		<?php endif; ?>

		<?php if ( $next ) : ?>
			<a class="bain-project__pager-link bain-project__pager-link--right" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
				<span class="bain-project__pager-title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
				<span class="bain-project__pager-dir"> next &rarr;</span>
			</a>
		<?php endif; ?>
	</nav>
	<?php endif; ?>

</article>

<?php
endwhile;

get_footer();


/* ---------------------------------------------------------------------
 *  Tiny inline render helpers — kept in-file so the template is portable
 *  on its own. Promote them to inc/bain-design-system.php if you start
 *  using them elsewhere.
 * ------------------------------------------------------------------ */

function bain_project__meta_row( $label, $value, $is_link = false ) {
	?>
	<div class="bain-project__meta-row">
		<dt class="bain-project__meta-label"><?php echo esc_html( $label ); ?></dt>
		<dd class="bain-project__meta-value">
			<?php if ( $is_link ) : ?>
				<a href="<?php echo esc_url( $value ); ?>" target="_blank" rel="noopener">
					<?php echo esc_html( preg_replace( '#^https?://#', '', (string) $value ) ); ?> &nearr;
				</a>
			<?php else : ?>
				<?php echo esc_html( $value ); ?>
			<?php endif; ?>
		</dd>
	</div>
	<?php
}

function bain_project__section_rail( $num, $label ) {
	?>
	<header class="bain-project__rail">
		<div class="bain-project__rail-num"><?php echo esc_html( $num ); ?></div>
		<h3 class="bain-project__rail-label"><?php echo esc_html( $label ); ?></h3>
	</header>
	<?php
}

function bain_project__section_inline( $num, $label ) {
	?>
	<header class="bain-project__inline-head">
		<span class="bain-project__inline-num"><?php echo esc_html( $num ); ?> /</span>
		<h3 class="bain-project__inline-label"><?php echo esc_html( $label ); ?></h3>
	</header>
	<?php
}
