<?php
/**
 * Single testimonial template — single-bd324_testimonials.php
 * Matches SingleTestimonial.jsx: breadcrumb → hero → pull quote → context → project → prev/next → other voices.
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

// Related project (first match)
$related_project = null;
if ( function_exists( 'bd324_get_testimonial_related_projects' ) ) {
	$related_projects = bd324_get_testimonial_related_projects( $post_id );
	if ( ! empty( $related_projects ) ) {
		$related_project = $related_projects[0];
	}
}

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
<nav class="nw-breadcrumb" aria-label="Breadcrumb">
	<span aria-hidden="true">~ </span>
	<span aria-hidden="true"> / </span>
	<a class="nw-breadcrumb__archive" href="<?php echo esc_url( $archive_url ); ?>">nice-words</a>
	<span aria-hidden="true"> / </span>
	<span class="nw-breadcrumb__current"><?php echo esc_html( sanitize_title( $author ) ); ?>.md</span>
</nav>

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
						echo ' at <strong>' . esc_html( $org ) . '</strong>';
					}
					echo '. Wrote in to talk about';
					if ( $related_project ) {
						echo ' the <em>' . esc_html( $related_project['title'] ) . '</em> build';
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
				<div class="nw-meta-row">
					<dt class="nw-meta-row__label">Verb.</dt>
					<dd class="nw-meta-row__value">Unedited</dd>
				</div>
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
			<?php if ( $related_project ) : ?>
			<div class="nw-pullquote__actions">
				<a class="nw-pullquote__btn nw-pullquote__btn--primary" href="<?php echo esc_url( $related_project['permalink'] ); ?>">
					see the project <span class="nw-pullquote__btn-arrow" aria-hidden="true">&rarr;</span>
				</a>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<!-- ============================================================= CONTEXT -->
<section class="nw-context">
	<div class="bain-wrap">
		<div class="nw-context__grid">

			<div>
				<div class="nw-section-label__num">A</div>
				<h2 class="nw-section-label__h3">Context</h2>
			</div>

			<div>
				<p class="nw-context__p1">A client engagement, scoped carefully from brief to launch.</p>
				<p class="nw-context__p2">The quote above came back when I checked in at the six-month mark. That is, in my experience, the best kind of review &mdash; unprompted, after the dust has settled.</p>
			</div>

			<aside class="nw-scope-card">
				<?php bain_meta_bracket( 'scope of work' ); ?>
				<p class="nw-context__p2" style="margin-top:var(--space-4);">Details on request &mdash; or read the project case study below.</p>
			</aside>

		</div>
	</div>
</section>

<!-- ============================================================= LINKED PROJECT -->
<?php if ( $related_project ) :
	$p_id    = $related_project['ID'];
	$p_url   = $related_project['permalink'];
	$p_title = $related_project['title'];
	$p_year  = $related_project['year'] ?: get_the_date( 'Y', $p_id );
	$p_thumb = get_the_post_thumbnail( $p_id, 'large' );
?>
<section class="nw-linked-project">
	<div class="bain-wrap">
		<div class="nw-linked-project__header">
			<span class="nw-linked-project__section-label" aria-hidden="true">B /</span>
			<h3 class="nw-linked-project__h3">The project this is about</h3>
		</div>
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
