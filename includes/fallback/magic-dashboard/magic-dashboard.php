<?php

if ( !defined( 'MAGIC_DASHBOARD_SLUG' ) ) {
  define( 'MAGIC_DASHBOARD_SLUG', 'magic_dashboard' );
}

if ( !function_exists( 'magic_dashboard' ) ) {
  function magic_dashboard() {
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Magic',
        'manage_options',
        MAGIC_DASHBOARD_SLUG,
        'magic_dashboard_render',
        'dashicons-carrot',
        25
    );
  }
  add_action( 'admin_menu', 'magic_dashboard' );
}

if ( !function_exists( 'magic_dashboard_render' ) ) {
  function magic_dashboard_render() {
    $context = Timber::get_context();

    Timber::render( 'views/dashboard.twig', $context );
  }
}

if ( !function_exists( 'magic_dashboard_add_submenu_page' ) ) {
  function magic_dashboard_add_submenu_page( array $atts = [] ) {
    $default = array (
      'capability' => 'manage_options',
      'link' => 'Magic Admin Panel',
      'title' => 'Magic Admin Panel',
      'slug' => 'magic_admin_panel',
      'settings' => [],
    );

    $atts = shortcode_atts( $default, $atts );

    add_submenu_page(
      MAGIC_DASHBOARD_SLUG,
      $atts['link'],
      $atts['link'],
      $atts['capability'],
      $atts['slug'],
      function() use ( $atts ) {
        magic_dashboard_render_admin_page( $atts['title'], $atts['settings'] );
      }
    );
  }
}

if ( !function_exists( 'magic_dashboard_render_admin_page') ) {
  function magic_dashboard_render_admin_page( string $title, array $settings ) {
    $context = Timber::get_context();

    if ( !empty( $_POST ) ) {
      $context['settings'] = magic_dashboard_set_options( $settings );
    } else {
      $context['settings'] = magic_dashboard_get_options( $settings );
    }

    $context['title'] = $title;

    Timber::render( 'views/dashboard-subpage.twig', $context );
  }
}

if ( !function_exists( 'magic_dashboard_get_options') ) {
  function magic_dashboard_get_options( $settings ) {
    $options = array();
    foreach ( $settings as $setting ) {
      $name = $setting['name'];
      if ($setting['type'] !== 'header') {
        $setting['value'] = magic_get_option( $name );
      }

      $options[$name] = $setting;
    }

    return $options;
  }
}

if ( !function_exists( 'magic_dashboard_set_options') ) {
  function magic_dashboard_set_options( array $settings = [] ) {
    foreach ( $settings as $setting ) {
      $name = $setting['name'];
      if ( isset( $_POST[$name] ) ) {
        $value = $_POST[$name];

        magic_set_option( $name, $value );
      }
    }

    return magic_dashboard_get_options( $settings );
  }
}

if ( !function_exists( 'magic_dashboard_render_settings_fields' ) ) {
  function magic_dashboard_render_settings_fields( array $settings = [] ) {
    foreach ( $settings as $key => $setting ) {
      $default = array (
        'default' => '',
        'name' => '',
        'type' => '',
      );

      $setting = array_merge( $default, $setting );

      $setting['type'] = !empty( $setting['type'] ) ? $setting['type'] : 'text';

      if ( $setting['type'] !== 'header' ) {
        $data = get_option( $setting['name'], $setting['default'] );
        $setting['value']  = esc_attr( $data );
      }

      if ($setting['type'] === 'image') {
        $upload_field = $setting['name'] . '_upload';
        $name = $setting['name'];

        $setting['value'] = magic_get_option( $setting['name'] );
      }

      $setting['template'] = 'inputs/input-' . $setting['type'] . '.twig';

      $settings[$key] = $setting;
    }

    $context['settings'] = $settings;

    Timber::render( 'views/dashboard-fields.twig', $context );
  }
}

if ( !function_exists( 'magic_register_style' ) ) {
  function magic_register_style($slug, $base_path ) {
    $content_url = content_url();
    $plugins_url = plugins_url();

    $plugin_path = str_replace( $content_url, '', $plugins_url );

    $local_path = $plugin_path . '/' . $base_path;

    wp_register_style( $slug, $local_path . '/' . $slug . '.less' );
    wp_enqueue_style( $slug );
  }
}
