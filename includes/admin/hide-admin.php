<?php

/**
 * Disable /wp-admin/* and wp-login.php.
 *
 * Does NOT disable admin-ajax.php and admin-post.php
 */

add_action(
	'init',
	function () {
		$hide_admin = magic_get_option( MAGIC_USER_ADMIN_SLUG . '_hide_admin', false );

		if ( $hide_admin && ! current_user_can( 'edit_posts' ) ) {
			$is_login      = stristr( $_SERVER['REQUEST_URI'], 'wp-login' );
			$is_admin_post = stristr( $_SERVER['REQUEST_URI'], 'admin-post.php' );
			$is_admin_post = stristr( $_SERVER['REQUEST_URI'], 'admin-post.php' );
			$is_ajax_post  = stristr( $_SERVER['REQUEST_URI'], 'admin-ajax.php' );

			if ( $is_admin_post || $is_ajax_post ) {
				return;
			}

			if ( is_admin() || $is_login ) {
				magic_redirect( site_url() );
				exit;
			}
		}
	}
);
