<?php

magic_require_login();

magic_check_arguments( array (
  'nonce' => 'nonce',
  'ID' => 'user_invalid',
  'display_name' => 'missing_display_name',
) );

magic_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_ACCOUNT_ACTION );

magic_add_query_arg( ['display_name' => $_POST['display_name']] );

if ( !empty( $_POST['full_name'] ) ) {
  magic_add_query_arg( ['full_name' => $_POST['full_name']] );
}

if ( !empty( $_POST['url'] ) ) {
  magic_add_query_arg( ['user_url' => $_POST['user_url']] );
}

$id = $_POST['ID'];

$user = get_user_by( 'id', $id );

if ( (int) $user->ID !== (int) $id ) {
  magic_add_query_error( 'user_invalid' );
}

magic_redirect_if_error();

$new_user_data = array(
  'ID' => $id,
  'display_name' => $_POST['display_name'],
  'user_nicename' => $_POST['user_nicename'],
  'user_url' => $_POST['user_url'],
);

$update = wp_update_user($new_user_data);

if (is_wp_error( $update ) ) {
  magic_add_query_error( 'insert' );
}

magic_redirect();
exit;
