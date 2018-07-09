<?php

magic_check_arguments( array (
  'email' => 'missing_email',
  'password' => 'missing_password',
  'password2' => 'missing_password2',
  'nonce' => 'nonce',
) );

magic_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_REGISTRATION_ACTION );

magic_add_query_arg( ['email' => $_POST['email']] );
magic_add_query_arg( ['username' => $_POST['username']] );

if ( function_exists( 'magic_gdpr_check_cookies' ) ) {
  magic_gdpr_check_cookies();
}

magic_redirect_if_error();

if ( empty( $_POST['username'] ) ) {
  $_POST['username'] = $_POST['email'];
}

if ( !username_exists( $_POST['username'] ) && !email_exists( $_POST['email'] ) ) {
  if ( $_POST['password'] !== $_POST['password2'] ) {
    magic_add_query_error( 'mismatch_password' );
  }

  magic_redirect_if_error();

  $username = !empty($_POST['username']) ? $_POST['username'] : $_POST['email'];

  $user_id = wp_create_user( $username, $_POST['password'], $_POST['email'] );
  if ( is_wp_error( $user_id ) ) {
    magic_add_query_error( 'create' );
  }
} else {
  $user = get_user_by( 'email', $_POST['email'] );
  if ( $user->ID === 0 ) {
    $user = get_user_by( 'username', $_POST['email'] );
  }

  $valid_password = wp_check_password(
    $_POST['password'],
    $user->data->user_pass,
    $user->ID
  );

  if ( !$valid_password ) {
    magic_add_query_error( 'create' );
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
  magic_add_query_error( 'create' );
}

magic_redirect_if_error();

wp_redirect( magic_get_option( 'magic_user_admin_registration_redirect', '/') );
exit;
