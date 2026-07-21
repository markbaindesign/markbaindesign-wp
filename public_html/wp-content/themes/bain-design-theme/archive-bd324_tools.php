<?php
/**
 * Tools timeline archive — bd324_tools.
 * Chart itself is rendered client-side by D3 (assets/js/tools-gantt.js) —
 * this template only outputs the header, filter pills, and the data payload.
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$gantt      = function_exists( 'bd324_get_tools_gantt_json' ) ? bd324_get_tools_gantt_json() : null;
$tool_count = 0;
if ( $gantt ) {
	foreach ( $gantt['tracks'] as $track ) {
		$tool_count += count( $track['tools'] );
	}
}
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( 'since 2013' ); ?>
		<h1 class="archive-header__title">Tools</h1>
		<p class="archive-header__count">
			<?php echo (int) $tool_count; ?> entries — how the practice has changed
		</p>
	</div>
</div>

<?php if ( $gantt && ! empty( $gantt['tracks'] ) ) : ?>

<div class="tools-filters">
	<div class="tools-filters__inner">
		<span class="tools-filters__label">filter:</span>
		<button type="button" class="tools-filter-pill is-active" data-tools-filter="all">All</button>
		<?php foreach ( $gantt['tracks'] as $track ) : ?>
		<button type="button" class="tools-filter-pill" data-tools-filter="<?php echo esc_attr( $track['slug'] ); ?>"><?php echo esc_html( $track['category'] ); ?></button>
		<?php endforeach; ?>
	</div>
</div>

<div id="tools-year-slider" class="tools-year-slider" aria-label="<?php esc_attr_e( 'Filter by year range', 'bain-design-theme' ); ?>"></div>

<div class="tools-legend">
	<div class="tools-legend__inner">
		<span class="tools-legend__item"><span class="tools-legend__swatch tools-legend__swatch--current"></span>current</span>
		<span class="tools-legend__item"><span class="tools-legend__swatch tools-legend__swatch--sunset"></span>sunset — legacy projects only</span>
		<span class="tools-legend__item"><span class="tools-legend__swatch tools-legend__swatch--ended"></span>ended</span>
	</div>
</div>

<div id="tools-gantt-root" class="tools-gantt-d3" aria-label="<?php esc_attr_e( 'Tools timeline chart', 'bain-design-theme' ); ?>">
	<p class="tools-gantt-d3__noscript">Enable JavaScript to see the interactive timeline.</p>
</div>
<script type="application/json" id="tools-gantt-data"><?php echo wp_json_encode( $gantt ); ?></script>

<?php else : ?>
<div class="bain-section">
	<div class="bain-section__inner">
		<p class="tools-timeline__empty">No tools logged yet.</p>
	</div>
</div>
<?php endif; ?>

<?php get_footer();
