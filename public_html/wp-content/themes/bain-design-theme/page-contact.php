<?php
/**
 * Template Name: Contact
 * Description: Contact page with channels, form, and FAQ
 *
 * Variation B: channels grid + big form + FAQ
 * Matches ContactB.jsx design
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

if ( ! have_posts() ) {
	get_footer();
	exit;
}

the_post();

$contact = array(
	'email'         => 'hello@bain.design',
	'schedule'      => 'calendly.com/bain',
	'github'        => 'github.com/markbaindesign',
	'rss'           => 'bain.design/feed',
	'location'      => 'Eixample / Gràcia',
	'responseTime'  => 'within a working day or two',
	'hours'         => '09:00–17:00 CET (weekdays)',
);

$channels = array(
	array(
		'kind'  => 'Primary',
		'title' => 'Email',
		'addr'  => $contact['email'],
		'desc'  => 'The most reliable way to reach me. I read everything, I reply within a working day or two.',
		'cta'   => 'Compose →',
		'tone'  => 'ink',
	),
	array(
		'kind'  => 'Booking',
		'title' => 'Schedule a chat',
		'addr'  => $contact['schedule'],
		'desc'  => '30 minutes, free. Useful once you\'ve got a brief shape and want to talk about scope, timing or fit.',
		'cta'   => 'Pick a slot ↗',
		'tone'  => 'paper',
	),
	array(
		'kind'  => 'Engineering',
		'title' => 'GitHub',
		'addr'  => $contact['github'],
		'desc'  => 'Open-source plugins, theme experiments, code review. Drop an issue on Plain Sitemap if you found a bug.',
		'cta'   => 'Browse repos ↗',
		'tone'  => 'paper',
	),
	array(
		'kind'  => 'Subscribe',
		'title' => 'RSS',
		'addr'  => $contact['rss'],
		'desc'  => 'I write once or twice a quarter — usually about WordPress internals, the indie web, or a tool worth knowing.',
		'cta'   => 'Subscribe ↗',
		'tone'  => 'paper',
	),
	array(
		'kind'  => 'In person',
		'title' => 'Barcelona',
		'addr'  => 'Eixample / Gràcia',
		'desc'  => 'I work from home or from Antic Forn café most mornings. Happy to meet for coffee if you\'re passing through.',
		'cta'   => 'Say hi if you\'re here',
		'tone'  => 'paper',
	),
	array(
		'kind'  => 'Hours',
		'title' => 'Office hours',
		'addr'  => $contact['hours'],
		'desc'  => 'I close my mail client outside these. If something is genuinely on fire, mark the subject [URGENT].',
		'cta'   => null,
		'tone'  => 'paper',
	),
);

$faq = array(
	array(
		'q' => 'Do you work with WordPress only?',
		'a' => 'Yes — bespoke themes and plugins, no page builders, no parent themes. If your stack is React/Next or Astro, I can recommend a couple of friends who do that well.',
	),
	array(
		'q' => 'Smallest project you\'ll take on?',
		'a' => 'A two-week scope is the floor; below that the on-ramp costs more than the work. I do free 30-minute consults if you\'re weighing it up.',
	),
	array(
		'q' => 'Do you do retainers?',
		'a' => 'Yes — typically half a day a week, for clients I\'ve already shipped a build with. Two slots open at any time.',
	),
	array(
		'q' => 'Where are you based?',
		'a' => 'Barcelona (Eixample). I work async with clients across UTC-8 to UTC+10. The overlap with US East and West coasts is the usual sticking point.',
	),
	array(
		'q' => 'Do you use AI?',
		'a' => 'For early drafting, code skeletons, and rubber-ducking — yes. For decisions, design, and final code — no. The shipped work is mine.',
	),
	array(
		'q' => 'What about page builders?',
		'a' => 'I don\'t use Elementor, Divi, WPBakery, or similar. They optimise for click-flow at the cost of performance, accessibility and maintainability. The Bain default is custom blocks or ACF.',
	),
);
?>

<!-- ================================================================= HERO -->
<section class="contact-hero">
	<div class="bain-wrap">
		<div class="contact-hero__grid">

			<?php bain_meta_bracket( 'Get in touch' ); ?>

			<h1 class="contact-hero__title">
				Lots of ways to start a conversation<span class="contact-hero__dot">.</span>
			</h1>

			<p class="contact-hero__lead">
				Pick whichever fits — but email is usually fastest, and the only one I check every morning. I reply <strong><?php echo esc_html( $contact['responseTime'] ); ?></strong>.
			</p>

		</div>
	</div>
</section>

<!-- ================================================================= CHANNELS GRID -->
<section class="contact-channels">
	<div class="bain-wrap">

		<?php bain_meta_bracket( '01', array( 'tag' => 'div' ) ); ?>
		<h2 class="contact-channels__heading">Channels</h2>

		<div class="contact-channels__grid">
			<?php foreach ( $channels as $c ) : ?>
			<article class="contact-channel-card contact-channel-card--<?php echo esc_attr( $c['tone'] ); ?>">

				<div class="contact-channel-card__header">
					<?php bain_meta_bracket( $c['kind'], array( 'tag' => 'div' ) ); ?>
				</div>

				<h3 class="contact-channel-card__title">
					<?php echo esc_html( $c['title'] ); ?><span class="contact-channel-card__dot">.</span>
				</h3>

				<div class="contact-channel-card__addr">
					<?php echo esc_html( $c['addr'] ); ?>
				</div>

				<p class="contact-channel-card__desc">
					<?php echo esc_html( $c['desc'] ); ?>
				</p>

				<?php if ( $c['cta'] ) : ?>
				<div class="contact-channel-card__cta">
					<?php echo esc_html( $c['cta'] ); ?>
				</div>
				<?php endif; ?>

			</article>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<!-- ================================================================= FORM SECTION -->
<section class="contact-form-section">
	<div class="bain-wrap">

		<div class="contact-form-section__grid">

			<div class="contact-form-section__left">
				<?php bain_meta_bracket( '02', array( 'tag' => 'div' ) ); ?>
				<h2 class="contact-form-section__heading">Send a brief</h2>
				<p class="contact-form-section__copy">
					Faster than an open-ended "let's chat" email — fill this in once and we'll get to scope in the first reply.
				</p>
				<ul class="contact-form-section__benefits">
					<li>No newsletter sign-up.</li>
					<li>Goes straight to my inbox.</li>
					<li>I delete it after we close out.</li>
				</ul>
			</div>

			<div class="contact-form-section__form">
				<?php echo do_shortcode( '[contact-form-7 id="1963" title="Bain Contact"]' ); ?>

				<div class="contact-form-section__form-footer">
					<span class="contact-form-section__form-note">
						No analytics, no Mailchimp, no 'we'll be in touch'.
					</span>
				</div>
			</div>

		</div>

	</div>
</section>

<!-- ================================================================= FAQ -->
<section class="contact-faq">
	<div class="bain-wrap">

		<?php bain_meta_bracket( '03', array( 'tag' => 'div' ) ); ?>
		<h2 class="contact-faq__heading">Common questions</h2>

		<div class="contact-faq__grid">
			<?php foreach ( $faq as $item ) : ?>
			<details class="contact-faq__item" open>
				<summary class="contact-faq__summary">
					<span class="contact-faq__mark" aria-hidden="true">?</span>
					<?php echo esc_html( $item['q'] ); ?>
				</summary>
				<p class="contact-faq__answer">
					<?php echo esc_html( $item['a'] ); ?>
				</p>
			</details>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<?php get_footer();
