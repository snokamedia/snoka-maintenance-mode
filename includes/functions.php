<?php
/**
 * Registers the plugin settings page within the WordPress admin area.
 */
function snoka_maintenance_mode_add_admin_menu() {
    add_options_page(
        'Snoka Maintenance Mode',
        'Snoka Maintenance Mode',
        'manage_options',
        'snoka_maintenance_mode',
        'snoka_maintenance_mode_settings_page'
    );
}

/**
 * Displays the maintenance message if maintenance mode is active.
 */
function snoka_maintenance_mode_check_status() {
    $options = get_option('snoka_maintenance_mode_options');

    // Exit if maintenance mode is not enabled or if the current user can bypass it
    if (empty($options['enabled']) || current_user_can('manage_options')) {
        return;
    }

    $title = !empty($options['maintenance_title']) ? $options['maintenance_title'] : 'Under Maintenance';
    $message = !empty($options['maintenance_message']) ? "<h1>{$title}</h1><br>" . $options['maintenance_message'] : "<h1>{$title}</h1><p>Currently under planned maintenance. Please check back later.</p>";
    $retry_after = !empty($options['retry_after']) ? $options['retry_after'] : 3600;
    $response_code = !empty($options['response_code']) ? $options['response_code'] : 503;

    header('Retry-After: ' . $retry_after);
    wp_die($message, $title, ['response' => $response_code]);
}

/**
 * Clears cache from various caching plugins upon activation of maintenance mode.
 */
function snoka_activate_maintenance_mode() {
    // Clear cache in popular caching plugins
    if (function_exists('rocket_clean_domain')) {
        rocket_clean_domain();
    }
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }
    if (function_exists('w3tc_flush_all')) {
        w3tc_flush_all();
    }
    if (function_exists('wpfc_clear_all_cache')) {
        wpfc_clear_all_cache();
    }
    wp_cache_flush(); // WordPress default cache
}

/**
 * Hooks into the option update to clear cache when maintenance mode is enabled.
 */
function snoka_maintenance_mode_update_option($old_value, $value) {
    if (!empty($value['enabled']) && $value['enabled'] != $old_value['enabled']) {
        snoka_activate_maintenance_mode();
    }
}
add_action('update_option_snoka_maintenance_mode_options', 'snoka_maintenance_mode_update_option', 10, 2);
