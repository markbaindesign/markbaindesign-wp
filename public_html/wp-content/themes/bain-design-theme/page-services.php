<?php
/**
 * Services page template — page-services.php
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header();

$all_services = get_posts( array(
	'post_type'      => 'bd324_services',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order',
	'order'          => 'ASC',
) );

function bain_service_tree_rows( $items, $parent_id = 0, $prefix = '' ) {
	$children = array_values( array_filter( $items, fn( $p ) => (int) $p->post_parent === $parent_id ) );
	$total    = count( $children );

	foreach ( $children as $i => $item ) {
		$is_last   = ( $i === $total - 1 );
		$connector = $is_last ? '└── ' : '├── ';
		$extension = $is_last ? '    ' : '│   ';
		$depth     = substr_count( $prefix, '│' ) + substr_count( $prefix, ' ' ) / 4;
		?>
		<div class="stree__row stree__row--depth-<?php echo (int) $depth; ?>">
			<span class="stree__prefix" aria-hidden="true"><?php echo esc_html( $prefix . $connector ); ?></span>
			<a class="stree__name" href="<?php echo esc_url( get_permalink( $item ) ); ?>">
				<?php echo esc_html( $item->post_title ); ?>
			</a>
		</div>
		<?php
		bain_service_tree_rows( $items, $item->ID, $prefix . $extension );
	}
}

$roots = array_values( array_filter( $all_services, fn( $p ) => (int) $p->post_parent === 0 ) );
?>

<div class="archive-header">
	<div class="archive-header__inner">
		<?php bain_meta_bracket( 'What I do' ); ?>
		<h1 class="archive-header__title">Services<span class="archive-header__dot">.</span></h1>
	</div>
</div>

<?php bain_ascii_rule(); ?>

<section class="stree-section">
	<div class="bain-wrap">

		<div class="stree">
			<?php foreach ( $roots as $ri => $root ) : ?>
			<div class="stree__block">
				<div class="stree__row stree__row--root">
					<a class="stree__name stree__name--root" href="<?php echo esc_url( get_permalink( $root ) ); ?>">
						<?php echo esc_html( $root->post_title ); ?>
					</a>
				</div>
				<?php bain_service_tree_rows( $all_services, $root->ID ); ?>
			</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>

<?php get_footer();
