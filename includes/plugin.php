<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

require_once 'admin/requirements.php';

require_once 'fallback/custom-fields.php';
require_once 'custom-fields/index.php';

require_once 'fallback/page-templates.php';

$templates = array(
	MAGIC_USER_ADMIN_LOGIN_TEMPLATE => 'Login Page',
	MAGIC_USER_ADMIN_LOGOUT_TEMPLATE  => 'Logout Page',
	MAGIC_USER_ADMIN_REGISTRATION_TEMPLATE => 'Registration Page',
	MAGIC_USER_ADMIN_ACCOUNT_TEMPLATE => 'User Account Page',
);

magic_page_templates($templates, plugin_dir_path( __FILE__ ) . 'templates/' );

require_once 'post/login.php';
add_action( 'admin_post_nopriv_magic_user_admin_login', 'magic_user_admin_login_form' );
add_action( 'admin_post_magic_user_admin_login', 'magic_user_admin_login_form' );

require_once 'post/registration.php';
add_action( 'admin_post_nopriv_magic_user_admin_registration', 'magic_user_admin_registration_form' );
add_action( 'admin_post_magic_user_admin_registration', 'magic_user_admin_registration_form' );

require_once 'post/profile.php';
add_action( 'admin_post_nopriv_magic_user_admin_profile', 'magic_user_admin_profile_form' );
add_action( 'admin_post_magic_user_admin_profile', 'magic_user_admin_profile_form' );

require_once 'shortcodes/login-form.php';
add_shortcode( 'magic-login-form', 'magic_user_admin_login_form_shortcode' );

require_once 'fallback/magic-dashboard/magic-dashboard.php';

require_once 'admin/dashboard.php';

require_once 'styles/index.php';

add_action('after_setup_theme', function () {
  if ( ! current_user_can( 'delete_posts' ) ) {
    show_admin_bar(false);
  }
});

add_action( 'init', function () {
  $domain = 'appointment_post_type';
  load_plugin_textdomain( $domain, FALSE, plugin_dir_path( __FILE__ ) . '/languages' );
} );
