<?php

/**
 * Login form context.
 *
 * @package Magic-User-Admin
 * @since   0.0.1
 */


if ( wp_get_current_user()->ID > 0 ) {
  wp_redirect( magic_get_option( 'magic_user_admin_account_page', '/' ) );
  exit;
}

$context = Timber::get_context();

if ( !empty( $_POST ) ) {
  require_once 'request/login.php';
  $context = array_merge( $context, magic_user_admin_post_login() );
}

$context['post'] = new TimberPost();

$context['form'] = array(
  'url' => '',
  'action' => MAGIC_USER_ADMIN_LOGIN_ACTION,
  'nonce' => wp_create_nonce( MAGIC_USER_ADMIN_LOGIN_ACTION ),
);

$context['_REQUEST'] = $_REQUEST;

if ( defined( 'MAGIC_GDPR_SLUG' ) ) {
  $context['cookie_template'] = MAGIC_GDPR_FORM_INPUT_TEMPLATE;
  $context['gdpr_exists'] = true;
  $cookie = $_COOKIE[MAGIC_GDPR_COOKIE_SLUG];
  $enabled_cookies = wp_parse_args( $cookie );
  $context['cookies'] = $enabled_cookies;
  $context['post']->before_allow_cookies_text = magic_get_option( MAGIC_USER_ADMIN_SLUG . '_before_allow_cookies_text', '' );
  $context['post']->after_allow_cookies_text = magic_get_option( MAGIC_USER_ADMIN_SLUG . '_after_allow_cookies_text', 'Allow Login Cookies' );
}

Timber::render( 'views/login.twig', $context );
