<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wrap">
	<h1><?php esc_html_e( 'Trusted Admins', 'zamkai-watchdog' ); ?></h1>

	<!-- Add a Trusted Admin -->
	<div class="card" style="max-width: 600px; margin-bottom: 20px;">
		<h2><?php esc_html_e( 'Add a trusted admin', 'zamkai-watchdog' ); ?></h2>
		<form method="post" action="">
			<?php wp_nonce_field( 'add_trusted_admin', 'trusted_admin_nonce' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row">
						<label for="trusted-admin-search"><?php esc_html_e( 'Search bar', 'zamkai-watchdog' ); ?></label>
					</th>
					<td>
						<input
							type="search"
							id="trusted-admin-search"
							name="trusted_admin_search"
							class="regular-text"
							placeholder="<?php esc_attr_e( 'Search by name or email&hellip;', 'zamkai-watchdog' ); ?>"
						/>
						<button type="submit" class="button button-primary" style="margin-left: 6px;">
							<?php esc_html_e( 'Add', 'zamkai-watchdog' ); ?>
						</button>
					</td>
				</tr>
			</table>
		</form>
	</div>

	<!-- Trusted Admins Table -->
	<table class="wp-list-table widefat fixed striped">
		<thead>
			<tr>
				<th scope="col"><?php esc_html_e( 'User ID', 'zamkai-watchdog' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Username', 'zamkai-watchdog' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Email', 'zamkai-watchdog' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Date Added', 'zamkai-watchdog' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="4" style="text-align: center; padding: 20px;">
					<?php esc_html_e( 'No trusted admins added yet.', 'zamkai-watchdog' ); ?>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<th scope="col"><?php esc_html_e( 'User ID', 'zamkai-watchdog' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Username', 'zamkai-watchdog' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Email', 'zamkai-watchdog' ); ?></th>
				<th scope="col"><?php esc_html_e( 'Date Added', 'zamkai-watchdog' ); ?></th>
			</tr>
		</tfoot>
	</table>
</div>
