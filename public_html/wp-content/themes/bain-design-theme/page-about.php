<?php
/**
 * About page template — page-about.php
 * Matches AboutPage.jsx: hero → bio/letter → principles → timeline → tools → off-clock → CTA.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$portrait_id = 1954;

$bio = array(
	"I grew up taking radios apart and putting them back together, with the predictable variation in success. I started building websites for friends at university — a magazine, then a bicycle shop, then a small press — and at some point in 2012 stopped pretending it was a side project.",
	"What I sell now is the same thing I sold then, only better-rehearsed. I read your brief carefully. I write a small, well-organised codebase to deliver it. I hand it over with documentation you'll actually open. And I am still here, on the other end of the email, two years later when you want to add a newsletter form.",
	"I work from a small studio overlooking a quiet street in Sant Cugat. I take on between six and ten engagements a year. I do not have a sales team or a project manager or a JIRA instance — I have a notebook, a calendar, and the kind of clients who came back because they liked the first time.",
);

$principles = array(
	array( 'title' => 'Bespoke, not boilerplate',        'body' => 'I write the theme. I write the plugin. I write the docs. Every site is coded from scratch against your actual needs, not bolted together from a marketplace.' ),
	array( 'title' => 'Plain code, plain English',        'body' => 'If I can\'t explain a technical decision in two sentences to a non-technical client, the decision is probably wrong. Same goes for the codebase your next developer will inherit.' ),
	array( 'title' => 'Editorial flow first',             'body' => 'The CMS your editors use every Tuesday matters more than the homepage your competitors look at once. I design the back end with the same care as the front.' ),
	array( 'title' => 'Small, well-scoped engagements',   'body' => 'I\'d rather ship a good 12-week build than a mediocre 12-month one. If your brief needs a team, I\'ll happily refer you to one.' ),
	array( 'title' => 'Around afterwards',                'body' => 'A care plan, a sensible email reply window, and version-tagged plugins so upgrades don\'t surprise you. The work isn\'t over at launch.' ),
);

$timeline = array(
	array( 'year' => '2012', 'body' => 'Went full-time freelance after two years moonlighting. First clients: a small press, a magazine, a bicycle shop. All three are still on bain.design servers.' ),
	array( 'year' => '2014', 'body' => 'Moved from Edinburgh to Barcelona. First non-UK client (Catalan bookshop chain). Started writing the editorial-flow plugin that would, six years later, become Plain Sitemap.' ),
	array( 'year' => '2017', 'body' => 'Released Plain Sitemap on WordPress.org. 28,000 active installs at last count. No upsells, no admin UI, no newsletter modal.' ),
	array( 'year' => '2019', 'body' => 'Released Slow Comments — a Disqus-replacement plugin built for two specific clients, then open-sourced. 4,000 installs and a small, polite Discord.' ),
	array( 'year' => '2021', 'body' => 'Hired (briefly) by Noon Health as part-time staff. Returned to freelancing after six months — same clients, slightly better office chair.' ),
	array( 'year' => '2024', 'body' => 'Khyentse Foundation grants platform shipped in five months. Most complex single engagement to date. Worth a tea sometime if you want the war stories.' ),
	array( 'year' => '2026', 'body' => 'Currently taking two more projects for the year. If you are reading this in 2027, that probably also applies, but ask.' ),
);

$tools = array(
	array( 'group' => 'CMS / Back-end',  'items' => array( 'WordPress 6.x', 'PHP 8.2', 'ACF Pro', 'WP-CLI', 'Composer' ) ),
	array( 'group' => 'Front-end',       'items' => array( 'HTML / CSS', 'Vanilla JS', 'Alpine.js (rarely)', 'No build step where possible', 'Vite when not' ) ),
	array( 'group' => 'Editorial',       'items' => array( 'Bespoke custom post types', 'Block patterns', 'No page builders', 'Editorial workflows in plain PHP' ) ),
	array( 'group' => 'Studio kit',      'items' => array( 'MacBook Pro 14"', 'A Field Notes pocket notebook', 'iA Writer for drafts', 'Tot for daily plan', 'Mechanical pencil — Pentel P205' ) ),
);

$off_clock = array(
	array( 'label' => 'In the kitchen', 'text' => 'Slow-cooking, mostly North African and Catalan. Best loaf so far: a 36-hour sourdough. Worst: an attempt at canelones de marisco that the cat then ate.' ),
	array( 'label' => 'In the water',   'text' => 'Open-water swimming year-round at Caldes d\'Estrac. Two friends, a thermos, twenty minutes in November.' ),
	array( 'label' => 'In the shelves', 'text' => 'Reading whatever Mhairi McFarlane is currently writing, plus too many Penguin classics with broken spines.' ),
	array( 'label' => 'On a bike',      'text' => 'A 1996 Peugeot frame I keep meaning to repaint. The brakes work.' ),
);
?>

<!-- ================================================================= HERO -->
<section class="about-hero">
	<div class="bain-wrap about-hero__grid">

		<div class="about-hero__ab" aria-hidden="true">AB</div>

		<div class="about-hero__body">
			<?php bain_meta_bracket( 'WordPress Designer &amp; Developer / since 2012 / freelance' ); ?>
			<h1 class="about-hero__name">Mark Crawford Bain<span class="about-hero__dot" aria-hidden="true">.</span></h1>
			<p class="about-hero__lead">I design &amp; build bespoke WordPress sites for individuals, small businesses &amp; start-ups. No page builders, no parent themes, no nonsense. One developer, one designer — same person, same head — from inception to launch and onwards.</p>
		</div>

		<dl class="about-hero__meta">
			<div class="about-hero__meta-row"><dt>Where</dt><dd>Sant Cugat, near Barcelona</dd></div>
			<div class="about-hero__meta-row"><dt>Pronouns</dt><dd>he / him</dd></div>
			<div class="about-hero__meta-row"><dt>Email</dt><dd><a href="mailto:mark@bain.design">mark@bain.design ↗</a></dd></div>
			<div class="about-hero__meta-row"><dt>Since</dt><dd>2012</dd></div>
			<div class="about-hero__meta-row"><dt>Status</dt><dd>Booking 2026</dd></div>
		</dl>

	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ============================================================= BIO / LETTER -->
<section class="about-letter">
	<div class="bain-wrap about-letter__grid">

		<div class="about-letter__portrait-col">
			<div class="about-letter__portrait" data-tip="by J. Vidal · 2024">
				<span class="about-letter__portrait-tick about-letter__portrait-tick--tl" aria-hidden="true">┌</span>
				<span class="about-letter__portrait-tick about-letter__portrait-tick--tr" aria-hidden="true">┐</span>
				<span class="about-letter__portrait-tick about-letter__portrait-tick--bl" aria-hidden="true">└</span>
				<span class="about-letter__portrait-tick about-letter__portrait-tick--br" aria-hidden="true">┘</span>
				<?php echo wp_get_attachment_image( $portrait_id, 'large', false, array(
					'class' => 'about-letter__portrait-img',
					'alt'   => 'Mark Crawford Bain',
				) ); ?>
			</div>
			<div class="about-letter__caption">
				<div>[ Sant Cugat studio &middot; Tuesday morning ]</div>
				<div class="about-letter__caption-sub">photo &middot; J. Vidal &middot; 2024</div>
			</div>
		</div>

		<div class="about-letter__text">
			<?php bain_meta_bracket( 'a short letter' ); ?>
			<div class="about-letter__paras">
				<?php foreach ( $bio as $i => $para ) : ?>
				<p class="about-letter__p<?php echo $i === 0 ? ' about-letter__p--first' : ''; ?>">
					<?php if ( $i === 0 ) : ?>
						<span class="about-letter__dropcap" aria-hidden="true"><?php echo esc_html( $para[0] ); ?></span><?php echo esc_html( substr( $para, 1 ) ); ?>
					<?php else : ?>
						<?php echo esc_html( $para ); ?>
					<?php endif; ?>
				</p>
				<?php endforeach; ?>
				<div class="about-letter__sign">&mdash; Mark <span class="about-letter__sign-loc"> / Sant Cugat</span></div>
			</div>
		</div>

	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- =========================================================== PRINCIPLES -->
<section class="about-principles">
	<div class="bain-wrap about-principles__grid">

		<div class="about-principles__aside">
			<?php bain_meta_bracket( '01' ); ?>
			<h2 class="about-principles__heading">How I think about the work</h2>
			<p class="about-principles__sub">Five rules that have not changed since 2012. Two of them I'd defend in court.</p>
		</div>

		<ol class="about-principles__list">
			<?php foreach ( $principles as $i => $p ) : ?>
			<li class="about-principles__item<?php echo $i === 0 ? ' about-principles__item--first' : ''; ?>">
				<span class="about-principles__check" aria-hidden="true">&#10004;</span>
				<div>
					<h3 class="about-principles__title"><?php echo esc_html( $p['title'] ); ?><span class="about-principles__dot" aria-hidden="true">.</span></h3>
					<p class="about-principles__body"><?php echo esc_html( $p['body'] ); ?></p>
				</div>
			</li>
			<?php endforeach; ?>
		</ol>

	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ============================================================== TIMELINE -->
<section class="about-timeline">
	<div class="bain-wrap about-timeline__grid">

		<div class="about-timeline__aside">
			<?php bain_meta_bracket( '02' ); ?>
			<h2 class="about-timeline__heading">What happened, in order</h2>
			<div class="about-timeline__cmd">cat ~/career.log<br><span class="about-timeline__cmd-count"><?php echo count( $timeline ); ?> entries</span></div>
		</div>

		<ol class="about-timeline__list">
			<div class="about-timeline__rule" aria-hidden="true"></div>
			<?php $last = count( $timeline ) - 1; foreach ( $timeline as $i => $t ) : ?>
			<li class="about-timeline__item">
				<div class="about-timeline__year">
					<?php echo esc_html( $t['year'] ); ?>
					<span class="about-timeline__dot<?php echo $i === $last ? ' about-timeline__dot--clay' : ''; ?>" aria-hidden="true"></span>
				</div>
				<p class="about-timeline__body"><?php echo esc_html( $t['body'] ); ?></p>
			</li>
			<?php endforeach; ?>
		</ol>

	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ================================================================= TOOLS -->
<section class="about-tools">
	<div class="bain-wrap">
		<div class="about-tools__header">
			<?php bain_meta_bracket( '03' ); ?>
			<h2 class="about-tools__heading">Tools I reach for</h2>
		</div>
		<div class="about-tools__grid">
			<?php foreach ( $tools as $i => $g ) : ?>
			<div class="about-tools__col<?php echo $i === 0 ? ' about-tools__col--first' : ''; ?>">
				<div class="about-tools__group-label"><?php echo esc_html( $g['group'] ); ?></div>
				<ul class="about-tools__items">
					<?php foreach ( $g['items'] as $item ) : ?>
					<li class="about-tools__item"><span aria-hidden="true">&middot;</span> <?php echo esc_html( $item ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php bain_ascii_rule(); ?>

<!-- ============================================================ OFF THE CLOCK -->
<section class="about-offclock">
	<div class="bain-wrap about-offclock__grid">

		<div class="about-offclock__aside">
			<?php bain_meta_bracket( '04' ); ?>
			<h2 class="about-offclock__heading">Off the clock<span class="about-offclock__dot" aria-hidden="true">.</span></h2>
			<p class="about-offclock__sub">Not really part of a portfolio. Included anyway, because clients keep asking and the swimming is genuinely a selling point.</p>
		</div>

		<ul class="about-offclock__list">
			<?php foreach ( $off_clock as $i => $row ) : ?>
			<li class="about-offclock__item<?php echo $i === count( $off_clock ) - 1 ? ' about-offclock__item--last' : ''; ?>">
				<div class="about-offclock__label"><?php echo esc_html( $row['label'] ); ?></div>
				<p class="about-offclock__text"><?php echo esc_html( $row['text'] ); ?></p>
			</li>
			<?php endforeach; ?>
		</ul>

	</div>
</section>

<!-- ================================================================== CTA -->
<section class="about-cta">
	<div class="bain-wrap">
		<div class="about-cta__band">
			<div class="about-cta__copy">
				<?php bain_meta_bracket( 'next', array( 'tag' => 'div' ) ); ?>
				<h3 class="about-cta__heading">Still reading? Let's start with an email<span class="about-cta__dot">.</span></h3>
				<p class="about-cta__sub">I read every one. Usually reply within a working day, or the next morning if you wrote at midnight in another timezone.</p>
			</div>
			<a class="about-cta__email" href="mailto:mark@bain.design">
				mark@bain.design <span aria-hidden="true">&rarr;</span>
			</a>
		</div>
	</div>
</section>

<?php get_footer();
