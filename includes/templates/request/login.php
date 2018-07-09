<?php

magic_request();

magic_check_arguments( array(
  'email' => 'missing_email',
  'nonce' => 'nonce',
  'password' => 'missing_password',
) );

magic_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_LOGIN_ACTION );

magic_redirect_if_error();

magic_add_query_arg( ['email' => $_POST['email']] );

if ( function_exists( 'magic_gdpr_check_cookies' ) ) {
  magic_gdpr_check_cookies();
}

$credentials = array(
  'user_login' => $_POST['email'],
  'user_password' => $_POST['password'],
  'remember' => isset($_POST['remember']) ? $_POST['remember'] : false,
);

$signon = wp_signon( $credentials );

if ( is_wp_error($signon)) {
  magic_add_query_error( 'user_not_found' );
}

magic_redirect_if_error();

wp_redirect( magic_get_option( 'magic_user_admin_login_redirect', '/' ) );
exit;
