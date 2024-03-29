<?php
/**
 * Logout and redirect user to page set in config.
 *
 * @package  Magic-User-Admin
 * @since   0.0.1
 */

wp_logout();
magic_redirect( magic_get_option( 'magic_user_admin_logout_redirect', '/' ) );
