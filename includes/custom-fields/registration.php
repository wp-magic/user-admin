<?php
if ( function_exists( 'magic_register_field_group' ) ) {
	$slug = MAGIC_USER_ADMIN_SLUG . '_registration_page';

	$gdpr_fields = defined( 'MAGIC_GDPR_CUSTOM_FIELDS' )
		? MAGIC_GDPR_CUSTOM_FIELDS
		: [];

	$error_fields = array(
		'error_tab'               => array(
			'type'  => 'tab',
			'label' => 'Page Errors',
		),
		'error_nonce'             => array(
			'label'         => 'Nonce error',
			'type'          => 'text',
			'default_value' => 'Nonce error. Please retry.',
		),
		'error_cookie'            => array(
			'label'         => 'Cookie error',
			'type'          => 'text',
			'default_value' => 'Cookies not allowed.',
		),
		'error_user_not_found'    => array(
			'label'         => 'User not found / Invalid Password errors.',
			'type'          => 'text',
			'default_value' => 'User not found.',
			'instructions'  => 'We combine all user errors into one. This way it is not possible to get a list of valid usernames by brute forcing the login form with email/password combinations.',
		),
		'error_username_exists'   => array(
			'label'         => 'Username exists with different Email',
			'type'          => 'text',
			'default_value' => 'Username is already registered but the password or email are different.',
		),
		'error_create'            => array(
			'label'         => 'User could not be created.',
			'type'          => 'text',
			'default_value' => 'User could not be created.',
		),
		'error_missing_email'     => array(
			'label'         => 'Email field empty.',
			'type'          => 'text',
			'default_value' => 'Email must be entered',
		),
		'error_missing_password'  => array(
			'label'         => 'Password field empty.',
			'type'          => 'text',
			'default_value' => 'Password must be entered',
		),
		'error_missing_password2' => array(
			'label'         => 'Password confirmation field empty.',
			'type'          => 'text',
			'default_value' => 'Password must be entered',
		),
		'error_mismatch_password' => array(
			'label'         => 'Passwords do not match.',
			'type'          => 'text',
			'default_value' => 'Passwords did not match',
		),
		'error_unknown'           => array(
			'label'         => 'Unknown error.',
			'type'          => 'text',
			'default_value' => 'Unknown Error.',
		),
	);


	magic_register_field_group(
		array(
			'id'         => 'acf_' . $slug,
			'title'      => 'Magic Registration Page',
			'slug'       => $slug,
			'fields'     => array_merge(
				array(
					'tab_form'             => array(
						'type'  => 'tab',
						'label' => 'Page Content',
					),
					'above_text'           => array(
						'label' => 'Content above Form',
						'type'  => 'wysiwyg',
					),
					'log_placeholder'      => array(
						'label'         => 'Email Placeholder Text',
						'type'          => 'text',
						'default_value' => 'Your email',
					),
					'pwd_placeholder'      => array(
						'label'         => 'Password Placeholder Text',
						'type'          => 'text',
						'default_value' => 'Password',
					),
					'pwd2_placeholder'     => array(
						'label'         => 'Password2 Placeholder Text',
						'type'          => 'text',
						'default_value' => 'Password (again...)',
					),
					'username_placeholder' => array(
						'label'         => 'Username Placeholder Text',
						'type'          => 'text',
						'default_value' => 'Username (can not be changed later)',
					),
					'submit_text'          => array(
						'label'         => 'Submit Button Text',
						'type'          => 'text',
						'default_value' => 'Sign up',
					),
					'below_text'           => array(
						'label' => 'Content Below Form',
						'type'  => 'wysiwyg',
					),
				),
				$gdpr_fields,
				$error_fields
			),
			'location'   => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => MAGIC_USER_ADMIN_REGISTRATION_TEMPLATE,
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options'    => array(
				'position'       => 'normal',
				'layout'         => 'display',
				'hide_on_screen' => array(
					0 => 'the_content',
					1 => 'excerpt',
					2 => 'custom_fields',
					3 => 'discussion',
					4 => 'comments',
					5 => 'categories',
					6 => 'tags',
					7 => 'send-trackbacks',
				),
			),
			'menu_order' => 0,
		)
	);
}
