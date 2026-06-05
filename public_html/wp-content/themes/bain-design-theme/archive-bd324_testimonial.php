<?php	get_header(); ?>		
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="section">
			<div class="container">
				<header class="entry-header">
					<h1 class="entry-title">Nice Words</h1>
				</header><!-- .entry-header -->
			</div>
		</div>
	<?php if ( have_posts() ) : ?>
			<div class="section">
				<div class="container">
					<div class="masonrycontainer">

						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>
		    
			<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'home' ); ?>
	
			<?php endwhile; ?>

				</div><!-- .masonrycontainer -->	
			</div>
		</div>	
<?php wp_pagenavi(); ?>							
						<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
