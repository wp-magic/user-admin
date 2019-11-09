<?php
/**
 * Remove admin bar for all non staff users (subscribers).
 *
 * @package MagicUserAdmin
 * @since 0.0.1
 */

add_action(
	'after_setup_theme',
	function () {
		if ( ! current_user_can( 'delete_posts' ) ) {
			show_admin_bar( false );
		}
	}
);
