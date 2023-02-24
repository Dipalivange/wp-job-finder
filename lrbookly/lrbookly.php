<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.logicrays.com/
 * @since             1.0.0
 * @package           Lrbookly
 *
 * @wordpress-plugin
 * Plugin Name:       LRBookly
 * Plugin URI:        https://www.logicrays.com/
 * Description:       This plugin is used for booking services with available dates and times. also, this plugin provides a payment gateway to build your business. 
 * Version:           1.0.0
 * Author:            LogicRays
 * Author URI:        https://www.logicrays.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lrbookly
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LRBOOKLY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lrbookly-activator.php
 */
function activate_lrbookly() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lrbookly-activator.php';
	Lrbookly_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lrbookly-deactivator.php
 */
function deactivate_lrbookly() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lrbookly-deactivator.php';
	Lrbookly_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lrbookly' );
register_deactivation_hook( __FILE__, 'deactivate_lrbookly' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lrbookly.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lrbookly() {

	$plugin = new Lrbookly();
	$plugin->run();

}
run_lrbookly();
