<?php

function magic_user_admin_login_form_check() {
  if( !wp_verify_nonce( $_POST['nonce'], 'magic_user_admin_login' ) ) {
    return 'nonce';
  }

  if ( !wp_get_current_user() && !isset( $_POST['password'] ) || !isset( $_POST['email'] ) ) {
    return 'invalid';
  }
}

function magic_user_admin_login_form() {
  $ref = $_SERVER['HTTP_REFERER'];

  if( !wp_verify_nonce( $_POST['nonce'], 'magic_user_admin_login' ) ) {
    $error = 'nonce';
  } else if ( !wp_get_current_user() && !isset( $_POST['password'] ) || !isset( $_POST['email'] ) ) {
    $error = 'invalid';
  }

  if ( !empty( $error ) ) {
    wp_redirect( add_query_arg( 'error', $error, $ref ) );
    exit;
  }

  if ( !username_exists( $_POST['email'] ) && !email_exists($_POST['email']) ) {
    $refs = magic_get_option( 'magic_user_admin_registration_page', '/register');
    $refs = add_query_arg( 'email', $_POST['email'], $refs );
    $refs = add_query_arg( 'error', 'noexist', $refs );
    wp_redirect( $refs );
    exit;
  }

  $credentials = array(
    'user_login' => $_POST['email'],
    'user_password' => $_POST['password'],
    'remember' => isset($_POST['remember']) ? $_POST['remember'] : false,
  );

  $signon = wp_signon( $credentials );

  if ( is_wp_error($signon)) {
    if ( isset($signon->errors['incorrect_password'] ) ) {
      $error = 'incorrect_password';
    }
    $refs = magic_get_option( 'magic_user_admin_login_page', '/login');

    $refs = add_query_arg( 'error', $error, $refs );

    if ( !empty( $_POST['email'] ) ) {
      $refs = add_query_arg( 'email', $_POST['email'], $refs );
    }

    wp_redirect( $refs );
    exit;
  }

  wp_redirect( magic_get_option( 'magic_user_admin_login_redirect', '/') );
  exit;
}
