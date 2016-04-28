<?php get_header(); ?>		

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="section">
			<div class="container">
	<?php	if ( have_posts() ) : ?> 
				<header class="entry-header">
					<h1 class="entry-title">Work</h1>
					<h3><?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?></h3>
				</header><!-- .entry-header -->
			</div>
		</div>
	

			<div class="section">
				<div class="container">
					<div class="masonrycontainer">
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>
		    
	<?php
		while( have_posts() ) :the_post();	  
			get_template_part( 'content', 'home' );
		   
		    wp_reset_postdata(); 
 
	?>
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
