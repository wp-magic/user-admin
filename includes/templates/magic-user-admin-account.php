<?php

/**
 * Login form context.
 *
 * @package Magic-User-Admin
 * @since   0.0.1
 */

magic_require_login();

$context = Timber::get_context();

if ( !empty( $_POST ) ) {
  require_once 'request/account.php';
  $context = array_merge( $context, magic_user_admin_post_account() );
}

$context['post'] = new TimberPost();

$user_id = get_current_user_id();
$context['user'] = get_userdata( $user_id );

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
