<?php
/**
 * Enqueue the css file
 *
 * @package MagicUserAdmin
 * @since 0.0.1
 */

add_action(
	'wp_enqueue_scripts',
	function () {
		magic_register_style( 'magic-user-admin', dirname( plugin_basename( __FILE__ ) ) );
	}
);
