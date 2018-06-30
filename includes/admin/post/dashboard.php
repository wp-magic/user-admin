<?php

function magic_user_admin_login_form() {
  if ( !current_user_can( 'manage_options') ) {
    $error = "authorization";
  } else if ( !wp_verify_nonce( $_POST['nonce'], 'magic_user_admin_login' ) ) {
    $error = 'nonce';
  } //else if ( !isset( $_POST['password'] ) || !isset( $_POST['email'] ) ) {
    //$error = 'invalid';
  //}

  if ( $error ) {
    wp_redirect( add_query_arg( 'error', $error, $_SERVER['HTTP_REFERER'] ) );
    exit;
  }

  print_r($_POST);
}
