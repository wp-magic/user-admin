<?php

add_action( 'admin_post_nopriv_magic_user_admin_login', 'magic_user_admin_login_form' );
add_action( 'admin_post_magic_user_admin_login', 'magic_user_admin_login_form' );

function magic_user_admin_login_form() {
  $ref = $_SERVER['HTTP_REFERER'];

  if( !wp_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_LOGIN_ACTION ) ) {
    $error = 'nonce';
  } else if ( !wp_get_current_user() && !isset( $_POST['password'] ) || !isset( $_POST['email'] ) ) {
    $error = 'invalid';
  }

  if ( defined( 'MAGIC_GDPR_COOKIE_SLUG' ) ) {
    $cookies = wp_parse_args( $_COOKIE[MAGIC_GDPR_COOKIE_SLUG], MAGIC_GDPR_DEFAULT_COOKIES );

    if ( empty( $_POST['allow_cookies'] ) && empty( $cookies['auth'] ) ) {
      $error = 'cookie';
    }
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

    $ref = add_query_arg( 'error', $error, $ref );

    if ( !empty( $_POST['email'] ) ) {
      $ref = add_query_arg( 'email', $_POST['email'], $ref );
    }

    wp_redirect( $ref );
    exit;
  }

  if ( function_exists( 'magic_gdpr_set_cookies' ) && isset( $_POST['allow_cookies'] ) ) {
    magic_gdpr_set_cookies( array('settings', 'auth') );
  }

  wp_redirect( magic_get_option( 'magic_user_admin_login_redirect', '/' ) );
  exit;
}
