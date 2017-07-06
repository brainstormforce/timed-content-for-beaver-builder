<?php
/**
 * Plugin Name: Timed Content for Beaver Builder
 * Plugin URI: https://www.brainstormforce.com/
 * Description: Timed Content For Beaver builder plugin allows users to hide content after given time.
 * Version: 1.0.0
 * Author: Beaver Builder Addon
 * Author URI: https://www.ultimatebeaver.com/
 * Text Domain: timed-content-for-beaver-builder
 *
 * @package timed-content-for-beaver-builder
 */

define( 'TIMED_CONTENT_BEAVER_BUILDER_DIR', plugin_dir_path( __FILE__ ) );
define( 'TIMED_CONTENT_BEAVER_BUILDER_URL', plugins_url( '/', __FILE__ ) );

/**
 * Custom modules
 */
// check of BSFBBTimedContent class already exist or not.
if ( ! class_exists( 'BSFBBTimedContent' ) ) {

	/**
	 * Class to check BB timeled install
	 */
	class BSFBBTimedContent {
		/**
		 * To initialize new object
		 */
		function __construct() {
			add_action( 'init', array( $this, 'load_timed' ) );
			add_action( 'init', array( $this, 'load_textdomain' ) );
		}

		/**
		 * Function to load BB Timed module
		 */
		function load_timed() {
			if ( class_exists( 'FLBuilder' ) ) {
				// If class exist it loads the module.
				require_once 'class-timed-content-helper.php';
				require_once 'timed-content-module/timed-content-module.php';
			} else {
				// Display admin notice for activating beaver builder.
				add_action( 'admin_notices',array( $this, 'admin_notices_function' ) );
				add_action( 'network_admin_notices',array( $this, 'admin_notices_function' ) );
			}
		}

		/**
		 * Function to load text domain
		 */
		public function load_textdomain() {

			load_plugin_textdomain( 'timed-content-for-beaver-builder' );
		}

		/**
		 * Function to display admin notice
		 */
		function admin_notices_function() {
			// check for Beaver Builder Installed / Activated or not.
			if ( file_exists( plugin_dir_path( 'bb-plugin-agency/fl-builder.php' ) )
				|| file_exists( plugin_dir_path( 'beaver-builder-lite-version/fl-builder.php' ) ) ) {
				$url = network_admin_url() . 'plugins.php?s=Beaver+Builder+Plugin';

			} else {

				$url = network_admin_url() . 'plugin-install.php?s=billyyoung&tab=search&type=author';

			}

			// To display notice.
			echo '<div class="notice notice-error">';

			/* Translators: Timed Content Module For Beaver Builder */
				echo '<p>' . sprintf( __( 'The <strong>Timed Content Module For Beaver Builder</strong> plugin requires <strong><a href="%s">Beaver Builder</strong></a> plugin installed & activated.', 'timed-content-for-beaver-builder' ) . '</p>', $url );

			echo '</div>';
		}
	}
	new BSFBBTimedContent();
}// End if().
?>