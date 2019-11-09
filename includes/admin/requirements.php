<?php
/**
 * @package    Magic-User-Admin
 * @version    0.0.1
 */

add_action( 'magic_pa_register', 'magic_user_admin_register_required_plugins' );

function magic_user_admin_register_required_plugins() {

	$plugins = array(
		array(
			'name'     => 'Timber',
			'slug'     => 'timber-library',
			'required' => true,
		),

		array(
			'name'     => 'Advanced Custom Fields',
			'slug'     => 'advanced-custom-fields',
			'required' => true,
		),

		array(
			'name'     => 'Advanced Custom Fields: Date and Time Picker',
			'slug'     => 'acf-field-date-time-picker',
			'required' => true,
		),

		array(
			'name'     => 'WP Less',
			'slug'     => 'wp-less',
			'required' => true,
		),
	);
	$config = array(
		'id'           => 'magic_user_admin',         // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                         // Default absolute path to bundled plugins.
		'menu'         => 'magic_pa-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php',              // Parent menu slug.
		'capability'   => 'manage_options',           // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                       // Show admin notices or not.
		'dismissable'  => true,                       // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                         // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                      // Automatically activate plugins after installation or not.
		'message'      => '',                         // Message to output right before the plugins table.
	);

	magic_pa( $plugins, $config );
}
