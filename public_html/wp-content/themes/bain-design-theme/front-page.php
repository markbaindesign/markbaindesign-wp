<?php
/**
 * Front page template.
 */

get_header();
?>

<!-- ================================================================== HERO -->
<section class="hero" aria-label="<?php esc_attr_e( 'Introduction', 'bain-design-theme' ); ?>">
	<div class="bain-wrap">
		<h1 class="hero__headline" id="hero-headline">
			<?php
			/*
			 * One .hero__line per line rather than letting the headline wrap:
			 * slots size to their visible text, so a wrapping headline would
			 * rewrap on every keystroke of the typing animation.
			 *
			 * The tint is a single background on .hero__lines at a fixed width,
			 * so it holds still while the animation empties and refills a slot.
			 * A line still soft-wraps inside the pane if it cannot fit, so
			 * narrow screens degrade instead of overflowing.
			 *
			 * .hero__ws holds a real space, drawn as a dot by theme.css. The
			 * space is kept in the markup rather than swapped for a "·" so the
			 * heading still reads and copies as words separated by spaces.
			 *
			 * No incidental whitespace inside a .hero__line: it would collapse
			 * into a rendered space and throw the character grid out.
			 */
			?>
			<span class="hero__lines">
				<span class="hero__line"><span class="hero__slot" id="slot-0"><span id="slot-0-text">Friendly</span></span></span>
				<span class="hero__line"><span class="hero__connector">websites</span><span class="hero__ws"> </span><span class="hero__connector">for</span><span class="hero__ws"> </span><span class="hero__slot" id="slot-1"><span id="slot-1-text">interesting</span></span></span>
				<span class="hero__line"><span class="hero__slot" id="slot-2"><span id="slot-2-text">people</span></span></span>
			</span>
			<span class="hero__caret" id="hero-caret" aria-hidden="true"></span>
		</h1>

		<p class="hero__sub">
			I design &amp; build <strong>bespoke websites</strong> for
			<strong>individuals</strong>, <strong>small businesses</strong> &amp;
			<strong>start-ups</strong>.
		</p>

		<div class="hero__actions">
			<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="bain-btn">Arrange a chat now</a>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'bd324_projects' ) ); ?>" class="bain-btn bain-btn--ghost">Check out my work →</a>
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

		<?php
		$fp_services = get_posts( array(
			'post_type'      => 'bd324_services',
			'post_status'    => 'publish',
			'post_parent'    => 0,
			'posts_per_page' => -1,
			'orderby'        => 'menu_order',
			'order'          => 'ASC',
		) );
		?>
		<div class="services-panel">
			<div class="services-list" role="list">
				<?php foreach ( $fp_services as $i => $svc ) :
					$svc_note = $svc->post_excerpt ?: wp_trim_words( strip_tags( $svc->post_content ), 20 );
				?>
				<a class="services-list__item" href="<?php echo esc_url( get_permalink( $svc ) ); ?>" role="listitem">
					<span class="services-list__num" aria-hidden="true"><?php echo sprintf( '%02d', $i + 1 ); ?></span>
					<span class="services-list__name"><?php echo esc_html( $svc->post_title ); ?></span>
					<?php if ( $svc_note ) : ?>
					<span class="services-list__note"><?php echo esc_html( $svc_note ); ?></span>
					<?php endif; ?>
				</a>
				<?php endforeach; ?>
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
			<a href="<?php echo esc_url( get_post_type_archive_link( 'bd324_projects' ) ); ?>" class="bain-btn bain-btn--ghost bain-btn--sm">
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
			<?php while ( $fp_projects->have_posts() ) : $fp_projects->the_post(); ?>
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

		<div class="about-section__portrait">
			<?php $fp_portrait_id = get_post_thumbnail_id( 69 ) ?: 1954; ?>
			<div class="about-letter__portrait" data-tip="by J. Vidal · 2024">
				<span class="about-letter__portrait-tick about-letter__portrait-tick--tl" aria-hidden="true">┌</span>
				<span class="about-letter__portrait-tick about-letter__portrait-tick--tr" aria-hidden="true">┐</span>
				<span class="about-letter__portrait-tick about-letter__portrait-tick--bl" aria-hidden="true">└</span>
				<span class="about-letter__portrait-tick about-letter__portrait-tick--br" aria-hidden="true">┘</span>
				<div class="about-letter__portrait-clip">
					<?php echo wp_get_attachment_image( $fp_portrait_id, 'large', false, array(
						'class' => 'about-letter__portrait-img',
						'alt'   => 'Mark Crawford Bain',
					) ); ?>
				</div>
			</div>
		</div>

		<div class="about-section__text">
			<?php bain_meta_bracket( 'about' ); ?>
			<h2 class="about-section__name" id="about-heading">Mark Crawford Bain</h2>
			<?php bain_meta_bracket( 'WordPress Designer & Developer', array( 'tag' => 'p' ) ); ?>
			<p class="about-section__intro">
				14+ years building bespoke WordPress sites from inception to execution. Based near Barcelona, working with clients worldwide.
			</p>
			<ul class="bain-check">
				<li>Dedicated and creative &mdash; every site is coded from scratch. <span class="tip-q" data-tip="no Wix/Squarespace/Webflow">?</span></li>
				<li>Proficient in wireframing, designing responsive layouts, and coding bespoke themes &amp; plugins. <span class="tip-q" data-tip="full-stack, mostly">?</span></li>
				<li>Two open-source plugins published on <a href="https://profiles.wordpress.org/markcbain/" target="_blank" rel="noopener noreferrer">WordPress.org</a>. <span class="tip-q" data-tip="free as in beer">?</span></li>
				<li>Committed to delivering technical solutions that align with clients&#8217; business objectives. <span class="tip-q" data-tip="translation: I read your brief">?</span></li>
			</ul>
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
		<a href="<?php echo antispambot( 'mailto:hello@bain.design' ); ?>" class="contact-section__email" id="contact-email"
			   data-tip="click to copy + open">
			<?php echo antispambot( 'hello@bain.design' ); ?> →
		</a>
	</div>
</section>

<?php get_footer(); ?>
