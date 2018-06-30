<?php
/**
 * Appointment Post Type
 *
 * @package   Magic_Appointment_Post_Type
 * @license   GPL-2.0+
 */

// plugin activation required
require_once 'admin/requirements.php';

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

/**
 * Registration of CPT and related taxonomies.
 *
 * @since 0.0.1
 */
class Magic_User_Management {

  /**
   * Plugin version, used for cache-busting of style and script file references.
   *
   * @since 0.0.1
   *
   * @var string VERSION Plugin version.
   */
  const VERSION = '0.0.1';

  /**
   * Unique identifier for your plugin.
   *
   * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
   * match the Text Domain file header in the main plugin file.
   *
   * @since 0.0.1
   *
   * @var string
   */
  const PLUGIN_SLUG = 'appointment-post-type';

  /**
   * Unique identifier for the added user role.
   *
   * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
   * match the Text Domain file header in the main plugin file.
   *
   * @since 0.0.1
   *
   * @var string
   */
  const USER_ROLE_SLUG = 'customer';

  /**
   * Initialize the plugin by setting localization and new site activation hooks.
   *
   * @since 0.0.1
   */
  public function __construct(  ) {

    require_once 'fallback/page-templates.php';

    $templates = array(
			'templates/login.php' => 'Login Page',
			'templates/logout.php' => 'Logout Page',
			'templates/registration.php' => 'Registration Page',
			'templates/profile.php' => 'User Profile Page',
		);

    $page_templates = new Magic_User_Admin_PageTemplates($templates);

    add_action( 'plugins_loaded', array( $page_templates, 'add_filters' ) );

    // Load plugin text domain
    add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

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
  }

  /**
   * Fired for each blog when the plugin is activated.
   *
   * @since 0.0.1
   */
  public function activate() {
    flush_rewrite_rules();
  }

  /**
   * Fired for each blog when the plugin is deactivated.
   *
   * @since 0.0.1
   */
  public function deactivate() {
    flush_rewrite_rules();
  }

  /**
   * Returns an instance of this class.
   */
  public static function get_instance() {

  	if( null == self::$instance ) {
  		self::$instance = new PageTemplater();
  	}

  	return self::$instance;

  }

  /**
   * Load the plugin text domain for translation.
   *
   * @since 0.0.1
   */
  public function load_plugin_textdomain() {
    $domain = self::PLUGIN_SLUG;
    load_plugin_textdomain( $domain, FALSE, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages' );
  }
}
