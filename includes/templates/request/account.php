<?php
function magic_user_admin_post_account() {
  magic_require_login();
  $arguments = array (
    'nonce' => 'nonce',
    'ID' => 'user_invalid',
    'display_name' => 'missing_display_name',
    'first_name' => false,
    'last_name' => false,
    'user_url' => false,
  );

  $ctx = magic_parse_arguments( $arguments );

  if ( !wp_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_ACCOUNT_ACTION ) ) {
    $ctx['errors']['nonce'] = true;
  }

  $id = $_POST['ID'];

  $user = get_user_by( 'id', $id );

  if ( (int) $user->ID !== (int) $id ) {
    $ctx['errors']['user_invalid'] = true;
  }

  if ( !empty( $ctx['errors'] ) ) {
    return $ctx;
  }

  $new_user_data = array(
    'ID' => $id,
    'display_name' => $_POST['display_name'],
    'user_url' => $_POST['user_url'],
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
  );

  $update = wp_update_user($new_user_data);

  if (is_wp_error( $update ) ) {
    $ctx['errors']['insert_user'] = true;
  }

  return $ctx;
}
