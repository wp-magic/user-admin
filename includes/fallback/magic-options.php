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
