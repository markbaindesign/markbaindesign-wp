<?php
/**
 * Template Name: Style Guide
 * Description: Living reference for the design system — tokens, type, components.
 *
 * Specimens are rendered from the real tokens and the real component classes,
 * never from copied values, so this page cannot drift from tokens.css. Swatch
 * and scale readouts are filled in at runtime by initStyleguide() in main.js.
 *
 * Binds automatically to a page with the slug "styleguide", and is also
 * selectable as a page template.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

/* Token groups — names only. Values are read from the cascade at runtime. */
$sg_colours = array(
	'Surfaces'   => array( '--paper', '--paper-deep', '--paper-pure', '--hover-bg' ),
	'Ink'        => array( '--ink', '--graphite', '--pencil', '--rule', '--rule-soft' ),
	'Accent'     => array( '--clay', '--clay-deep', '--clay-soft' ),
	'Link'       => array( '--link', '--link-hover', '--visited' ),
	'Status'     => array( '--phosphor', '--amber', '--vermilion' ),
);

$sg_type_scale = array(
	'--type-12', '--type-13', '--type-14', '--type-16', '--type-18', '--type-20',
	'--type-24', '--type-32', '--type-44', '--type-64', '--type-96',
);

$sg_headings = array(
	'h1' => '--type-64',
	'h2' => '--type-44',
	'h3' => '--type-32',
	'h4' => '--type-24',
	'h5' => '--type-20',
	'h6' => '--type-16',
);

$sg_space = array(
	'--space-1', '--space-2', '--space-3', '--space-4', '--space-5',
	'--space-6', '--space-7', '--space-8', '--space-9', '--space-10',
);

$sg_leading  = array( '--leading-tight', '--leading-snug', '--leading-normal', '--leading-loose' );
$sg_tracking = array( '--tracking-tight', '--tracking-normal', '--tracking-wide' );
$sg_motion   = array( '--dur-1', '--dur-2', '--dur-3' );
?>

<!-- ================================================================ HEADER -->
<section class="hero" aria-label="<?php esc_attr_e( 'Style guide', 'bain-design-theme' ); ?>">
	<div class="bain-wrap">
		<?php bain_meta_bracket( 'Design system' ); ?>
		<h1 class="sg-title"><?php the_title(); ?></h1>
		<p class="sg-lead">
			Every specimen below is rendered with the real tokens and the real
			component classes. If it looks wrong here, it is wrong on the site.
		</p>
		<nav class="sg-toc" aria-label="<?php esc_attr_e( 'Sections', 'bain-design-theme' ); ?>">
			<a href="#sg-colour">01 / Colour</a>
			<a href="#sg-type">02 / Type</a>
			<a href="#sg-space">03 / Space</a>
			<a href="#sg-components">04 / Components</a>
			<a href="#sg-forms">05 / Forms</a>
			<a href="#sg-motion">06 / Motion</a>
		</nav>
	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ================================================================ COLOUR -->
<section class="bain-section" id="sg-colour" aria-labelledby="sg-colour-heading">
	<div class="bain-section__inner">
		<header class="section-header">
			<h2 class="section-header__title" id="sg-colour-heading">
				<span class="section-number" aria-hidden="true">01 /</span>Colour
			</h2>
		</header>

		<p class="sg-note">
			Reach for the semantic aliases (<code>--fg-1</code>, <code>--bg-1</code>,
			<code>--border-1</code>) in component CSS where you can. Clay is a brand
			mark, never a navigation cue — links stay blue.
		</p>

		<?php foreach ( $sg_colours as $group => $tokens ) : ?>
			<h3 class="sg-subhead"><?php echo esc_html( $group ); ?></h3>
			<ul class="sg-swatches" role="list">
				<?php foreach ( $tokens as $token ) : ?>
					<li class="sg-swatch">
						<span class="sg-swatch__chip" style="background: var(<?php echo esc_attr( $token ); ?>);" aria-hidden="true"></span>
						<code class="sg-swatch__name"><?php echo esc_html( $token ); ?></code>
						<span class="sg-swatch__value" data-sg-token="<?php echo esc_attr( $token ); ?>"></span>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endforeach; ?>
	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ================================================================== TYPE -->
