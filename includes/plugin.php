<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

// plugin activation required
require_once 'admin/requirements.php';

require_once 'fallback/custom-fields.php';
require_once 'custom-fields/index.php';

// require_once 'admin/hide-users-by-role.php';

/**
 * Adds admin screens and metaboxes.
 */
// if ( is_admin() ) {
  // Loads for users viewing the WordPress dashboard
  // if ( ! class_exists( 'Magic_Dashboard' ) ) {
    // require plugin_dir_path( __FILE__ ) . 'includes/class-dashboard.php';
  // }
// }

require_once 'fallback/page-templates.php';

$templates = array(
	'magic_user_admin_login.php' => 'Login Page',
	'magic_user_admin_logout.php' => 'Logout Page',
	'magic_user_admin_registration.php' => 'Registration Page',
	'magic_user_admin_profile.php' => 'User Profile Page',
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
add_action( 'admin_menu', 'magic_user_admin_dashboard' );

require_once 'styles/index.php';
add_action( 'wp_enqueue_scripts', 'magic_user_admin_enqueue_styles' );


add_action('after_setup_theme', function () {
  if ( ! current_user_can( 'delete_posts' ) ) {
    show_admin_bar(false);
  }
});

/**
 * Load the plugin text domain for translation.
 *
 * @since 0.0.1
 */
add_action( 'init', function () {
  $domain = 'appointment_post_type';
  load_plugin_textdomain( $domain, FALSE, plugin_dir_path( __FILE__ ) . '/languages' );
} );
