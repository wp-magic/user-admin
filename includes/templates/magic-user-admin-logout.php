<?php

/**
 * Logout and redirect user to login
 *
 * @package  Magic-User-Admin
 * @since   0.0.1
 */

wp_logout();
wp_redirect( magic_get_option( 'magic_user_admin_logout_redirect', '/' ) );
exit;
