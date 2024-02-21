<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package _mbbasetheme
 */
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<!-- Favicons & icons -->
   <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( home_url() ); ?>/favicon-32x32.png?v=2.5.0">
   <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( home_url() ); ?>/favicon-16x16.png?v=2.5.0">
   <link rel="manifest" href="<?php echo esc_url( home_url() ); ?>/site.webmanifest?v=2.5.0">
   <link rel="mask-icon" href="<?php echo esc_url( home_url() ); ?>/safari-pinned-tab.svg?v=2.5.0" color="#000000">
   <link rel="shortcut icon" href="<?php echo esc_url( home_url() ); ?>/favicon.ico?v=2.5.0">
   <meta name="msapplication-TileColor" content="#000000">
   <meta name="theme-color" content="#ffffff">

	<!-- Open Graph protocol -->
	<meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/img/mbd-og.png">
	<meta property="og:image:width" content="1200">
	<meta property="og:image:height" content="630">
	<meta property="og:image:type" content="image/png">

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<!--[if lt IE 9]>
	    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

	<header id="masthead" class="site-header section" role="banner">
		<div class="container">
			<div class="branding">
				<?php 
					$blog_title = get_bloginfo('name');
					$blog_url = esc_url( home_url());
				?>
				<a id="logo-link" href="<?php echo $blog_url; ?>" rel="home" title="<?php echo $blog_title; ?>">
					<h1 id="site-title"><?php echo $blog_title; ?></h1>
				</a>
				<a href="#nav" id="main-menu-toggle" aria-hidden="false"><h2 class="visuallyhidden">Menu</h2></a>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'nav', 'container_class' => 'nav-collapse menu-main-container' ) ); ?>
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
