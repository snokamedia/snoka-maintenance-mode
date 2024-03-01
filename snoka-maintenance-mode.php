<?php
/**
 * Plugin Name:       Snoka Maintenance Mode
 * Plugin URI:        https://snoka.ca
 * Description:       Enable maintenance mode with customizable options.
 * Version:           1.0
 * Author:            Snoka Media
 * Author URI:        https://snoka.ca
 *
 * @package           SnokaMaintenanceMode
 */

// Include the settings page and functions file.
require_once plugin_dir_path(__FILE__) . 'admin/settings-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';

/**
 * Hook into WordPress to add the settings page and check maintenance status.
 */
add_action('admin_menu', 'snoka_maintenance_mode_add_admin_menu');
add_action('get_header', 'snoka_maintenance_mode_check_status');

/**
 * Register hook for executing code on plugin deactivation.
 */
register_deactivation_hook(__FILE__, 'snoka_maintenance_mode_deactivate');

/**
 * Cleans up the database by removing options added by the plugin upon deactivation.
 */
function snoka_maintenance_mode_deactivate()
{
    delete_option('snoka_maintenance_mode_options');
}
