<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Ultimate_3D_Model_Viewer
 *
 * @wordpress-plugin
 * Plugin Name:       Ultimate 3D Model Viewer
 * Description:       This plugin provides a custom widget for Elementor that allows to display 3D model und customize the settings. 
 * Version:           1.0.0
 * Author:            Alexander Dort GmbH
 * Author URI:        https://www.alexanderdort.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ultimate-3d-model-viewer
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
define( 'ULTIMATE_3D_MODEL_VIEWER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/model-viewer-widget-activator.php
 */
function activate_ultimate_3d_model_viewer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/ultimate-3d-model-viewer-activator.php';
	Ultimate_3D_Model_Viewer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_ultimate_3d_model_viewer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/ultimate-3d-model-viewer-deactivator.php';
	Ultimate_3D_Model_Viewer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ultimate_3d_model_viewer' );
register_deactivation_hook( __FILE__, 'deactivate_ultimate_3d_model_viewer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/ultimate-3d-model-viewer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ultimate_3d_model_viewer() {

	$plugin = new Ultimate_3D_Model_Viewer();
	$plugin->run();

}
run_ultimate_3d_model_viewer();
