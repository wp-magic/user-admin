<?php

function magic_user_admin_profile_form() {
  $ref = $_SERVER['HTTP_REFERER'];

  if ( !wp_get_current_user()->ID ) {
    wp_redirect('/login');
    exit;
  }

  if( !wp_verify_nonce( $_POST['nonce'], MAGIC_USER_ADMIN_PROFILE_ACTION ) ) {
    wp_redirect( add_query_arg( 'error', 'nonce', $ref ) );
    exit;
  }

  $user = get_user_by( 'id', $_POST['ID'] );

  if ($user->ID != $_POST['ID'] ) {
    wp_redirect( add_query_arg( 'error', 'invalid', $ref ) );
    exit;
  }

  $new_user_data = array(
    'ID' => $_POST['ID'],
    'display_name' => $_POST['display_name'],
    'user_nicename' => $_POST['user_nicename'],
    'user_url' => $_POST['user_url'],
  );

  $update = wp_update_user($new_user_data);

  if (is_wp_error( $update ) ) {
    wp_redirect( add_query_arg( 'error', 'update', $ref ) );
    exit;
  }

  wp_redirect( $ref );
}