<section class="bain-section" id="sg-type" aria-labelledby="sg-type-heading">
	<div class="bain-section__inner">
		<header class="section-header">
			<h2 class="section-header__title" id="sg-type-heading">
				<span class="section-number" aria-hidden="true">02 /</span>Type
			</h2>
		</header>

		<h3 class="sg-subhead">Families</h3>
		<ul class="sg-specimens" role="list">
			<li class="sg-specimen">
				<span class="sg-specimen__label"><code>--font-mono</code> · JetBrains Mono</span>
				<span class="sg-specimen__sample" style="font-family: var(--font-mono);">Bespoke websites for interesting people 0123</span>
			</li>
			<li class="sg-specimen">
				<span class="sg-specimen__label"><code>--font-mono-2</code> · IBM Plex Mono</span>
				<span class="sg-specimen__sample" style="font-family: var(--font-mono-2);">Bespoke websites for interesting people 0123</span>
			</li>
			<li class="sg-specimen">
				<span class="sg-specimen__label"><code>--font-serif</code> · Source Serif 4</span>
				<span class="sg-specimen__sample" style="font-family: var(--font-serif);">Bespoke websites for interesting people 0123</span>
			</li>
		</ul>

		<h3 class="sg-subhead">Scale</h3>
		<ul class="sg-specimens" role="list">
			<?php foreach ( $sg_type_scale as $token ) : ?>
				<li class="sg-specimen">
					<span class="sg-specimen__label">
						<code><?php echo esc_html( $token ); ?></code>
						<span class="sg-specimen__value" data-sg-token="<?php echo esc_attr( $token ); ?>"></span>
					</span>
					<span class="sg-specimen__sample sg-specimen__sample--clip"
						style="font-size: var(<?php echo esc_attr( $token ); ?>);" aria-hidden="true">Aa Bespoke websites</span>
				</li>
			<?php endforeach; ?>
		</ul>

		<h3 class="sg-subhead">Headings</h3>
		<p class="sg-note">
			Headings are left-aligned, never centred, never all-caps. Specimens are
			marked decorative so the page keeps a sane heading outline.
		</p>
		<ul class="sg-specimens" role="list">
			<?php foreach ( $sg_headings as $tag => $token ) : ?>
				<li class="sg-specimen">
					<span class="sg-specimen__label">
						<code><?php echo esc_html( $tag ); ?></code>
						<span class="sg-specimen__value" data-sg-computed="<?php echo esc_attr( $tag ); ?>"></span>
					</span>
					<<?php echo esc_html( $tag ); ?> class="sg-specimen__sample" aria-hidden="true">Aa Bespoke websites</<?php echo esc_html( $tag ); ?>>
				</li>
			<?php endforeach; ?>
		</ul>

		<h3 class="sg-subhead">Leading &amp; tracking</h3>
		<ul class="sg-specimens" role="list">
			<?php foreach ( $sg_leading as $token ) : ?>
				<li class="sg-specimen">
					<span class="sg-specimen__label">
						<code><?php echo esc_html( $token ); ?></code>
						<span class="sg-specimen__value" data-sg-token="<?php echo esc_attr( $token ); ?>"></span>
					</span>
					<span class="sg-specimen__sample sg-specimen__sample--para"
						style="line-height: var(<?php echo esc_attr( $token ); ?>);">
						I design &amp; build bespoke WordPress sites from inception to
						execution. No page builders, no parent themes, no nonsense.
					</span>
				</li>
			<?php endforeach; ?>
			<?php foreach ( $sg_tracking as $token ) : ?>
				<li class="sg-specimen">
					<span class="sg-specimen__label">
						<code><?php echo esc_html( $token ); ?></code>
						<span class="sg-specimen__value" data-sg-token="<?php echo esc_attr( $token ); ?>"></span>
					</span>
					<span class="sg-specimen__sample"
						style="letter-spacing: var(<?php echo esc_attr( $token ); ?>);">Bespoke websites</span>
				</li>
			<?php endforeach; ?>
		</ul>

		<h3 class="sg-subhead">Inline elements</h3>
		<div class="sg-prose">
			<p>
				Body copy sits at <code>--type-16</code> with <code>--leading-loose</code>.
				A <a href="#sg-type">link looks like this</a>, a visited one shades
				purple, and <code>inline code</code> gets a hairline box.
				<strong>Strong</strong> and <em>emphasis</em> both hold their weight.
			</p>
			<pre><code>function bain_meta_bracket( $text, $args = array() ) {
	// Square brackets are added by CSS, never by the caller.
}</code></pre>
			<p class="meta-bracket">meta-bracket — brackets come from CSS</p>
			<p class="bain-signoff">Sign-off <span class="heart">&hearts;</span></p>
			<p>Terminal cursor<?php bain_cursor(); ?></p>
		</div>
	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ================================================================= SPACE -->
