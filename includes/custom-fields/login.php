<?php
if(function_exists("magic_register_field_group")) {
	$slug = MAGIC_USER_ADMIN_SLUG . '_login_page';

	$add_fields = array();
	if ( defined( 'MAGIC_GDPR_SLUG' ) ) {
		$add_fields = array (
			'tab_cookies' => array(
				'type' => 'tab',
				'label' => 'GDPR settings',
			),
			'before_allow_cookies_text' => array (
				'label' => 'Text before Allow Login Cookie Checkbox',
				'type' => 'text',
				'default_value' => '',
			),
			'after_allow_cookies_text' => array (
				'label' => 'Text after Allow Login Cookie Checkbox',
				'type' => 'text',
				'default_value' => 'Accept Login Cookies',
			),
		);
	}

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
				'email_placeholder' => array (
					'label' => 'Login Form Email Placeholder',
					'type' => 'text',
					'default_value' => 'Email',
				),
				'password_placeholder' => array (
					'key' => 'field_5b3525dbbda43',
					'label' => 'Login Form Password Placeholder',
					'name' => 'password_placeholder',
					'type' => 'text',
					'default_value' => 'Password',
				),
				'submit_text' => array (
					'name' => 'submit_text',
					'type' => 'text',
					'default_value' => 'Send',
				),
				'below_form' => array (
					'label' => 'Content below Form',
					'type' => 'wysiwyg',
				),
			),
			$add_fields
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
