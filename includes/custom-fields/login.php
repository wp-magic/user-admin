<?php
if(function_exists("register_field_group")) {
	register_field_group(array (
		'id' => 'acf_magic_user_admin_login_page',
		'title' => 'Magic Login Page',
		'fields' => array (
			array (
				'key' => 'field_5b3649feb6591',
				'label' => 'Content above Form',
				'name' => 'above_form',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_5b3524cbb55bd',
				'label' => 'Login Form Email Placeholder',
				'name' => 'email_placeholder',
				'type' => 'text',
				'default_value' => 'Email',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b3525dbbda43',
				'label' => 'Login Form Password Placeholder',
				'name' => 'password_placeholder',
				'type' => 'text',
				'default_value' => 'Password',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b3525f372dd7',
				'label' => 'Login Form Submit Button Text',
				'name' => 'submit_text',
				'type' => 'text',
				'default_value' => 'Send',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b364a0fb6592',
				'label' => 'Content below Form',
				'name' => 'below_form',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'templates/login.php',
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
		'menu_order' => 0,
	));
}
