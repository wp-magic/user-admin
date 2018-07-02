<?php
if(function_exists("magic_register_field_group")) {
	magic_register_field_group(array (
		'id' => 'acf_magic_user_admin_login_page',
		'title' => 'Magic Login Page',
		'slug' => 'magic_user_admin',
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
					'value' => 'magic_user_admin_login.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
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
