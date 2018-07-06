<?php
if ( function_exists( "magic_register_field_group" ) ) {
	$slug = MAGIC_USER_ADMIN_SLUG . '_registration_page';
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

	magic_register_field_group(array (
		'id' => 'acf_' . $slug,
		'title' => 'Magic Registration Page',
		'slug' => $slug,
		'fields' => array_merge(
			array (
				'tab_form' => array(
					'type' => 'tab',
					'label' => 'Page Content',
				),
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
			$add_fields
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
