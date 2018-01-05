<?php
/**
 * The template for displaying the front page.
 *
 * This is the template that displays on the front page only.
 *
 * @package _mbbasetheme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	
<div class="hero">
	<picture>
		<!--[if IE 9]><video style="display: none;"><![endif]-->
		<source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-320x213.jpg" media="(max-width: 20em)">
		<source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-480x320.jpg" media="(max-width: 30em)">
		<source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-768x512.jpg" media="(max-width: 48em)">
		<source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-960x639.jpg" media="(max-width: 64em)">
		<source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero-1120x746.jpg" media="(max-width: 70em)">
		<source srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero.jpg">

		<!--[if IE 9]></video><![endif]-->
		<img srcset="<?php echo get_bloginfo('template_url') ?>/assets/images/hero.jpg" alt="">
	</picture>

		<div class="hero-header section">
			<div class="container">			
				<h1 class="wow fadeInLeft">Friendly websites for interesting people.</h1>
				<h3 class="wow fadeInRight">I design & build bespoke websites for individuals, small businesses & start-ups.</h3> 
				<div class="hero-cta">
					<div class="wow fadeInLeft"><a href="<?php bloginfo( 'url' ); ?>/contact" class="cta button cta-primary">Arrange a chat now <i aria-hidden="true" class="icon-arrow-right"></i></a></div>
					<div class="wow fadeInRight"><a href="<?php bloginfo( 'url' ); ?>/portfolio" class="cta button cta-secondary">Check out my work <i aria-hidden="true" class="icon-arrow-right"></i></a></div>
				</div>



			</div>
		</div>


	</div><!-- .hero -->

	<div class="section showcase">
		<div class="container">
			<h2>Recent projects</h2>
			<p>One of the best ways of choosing a designer to work with is to take a look at their previous work. Although my portfolio may not contain anything <i>identical</i> to what you are looking for, it'll give you a good idea of my style and the sort of projects I am looking for.</p>
			<div class="media_objects">	
				<a href="<?php echo get_bloginfo('url') ?>/?p=1282"class="media_object">
					<img src="<?php echo get_bloginfo('template_url') ?>/assets/images/flovoco-browser.png">
					<p class="wp-caption-text">flovco for ELTJam</p>
				</a>
				<a href="<?php echo get_bloginfo('url') ?>/?p=57"class="media_object">
					<img src="<?php echo get_bloginfo('template_url') ?>/assets/images/episodia-browser.png">
					<p class="wp-caption-text">episodia.es</p>
				</a>
				<a href="<?php echo get_bloginfo('url') ?>/?p=1281"class="media_object">
					<img src="<?php echo get_bloginfo('template_url') ?>/assets/images/atama-ii-browser.png">
					<p class="wp-caption-text">atama-ii books</p>
				</a>
			</div><!-- .media_objects -->
			<p><a href="<?php echo get_bloginfo('url') ?>/portfolio/">See more projects</a></p>
		</div>
	</div><!-- .section .showcase -->




	<div class="section final-call">
		<div class="container">
			<h2>Get in touch</h2>
			<div class="final-call-content clearfix">
				<p>If you're keen to find out more, there are lots of ways you can get in touch with me, but <a href="mailto:hello@markbaindesign.com">why not start with an email?</a></p>
			</div>
		</div>
	</div><!-- .final-call -->

		</main><!-- #main -->
	</div><!-- #primary -->




<?php get_sidebar(); ?>
<?php get_footer(); ?>
