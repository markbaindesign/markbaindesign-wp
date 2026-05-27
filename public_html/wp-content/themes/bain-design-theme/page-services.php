<?php
/**
 * Services page template — page-services.php
 * Matches Services.jsx: 4-column row list with hover quirks.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$services = array(
	array(
		'num'   => '01',
		'name'  => 'Themes',
		'stamp' => 'no bloat ✦',
		'desc'  => 'Bespoke WordPress themes, coded from scratch. No page builders, no bloat.',
		'url'   => '/work/wordpress-themes-development/',
	),
	array(
		'num'   => '02',
		'name'  => 'Plugins',
		'stamp' => 'two on .org ✦',
		'desc'  => 'Custom functionality, two open-source plugins on .org, hundreds of bespoke installs.',
		'url'   => '/work/wordpress-plugin-development/',
	),
	array(
		'num'   => '03',
		'name'  => 'Design',
		'stamp' => 'pixels &amp; all ✦',
		'desc'  => 'Wireframing through to UI &mdash; mood-boarding, prototyping, full handoff.',
		'url'   => '/work/ui-ux-design/',
	),
);
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( 'What we do' ); ?>
		<h1 class="archive-header__title">Services</h1>
	</div>
</div>

<?php bain_ascii_rule(); ?>

<div class="services-page">
	<div class="bain-wrap">
		<div class="services-panel">
			<div class="services-list services-list--page" role="list">

				<?php foreach ( $services as $s ) : ?>
				<div class="services-list__item" role="listitem">
					<span class="services-list__num" aria-hidden="true"><?php echo esc_html( $s['num'] ); ?></span>
					<span class="services-list__name">
						<?php echo esc_html( $s['name'] ); ?>
						<span class="services-list__stamp" aria-hidden="true"><?php echo $s['stamp']; ?></span>
					</span>
					<span class="services-list__note"><?php echo $s['desc']; ?></span>
					<a class="services-list__cta" href="<?php echo esc_url( home_url( $s['url'] ) ); ?>">
						<span class="services-list__cta-default">read more &rarr;</span>
						<span class="services-list__cta-hover">open ticket &rarr;</span>
					</a>
				</div>
				<?php endforeach; ?>

			</div>
		</div>
	</div>
</div>

<?php get_footer();
