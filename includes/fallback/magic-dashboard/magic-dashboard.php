<?php
if ( !function_exists( 'magic_dashboard' ) ) {
  function magic_dashboard() {
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Magic',
        'manage_options',
        'magic-dashboard',
        'magic_dashboard_render',
        'dashicons-carrot',
        25
    );
  }
  add_action( 'admin_menu', 'magic_dashboard' );

  function magic_set_option($name, $value) {
    if (function_exists( 'update_blog_option' ) ) {
      update_blog_option( null, $name, $value );
    } else {
      update_option( $name, $value );
    }
  }

  function magic_get_option($name, $default = '') {
    if (function_exists( 'get_blog_option' ) ) {
      $val = get_blog_option( null, $name );
    } else {
      $val = get_option( $name );
    }
    if (!$val) {
      return $default;
    }

    return $val;
  }

  function magic_dashboard_render() {
    $context = Timber::get_context();

    magic_set_option('magic-setting-1', 'test');

    $context['settings'] = array(
      'setting_1' => magic_get_option('magic-setting-1'),
    );

    Timber::render( 'views/dashboard.twig', $context );
  }

  // }
  // function wpdocs_register_my_setting() {
  //   register_setting( 'my-options-group', 'my-option-name', 'intval' );
  // }
  // add_action( 'admin_init', 'wpdocs_register_my_setting' );
  //
  // // Modify capability
  // function wpdocs_my_page_capability( $capability ) {
  //   return 'edit_others_posts';
  // }
  //
  // add_filter( 'option_page_capability_my-options-group', 'wpdocs_my_page_capability' );
}
