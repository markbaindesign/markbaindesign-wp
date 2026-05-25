<?php
/**
 * Site footer template.
 */
?>
</main><!-- #main -->

<footer class="site-footer" id="colophon">
	<div class="site-footer__copy">
		<span>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> &mdash;</span>
		<span class="footer-verb" id="footer-verb">Build</span>
		<span> with </span>
		<span class="footer-heart" id="footer-heart">&#9829;</span>
	</div>

	<nav class="site-footer__nav" aria-label="<?php esc_attr_e( 'Footer', 'bain-design-theme' ); ?>">
		<a href="https://profiles.wordpress.org/markcbain/">WordPress</a>
		<span class="footer-sep">/</span>
		<a href="https://github.com/markbaindesign">GitHub</a>
		<span class="footer-sep">/</span>
		<a href="<?php echo esc_url( get_feed_link() ); ?>">RSS</a>
	</nav>
</footer><!-- #colophon -->

</div><!-- .site-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
