<?php
/**
 * Single service template — single-bd324_services.php
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

while ( have_posts() ) :
	the_post();

	$ancestors = array_reverse( get_post_ancestors( get_the_ID() ) );
	$children  = get_posts( array(
		'post_type'      => 'bd324_services',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'post_parent'    => get_the_ID(),
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	) );
	?>

	<div class="archive-header">
		<div class="archive-header__inner">
			<?php
			$crumb_parts   = array();
			$crumb_parts[] = '<a href="' . esc_url( get_post_type_archive_link( 'bd324_services' ) ) . '">Services</a>';
			foreach ( $ancestors as $anc_id ) {
				$crumb_parts[] = '<a href="' . esc_url( get_permalink( $anc_id ) ) . '">' . esc_html( get_the_title( $anc_id ) ) . '</a>';
			}
			$crumb_parts[] = '<span>' . esc_html( get_the_title() ) . '</span>';
			echo '<nav class="meta-bracket service-breadcrumb" aria-label="Breadcrumb">' . implode( ' / ', $crumb_parts ) . '</nav>';
			?>
			<h1 class="archive-header__title"><?php the_title(); ?><span class="archive-header__dot">.</span></h1>
		</div>
	</div>

	<?php bain_ascii_rule(); ?>

	<div class="bain-wrap bain-section">

		<?php if ( get_the_content() ) : ?>
		<div class="service-single__content bain-body-copy">
			<?php the_content(); ?>
		</div>
		<?php endif; ?>

		<?php if ( $children ) : ?>
		<div class="service-single__children">
			<?php bain_meta_bracket( 'In this section', array( 'tag' => 'div' ) ); ?>
			<ul class="service-single__child-list">
				<?php foreach ( $children as $child ) : ?>
				<li>
					<a href="<?php echo esc_url( get_permalink( $child ) ); ?>">
						<?php echo esc_html( $child->post_title ); ?> →
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

	</div>

<?php endwhile;

get_footer();
