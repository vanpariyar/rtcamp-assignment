<?php
/**
 * Plugin Name:     Wp Cli Rest Command
 * Plugin URI:      ''
 * Description:     Pluging can help you with the fetch other sites post to your own database.
 * Author:          Ronak Vanpariya
 * Author URI:      ''
 * Text Domain:     wp-cli-rest-command
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Wp_Cli_Rest_Command
 */

use Wp_Cli_Rest_Command;

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

$wpcli_search_replace_autoloader = dirname( __FILE__ ) . '/vendor/autoload.php';
if ( file_exists( $wpcli_search_replace_autoloader ) ) {
	require_once $wpcli_search_replace_autoloader;
}

$wpcli_rest_command = new Wp_Cli_Rest_Command();