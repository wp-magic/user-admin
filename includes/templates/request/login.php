<?php
function magic_user_admin_post_login() {
  $ctx = magic_parse_arguments( array(
    'nonce' => MAGIC_USER_ADMIN_LOGIN_ACTION,
    'log' => 'missing_email',
    'pwd' => 'missing_password',
    'allow_cookies' => false,
    'rememberme' => false,
  ) );

  if ( !empty( $ctx['errors'] ) ) {
    return $ctx;
  }

  $signon = wp_signon();

  if ( is_wp_error($signon)) {
    $ctx['errors'][] = 'user_not_found';
  }

  if ( !empty( $ctx['errors'] ) ) {
    return $ctx;
  }

  wp_redirect( magic_get_option( 'magic_user_admin_login_redirect', '/' ) );
  exit;
}
