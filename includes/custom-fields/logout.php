<?php
if ( function_exists( 'magic_register_field_group' ) ) {
	$slug = MAGIC_USER_ADMIN_SLUG . '_logout_page';

	magic_register_field_group(
		array(
			'id'         => 'acf_' . $slug,
			'title'      => 'Magic Logout Page',
			'slug'       => $slug,
			'fields'     => array(),
			'location'   => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => MAGIC_USER_ADMIN_LOGOUT_TEMPLATE,
						'order_no' => 0,
						'group_no' => 0,
					),
				),
			),
			'options'    => array(
				'position'       => 'normal',
				'layout'         => 'no_box',
				'hide_on_screen' => array(
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
		)
	);
}
