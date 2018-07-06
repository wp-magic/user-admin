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

$context['post'] = new TimberPost();

$context['form'] = array(
  'url' => esc_url( admin_url('admin-post.php') ),
  'action' => MAGIC_USER_ADMIN_REGISTRATION_ACTION,
  'nonce' => wp_create_nonce( MAGIC_USER_ADMIN_REGISTRATION_ACTION ),
);

if ( defined( 'MAGIC_GDPR_COOKIE_SLUG' ) ) {
  // magic gdpr exists
  $context['gdpr_exists'] = true;
  $enabled_cookies = wp_parse_args( $_COOKIE[MAGIC_GDPR_COOKIE_SLUG] );
  $context['cookies'] = $enabled_cookies;
  $context['post']->before_allow_cookies_text = magic_get_option( MAGIC_USER_ADMIN_SLUG . '_before_allow_cookies_text', '' );
  $context['post']->after_allow_cookies_text = magic_get_option( MAGIC_USER_ADMIN_SLUG . '_after_allow_cookies_text', 'Allow Login Cookies' );
}

if ( isset( $_REQUEST['error'] ) ) {
  $context['form']['error'] = $_REQUEST['error'];
}

$context['_REQUEST'] = $_REQUEST;

Timber::render( 'views/registration.twig', $context );
