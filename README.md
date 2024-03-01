# Snoka Maintenance Mode
Snoka Maintenance Mode is a WordPress plugin that enables site administrators to activate maintenance mode with customizable options. It offers an easy way to temporarily make your site unavailable to the public while allowing administrators to access the site for updates, maintenance, or any administration work.

[![ko-fi](https://ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/W7W1FDHVR)

## Features

- **Customizable Maintenance Message**: Easily customize the maintenance message displayed to visitors.
- **Selectable HTTP Response Codes**: Choose the appropriate HTTP response code to send while in maintenance mode.
- **Retry-After Header**: Configure the `Retry-After` HTTP header to inform search engines and users when to expect the site to be available again.
- **Clears Cache**: Clears cache from various caching plugins upon activation of maintenance mode. Currently supports WP Fastest Cache, W3 Total Cache, WP Super Cache, and WP Rocket

## Installation

1. Download the plugin files from the GitHub repository.
2. Upload the plugin folder to the `/wp-content/plugins/` directory of your WordPress installation.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

After activation, navigate to **Settings > Snoka Maintenance Mode** in the WordPress admin to configure the plugin:

- **Enable Maintenance Mode**: Check this option to activate maintenance mode.
- **Maintenance Message**: Enter the message you wish to display to visitors. HTML is allowed.
- **Maintenance Title**: Set a custom title for the maintenance page.
- **Retry-After (seconds)**: Specify the time in seconds after which the site will be available again.
- **HTTP Response Code**: Select an appropriate HTTP status code for the maintenance mode.

## Deactivation

Deactivating the plugin will automatically remove all plugin-specific settings from the database, ensuring a clean state.

## Contributing

Contributions to the Snoka Maintenance Mode plugin are welcome. Please feel free to fork the repository, make your improvements, and submit a pull request.

## License

The Snoka Maintenance Mode plugin is open-source software licensed under the GPL (GNU General Public License).

## Support

For support, please open an issue in the GitHub repository or contact Snoka Media directly at [https://snoka.ca](https://snoka.ca).

## Author

Snoka Maintenance Mode is developed and maintained by Snoka Media, [https://snoka.ca](https://snoka.ca).
