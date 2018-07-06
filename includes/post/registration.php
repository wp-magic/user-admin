<?php

function magic_user_admin_registration_form() {
  $ref = $_SERVER['HTTP_REFERER'];

  if ( !empty( $_POST['email'] ) ) {
    $ref = add_query_arg( 'email', $_POST['email'], $ref );
  }

  if( !wp_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_REGISTRATION_ACTION ) ) {
    wp_redirect( add_query_arg( 'error', 'nonce', $ref ) );
    exit;
  }

  if ( !wp_get_current_user() && !isset( $_POST['password'] ) || !isset( $_POST['password2']) || !isset( $_POST['email'] ) ) {
    wp_redirect( add_query_arg( 'error', 'invalid', $ref ) );
    exit;
  }

  if ( !username_exists( $_POST['email'] ) && !email_exists($_POST['email']) ) {
    if ( $_POST['password'] != $_POST['password2'] ) {
      wp_redirect( add_query_arg( 'error', 'password_mismatch', $ref ) );
      exit;
    }

    $user_id = wp_create_user( $_POST['email'], $_POST['password'], $_POST['email'] );
    if ( is_wp_error( $user_id ) ) {
      wp_redirect( add_query_arg('error', 'create', $ref ) );
      exit;
    }
  } else {
    $user = get_user_by( 'email', $_POST['email'] );

    $checked = wp_check_password( $_POST['password'], $user->data->user_pass, $user->ID );
    if (!$checked) {
      wp_redirect( add_query_arg( 'error', 'invalid_password', $ref ) );
      exit;
    }
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
