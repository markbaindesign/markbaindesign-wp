<?php
/**
 * @package _mbbasetheme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<!-- <div class="entry-meta">
<?php mbdmaster_posted_on(); ?>


		</div> --><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', '_mbbasetheme' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">		<?php mbdmaster_posted_on(); ?>			<?php mbdmaster_post_meta(); ?>


		<!-- <?php edit_post_link( __( 'Edit', '_mbbasetheme' ), '<span class="edit-link">', '</span>' ); ?> -->
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
