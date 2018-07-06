<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

require_once 'admin/requirements.php';

require_once 'fallback/index.php';
require_once 'custom-fields/index.php';

$templates = array(
	MAGIC_USER_ADMIN_LOGIN_TEMPLATE => 'Login Page',
	MAGIC_USER_ADMIN_LOGOUT_TEMPLATE  => 'Logout Page',
	MAGIC_USER_ADMIN_REGISTRATION_TEMPLATE => 'Registration Page',
	MAGIC_USER_ADMIN_ACCOUNT_TEMPLATE => 'User Account Page',
);

magic_page_templates($templates, plugin_dir_path( __FILE__ ) . 'templates/' );

require_once 'post/index.php';
// require_once 'shortcodes/login-form.php';

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
