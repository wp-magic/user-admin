<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

require_once 'styles/index.php';

require_once 'admin/hide-admin-bar.php';
require_once 'admin/hide-admin.php';

if ( is_admin() ) {
	require_once 'admin/dashboard.php';
	require_once 'admin/requirements.php';
}

add_action( 'plugins_loaded', function () {
	if ( function_exists( 'magic_page_templates' ) ) {
		$templates = array(
			MAGIC_USER_ADMIN_LOGIN_TEMPLATE => 'Login Page',
			MAGIC_USER_ADMIN_LOGOUT_TEMPLATE  => 'Logout Page',
			MAGIC_USER_ADMIN_REGISTRATION_TEMPLATE => 'Registration Page',
			MAGIC_USER_ADMIN_ACCOUNT_TEMPLATE => 'User Account Page',
		);

		magic_page_templates($templates, plugin_dir_path( __FILE__ ) . 'templates/' );

		require_once 'custom-fields/index.php';
	}
} );

add_action( 'wp_footer', function () {
  if ( current_user_can( 'edit_posts' ) ) {
		Timber::render( 'magic-user-admin-link.twig' );
	}
} );
