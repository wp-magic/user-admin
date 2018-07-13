<?php
if(function_exists("magic_register_field_group")) {
	$slug = MAGIC_USER_ADMIN_SLUG . '_login_page';

	$gdpr_fields = defined( 'MAGIC_GDPR_CUSTOM_FIELDS' )
		? MAGIC_GDPR_CUSTOM_FIELDS
		: [];

	$error_fields = array(
		'error_tab' => array(
			'type' => 'tab',
			'label' => 'Page Errors',
		),
		'error_nonce' => array (
			'label' => 'Nonce error',
			'type' => 'text',
			'default_value' => 'Nonce error. Please retry.',
		),
		'error_cookie' => array (
			'label' => 'Cookie error',
			'type' => 'text',
			'default_value' => 'Cookies not allowed.',
		),
		'error_user_not_found' => array (
			'label' => 'User not found / Invalid Password errors.',
			'type' => 'text',
			'default_value' => 'User not found.',
			'instructions' => 'We combine all user errors into one. This way it is not possible to get a list of valid usernames by brute forcing the login form with email/password combinations.',
		),
		'error_missing_email' => array (
			'label' => 'Email field empty.',
			'type' => 'text',
			'default_value' => 'Email must be entered',
		),
		'error_missing_password' => array (
			'label' => 'Password field empty.',
			'type' => 'text',
			'default_value' => 'Password must be entered',
		),
		'error_unknown' => array (
			'label' => 'Unknown error.',
			'type' => 'text',
			'default_value' => 'Unknown Error.',
		),
	);

	$fields = array (
		'id' => 'acf_' . $slug,
		'title' => 'Magic Login Page',
		'slug' => $slug,
		'fields' => array_merge(
			array (
				'tab_form' => array(
					'type' => 'tab',
					'label' => 'Page Content',
				),
				'above_form' => array (
					'label' => 'Content above Form',
					'type' => 'wysiwyg',
				),
				'log_placeholder' => array (
					'label' => 'Login Form Email Placeholder',
					'type' => 'text',
					'default_value' => 'Email',
				),
				'pwd_placeholder' => array (
					'label' => 'Login Form Password Placeholder',
					'type' => 'text',
					'default_value' => 'Password',
				),
				'submit_text' => array (
					'type' => 'text',
					'default_value' => 'Send',
					'label' => 'Submit button text',
				),
				'below_form' => array (
					'label' => 'Content below Form',
					'type' => 'wysiwyg',
				),
			),
			$gdpr_fields,
			$error_fields
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => MAGIC_USER_ADMIN_LOGIN_TEMPLATE,
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'display',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'slug',
				6 => 'categories',
				7 => 'tags',
				8 => 'send-trackbacks',
			),
		),
	);

	magic_register_field_group( $fields );
}
