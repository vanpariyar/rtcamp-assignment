<?php
use WP_CLI;
namespace Wp_Cli_Rest_Command;

class Fetch{
    
    function __construct(){
        add_action( 'cli_init', array($this,'wds_cli_register_commands') );
    }

    /**
	 * Returns 'Hello World'
	 *
	 * @since  0.0.1
	 * @author Scott Anderson
	 */
	public function hello_world() {
		WP_CLI::line( 'Hello World!' );
	}

    /**
     * Registers our command when cli get's initialized.
     *
     * @since  1.0.0
     * @author Scott Anderson
     */
    public function wds_cli_register_commands() {
        WP_CLI::add_command( 'wds', $this);
    }

}

    