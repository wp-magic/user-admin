<?php
if ( function_exists( "magic_register_field_group" ) ) {
	$slug = MAGIC_USER_ADMIN_SLUG . '_registration_page';
	magic_register_field_group(array (
		'id' => 'acf_' . $slug,
		'title' => 'Magic Registration Page',
		'slug' => $slug,
		'fields' => array (
			'above_text' => array (
				'label' => 'Content above Form',
				'type' => 'wysiwyg',
			),
			'email_placeholder' => array (
				'label' => 'Email Placeholder Text',
				'type' => 'text',
				'default_value' => 'Your email',
			),
			'password_placeholder' => array (
				'label' => 'Password Placeholder Text',
				'type' => 'text',
				'default_value' => 'Password',
			),
			'password2_placeholder' => array (
				'label' => 'Password2 Placeholder Text',
				'type' => 'text',
				'default_value' => 'Password (again...)',
			),
			'username_placeholder' => array (
				'label' => 'Username Placeholder Text',
				'type' => 'text',
				'default_value' => 'Username (can not be changed later)',
			),
			'submit_text' => array (
				'label' => 'Submit Button Text',
				'type' => 'text',
				'default_value' => 'Submit',
			),
			'below_text' => array (
				'label' => 'Content Below Form',
				'type' => 'wysiwyg',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => MAGIC_USER_ADMIN_REGISTRATION_TEMPLATE,
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
				5 => 'categories',
				6 => 'tags',
				7 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
