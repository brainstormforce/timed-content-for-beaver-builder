<?php
/**
 * Plugin Name: Timed Content for Beaver Builder
 * Plugin URI: https://www.brainstormforce.com/
 * Description: Timed Content For Beaver builder plugin allows users to hide content after given time.
 * Version: 1.0.2.1
 * Author: Brainstorm Force
 * Author URI: http://www.brainstormforce.com
 * Text Domain: timed-content-for-beaver-builder
 *
 * @package timed-content-for-beaver-builder
 */

/**
 * Initiate class define constants
 */
require_once 'class-bb-timed-content.php';
define( 'TIMED_CONTENT_BEAVER_BUILDER_DIR', plugin_dir_path( __FILE__ ) );
define( 'TIMED_CONTENT_BEAVER_BUILDER_URL', plugins_url( '/', __FILE__ ) );

/**
 * Load the Plugin Class.
 */
function bb_timed_content_init() {
	new BB_Timed_Content();
}
add_action( 'plugins_loaded', 'bb_timed_content_init' );
