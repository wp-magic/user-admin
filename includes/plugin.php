<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

/**
 * Enqueue less css file
 */
require_once 'styles/index.php';

/**
 * Functionality that hides the admin bar from the top of the page.
 */
require_once 'admin/hide-admin-bar.php';

/**
 * Hides wp-admin and wp-login.php
 */
require_once 'admin/hide-admin.php';

/**
 * Include Dashboard if in admin.
 */
if ( is_admin() ) {
	require_once 'admin/dashboard.php';
}

add_action(
	'plugins_loaded',
	function () {
		if ( function_exists( 'magic_page_templates' ) ) {
			$templates = array(
				MAGIC_USER_ADMIN_LOGIN_TEMPLATE        => 'Login Page',
				MAGIC_USER_ADMIN_LOGOUT_TEMPLATE       => 'Logout Page',
				MAGIC_USER_ADMIN_REGISTRATION_TEMPLATE => 'Registration Page',
				MAGIC_USER_ADMIN_ACCOUNT_TEMPLATE      => 'User Account Page',
			);

			magic_page_templates( $templates, plugin_dir_path( __FILE__ ) . 'templates/' );

			require_once 'custom-fields/index.php';
		}
	}
);

add_action(
	'wp_footer',
	function () {
		if ( current_user_can( 'edit_posts' ) ) {
			Timber::render( 'magic-user-admin-link.twig' );
		}
	}
);
