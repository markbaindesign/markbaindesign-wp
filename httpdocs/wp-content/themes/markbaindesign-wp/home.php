<?php 
	get_header();
	get_template_part( 'featured' ); 	
?>		

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
	
	<?php


		$args = array(
			'offset' => 1,
			'paged' => $paged,
			'my_special_query' => true	
		);

		$query = new WP_Query($args);

		if ( $query->have_posts() ) : ?> 
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

<?php wp_pagenavi(); ?>							
						<?php else : ?>

				<?php get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
