<div id="post-<?php the_ID(); ?>" <?php post_class( 'media' ); ?>>

<div class="hero">

		<div class="hero-header">
		

			<div class="hero-image wow fadeInRight">
				<a href="<?php the_permalink(); ?>" class="media__img">
					<?php 
						if ( has_post_thumbnail() ) { 
							the_post_thumbnail( 'featured_small_1' ); 
						 } 
					?>
				</a>
			</div>  
			<div class="hero-text wow fadeInLeft">
				<h1><?php the_title(); ?></h1>
				<h5 class="sub-hero"><?php the_excerpt(); ?></h5>
			<div class="hero-cta">
				<div>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="Read more about this project." class="cta button cta-primary">Read more<i aria-hidden="true" class="icon-arrow-right"></i></a>
			</div>
			</div>
			</div>

		</div>
	</div><!-- .hero -->

</div>
