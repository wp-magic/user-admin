<?php

add_action(
	'admin_menu',
	function () {
		$title = 'Magic User Admin Settings';

		$settings = array(
			array(
				'name'  => 'hide_admin_header',
				'type'  => 'header',
				'value' => 'Hide Admin interfaces',
				'label' =>
				'Hides /wp-admin and /wp-login.php from both subscribers and non logged in users.<br>' .
				'/wp-admin/admin-post.php and /wp-admin/admin-ajax.php stay available to permit form submits from the front page.<br>' .
				'To access the admin, login on the frontpage using a ' .
				'contributor, author, editor, admin or superadmin account',
			),
			array(
				'name'    => 'hide_admin',
				'type'    => 'checkbox',
				'label'   => 'Hide wp-admin and wp-login.php',
				'default' => 0,
			),
			array(
				'name'  => 'page_header',
				'type'  => 'header',
				'value' => 'Page urls',
				'label' => 'Where page templates are registered in your child theme',
			),
			array(
				'name'    => 'login_page',
				'type'    => 'text',
				'default' => '/login',
				'label'   => 'Login Page',
			),
			array(
				'name'    => 'registration_page',
				'type'    => 'text',
				// 'type' => 'dropdown-pages',
				'default' => '/register',
				'label'   => 'Registration Page',
			),
			array(
				'name'    => 'logout_page',
				'type'    => 'text',
				'default' => '/logout',
				'label'   => 'Logout Page',
			),
			array(
				'name'    => 'account_page',
				'type'    => 'text',
				'default' => '/account',
				'label'   => 'Profile Page',
			),

			array(
				'name'  => 'redirect_header',
				'type'  => 'header',
				'value' => 'Redirect urls',
				'label' => 'Where the user gets redirected after certain actions',
			),
			array(
				'name'    => 'login_redirect',
				'type'    => 'text',
				'default' => '/',
				'label'   => 'Login Redirect',
			),
			array(
				'name'    => 'registration_redirect',
				'type'    => 'text',
				'default' => '/',
				'label'   => 'Registration Redirect',
			),
			array(
				'name'    => 'logout_redirect',
				'type'    => 'text',
				'default' => '/',
				'label'   => 'Logout Redirect',
			),
		);

		magic_dashboard_add_submenu_page(
			array(
				'link'     => 'User Admin',
				'slug'     => MAGIC_USER_ADMIN_SLUG,
				'title'    => $title,
				'settings' => $settings,
			)
		);
	},
	2
);
