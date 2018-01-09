<?php

/**
 * Plugin Name: Nice Words
 * Description: Add client testimonials; embed them in pages.
 * Version: 1.0.0
 * Author: Mark Bain
 * Author URI: http://markbaindesign.com
 *
 */

class MBd_Nice_Words {

	/**
	 * PHP5 constructor method.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		/* Load the functions files. */
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 3 );

		/* Load the admin files. */
		add_action( 'plugins_loaded', array( &$this, 'admin' ), 4 );

		/* Register activation hook. */
		register_activation_hook( __FILE__, array( &$this, 'activation' ) );
	}

	/**
	 * Defines constants used by the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function constants() {

		/* Set constant path to the plugin directory. */
		define( 'NW_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

		/* Set the constant path to the plugin directory URI. */
		define( 'NW_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set the constant path to the includes directory. */
		define( 'NW_INCLUDES', NW_DIR . trailingslashit( 'includes' ) );

		/* Set the constant path to the admin directory. */
		define( 'NW_ADMIN', NW_DIR . trailingslashit( 'admin' ) );
		
	}

	/**
	 * Loads the initial files needed by the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function includes() {

		require_once( NW_INCLUDES . 'functions.php' );
		require_once( NW_INCLUDES . 'meta.php' );
		require_once( NW_INCLUDES . 'post-types.php' );
		require_once( NW_INCLUDES . 'taxonomies.php' );
		require_once( NW_INCLUDES . 'shortcodes.php' );
		require_once( NW_INCLUDES . 'scripts.php' );
	}

	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function i18n() {

		/* Load the translation of the plugin. */
		load_plugin_textdomain( 'mbd-nice-words', false, 'nice-words/languages' );
	}

	/**
	 * Loads the admin functions and files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function admin() {

		if ( is_admin() )
			require_once( NW_ADMIN . 'admin.php' );
	}

	/**
	 * Method that runs only when the plugin is activated.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	function activation() {

		/* Get the administrator role. */
		$role =& get_role( 'administrator' );

		/* If the administrator role exists, add required capabilities for the plugin. */
		if ( !empty( $role ) ) {

			$role->add_cap( 'manage_testimonials' );
			$role->add_cap( 'create_testimonials' );
			$role->add_cap( 'edit_testimonials' );
		}
	}
}

new MBd_Nice_Words();

?>
