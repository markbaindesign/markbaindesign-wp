<?php get_header(); ?>		

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="section">
			<div class="container">
	<?php	if ( have_posts() ) : ?> 
				<header class="entry-header">
					<h1 class="entry-title">Work</h1>
					<h3><?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( 'Author: %s', '_mbbasetheme' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', '_mbbasetheme' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', '_mbbasetheme' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', '_mbbasetheme' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', '_mbbasetheme' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', '_mbbasetheme' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( 'Galleries', '_mbbasetheme');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', '_mbbasetheme');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( 'Statuses', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( 'Audios', '_mbbasetheme' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( 'Chats', '_mbbasetheme' );
						
						// Portfolio item archives
						elseif ( is_post_type_archive( 'portfolio_item' ) ) :
							_e( 'Books', '_mbbasetheme' ); 

						else :
							_e( 'Archives', '_mbbasetheme' );

						endif;
					?></h3>
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
