<?php

if ( !empty( $_POST['email'] ) ) {
  magic_add_query_arg( ['email' => $_POST['email']] );
}

if ( !empty( $_POST['allow_cookies'] ) ) {
  magic_add_query_arg( ['allow_cookies' => 1] );
}

magic_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_LOGIN_ACTION );

if ( defined( 'MAGIC_GDPR_COOKIE_SLUG' ) ) {
  $cookies = wp_parse_args( $_COOKIE[MAGIC_GDPR_COOKIE_SLUG], MAGIC_GDPR_DEFAULT_COOKIES );

  if ( empty( $_POST['allow_cookies'] ) ) {
    magic_add_query_arg( ['error' => 'cookie'] );
  } else {
    magic_gdpr_set_cookies( array('settings', 'auth') );
  }
}

if ( !wp_get_current_user() && !isset( $_POST['password'] ) || !isset( $_POST['email'] ) ) {
  magic_add_query_arg( ['error' => 'missing_arguments'] );
} else if ( !username_exists( $_POST['email'] ) && !email_exists( $_POST['email'] ) ) {
  magic_add_query_arg( ['error' => 'noexist'] );
}

magic_redirect_if_error();

$credentials = array(
  'user_login' => $_POST['email'],
  'user_password' => $_POST['password'],
  'remember' => isset($_POST['remember']) ? $_POST['remember'] : false,
);

$signon = wp_signon( $credentials );

if ( is_wp_error($signon)) {
  if ( isset($signon->errors['incorrect_password'] ) ) {
    magic_add_query_arg( ['error' => 'password'] );
  }

  magic_add_query_arg( 'error', $error, $ref );

  if ( !empty( $_POST['email'] ) ) {
    $ref = add_query_arg( 'email', $_POST['email'], $ref );
  }
}


magic_redirect_if_error();

wp_redirect( magic_get_option( 'magic_user_admin_login_redirect', '/' ) );
exit;