<section class="bain-section" id="sg-space" aria-labelledby="sg-space-heading">
	<div class="bain-section__inner">
		<header class="section-header">
			<h2 class="section-header__title" id="sg-space-heading">
				<span class="section-number" aria-hidden="true">03 /</span>Space
			</h2>
		</header>

		<p class="sg-note">A 4px base grid. Corners are square everywhere — <code>--radius</code> is 0 and load-bearing.</p>

		<ul class="sg-scale" role="list">
			<?php foreach ( $sg_space as $token ) : ?>
				<li class="sg-scale__row">
					<code class="sg-scale__name"><?php echo esc_html( $token ); ?></code>
					<span class="sg-scale__value" data-sg-token="<?php echo esc_attr( $token ); ?>"></span>
					<span class="sg-scale__bar" style="width: var(<?php echo esc_attr( $token ); ?>);" aria-hidden="true"></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ============================================================ COMPONENTS -->
<section class="bain-section" id="sg-components" aria-labelledby="sg-components-heading">
	<div class="bain-section__inner">
		<header class="section-header">
			<h2 class="section-header__title" id="sg-components-heading">
				<span class="section-number" aria-hidden="true">04 /</span>Components
			</h2>
		</header>

		<h3 class="sg-subhead">Buttons</h3>
		<p class="sg-note">
			Rendered by <code>bain_button( $label, $url, $args )</code> — the
			only button that should be reached for. <code>.bain-btn</code> is
			always present; the variant is an additional modifier class, chosen
			with <code>$args['variant']</code>. Hover for the 2px hard-offset
			press shadow.
		</p>

		<ul class="sg-specimens" role="list">

			<li class="sg-specimen">
				<span class="sg-specimen__label">
					Fill dark <em>(default)</em><br>
					<code>.bain-btn</code>
					<span class="sg-specimen__value">variant omitted, or 'primary'</span>
				</span>
				<span class="sg-specimen__sample">
					<?php bain_button( 'Arrange a chat now', '#sg-components' ); ?>
				</span>
			</li>

			<li class="sg-specimen">
				<span class="sg-specimen__label">
					Outline<br>
					<code>.bain-btn.bain-btn--ghost</code>
					<span class="sg-specimen__value">variant: 'ghost'</span>
				</span>
				<span class="sg-specimen__sample">
					<?php bain_button( 'Check out my work', '#sg-components', array( 'variant' => 'ghost' ) ); ?>
				</span>
			</li>

			<li class="sg-specimen">
				<span class="sg-specimen__label">
					Fill terracotta<br>
					<code>.bain-btn.bain-btn--terracotta</code>
					<span class="sg-specimen__value">variant: 'terracotta'</span>
				</span>
				<span class="sg-specimen__sample">
					<?php bain_button( 'Send a brief', '#sg-components', array( 'variant' => 'terracotta' ) ); ?>
				</span>
			</li>

			<li class="sg-specimen">
				<span class="sg-specimen__label">
					External link modifier<br>
					<code>.bain-btn.bain-btn--ghost</code>
					<span class="sg-specimen__value">any variant + external: true — adds target="_blank", rel, and the ↗ arrow</span>
				</span>
				<span class="sg-specimen__sample">
					<?php bain_button( 'View on GitHub', 'https://github.com/markbaindesign', array( 'variant' => 'ghost', 'external' => true ) ); ?>
				</span>
			</li>

		</ul>

		<p class="sg-note">
			Outline's hover shadow is clay, not ink — an ink shadow behind an
			ink-filled hover state has no visible edge, the same defect fixed
			on the dark related-project card on single project pages. Fill
			terracotta's text is ink rather than paper: clay against paper
			text measures 2.95:1, below WCAG AA's 4.5:1 for normal text;
			against ink it is 4.72:1.
		</p>

		<?php
		/*
		 * This section used to list six independent button implementations.
		 * Four have since been migrated onto bain_button() and their CSS
		 * deleted: .nw-archive-cta__btn, .nw-pullquote__btn / --primary
		 * (archive-bd324_testimonials.php, single-bd324_testimonials.php),
		 * and the CF7 submit tag (class:bain-btn in the "Bain Contact" form's
		 * _form field — a Contact Form 7 tag option, not a template edit).
		 * .contact-form-field__btn was dead code with zero references and
		 * was deleted outright rather than migrated.
		 *
		 * What is left below is deliberately NOT bain_button(): different UI
		 * semantics, not overlooked drift.
		 */
		?>
		<div class="sg-callout">
			Down from six independent implementations to two, both kept apart
			from <code>.bain-btn</code> on purpose rather than by omission —
			see each specimen's label. Both now carry the same
			<code>:focus-visible</code> ring <code>.bain-btn</code> has, which
			neither had before: <code>a:focus-visible</code> is set sitewide,
			but nothing covered plain <code>&lt;button&gt;</code> elements.
		</div>

		<h3 class="sg-subhead">Buttons deliberately not built on .bain-btn</h3>
		<ul class="sg-specimens" role="list">

			<li class="sg-specimen">
				<span class="sg-specimen__label">
					<code>.tools-filter-pill</code>
					<span class="sg-specimen__value">archive-bd324_tools.php — a multi-select filter toggle with an is-active state, not a link; bain_button() only renders &lt;a href&gt;</span>
				</span>
				<span class="sg-specimen__sample">
					<button type="button" class="tools-filter-pill is-active">All</button>
					<button type="button" class="tools-filter-pill">Design</button>
				</span>
			</li>

			<li class="sg-specimen">
				<span class="sg-specimen__label">
					<code>.bain-project__stack-pill</code>
					<span class="sg-specimen__value">single-bd324_projects.php — a tag, not a button (no cursor: pointer); listed for contrast</span>
				</span>
				<span class="sg-specimen__sample">
					<ul class="bain-project__stack-list" style="display:flex;list-style:none;padding:0;margin:0;">
						<li class="bain-project__stack-pill"><a href="#sg-components">WordPress</a></li>
					</ul>
				</span>
			</li>

		</ul>

		<h3 class="sg-subhead">Cards</h3>
		<div class="sg-cluster sg-cluster--cards">
			<div class="bain-card">
				<?php bain_meta_bracket( '2026 / Frontend' ); ?>
				<h4 class="sg-card__title">Card</h4>
				<p>Hairline border that thickens to 2px on hover, with the padding compensating so the contents never reflow.</p>
			</div>
			<div class="bain-card bain-press">
				<?php bain_meta_bracket( 'utility' ); ?>
				<h4 class="sg-card__title">bain-press</h4>
				<p>Same card with the press-shadow utility applied.</p>
			</div>
		</div>

		<h3 class="sg-subhead">Contact channel cards</h3>
		<p class="sg-note">
			<code>.contact-channel-card</code>, page-contact.php — two tones,
			<code>--paper</code> (default) and <code>--ink</code>. The ink tone's
			eyebrow and CTA link were both fixed 2026-07-30: the eyebrow used
			<code>.meta-bracket</code>'s default graphite, sized for a light
			card, which read as near-invisible on this dark one; the CTA was a
			plain unclassed link, so its hover colour
			(<code>--link-hover</code>, #0E0E0E) was functionally identical to
			the card's own <code>--ink</code> background and vanished on
			pointer-over. Both now use <code>--clay-soft</code> /
			<code>--clay</code>, matching the address link already on this
			tone, and the focus ring is overridden to match — the generic
			<code>a:focus-visible</code> outline is also ink-on-ink here.
		</p>
		<div class="sg-cluster sg-cluster--cards">
			<article class="contact-channel-card contact-channel-card--ink">
				<div class="contact-channel-card__header">
					<?php bain_meta_bracket( 'Primary', array( 'tag' => 'div' ) ); ?>
				</div>
				<h3 class="contact-channel-card__title">Email<span class="contact-channel-card__dot">.</span></h3>
				<a class="contact-channel-card__addr contact-channel-card__addr--link" href="#sg-components">hello@bain.design</a>
				<p class="contact-channel-card__desc">The most reliable way to reach me. I read everything, I reply within a working day or two.</p>
				<div class="contact-channel-card__cta">
					<a href="#sg-components">Compose →</a>
				</div>
			</article>
			<article class="contact-channel-card contact-channel-card--paper">
				<div class="contact-channel-card__header">
					<?php bain_meta_bracket( 'Engineering', array( 'tag' => 'div' ) ); ?>
				</div>
				<h3 class="contact-channel-card__title">GitHub<span class="contact-channel-card__dot">.</span></h3>
				<a class="contact-channel-card__addr contact-channel-card__addr--link" href="#sg-components">github.com/markbaindesign</a>
				<p class="contact-channel-card__desc">Open-source plugins, theme experiments, code review. Drop an issue if you found a bug.</p>
				<div class="contact-channel-card__cta">
					<a href="#sg-components">Browse repos ↗</a>
				</div>
			</article>
		</div>

		<h3 class="sg-subhead">Checked list</h3>
		<?php
		bain_check_list( array(
			'Every site is coded from scratch.',
			'Wireframes, responsive layouts, bespoke themes &amp; plugins.',
			'Rendered by <code>bain_check_list()</code>.',
		) );
		?>

		<h3 class="sg-subhead">Rules</h3>
		<p class="sg-note"><code>hr</code>, then <code>.bain-rule-double</code>, then <code>bain_ascii_rule()</code>.</p>
		<hr>
		<hr class="bain-rule-double">
		<?php bain_ascii_rule(); ?>
	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ================================================================= FORMS -->
<section class="bain-section" id="sg-forms" aria-labelledby="sg-forms-heading">
	<div class="bain-section__inner">
		<header class="section-header">
			<h2 class="section-header__title" id="sg-forms-heading">
				<span class="section-number" aria-hidden="true">05 /</span>Forms
			</h2>
		</header>

		<div class="sg-form">
			<p>
				<label for="sg-name">Name</label>
				<input type="text" id="sg-name" placeholder="Ada Lovelace">
			</p>
			<p>
				<label for="sg-email">Email</label>
				<input type="email" id="sg-email" placeholder="ada@example.com">
			</p>
			<p>
				<label for="sg-budget">Budget</label>
				<select id="sg-budget">
					<option>Not sure yet</option>
					<option>Under £5k</option>
					<option>£5k–£15k</option>
				</select>
			</p>
			<p>
				<label for="sg-msg">Message</label>
				<textarea id="sg-msg" rows="4" placeholder="What are you building?"></textarea>
			</p>
		</div>
	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ================================================================ MOTION -->
<section class="bain-section" id="sg-motion" aria-labelledby="sg-motion-heading">
	<div class="bain-section__inner">
		<header class="section-header">
			<h2 class="section-header__title" id="sg-motion-heading">
				<span class="section-number" aria-hidden="true">06 /</span>Motion
			</h2>
		</header>

		<p class="sg-note">
			One easing curve, <code>--ease-1</code>, and three durations. Hover a tile
			to run it.
		</p>

		<ul class="sg-cluster" role="list">
			<?php foreach ( $sg_motion as $token ) : ?>
				<li class="sg-motion" style="transition-duration: var(<?php echo esc_attr( $token ); ?>);">
					<code><?php echo esc_html( $token ); ?></code>
					<span class="sg-specimen__value" data-sg-token="<?php echo esc_attr( $token ); ?>"></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>

<?php get_footer(); ?>
