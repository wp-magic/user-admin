<?php

function magic_user_admin_settings_field( array $args ) {
    $type    = $args['type'] || 'text';
    $id      = $args['id'] || '';
    $default = $args['default'] || '';

    $data   = get_option( $id, $default );
    $value  = esc_attr($data);

    print "<input type='$type' value='$value' name='$id' id='$id' />";
}

function magic_user_admin_dashboard() {
  add_submenu_page(
    'magic-dashboard',
    'User Admin',
    'User Admin',
    'manage_options',
    'magic_user_admin',
    'magic_user_admin_dashboard_render'
  );
}


function magic_user_admin_dashboard_create_settings( array $settings ) {
  $conf = array();
  foreach ( $settings as $setting ) {
    $name = $setting['name'];
    $conf[$name] = $setting;
    $conf[$name]['value'] = magic_get_option( $name );
  }

  return $conf;
}

function magic_user_admin_dashboard_render() {
  $settings = array(
    array(
      'name' => 'magic_user_admin_login_page',
      'type' => 'text',
      'default' => '/login',
      'label' => 'Login Page',
    ),
    array(
      'name' => 'magic_user_admin_login_redirect',
      'type' => 'text',
      'default' => '/',
      'label' => 'Login Redirect',
    ),
    array(
      'name' => 'magic_user_admin_registration_page',
      'type' => 'text',
      'default' => '/register',
      'label' => 'Registration Page',
    ),
    array(
      'name' => 'magic_user_admin_registration_redirect',
      'type' => 'text',
      'default' => '/',
      'label' => 'Registration Redirect',
    ),
    array(
      'name' => 'magic_user_admin_logout_page',
      'type' => 'text',
      'default' => '/logout',
      'label' => 'Logout Page',
    ),
    array(
      'name' => 'magic_user_admin_logout_redirect',
      'type' => 'text',
      'default' => '/',
      'label' => 'Logout Redirect',
    ),
    array(
      'name' => 'magic_user_admin_profile_page',
      'type' => 'text',
      'default' => '/profile',
      'label' => 'Profile Page',
    ),
  );

  $context = Timber::get_context();

  if ($_POST) {
    foreach ( $settings as $setting ) {
      $name = $setting['name'];
      if ( isset( $_POST[$name] ) ) {
        $value = $_POST[$name];
        if ( $value == '') {
          $value = '/';
        }

        magic_set_option( $name, $value );
      }
    }
  }

  $context['settings'] = magic_user_admin_dashboard_create_settings( $settings );

  Timber::render( 'views/dashboard.twig', $context );
}
