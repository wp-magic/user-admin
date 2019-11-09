<?php
/**
 * Actual post request handler for login post request.
 *
 * @package MagicUserAdmin
 * @since 0.0.1
 */

/**
 * Register user, then login, then redirect user.
 * Also checks magic-gdpr cookies.
 *
 * @since 0.0.1
 */
function magic_user_admin_post_registration() {
	$ctx = magic_parse_arguments(
		array(
			'log'           => 'missing_email',
			'pwd'           => 'missing_password',
			'pwd2'          => 'missing_password2',
			'nonce'         => MAGIC_USER_ADMIN_REGISTRATION_ACTION,
			'username'      => false,
			'allow_cookies' => false,
			'rememberme'    => false,
			'first_name'    => false,
			'last_name'     => false,
		)
	);

	if ( ! empty( $ctx['errors'] ) ) {
		return $ctx;
	}

	if ( defined( 'MAGIC_GDPR_SLUG' ) ) {
		if ( 'on' === $ctx['query']['allow_cookies'] ) {
			magic_gdpr_set_cookies( array( 'settings', 'auth' ) );
		} elseif ( ! magic_gdpr_check_cookies() ) {
			$ctx['errors'][] = 'cookie';
		}
	}

	if ( ! empty( $ctx['errors'] ) ) {
		return $ctx;
	}

	$email_without_host = explode( '@', $ctx['query']['log'] )[0];
	if ( empty( $ctx['query']['username'] ) ) {
		$ctx['query']['username'] = $email_without_host;
	}

	if ( ! email_exists( $ctx['query']['log'] ) ) {
		if ( username_exists( $ctx['query']['username'] ) ) {
			$ctx['errors'][] = 'username_exists';
		}
		if ( $ctx['query']['pwd'] !== $ctx['query']['pwd2'] ) {
			$ctx['errors'][] = 'mismatch_password';
		}

		$user_id = wp_create_user( $ctx['query']['username'], $ctx['query']['pwd'], $ctx['query']['log'] );

		if ( is_wp_error( $user_id ) ) {
			$ctx['errors'][] = 'create';
		}
	}

	if ( ! empty( $ctx['errors'] ) ) {
		return $ctx;
	}

	$signon = wp_signon();

	if ( is_wp_error( $signon ) ) {
		$ctx['errors'][] = 'create';
	}

	if ( ! empty( $ctx['errors'] ) ) {
		return $ctx;
	}

	magic_redirect( magic_get_option( 'magic_user_admin_registration_redirect', '/' ) );
}
