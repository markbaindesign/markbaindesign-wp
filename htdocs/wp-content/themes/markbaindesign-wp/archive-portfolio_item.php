<?php get_header(); ?>		

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="section">
			<div class="container">
				<header class="entry-header">
					<h1 class="entry-title">Work</h1>
				</header><!-- .entry-header -->
			</div>
		</div>
<?php get_template_part( 'featured' ); ?>	
	
	<?php


		$args = array(
			'offset' => 1,
			'paged' => $paged,
			'post_type' => 'portfolio_item',
			'my_special_query' => true	
		);

		$query = new WP_Query($args);

		if ( $query->have_posts() ) : ?> 
			<div class="section">
				<div class="container">
					<div class="masonrycontainer">
						<div class="grid-sizer"></div>
						<div class="gutter-sizer"></div>
		    
	<?php
		while( $query->have_posts() ) {  
			$query->the_post();	  
			get_template_part( 'content', 'home' );
		    } 
		   
		    wp_reset_postdata(); 
 
	?>
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
