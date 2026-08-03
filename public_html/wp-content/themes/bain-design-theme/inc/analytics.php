<?php
/**
 * Google Analytics (GA4).
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'BAIN_GA_MEASUREMENT_ID', 'G-MG96E49YBG' );

add_action( 'wp_head', function () {
	if ( 'production' !== wp_get_environment_type() ) {
		return;
	}
	?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( BAIN_GA_MEASUREMENT_ID ); ?>"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', '<?php echo esc_js( BAIN_GA_MEASUREMENT_ID ); ?>');
	</script>
	<?php
}, 5 );
