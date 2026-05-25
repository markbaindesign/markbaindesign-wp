<?php
/**
 * Front page template.
 */

get_header();
?>

<!-- ================================================================== HERO -->
<section class="hero" aria-label="<?php esc_attr_e( 'Introduction', 'bain-design-theme' ); ?>">
	<div class="bain-wrap">
		<?php bain_meta_bracket( 'WordPress Designer & Developer' ); ?>

		<h1 class="hero__headline" id="hero-headline">
			<span class="hero__slot" id="slot-0"
				><span class="hero__slot-reserve" aria-hidden="true">Tasteful</span
				><span class="hero__slot-inner"
					><span class="hero__slot-highlight" aria-hidden="true"></span
					><span id="slot-0-text">Friendly</span
				></span
			></span
			><span class="hero__connector"> websites for </span
			><span class="hero__slot" id="slot-1"
				><span class="hero__slot-reserve" aria-hidden="true">interesting</span
				><span class="hero__slot-inner"
					><span class="hero__slot-highlight" aria-hidden="true"></span
					><span id="slot-1-text">interesting</span
				></span
			></span
			>&nbsp;<span class="hero__slot" id="slot-2"
				><span class="hero__slot-reserve" aria-hidden="true">entrepreneurs</span
				><span class="hero__slot-inner"
					><span class="hero__slot-highlight" aria-hidden="true"></span
					><span id="slot-2-text">people</span
				></span
			></span>
			<span class="hero__caret" id="hero-caret" aria-hidden="true"></span>
		</h1>

		<p class="hero__sub">
			I design &amp; build <strong>bespoke websites</strong> for
			<strong>individuals</strong>, <strong>small businesses</strong> &amp;
			<strong>start-ups</strong>.
		</p>

		<div class="hero__actions">
			<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="bain-btn">Arrange a chat now</a>
			<a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="bain-btn bain-btn--ghost">Check out my work →</a>
		</div>
	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ============================================================= SERVICES -->
<section class="bain-section" id="services" aria-labelledby="services-heading">
	<div class="bain-section__inner">

		<header class="section-header">
			<h2 class="section-header__title" id="services-heading">
				<span class="section-number" aria-hidden="true">01 /</span>Services
			</h2>
		</header>

		<div class="services-panel">
			<div class="services-list" role="list">
				<div class="services-list__item" role="listitem">
					<span class="services-list__num" aria-hidden="true">01</span>
					<span class="services-list__name">Themes<span class="services-list__stamp" aria-hidden="true">no bloat ✦</span></span>
					<span class="services-list__note">Bespoke WordPress themes, coded from scratch. No page builders, no bloat.</span>
				</div>
				<div class="services-list__item" role="listitem">
					<span class="services-list__num" aria-hidden="true">02</span>
					<span class="services-list__name">Plugins<span class="services-list__stamp" aria-hidden="true">two on .org ✦</span></span>
					<span class="services-list__note">Custom functionality, two open-source plugins on .org, hundreds of bespoke installs.</span>
				</div>
				<div class="services-list__item" role="listitem">
					<span class="services-list__num" aria-hidden="true">03</span>
					<span class="services-list__name">Design<span class="services-list__stamp" aria-hidden="true">pixels &amp; all ✦</span></span>
					<span class="services-list__note">Wireframing through to UI &mdash; mood-boarding, prototyping, full handoff.</span>
				</div>
			</div>
		</div>

	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ============================================================= PROJECTS -->
<section class="bain-section" id="projects" aria-labelledby="projects-heading">
	<div class="bain-section__inner">

		<div class="section-header section-header--row">
			<h2 class="section-header__title" id="projects-heading">
				<span class="section-number" aria-hidden="true">02 /</span>Latest projects
			</h2>
			<a href="<?php echo esc_url( home_url( '/portfolio' ) ); ?>" class="bain-btn bain-btn--ghost bain-btn--sm">
				See all →
			</a>
		</div>

		<?php
		$fp_projects = new WP_Query( array(
			'post_type'      => 'bd324_projects',
			'posts_per_page' => 3,
			'post_status'    => 'publish',
			'no_found_rows'  => true,
		) );

		if ( $fp_projects->have_posts() ) :
		?>
		<div class="portfolio-grid">
			<?php while ( $fp_projects->have_posts() ) : $fp_projects->the_post();
				$proj_year  = get_the_date( 'Y' );
				$proj_terms = get_the_terms( get_the_ID(), 'project-category-service' );
				$proj_tag   = ( $proj_terms && ! is_wp_error( $proj_terms ) ) ? $proj_terms[0]->name : '';
			?>
			<article class="portfolio-card" id="post-<?php the_ID(); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<a href="<?php the_permalink(); ?>" class="portfolio-card__thumb" tabindex="-1" aria-hidden="true">
						<?php the_post_thumbnail( 'medium_large' ); ?>
					</a>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" class="portfolio-card__thumb portfolio-card__thumb--empty" tabindex="-1" aria-hidden="true">
						<span class="portfolio-card__placeholder">[project preview]</span>
					</a>
				<?php endif; ?>

				<div class="portfolio-card__body">
					<div class="portfolio-card__meta">
						<?php bain_meta_bracket( trim( $proj_year . ( $proj_tag ? ' / ' . $proj_tag : '' ) ) ); ?>
					</div>
					<h3 class="portfolio-card__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					<p class="portfolio-card__excerpt">
						<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
					</p>
				</div>
			</article>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>
		<?php else : ?>
			<p style="color:var(--graphite);"><?php esc_html_e( 'Projects coming soon.', 'bain-design-theme' ); ?></p>
		<?php endif; ?>

	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ================================================================= ABOUT -->
<section class="bain-section about-section" id="about" aria-labelledby="about-heading">
	<div class="bain-section__inner about-section__inner">

		<div class="about-section__text">
			<?php bain_meta_bracket( 'about' ); ?>
			<h2 class="about-section__name" id="about-heading">Mark Crawford Bain</h2>
			<?php bain_meta_bracket( 'WordPress Designer & Developer', array( 'tag' => 'p' ) ); ?>
			<p class="about-section__intro">
				14+ years building bespoke WordPress sites from inception to execution. Based near Barcelona, working with clients worldwide.
			</p>
			<?php
			bain_check_list( array(
				'Dedicated and creative &mdash; every site is coded from scratch.',
				'Proficient in wireframing, designing responsive layouts, and coding bespoke themes &amp; plugins.',
				'Two open-source plugins published on WordPress.org.',
				'Committed to delivering technical solutions that align with clients&#8217; business objectives.',
			) );
			?>
		</div>

	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- =============================================================== CONTACT -->
<section class="bain-section contact-section" id="contact" aria-labelledby="contact-heading">
	<div class="bain-section__inner">
		<h2 class="section-header__title" id="contact-heading">
			<span class="section-number" aria-hidden="true">03 /</span>Get in touch
		</h2>
		<p class="contact-section__lead">
			If you're keen to find out more, there are lots of ways to get in touch &mdash; but why not start with an email?
		</p>
		<a href="mailto:hello@bain.design" class="contact-section__email" id="contact-email">
			hello@bain.design →
		</a>
	</div>
</section>

<?php get_footer(); ?>
