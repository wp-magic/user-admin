<?php
/**
 * Login form context.
 *
 * @package Magic-User-Admin
 * @since   0.0.1
 */

/**
 * Redirect user to account page if logged in.
 */
if ( wp_get_current_user()->ID > 0 ) {
	magic_redirect( magic_get_option( 'magic_user_admin_account_page', '/' ) );
}

$context = Timber::get_context();

$request = magic_verify_nonce( MAGIC_USER_ADMIN_LOGIN_ACTION );

if ( ! empty( $request ) ) {
	require_once 'request/login.php';
	$context = array_merge( $context, magic_user_admin_post_login() );
}

$context['post'] = new TimberPost();

$context['form'] = array(
	'url'    => '',
	'action' => MAGIC_USER_ADMIN_LOGIN_ACTION,
	'nonce'  => wp_create_nonce( MAGIC_USER_ADMIN_LOGIN_ACTION ),
);


if ( function_exists( 'magic_gdpr_create_context' ) ) {
	$context = magic_gdpr_create_context( $context );
}

Timber::render( 'views/login.twig', $context );
