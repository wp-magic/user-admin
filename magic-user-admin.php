<?php
/**
 * User Management
 *
 * @package   Magic-User-Management
 * @license   GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Magic User Management
 * Plugin URI:
 * Description: user management. very opinionated.
 * Version:     0.0.1
 * Author:      Jascha Ehrenreich
 * Author URI:  http://github.com/wp-magic
 * Text Domain: magic-user-manage
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

define( 'MAGIC_USER_ADMIN_SLUG', 'magic_user_admin' );

// Required files for registering the post type and taxonomies.
require_once plugin_dir_path( __FILE__ ) . 'includes/plugin.php';

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, function () {
  flush_rewrite_rules();
} );
register_deactivation_hook( __FILE__, function () {
  flush_rewrite_rules();
} );
