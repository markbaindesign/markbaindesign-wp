<?php
/**
 * @package _mbbasetheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'home-post' ); ?>>
<a href="<?php the_permalink(); ?>" class="media__img"><?php 
    if ( has_post_thumbnail() ) { 
        the_post_thumbnail( 'featured_small_1' ); 
    } 
?></a>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php echo get_the_date(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->




</article><!-- #post-## -->
