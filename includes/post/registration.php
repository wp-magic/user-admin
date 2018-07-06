<?php

add_action( 'admin_post_nopriv_magic_user_admin_registration', 'magic_user_admin_registration_form' );
add_action( 'admin_post_magic_user_admin_registration', 'magic_user_admin_registration_form' );

function magic_user_admin_registration_form() {
  $ref = $_SERVER['HTTP_REFERER'];

  if ( !empty( $_POST['email'] ) ) {
    $ref = add_query_arg( 'email', $_POST['email'], $ref );
  }

  if( !wp_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_REGISTRATION_ACTION ) ) {
    $error = 'nonce';
  } else if ( defined( 'MAGIC_GDPR_COOKIE_SLUG' ) ) {
    $cookies = wp_parse_args( $_COOKIE[MAGIC_GDPR_COOKIE_SLUG], MAGIC_GDPR_DEFAULT_COOKIES );

    if ( empty( $_POST['allow_cookies'] ) && empty( $cookies['auth'] ) ) {
      $error = 'cookie';
    }
  } else if ( !wp_get_current_user() && !isset( $_POST['password'] ) || !isset( $_POST['password2']) || !isset( $_POST['email'] ) ) {
    $error = 'invalid';
  }

  if ( !username_exists( $_POST['email'] ) && !email_exists($_POST['email']) ) {
    if ( $_POST['password'] != $_POST['password2'] ) {
      wp_redirect( add_query_arg( 'error', 'password_mismatch', $ref ) );
      exit;
    }

    $username = !empty($_POST['username']) ? $_POST['username'] : $_POST['email'];

    $user_id = wp_create_user( $username, $_POST['password'], $_POST['email'] );
    if ( is_wp_error( $user_id ) ) {
      $error = 'create';
    }
  } else {
    $user = get_user_by( 'email', $_POST['email'] );

    $checked = wp_check_password( $_POST['password'], $user->data->user_pass, $user->ID );
    if (!$checked) {
      $error = 'invalid_password';
    }
  }

  if ( $error ) {
    $ref = add_query_arg( 'error', $error, $ref );
    wp_redirect( $ref );
    exit;
  }

  $credentials = array(
    'user_login' => $_POST['email'],
    'user_password' => $_POST['password'],
    'remember' => isset($_POST['remember']) ? $_POST['remember'] : false,
  );

  $signon = wp_signon( $credentials );

  if ( is_wp_error($signon) ) {
    wp_redirect( add_query_arg( 'error', $signon, $ref ) );
    exit;
  }

  wp_redirect( magic_get_option( 'magic_user_admin_login_redirect', '/') );
}
