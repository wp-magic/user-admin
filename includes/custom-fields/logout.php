<?php
if(function_exists("register_field_group")) {
	register_field_group(array (
		'id' => 'acf_magic_user_admin_logout_page',
		'title' => 'Magic Logout Page',
		'fields' => array (
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'magic_user_admin_logout.php',
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
				2 => 'discussion',
				3 => 'comments',
				4 => 'categories',
				5 => 'tags',
				6 => 'send-trackbacks',
				7 => 'custom_fields',
				8 => 'slug',
			),
		),
		'menu_order' => 0,
	));
}
