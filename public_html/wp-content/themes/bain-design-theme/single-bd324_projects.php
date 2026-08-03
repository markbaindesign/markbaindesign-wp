<?php
/**
 * Single project template — editorial long-scroll.
 *
 * Mirrors ui_kits/website/SingleProject.jsx (variant A).
 * Data via ACF fields defined in bd-custom/acf-json/group_5be07d58217fd.json.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) :
	the_post();

	$num      = bain_project_number();
	$related_client = get_field( 'related_client' );
	$client   = ( ! empty( $related_client ) && is_array( $related_client ) ) ? ( $related_client[0]->post_title ?? '—' ) : '—';
	$year     = bain_project_field( 'year',      null, get_the_date( 'Y' ) );
	$duration = bain_project_field( 'duration',  null, '' );
	$role     = bain_project_field( 'role',      null, '' );
	$live     = bain_project_field( 'live_url',  null, '' );
	$tagline  = bain_project_field( 'tagline',   null, get_the_excerpt() );
	$brief    = bain_project_field( 'brief',     null, '' );
	$approach = bain_project_field( 'approach',  null, '' );
	$outcome  = bain_project_field( 'outcome',   null, '' );
	$cover    = get_post_thumbnail_id();
	$a_gallery = bain_project_field( 'approach_gallery', null, array() );
	$s_gallery = bain_project_field( 'showcase_gallery', null, array() );
	$wins     = bain_project_wins();
	$stack    = bain_project_terms_pills( 'project-category-tech-stack' );
	$services = bain_project_terms_pills( 'project-category-service' );
	$tools    = bain_project_terms_pills( 'project-category-tool' );
	$profiles = bain_project_terms_pills( 'project-category-profile' );

	// Quote for the project page comes solely from the related testimonial CPT.
	$tq = $ta = $tr = '';
	$testimonial_permalink = '';
	$linked_testimonials = get_post_meta( get_the_ID(), 'related_testimonials', true );
	if ( ! empty( $linked_testimonials ) && is_array( $linked_testimonials ) ) {
		$t_post = get_post( $linked_testimonials[0] );
		if ( $t_post && $t_post->post_status === 'publish' ) {
			$tq = $t_post->post_excerpt
				?: wp_trim_words( wp_strip_all_tags( $t_post->post_content ), 30, '…' );
			$ta = get_the_title( $t_post );
			$tr = get_post_meta( $t_post->ID, 'testimonial_role', true );
			$testimonial_permalink = get_permalink( $t_post );
		}
	}

	$related  = bain_project_related();
	$prev     = bain_project_adjacent( 'prev' );
	$next     = bain_project_adjacent( 'next' );
	$archive  = get_post_type_archive_link( 'bd324_projects' );
	$pub_count = (int) wp_count_posts( 'bd324_projects' )->publish;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'bain-project' ); ?>>

	<!-- ================================================================ HERO -->
	<section class="bain-project__hero">
		<div class="bain-wrap bain-project__hero-grid">

			<div class="bain-project__num" aria-hidden="true"><?php echo esc_html( $num ); ?></div>

			<div class="bain-project__hero-body">
				<?php bain_meta_bracket( esc_html( $year ) . ' / ' . esc_html( $client ) ); ?>
				<h1 class="bain-project__title">
					<?php the_title(); ?><span class="bain-project__title-dot" aria-hidden="true">.</span>
				</h1>
				<?php if ( $tagline ) : ?>
					<p class="bain-project__tagline"><?php echo esc_html( $tagline ); ?></p>
				<?php endif; ?>
			</div>

			<dl class="bain-project__meta">
				<?php bain_project__meta_row( 'Client',   $client ); ?>
				<?php bain_project__meta_row( 'Year',     $year ); ?>
				<?php if ( $duration ) { bain_project__meta_row( 'Duration', $duration ); } ?>
				<?php if ( $role )     { bain_project__meta_row( 'Role',     $role ); } ?>
				<?php if ( $live )     { bain_project__meta_row( 'Live',     $live, true ); } ?>
			</dl>

		</div>
	</section>

	<!-- ============================================================== COVER -->
	<?php if ( $cover ) : ?>
	<section class="bain-project__cover">
		<div class="bain-wrap">
			<?php echo wp_get_attachment_image( $cover, 'full', false, array(
				'class' => 'bain-project__cover-img',
				'alt'   => esc_attr( get_the_title() . ' — cover' ),
			) ); ?>
		</div>
	</section>
	<?php endif; ?>

	<?php bain_ascii_rule(); ?>

	<!-- =========================================================== CASE STUDY BODY -->
	<section class="bain-project__body">
		<div class="bain-wrap">

			<?php if ( $brief || $approach || $outcome || $wins ) : ?>

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

					<?php if ( ! empty( $a_gallery ) ) : ?>
					<div class="bain-project__approach-grid">
						<?php foreach ( array_slice( (array) $a_gallery, 0, 2 ) as $img ) :
							$id = is_array( $img ) ? ( $img['ID'] ?? 0 ) : (int) $img;
							if ( $id ) {
								echo wp_get_attachment_image( $id, 'large', false, array( 'class' => 'bain-project__approach-img' ) );
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
					<?php if ( $wins ) { bain_check_list( $wins, 'bain-project__wins' ); } ?>
				</div>
			</div>
			<?php endif; ?>

			<?php else : ?>
			<div class="bain-project__block bain-project__block--legacy">
				<div class="bain-project__prose bain-project__prose--legacy">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endif; ?>

		</div>
	</section>

	<!-- =========================================================== TESTIMONIAL -->
	<?php if ( $tq ) : ?>
	<section class="bain-project__quote">
		<div class="bain-wrap bain-project__quote-inner">
			<span class="bain-project__quote-mark" aria-hidden="true">&ldquo;</span>
			<div class="bain-project__quote-eyebrow">
				Nice words
			</div>
			<blockquote class="bain-project__quote-text">
				<?php echo esc_html( $tq ); ?>
			</blockquote>
			<?php if ( $ta || $tr ) : ?>
			<div class="bain-project__quote-attribution">
				&mdash; <?php echo esc_html( $ta ); ?>
				<?php if ( $tr ) : ?>
					<span class="bain-project__quote-role"> / <?php echo esc_html( $tr ); ?></span>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if ( ! empty( $testimonial_permalink ) ) : ?>
			<a class="bain-project__quote-link" href="<?php echo esc_url( $testimonial_permalink ); ?>">
				read the full testimonial &rarr;
			</a>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<?php bain_ascii_rule(); ?>

	<!-- ============================================================== GALLERY -->
	<?php
	$gallery_items = array();
	foreach ( (array) $s_gallery as $img ) {
		$id = is_array( $img ) ? ( $img['ID'] ?? 0 ) : (int) $img;
		if ( ! $id ) { continue; }
		$gallery_items[] = array(
			'id'      => $id,
			'full'    => wp_get_attachment_image_url( $id, 'full' ),
			'alt'     => get_post_meta( $id, '_wp_attachment_image_alt', true ),
			'caption' => wp_get_attachment_caption( $id ),
		);
	}
	if ( ! empty( $gallery_items ) ) :
		$big         = $gallery_items[0];
		$right       = array( $gallery_items[1] ?? null, $gallery_items[2] ?? null );
		$extra_count = max( 0, count( $gallery_items ) - 3 );
	?>
	<section class="bain-project__gallery" data-gallery="<?php echo esc_attr( wp_json_encode( $gallery_items ) ); ?>">
		<div class="bain-wrap">
			<?php bain_project__section_inline( '04', 'Selected screens' ); ?>
			<div class="bain-project__gallery-grid">
				<button type="button" class="bain-project__gallery-trigger bain-project__gallery-trigger--big" data-gallery-index="0">
					<?php echo wp_get_attachment_image( $big['id'], 'full', false, array( 'class' => 'bain-project__gallery-big' ) ); ?>
				</button>
				<div class="bain-project__gallery-stack">
					<?php foreach ( $right as $i => $img ) :
						if ( ! $img ) { continue; }
						$is_last = ( 1 === $i && $extra_count > 0 );
					?>
					<button type="button" class="bain-project__gallery-trigger" data-gallery-index="<?php echo esc_attr( $i + 1 ); ?>">
						<?php echo wp_get_attachment_image( $img['id'], 'large', false, array( 'class' => 'bain-project__gallery-small' ) ); ?>
						<?php if ( $is_last ) : ?>
						<span class="bain-project__gallery-more" aria-hidden="true">+<?php echo esc_html( $extra_count ); ?></span>
						<?php endif; ?>
					</button>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<div class="bain-lightbox" id="bain-lightbox" hidden aria-hidden="true">
		<div class="bain-lightbox__backdrop" data-lightbox-close></div>
		<div class="bain-lightbox__inner" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Project screens', 'bain-design-theme' ); ?>">
			<button type="button" class="bain-lightbox__close" data-lightbox-close aria-label="<?php esc_attr_e( 'Close', 'bain-design-theme' ); ?>">&times;</button>
			<button type="button" class="bain-lightbox__nav bain-lightbox__prev" data-lightbox-prev aria-label="<?php esc_attr_e( 'Previous image', 'bain-design-theme' ); ?>">&larr;</button>
			<img class="bain-lightbox__image" src="" alt="">
			<button type="button" class="bain-lightbox__nav bain-lightbox__next" data-lightbox-next aria-label="<?php esc_attr_e( 'Next image', 'bain-design-theme' ); ?>">&rarr;</button>
			<div class="bain-lightbox__footer">
				<p class="bain-lightbox__caption"></p>
				<span class="bain-lightbox__counter"></span>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<!-- ================================================================ STACK -->
	<?php if ( $stack ) : ?>
	<section class="bain-project__stack">
		<div class="bain-wrap">
			<?php bain_project__section_inline( '05', 'Stack' ); ?>
			<ul class="bain-project__stack-list" role="list">
				<?php foreach ( $stack as $s ) : ?>
					<li class="bain-project__stack-pill"><a href="<?php echo esc_url( $s['url'] ); ?>"<?php echo $s['description'] ? ' data-tip="' . esc_attr( $s['description'] ) . '"' : ''; ?>><?php echo esc_html( $s['name'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ============================================================== SERVICES -->
	<?php if ( $services ) : ?>
	<section class="bain-project__stack">
		<div class="bain-wrap">
			<?php bain_project__section_inline( '06', 'Services' ); ?>
			<ul class="bain-project__stack-list" role="list">
				<?php foreach ( $services as $s ) : ?>
					<li class="bain-project__stack-pill"><a href="<?php echo esc_url( $s['url'] ); ?>"<?php echo $s['description'] ? ' data-tip="' . esc_attr( $s['description'] ) . '"' : ''; ?>><?php echo esc_html( $s['name'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ================================================================ TOOLS -->
	<?php if ( $tools ) : ?>
	<section class="bain-project__stack">
		<div class="bain-wrap">
			<?php bain_project__section_inline( '07', 'Tools' ); ?>
			<ul class="bain-project__stack-list" role="list">
				<?php foreach ( $tools as $s ) : ?>
					<li class="bain-project__stack-pill"><a href="<?php echo esc_url( $s['url'] ); ?>"<?php echo $s['description'] ? ' data-tip="' . esc_attr( $s['description'] ) . '"' : ''; ?>><?php echo esc_html( $s['name'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ============================================================= PROFILES -->
	<?php if ( $profiles ) : ?>
	<section class="bain-project__stack">
		<div class="bain-wrap">
			<?php bain_project__section_inline( '08', 'Profiles' ); ?>
			<ul class="bain-project__stack-list" role="list">
				<?php foreach ( $profiles as $s ) : ?>
					<li class="bain-project__stack-pill"><a href="<?php echo esc_url( $s['url'] ); ?>"<?php echo $s['description'] ? ' data-tip="' . esc_attr( $s['description'] ) . '"' : ''; ?>><?php echo esc_html( $s['name'] ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<!-- ============================================================== RELATED -->
	<?php if ( $related || $archive ) : ?>
	<section class="bain-project__related">
		<div class="bain-wrap">
			<?php bain_project__section_inline( '09', 'Related' ); ?>
			<div class="bain-project__related-grid">

				<?php foreach ( $related as $r ) : ?>
				<a class="bain-project__related-card" href="<?php echo esc_url( get_permalink( $r ) ); ?>">
					<h4 class="bain-project__related-title"><?php echo esc_html( get_the_title( $r ) ); ?></h4>
					<span class="bain-project__related-link">view project &rarr;</span>
				</a>
				<?php endforeach; ?>

				<?php if ( $archive ) : ?>
				<a class="bain-project__related-card bain-project__related-card--all" href="<?php echo esc_url( $archive ); ?>">
					<?php bain_meta_bracket( $pub_count . ' projects shipped' ); ?>
					<div>
						<h4 class="bain-project__related-title">See all work</h4>
						<div class="bain-project__related-cta">cat case-studies.md &rarr;</div>
					</div>
				</a>
				<?php endif; ?>

			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- ============================================================= PREV/NEXT -->
	<?php if ( $prev || $next ) : ?>
	<nav class="bain-project__pager" aria-label="<?php esc_attr_e( 'Project navigation', 'bain-design-theme' ); ?>">
		<div class="bain-wrap bain-project__pager-inner">

			<?php if ( $prev ) : ?>
			<a class="bain-project__pager-link" href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
				<span class="bain-project__pager-dir" aria-hidden="true">&larr; prev </span>
				<span class="bain-project__pager-title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
			</a>
			<?php else : ?>
				<span></span>
			<?php endif; ?>

			<?php if ( $next ) : ?>
			<a class="bain-project__pager-link bain-project__pager-link--right" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
				<span class="bain-project__pager-title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
				<span class="bain-project__pager-dir" aria-hidden="true"> next &rarr;</span>
			</a>
			<?php endif; ?>

		</div>
	</nav>
	<?php endif; ?>

</article>

<?php
endwhile;

get_footer();


/* -------------------------------------------------------------------------
 * Inline render helpers — project-specific, kept here so the template is
 * self-contained. Promote to bain-design-system.php if used elsewhere.
 * ---------------------------------------------------------------------- */

