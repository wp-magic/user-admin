<?php

/**
 * Registration form context
 *
 * @package  Magic-User-Admin
 * @since   0.0.1
 */

if ( wp_get_current_user()->ID > 0 ) {
	wp_redirect( magic_get_option( 'magic_user_admin_account_page', '/' ) );
	exit;
}

$context = Timber::get_context();

if ( ! empty( $_POST ) ) {
	require_once 'request/registration.php';
	$context = array_merge( $context, magic_user_admin_post_registration() );
}

$context['post'] = new TimberPost();

$context['form'] = array(
	'url'    => '',
	'action' => MAGIC_USER_ADMIN_REGISTRATION_ACTION,
	'nonce'  => wp_create_nonce( MAGIC_USER_ADMIN_REGISTRATION_ACTION ),
);

if ( function_exists( 'magic_gdpr_create_context' ) ) {
	$context = magic_gdpr_create_context( $context );
}

Timber::render( 'views/registration.twig', $context );
