<?php

add_shortcode( 'magic-login-form', function( $atts ) {
  $context = Timber::get_context();

  $context['form'] = array(
    'url' => esc_url( admin_url('admin-post.php') ),
    'action' => 'login_form',
    'nonce' => wp_create_nonce('magic_user_admin-login'),
  );

  if ( isset( $_REQUEST['error'] ) ) {
    $context['form']['error'] = $_REQUEST['error'];
  }

  $rendered = Timber::compile( '../views/login-form.twig', $context );

  return $rendered;
}
