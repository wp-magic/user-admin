<?php
if(function_exists("magic_register_field_group")) {
	$slug = MAGIC_USER_ADMIN_SLUG . '_login_page';
	magic_register_field_group(array (
		'id' => 'acf_' . $slug,
		'title' => 'Magic Login Page',
		'slug' => $slug,
		'fields' => array (
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
	) );
}
