<?php

if ( !function_exists( 'magic_set_option') ) {
  function magic_set_option( string $name, $value ) {
    if (function_exists( 'update_blog_option' ) ) {
      update_blog_option( null, $name, $value );
    } else {
      update_option( $name, $value );
    }
  }
}

if ( !function_exists( 'magic_get_option') ) {
  function magic_get_option( string $name, $default = '' ) {
    if (function_exists( 'get_blog_option' ) ) {
      $val = get_blog_option( null, $name );
    } else {
      $val = get_option( $name );
    }

    if ( empty($val) ) {
      return $default;
    }

    return $val;
  }
}

if ( !function_exists( 'magic_slugify' ) ) {
  function magic_slugify( string $value = '' ) {
    $value = trim( $value );
    $value = strtolower( $value );
    return str_replace( ' ', '_', $value );
  }
}

if ( !function_exists( 'magic_deserialize_cookie' ) ) {
  function magic_deserialize_cookie( string $str ) {
    $string_array = explode( PHP_EOL, $str);
    $cookies = [];
    foreach ( $string_array as $string ) {
      $arr = explode( MAGIC_DASHBOARD_COOKIE_SEP, $string );

      if ( empty( $arr ) || empty( $arr[0] ) ) {
        break;
      }

      $name = esc_html( trim( $arr[0] ) );
      $slug = esc_html( trim( $arr[1] ) );
      $desc = esc_html( trim( $arr[2] ) );
      $cook = esc_html( trim( $arr[3] ) );
      $on   = !empty($_POST[$slug]) || !empty( $_POST['accept_all'] );

      $cookies[] = array (
        'name' => $name,
        'slug' => $slug,
        'description' => $desc,
        'cookies' => explode( ',', $cook ),
        'on' => $on,
      );
    }

    return $cookies;
  }
}

if ( !function_exists( 'magic_serialize_cookie' ) ) {
  function magic_serialize_cookie( array $array ) {
    $array = implode( MAGIC_DASHBOARD_COOKIE_SEP, $array );
    $string = implode( PHP_EOL, $array );
    return $string;
  }
}
