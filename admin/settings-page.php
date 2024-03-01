<?php
/**
 * Renders the plugin settings page in the WordPress admin.
 */
function snoka_maintenance_mode_settings_page()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && current_user_can('manage_options')) {
        check_admin_referer('snoka_maintenance_mode_options_verify');
        $options = [
            'enabled' => isset($_POST['snoka_maintenance_mode_enabled']),
            'maintenance_message' => sanitize_text_field($_POST['snoka_maintenance_mode_message']),
            'maintenance_title' => sanitize_text_field($_POST['snoka_maintenance_mode_title']),
            'retry_after' => intval($_POST['snoka_maintenance_mode_retry_after']),
            'response_code' => intval($_POST['snoka_maintenance_mode_response_code']),
        ];
        update_option('snoka_maintenance_mode_options', $options);
        echo '<div class="updated"><p>Settings updated.</p></div>';
    }

    $options = get_option('snoka_maintenance_mode_options');
    ?>
    <div class="wrap">
        <h2>Snoka Maintenance Mode Settings</h2>
        <form method="POST" action="">
            <?php wp_nonce_field('snoka_maintenance_mode_options_verify');?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enable Maintenance Mode</th>
                    <td><input type="checkbox" name="snoka_maintenance_mode_enabled" <?php checked(isset($options['enabled']) ? $options['enabled'] : 0, 1);?> /></td>
                </tr>
				<tr valign="top">
					<th scope="row">Retry-After (seconds)</th>
					<td><input type="number" name="snoka_maintenance_mode_retry_after" value="<?php echo esc_attr($options['retry_after'] ?? ''); ?>" class="small-text" /> seconds</td>
				</tr>
				<tr valign="top">
					<th scope="row">HTTP Response Code</th>
					<td>
						<select name="snoka_maintenance_mode_response_code" class="regular-text">
							<option value="503" <?php selected($options['response_code'] ?? 503, 503);?>>503 Service Unavailable</option>
							<option value="502" <?php selected($options['response_code'] ?? 503, 502);?>>502 Bad Gateway</option>
							<option value="504" <?php selected($options['response_code'] ?? 503, 504);?>>504 Gateway Timeout</option>
						</select>
					</td>
				</tr>
                <tr valign="top">
                    <th scope="row">Maintenance Title</th>
                    <td><input type="text" name="snoka_maintenance_mode_title" value="<?php echo esc_attr($options['maintenance_title'] ?? ''); ?>" class="regular-text" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Maintenance Message</th>
                    <td>
                        <textarea name="snoka_maintenance_mode_message" rows="10" cols="50" class="large-text"><?php echo esc_textarea($options['maintenance_message'] ?? ''); ?></textarea>
                    </td>
                </tr>
            </table>
            <?php submit_button();?>
        </form>
    </div>
    <?php
}
