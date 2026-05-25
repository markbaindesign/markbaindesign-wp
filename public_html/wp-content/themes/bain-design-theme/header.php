<?php
/**
 * Site header template.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrapper">

<header class="site-header" id="masthead">

	<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<div class="site-header__mark" id="bd-mark" aria-hidden="true">Bd</div>
		<span class="site-header__name"><?php bloginfo( 'name' ); ?></span>
	</a>

	<button class="site-header__menu-toggle" id="menu-toggle"
	        aria-expanded="false" aria-controls="primary-nav">
		[menu]
	</button>

	<nav class="site-header__nav" id="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'bain-design-theme' ); ?>">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_id'        => 'primary-menu',
			'container'      => false,
			'depth'          => 1,
			'fallback_cb'    => false,
		) );
		?>
	</nav>

</header><!-- #masthead -->

<main class="site-main" id="main">
