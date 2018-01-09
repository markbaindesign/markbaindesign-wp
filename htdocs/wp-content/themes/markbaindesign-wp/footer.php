<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package _mbbasetheme
 */
?>

	</div><!-- #content -->
	
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="footer-widgets" class="widget-area">
			
				
				<div class="masonrycontainer">
					<div class="grid-sizer"></div>
					<div class="gutter-sizer"></div>				
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				
				
				</div>
				
			
		</div><!-- .widget-container -->
	<?php endif; ?>
	<footer id="colophon" class="section site-footer" role="contentinfo">
		<div class="container">
		<div class="site-info">
			<div id="copyright">
					<p><a href="<?php echo bloginfo( 'url' ); ?>">&copy; <?php echo date("Y"); ?> <?php echo bloginfo( 'name' ); ?></a></p>
			</div> 
		<!--	<p id="tagline">
				<?php echo get_bloginfo( 'description' ); ?>
			</p> --> 
		</div><!-- .site-info -->

		<div class="social">
			<ul class="social-media-links">
				<li><a href="https://www.facebook.com/markbaindesign"><i aria-hidden="true" class="icon-facebook icon-left"></i><span class="">Facebook</span></a></li> 
				<li><a href="https://twitter.com/mbain"><i aria-hidden="true" class="icon-twitter icon-left"></i><span class="">Twitter</span></a></li> 
				<li><a href="<?php bloginfo('rss2_url'); ?>"><i aria-hidden="true" class="icon-feed icon-left"></i><span class="">RSS</span></a></li> 
			</ul>
		</div><!-- .social -->

		<!-- <div id="design">
			<p>Designed <span class="amp">&amp;</span> coded by <a href="http://markbaindesign.com" title="Visit the website of Mark Bain Design">Mark Bain Design</a></p>
		</div> --><!-- #design -->

		<div id="back-to-top" >
			<p><a href="#header" title="Go back to the top" class=""><i aria-hidden="true" class="icon-arrow-up"></i>Back to top</a></p>
		</div><!-- #back-to-top -->
		</div><!-- .container -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
