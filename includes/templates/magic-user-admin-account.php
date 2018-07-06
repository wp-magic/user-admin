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

$context = Timber::get_context();

$context['post'] = new TimberPost();

$context['user'] = $user;

$context['user']->avatar = get_avatar_url( $user->user_email );

$context['form'] = array(
  'url' => esc_url( admin_url('admin-post.php') ),
  'action' => MAGIC_USER_ADMIN_PROFILE_ACTION,
  'nonce' => wp_create_nonce( MAGIC_USER_ADMIN_PROFILE_ACTION ),
);

if ( isset( $_REQUEST['error'] ) ) {
  $context['form']['error'] = $_REQUEST['error'];
}

Timber::render( 'views/account.twig', $context );
