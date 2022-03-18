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

use WP_CLI;
namespace Wp_Cli_Rest_Command;
use Wp_Cli_Rest_Command\Fetch;

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}

require dirname(__FILE__). '/inc/plugin.php';

class Wp_Cli_Rest_Command {

	public function __construct() {
		add_action( 'cli_init', array($this, 'wds_cli_register_commands') );
	}

	/**
	 * Registers our command when cli get's initialized.
	 *
	 * @since  1.0.0
	 * @author Scott Anderson
	 */
	public function wds_cli_register_commands() {
		\WP_CLI::add_command( 'sync', '\Wp_Cli_Rest_Command\Fetch' );
	}
	
}

$Wp_Cli_Rest_Command = new Wp_Cli_Rest_Command();
