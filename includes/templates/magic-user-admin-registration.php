<?php

/**
 * Registration form context
 *
 * @package  Magic-User-Admin
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
  'action' => MAGIC_USER_ADMIN_REGISTRATION_ACTION,
  'nonce' => wp_create_nonce( MAGIC_USER_ADMIN_REGISTRATION_ACTION ),
);

if ( isset( $_REQUEST['error'] ) ) {
  $context['form']['error'] = $_REQUEST['error'];
}

$context['_REQUEST'] = $_REQUEST;

Timber::render( 'views/registration.twig', $context );
