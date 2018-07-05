<?php

add_action( 'admin_menu', function () {
  $title = 'Magic User Admin Settings';

  $settings = array(
    array(
      'name' => 'page_header',
      'type' => 'header',
      'value' => 'Page urls',
      'label' => 'Where page templates are registered in your child theme',
    ),
    array(
      'name' => 'magic_user_admin_login_page',
      'type' => 'text',
      'default' => '/login',
      'label' => 'Login Page',
    ),
    array(
      'name' => 'magic_user_admin_registration_page',
      'type' => 'text',
      'default' => '/register',
      'label' => 'Registration Page',
    ),
    array(
      'name' => 'magic_user_admin_logout_page',
      'type' => 'text',
      'default' => '/logout',
      'label' => 'Logout Page',
    ),
    array(
      'name' => 'magic_user_admin_profile_page',
      'type' => 'text',
      'default' => '/profile',
      'label' => 'Profile Page',
    ),

    array(
      'name' => 'redirect_header',
      'type' => 'header',
      'value' => 'Redirect urls',
      'label' => 'Where the user gets redirected after certain actions',
    ),
    array(
      'name' => 'magic_user_admin_login_redirect',
      'type' => 'text',
      'default' => '/',
      'label' => 'Login Redirect',
    ),
    array(
      'name' => 'magic_user_admin_registration_redirect',
      'type' => 'text',
      'default' => '/',
      'label' => 'Registration Redirect',
    ),
    array(
      'name' => 'magic_user_admin_logout_redirect',
      'type' => 'text',
      'default' => '/',
      'label' => 'Logout Redirect',
    ),
  );

  magic_dashboard_add_submenu_page( array (
    'link' => 'User Admin',
    'slug' => MAGIC_USER_ADMIN_SLUG,
    'title' => $title,
    'settings' => $settings,
  ) );
} );
