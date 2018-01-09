<?php
/**
 * Uninstall procedure for the plugin.
 */

/* Make sure we're actually uninstalling the plugin. */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
	wp_die( sprintf( __( '%s should only be called when uninstalling the plugin.', 'nice-words' ), '<code>' . __FILE__ . '</code>' ) );

/* === Delete plugin options. === */

delete_option( 'plugin_nice_words' );

/* === Remove capabilities added by the plugin. === */

/* Get the administrator role. */
$role =& get_role( 'administrator' );

/* If the administrator role exists, remove added capabilities for the plugin. */
if ( !empty( $role ) ) {

	$role->remove_cap( 'manage_testimonials' );
	$role->remove_cap( 'create_testimonials' );
	$role->remove_cap( 'edit_testimonials' );
}

?>
