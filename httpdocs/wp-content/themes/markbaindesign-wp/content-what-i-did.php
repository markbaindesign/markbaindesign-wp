<div class="what-i-did block">
		<h3>Some examples</h3>
		<div class="nice-words-content clearfix">
			<p>Pull in random thumbs and excerpts from the testimonials</p>
			<p>Three cols ought to do it</p>
			<?php
				$args = array( 
					'post_type' => 'portfolio_item', 
					'posts_per_page' => 3,
				  	'orderby' => 'rand'	
				);
				$query = new WP_Query( $args );
				while ( $query->have_posts() ) : $query->the_post();
			get_template_part( 'content', 'home' ); 
				wp_reset_postdata();
				endwhile; 
			?>
		</div>
	</div><!-- .what-i-did -->
