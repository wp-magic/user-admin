<?php

/**
 * Login form context.
 *
 * @package Magic-User-Admin
 * @since   0.0.1
 */


$user = wp_get_current_user();

if ( $user->ID == 0 ) {
  wp_redirect( magic_get_option( 'magic_user_admin_login_page', '/' ) );
  exit;
}

if ( !empty( $_POST ) ) {
  require_once 'request/account.php';

  exit;
}

$context = Timber::get_context();

$context['post'] = new TimberPost();

$context['user'] = $user;

if ( $context['post']->use_gravatar ) {
  $context['user']->avatar = get_avatar_url( $user->user_email );
}

$context['form'] = array(
  'url' => '',
  'action' => MAGIC_USER_ADMIN_ACCOUNT_ACTION,
  'nonce' => wp_create_nonce( MAGIC_USER_ADMIN_ACCOUNT_ACTION ),
);

$context['_REQUEST'] = $_REQUEST;

Timber::render( 'views/account.twig', $context );
