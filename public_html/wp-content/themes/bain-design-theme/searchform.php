<?php
/**
 * Search form template.
 *
 * @package bain-design-theme
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="search-form__label">
		<?php _e( 'Search', 'bain-design-theme' ); ?>
	</label>
	<input
		type="search"
		class="search-form__input"
		placeholder="<?php esc_attr_e( 'Search the site...', 'bain-design-theme' ); ?>"
		value="<?php echo get_search_query(); ?>"
		name="s"
		id="s" />
	<button type="submit" class="search-form__submit">
		<span class="search-form__submit-text"><?php _e( 'Search', 'bain-design-theme' ); ?></span>
	</button>
</form>
