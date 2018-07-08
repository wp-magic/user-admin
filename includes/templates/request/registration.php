<?php

if ( !empty( $_POST['email'] ) ) {
  magic_add_query_arg( ['email' => $_POST['email']] );
}

if ( !empty( $_POST['username'] ) ) {
  magic_add_query_arg( ['username' => $_POST['username']] );
}

magic_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_REGISTRATION_ACTION );

if ( defined( 'MAGIC_GDPR_COOKIE_SLUG' ) ) {
  $cookies = wp_parse_args( $_COOKIE[MAGIC_GDPR_COOKIE_SLUG], MAGIC_GDPR_DEFAULT_COOKIES );

  if ( empty( $_POST['allow_cookies'] ) && empty( $cookies['auth'] ) ) {
    magic_add_query_arg( ['error' => 'cookie'] );
  }
}

if ( !wp_get_current_user() && !isset( $_POST['password'] ) || !isset( $_POST['password2']) || !isset( $_POST['email'] ) ) {
  magic_add_query_arg( ['error' => 'missing_arguments'] );
}

magic_redirect_if_error();

if ( !username_exists( $_POST['email'] ) && !email_exists($_POST['email']) ) {
  if ( $_POST['password'] !== $_POST['password2'] ) {
    magic_add_query_arg( ['error' => 'password_mismatch'] );
  }

  magic_redirect_if_error();

  $username = !empty($_POST['username']) ? $_POST['username'] : $_POST['email'];

  $user_id = wp_create_user( $username, $_POST['password'], $_POST['email'] );
  if ( is_wp_error( $user_id ) ) {
    magic_add_query_arg( ['error' => 'create'] );
  }
} else {
  $user = get_user_by( 'email', $_POST['email'] );

  $valid_password = wp_check_password(
    $_POST['password'],
    $user->data->user_pass,
    $user->ID
  );

  if ( !$valid_password ) {
    magic_add_query_arg( ['error' => 'invalid_password'] );
  }
}

magic_redirect_if_error();

$credentials = array(
  'user_login' => $_POST['email'],
  'user_password' => $_POST['password'],
  'remember' => isset($_POST['remember']) ? $_POST['remember'] : false,
);

$signon = wp_signon( $credentials );

if ( is_wp_error($signon) ) {
  magic_add_query_arg( ['error' => $signon] );
}

magic_redirect_if_error();

wp_redirect( magic_get_option( 'magic_user_admin_login_redirect', '/') );
exit;
