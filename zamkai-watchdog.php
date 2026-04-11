<?php
/**
 * Plugin Name: Zamkai Watchdog
 * Description: Watch out for intruders and CHOW them down.
 * Author: TechGrill
 * Version: 1.0
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('ZAMKAI_WATCHDOG_PATH', plugin_dir_path(__FILE__));
define('ZAMKAI_WATCHDOG_URL', plugin_dir_url(__FILE__));

/**
 * MAIN PLUGIN CLASS
 * This is the container for all our plugin's functionality
 * Think of it as the "brain" of the plugin that coordinates everything
 */

class Zamkai_WD_Main {

	private $option_name = 'zamkai_wd_settings';

	function __construct() {

		add_action('init', array($this,'get_admins'));
		require_once ZAMKAI_WATCHDOG_PATH . '/admin/zk-watchdog-admin.php';
		

	}

	public function get_admins(){
		$admins = get_users( [ 'role' => 'administrator' ] );
		error_log(print_r($admins, true));
	}
	

}

new Zamkai_WD_Main();

/** Things needed to do. 
 * Check for existing admins from a list
 * Allow users to add only admins who are 100% verified
 * Admins that aren't in the whitelist are REMOVED / Demoted
 * Need to ensure we have good checks to not remove the only admin
 * Cron setup to check once a while
 * Also need to hook the check on every users table update
 * Need a VERY good fallback, there will be a master admin if possible.
 **/