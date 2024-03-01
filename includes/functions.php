<?php
/**
 * Adds the plugin settings page to the WordPress admin menu.
 */
function snoka_maintenance_mode_add_admin_menu()
{
    add_options_page('Snoka Maintenance Mode', 'Snoka Maintenance Mode', 'manage_options', 'snoka_maintenance_mode', 'snoka_maintenance_mode_settings_page');
}

/**
 * Checks if the maintenance mode is enabled and displays the maintenance message if conditions are met.
 */
function snoka_maintenance_mode_check_status()
{
    $options = get_option('snoka_maintenance_mode_options');
    if (!isset($options['enabled']) || !$options['enabled']) {
        return;
    }

    if (!current_user_can('edit_themes') || !is_user_logged_in()) {
        $title = !empty($options['maintenance_title']) ? $options['maintenance_title'] : 'Under Maintenance';
        // Check if a custom maintenance message is provided
        if (!empty($options['maintenance_message'])) {
            // Prepend the custom message with the <h1> title format
            $message = "<h1>{$title}</h1><br>" . $options['maintenance_message'];
        } else {
            // Use the default message format if no custom message is provided
            $message = "<h1>{$title}</h1><p>Currently under planned maintenance. Please check back later.</p>";
        }

        // Set Retry-After to 3600 seconds if not specified
        $retry_after = !empty($options['retry_after']) ? $options['retry_after'] : 3600;
        header('Retry-After: ' . $retry_after);

        // Use the response code if set; default to 503 if not
        $response_code = !empty($options['response_code']) ? $options['response_code'] : 503;
        wp_die($message, $title, ['response' => $response_code]);
    }
}
