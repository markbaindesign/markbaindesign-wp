<?php
/**
 * Single testimonial template — single-bd324_testimonials.php
 * Matches SingleTestimonial.jsx: breadcrumb → hero → pull quote → project → prev/next → other voices.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

if ( ! have_posts() ) {
	get_footer();
	exit;
}

the_post();

$post_id     = get_the_ID();
$author      = get_the_title();
$role        = get_post_meta( $post_id, 'testimonial_role', true );
$year        = get_the_date( 'Y' );
$full_quote  = wp_strip_all_tags( get_the_content() );
$archive_url = get_post_type_archive_link( 'bd324_testimonials' );

// Short quote for the hero descriptor
$short = get_the_excerpt() ?: wp_trim_words( $full_quote, 30 );

// Related client / org
$org              = '';
$client_permalink = '';
if ( function_exists( 'bd324_get_testimonial_related_client_data' ) ) {
	$client_data      = bd324_get_testimonial_related_client_data( $post_id );
	$org              = $client_data['client_name'] ?? '';
	$client_permalink = $client_data['client_permalink'] ?? '';
}

// Related projects (a testimonial can relate to more than one)
$related_projects = array();
if ( function_exists( 'bd324_get_testimonial_related_projects' ) ) {
	$related_projects = bd324_get_testimonial_related_projects( $post_id );
}
$related_project = ! empty( $related_projects ) ? $related_projects[0] : null;

// Prev/next within bd324_testimonials
$prev_post = get_previous_post();
$next_post = get_next_post();

// Other voices — 3 others, random order
$others_query = new WP_Query( array(
	'post_type'      => 'bd324_testimonials',
	'posts_per_page' => 3,
	'post__not_in'   => array( $post_id ),
	'orderby'        => 'rand',
	'no_found_rows'  => true,
) );
$other_posts = $others_query->posts;
wp_reset_postdata();
?>

<!-- ============================================================= BREADCRUMB -->
<?php
bain_breadcrumb( array(
	array( 'label' => 'nice-words', 'url' => $archive_url ),
	array( 'label' => $author ),
), '.md' );
?>

<!-- ============================================================= HERO -->
<section class="nw-hero">
	<div class="bain-wrap">
		<div class="nw-hero__grid">

			<div class="nw-hero__num" aria-hidden="true">01</div>

			<div>
				<?php
				$meta_parts = array_filter( array( $year, $org ) );
				bain_meta_bracket( implode( ' / ', $meta_parts ) );
				?>
				<h1 class="nw-hero__name"><?php echo esc_html( $author ); ?><span class="nw-hero__dot">.</span></h1>
				<p class="nw-hero__desc">
					<?php
					echo $role ? esc_html( $role ) : 'A client';
					if ( $org ) {
						if ( $related_project ) {
							echo ' at <strong><a href="' . esc_url( $related_project['permalink'] ) . '">' . esc_html( $org ) . '</a></strong>';
						} else {
							echo ' at <strong>' . esc_html( $org ) . '</strong>';
						}
					}
					echo '. Wrote in to talk about';
					if ( count( $related_projects ) === 1 ) {
						echo ' the <em>' . esc_html( $related_project['title'] ) . '</em> build';
					} elseif ( count( $related_projects ) > 1 ) {
						$titles = array_map( 'esc_html', wp_list_pluck( $related_projects, 'title' ) );
						$last   = array_pop( $titles );
						echo ' the <em>' . implode( '</em>, <em>', $titles ) . '</em> and <em>' . $last . '</em> builds';
					} else {
						echo ' the work';
					}
					echo '.';
					?>
				</p>
			</div>

			<dl class="nw-hero__sidebar">
				<div class="nw-meta-row">
					<dt class="nw-meta-row__label">Author</dt>
					<dd class="nw-meta-row__value"><?php echo esc_html( $author ); ?></dd>
				</div>
				<?php if ( $role ) : ?>
				<div class="nw-meta-row">
					<dt class="nw-meta-row__label">Role</dt>
					<dd class="nw-meta-row__value"><?php echo esc_html( $role ); ?></dd>
				</div>
				<?php endif; ?>
				<?php if ( $org ) : ?>
				<div class="nw-meta-row">
					<dt class="nw-meta-row__label">Org</dt>
					<dd class="nw-meta-row__value"><?php echo esc_html( $org ); ?></dd>
				</div>
				<?php endif; ?>
				<div class="nw-meta-row">
					<dt class="nw-meta-row__label">Year</dt>
					<dd class="nw-meta-row__value"><?php echo esc_html( $year ); ?></dd>
				</div>
				<?php if ( ! empty( $related_projects ) ) : ?>
				<div class="nw-meta-row">
					<dt class="nw-meta-row__label">Project</dt>
					<dd class="nw-meta-row__value">
						<?php
						$project_links = array();
						foreach ( $related_projects as $rp ) {
							$project_links[] = '<a href="' . esc_url( $rp['permalink'] ) . '">' . esc_html( $rp['title'] ) . '</a>';
						}
						echo implode( ', ', $project_links );
						?>
					</dd>
				</div>
				<?php endif; ?>
			</dl>

		</div>
	</div>
</section>

<!-- ============================================================= PULL QUOTE -->
<section class="nw-pullquote">
	<div class="nw-pullquote__inner">
		<div class="nw-pullquote__mark" aria-hidden="true">"</div>
		<blockquote class="nw-pullquote__blockquote">
			<?php echo esc_html( $full_quote ); ?>
		</blockquote>
		<div class="nw-pullquote__sig">
			<?php bain_nw_initials( $author, 'ink', true, $post_id ); ?>
			<div class="nw-pullquote__sig-info">
				<div class="nw-pullquote__sig-name">&mdash; <?php echo esc_html( $author ); ?></div>
				<div class="nw-pullquote__sig-meta">
					<?php
					$sig_parts = array_filter( array( $role, $org, $year ) );
					echo esc_html( implode( ' / ', $sig_parts ) );
					?>
				</div>
			</div>
			<?php if ( ! empty( $related_projects ) ) : ?>
			<div class="nw-pullquote__actions">
				<?php foreach ( $related_projects as $i => $rp ) : ?>
				<?php
				$rp_label = ( 0 === $i && count( $related_projects ) === 1 )
					? 'see the project →'
					: 'see “' . $rp['title'] . '” →';
				bain_button( $rp_label, $rp['permalink'] );
				?>
				<?php endforeach; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- ============================================================= LINKED PROJECT(S) -->
<?php if ( ! empty( $related_projects ) ) : ?>
<section class="nw-linked-project">
	<div class="bain-wrap">
		<div class="nw-linked-project__header">
			<span class="nw-linked-project__section-label" aria-hidden="true">B /</span>
			<h3 class="nw-linked-project__h3"><?php echo count( $related_projects ) === 1 ? 'The project this is about' : 'The projects this is about'; ?></h3>
		</div>
		<?php foreach ( $related_projects as $rp ) :
			$p_id    = $rp['ID'];
			$p_url   = $rp['permalink'];
			$p_title = $rp['title'];
			$p_year  = $rp['year'] ?: get_the_date( 'Y', $p_id );
			$p_thumb = get_the_post_thumbnail( $p_id, 'large' );
		?>
		<a class="nw-linked-project__card" href="<?php echo esc_url( $p_url ); ?>">
			<div class="nw-linked-project__thumb">
				<?php echo $p_thumb; ?>
			</div>
			<div class="nw-linked-project__body">
				<div>
					<?php bain_meta_bracket( 'case study / ' . esc_html( $p_year ) ); ?>
					<h4 class="nw-linked-project__title"><?php echo esc_html( $p_title ); ?><span class="nw-linked-project__dot">.</span></h4>
					<p class="nw-linked-project__desc">Brief, approach, outcome and the screens that ended up in the production build. The full write-up.</p>
				</div>
				<div class="nw-linked-project__cta">read the case study &rarr;</div>
			</div>
		</a>
		<?php endforeach; ?>
	</div>
</section>
<?php endif; ?>

<!-- ============================================================= PREV / NEXT -->
<nav class="nw-prevnext" aria-label="Testimonial navigation">
	<?php if ( $prev_post ) : ?>
	<a class="nw-prevnext__prev" href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>">
		<div class="nw-prevnext__dir">&larr; previous voice</div>
		<div class="nw-prevnext__name"><?php echo esc_html( get_the_title( $prev_post ) ); ?></div>
	</a>
	<?php else : ?>
	<span></span>
	<?php endif; ?>

	<a class="nw-prevnext__all" href="<?php echo esc_url( $archive_url ); ?>">&#8962; all nice words</a>

	<?php if ( $next_post ) : ?>
	<a class="nw-prevnext__next" href="<?php echo esc_url( get_permalink( $next_post ) ); ?>">
		<div class="nw-prevnext__dir">next voice &rarr;</div>
		<div class="nw-prevnext__name"><?php echo esc_html( get_the_title( $next_post ) ); ?></div>
	</a>
	<?php else : ?>
	<span></span>
	<?php endif; ?>
</nav>

<!-- ============================================================= OTHER VOICES -->
<?php if ( ! empty( $other_posts ) ) : ?>
<section class="nw-others">
	<div class="bain-wrap">
		<div class="nw-others__header">
			<span class="nw-others__label" aria-hidden="true">C /</span>
			<h3 class="nw-others__h3">Other voices</h3>
		</div>
		<div class="nw-others__grid">
			<?php foreach ( $other_posts as $other ) :
				$o_id    = $other->ID;
				$o_name  = get_the_title( $o_id );
				$o_role  = get_post_meta( $o_id, 'testimonial_role', true );
				$o_year  = get_the_date( 'Y', $o_id );
				$o_url   = get_permalink( $o_id );
				$o_quote = $other->post_excerpt ?: wp_trim_words( wp_strip_all_tags( $other->post_content ), 25 );
			?>
			<article class="nw-other-card">
				<?php bain_meta_bracket( $o_year, array( 'tag' => 'div' ) ); ?>
				<blockquote class="nw-other-card__quote">
					<span class="nw-other-card__mark">"</span><?php echo esc_html( $o_quote ); ?><span class="nw-other-card__mark">"</span>
				</blockquote>
				<div class="nw-other-card__footer">
					<?php bain_nw_initials( $o_name, 'ink', false, $o_id ); ?>
					<div class="nw-other-card__info">
						<div class="nw-other-card__name"><?php echo esc_html( $o_name ); ?></div>
						<?php if ( $o_role ) : ?>
						<div class="nw-other-card__role"><?php echo esc_html( $o_role ); ?></div>
						<?php endif; ?>
					</div>
					<a class="nw-other-card__read" href="<?php echo esc_url( $o_url ); ?>">read &rarr;</a>
				</div>
			</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endif; ?>

<?php get_footer();
