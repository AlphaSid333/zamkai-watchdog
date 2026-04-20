<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait ZK_Get_Admins {

	public function zk_search_admins() {
		check_ajax_referer( 'zk_search_admins_nonce', 'nonce' );

		$search = isset( $_POST['search'] ) ? sanitize_text_field( $_POST['search'] ) : '';

		$admins = get_users( array(
			'search'         => '*' . $search . '*',
			'search_columns' => array( 'user_login', 'user_email' ),
			'role'           => 'administrator',
			'number'         => 10,
		) );

		$results = array();

		foreach ( $admins as $admin ) {
			$results[] = array(
				'id'           => $admin->ID,
				'display_name' => $admin->display_name,
				'email'        => $admin->user_email,
			);
		}

		wp_send_json_success( $results );
		wp_die();
	}

}
