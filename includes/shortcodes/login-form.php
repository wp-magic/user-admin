<?php
function magic_user_admin_login_form_shortcode( $atts ) {
  // $atts = shortcode_atts( array(
	// 	'open' => '11:00',
	// ), $atts, 'magic_user_admin' );

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
