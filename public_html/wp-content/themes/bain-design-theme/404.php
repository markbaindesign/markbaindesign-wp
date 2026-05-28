<?php
/**
 * 404 template.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();
?>

<div class="e404-wrap">

	<div class="e404-terminal">
		<span class="e404-prompt">~ $ </span><span class="e404-cmd">cat <span class="e404-path"></span></span>
		<div class="e404-output">cat: No such file or directory</div>
	</div>

	<div class="e404-stage">
		<div class="e404-num" aria-hidden="true">404</div>

		<div class="e404-cats" aria-hidden="true">
			<div class="e404-cat e404-cat--gala">
				<pre class="e404-frame e404-frame--a"> /\_/\
(^.^)&gt; </pre>
				<pre class="e404-frame e404-frame--b"> /\_/\
(^-^)&gt; </pre>
			</div>
			<div class="e404-cat e404-cat--sal">
				<pre class="e404-frame e404-frame--a"> /\_/\
(=.=)&gt; </pre>
				<pre class="e404-frame e404-frame--b"> /\_/\
(-_-)&gt; </pre>
			</div>
		</div>

		<p class="e404-msg">Nothing here.<br>The cats looked, too.</p>
	</div>

	<nav class="e404-nav" aria-label="Find your way back">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">← home</a>
		<a href="<?php echo esc_url( get_post_type_archive_link( 'bd324_projects' ) ); ?>">work</a>
		<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>">about</a>
		<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>">contact</a>
	</nav>

</div>

<script>
(function(){
	var el = document.querySelector('.e404-path');
	if (el) el.textContent = window.location.pathname;
})();
</script>

<?php get_footer();