function bain_project__meta_row( $label, $value, $is_link = false ) { ?>
	<div class="bain-project__meta-row">
		<dt class="bain-project__meta-label"><?php echo esc_html( $label ); ?></dt>
		<dd class="bain-project__meta-value">
			<?php if ( $is_link ) : ?>
				<a href="<?php echo esc_url( $value ); ?>" target="_blank" rel="noopener noreferrer">
					<?php echo esc_html( preg_replace( '#^https?://#', '', (string) $value ) ); ?> &nearr;
				</a>
			<?php else : ?>
				<?php echo esc_html( $value ); ?>
			<?php endif; ?>
		</dd>
	</div>
<?php }

function bain_project__section_rail( $num, $label ) { ?>
	<header class="bain-project__rail">
		<div class="bain-project__rail-num" aria-hidden="true"><?php echo esc_html( $num ); ?></div>
		<h3 class="bain-project__rail-label"><?php echo esc_html( $label ); ?></h3>
	</header>
<?php }

function bain_project__section_inline( $num, $label ) { ?>
	<header class="bain-project__inline-head">
		<span class="bain-project__inline-num" aria-hidden="true"><?php echo esc_html( $num ); ?> /</span>
		<h3 class="bain-project__inline-label"><?php echo esc_html( $label ); ?></h3>
	</header>
<?php }
