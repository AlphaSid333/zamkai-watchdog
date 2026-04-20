<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ZAMKAI_WATCHDOG_PATH . 'admin/get admins/zk-get-admins.php';

class ZK_Watchdog_Admin {

	use ZK_Get_Admins;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'register_menus' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'wp_ajax_zk_search_admins', array( $this,'zk_search_admins') );
	}

	public function register_menus() {
		add_menu_page(
			'Zamkai Watchdog',
			'Zamkai Watchdog',
			'manage_options',
			'zamkai-watchdog',
			array( $this, 'render_main_page' ),
			'dashicons-shield',
			80
		);

		add_submenu_page(
			'zamkai-watchdog',
			'Trusted Admins',
			'Trusted Admins',
			'manage_options',
			'zamkai-wd-trusted-admins',
			array( $this, 'render_trusted_admins_page' )
		);
	}

	public function render_main_page() {
	}

	public function render_trusted_admins_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

		$template = ZAMKAI_WATCHDOG_PATH . 'admin/templates/trusted-admins-menu.php';

		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	public function enqueue_admin_styles( $hook_suffix ) {
		if ( $hook_suffix === 'zamkai-watchdog_page_zamkai-wd-trusted-admins' ) {
			wp_enqueue_script(
				'zk-get-admin',
				ZAMKAI_WATCHDOG_URL . 'admin/get admins/zk-get-admin.js',
				array(),
				'1.0.0',
				true
			);

			wp_localize_script(
				'zk-get-admin',
				'zkWatchdog',
				array(
					'ajaxUrl' => admin_url( 'admin-ajax.php' ),
					'nonce'   => wp_create_nonce( 'zk_search_admins_nonce' ),
				)
			);
		}
	}

}

new ZK_Watchdog_Admin();
