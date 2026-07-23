<?php
/**
 * Site footer template.
 */

$bd_climate = null;
if ( function_exists( 'bd_get_foobot_device_uuid' ) ) {
	$bd_climate_uuid = bd_get_foobot_device_uuid( 'HappyBot' );
	if ( $bd_climate_uuid && 'error_device_not_found' !== $bd_climate_uuid ) {
		$bd_climate_sensors = bd_foobot_fetch_db_sensors( $bd_climate_uuid );
		if ( ! empty( $bd_climate_sensors[0]['datapointTmp'] ) ) {
			$bd_climate = $bd_climate_sensors[0];
		}
	}
}
?>
</main><!-- #main -->

<footer class="site-footer" id="colophon">
	<div class="site-footer__copy">
		<span>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> &mdash;</span>
		<span class="footer-verb" id="footer-verb">Build</span>
		<span> with </span>
		<span class="footer-heart" id="footer-heart">&#9829;</span>
	</div>

	<?php if ( $bd_climate ) : ?>
	<div class="site-footer__climate" aria-label="<?php esc_attr_e( 'Studio environment', 'bain-design-theme' ); ?>">
		<span class="site-footer__climate-label"><a href="<?php echo esc_url( home_url( '/work/wordpress-plugin-development/open-source-contributions/' ) ); ?>" data-tip="powered by my open-source plugin — click to view">Studio environment</a> <span class="tip-q" data-tip="live reading from the studio's air quality sensor">?</span></span>
		<span class="site-footer__climate-item">
			<svg class="site-footer__climate-icon" viewBox="0 0 16 16" width="11" height="11" aria-hidden="true"><path d="M9 2.5a1 1 0 0 0-2 0v6.55a2.5 2.5 0 1 0 2 0V2.5Z" fill="none" stroke="currentColor" stroke-width="1.1"/><circle cx="8" cy="11.5" r="1.1" fill="currentColor"/></svg>
			<?php echo esc_html( number_format( $bd_climate['datapointTmp'], 1 ) . '°' . $bd_climate['unitTmp'] ); ?>
		</span>
		<span class="footer-sep">/</span>
		<span class="site-footer__climate-item">
			<svg class="site-footer__climate-icon" viewBox="0 0 16 16" width="11" height="11" aria-hidden="true"><path d="M8 2s4.5 5.2 4.5 8.2A4.5 4.5 0 0 1 3.5 10.2C3.5 7.2 8 2 8 2Z" fill="none" stroke="currentColor" stroke-width="1.1"/></svg>
			<?php echo esc_html( round( $bd_climate['datapointHum'] ) . '% hum' ); ?>
		</span>
	</div>
	<?php endif; ?>

	<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Footer', 'bain-design-theme' ); ?>">
		<a href="https://profiles.wordpress.org/markcbain/">WordPress</a>
		<span class="footer-sep">/</span>
		<a href="https://github.com/markbaindesign">GitHub</a>
		<span class="footer-sep">/</span>
		<a href="https://www.linkedin.com/in/mark-bain-070a09203/">LinkedIn</a>
		<span class="footer-sep">/</span>
		<a href="<?php echo esc_url( get_feed_link() ); ?>">RSS</a>
	</nav>
</footer><!-- #colophon -->

<div class="bain-pet" data-petname="Gala" aria-hidden="true" role="presentation">
	<div class="bain-pet__sprite"></div>
</div>
<div class="bain-pet" data-petname="Salvador" aria-hidden="true" role="presentation">
	<div class="bain-pet__sprite"></div>
</div>

</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
