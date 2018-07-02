<?php

/**
 * Login form context.
 *
 * @package Magic-User-Admin
 * @since   0.0.1
 */

if ( wp_get_current_user()->ID > 0 ) {
  wp_redirect( magic_get_option( 'magic_user_admin_profile_page', '/' ) );
  exit;
}

$context = Timber::get_context();

$context['post'] = new TimberPost();

$context['form'] = array(
  'url' => esc_url( admin_url('admin-post.php') ),
  'action' => 'magic_user_admin_login',
  'nonce' => wp_create_nonce('magic_user_admin_login'),
);

$context['_REQUEST'] = $_REQUEST;

if ( isset( $_REQUEST['error'] ) ) {
  $context['form']['error'] = $_REQUEST['error'];
}

Timber::render( 'views/login.twig', $context );
