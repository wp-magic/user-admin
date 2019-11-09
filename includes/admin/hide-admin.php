<?php
/**
 * Disable /wp-admin/* and wp-login.php.
 *
 * Does NOT disable admin-ajax.php and admin-post.php
 *
 * @package MagicUserAdmin
 * @since 0.0.1
 */

add_action(
	'init',
	function () {
		$hide_admin = magic_get_option( MAGIC_USER_ADMIN_SLUG . '_hide_admin', false );

		if ( $hide_admin && ! current_user_can( 'edit_posts' ) ) {
			$request_uri = ! empty( $_SERVER['REQUEST_URI'] ) && sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) );

			$is_login      = stristr( $request_uri, 'wp-login' );
			$is_admin_post = stristr( $request_uri, 'admin-post.php' );
			$is_admin_post = stristr( $request_uri, 'admin-post.php' );
			$is_ajax_post  = stristr( $request_uri, 'admin-ajax.php' );

			if ( $is_admin_post || $is_ajax_post ) {
				return;
			}

			if ( is_admin() || $is_login ) {
				magic_redirect( site_url() );
			}
		}
	}
);
