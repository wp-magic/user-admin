<?php
/**
 * Custom fields for Advanced Custom Fields.
 * Builds the Admin Settings on pages that have the this template activated
 *
 * @package MagicUserAdmin
 * @since 0.0.1
 */

if ( function_exists( 'magic_register_field_group' ) ) {
	$slug = MAGIC_USER_ADMIN_SLUG . '_account_page';


	$error_fields = array(
		'error_tab'                  => array(
			'type'  => 'tab',
			'label' => 'Page Errors',
		),
		'error_nonce'                => array(
			'label'         => 'Nonce error',
			'type'          => 'text',
			'default_value' => 'Nonce error. Please retry.',
		),
		'error_missing_display_name' => array(
			'label'         => 'Display Name missing Error',
			'type'          => 'text',
			'default_value' => 'Display name can not be empty.',
		),
		'error_unknown'              => array(
			'label'         => 'Unknown Error',
			'type'          => 'text',
			'default_value' => 'Unknown Error.',
		),
	);


	magic_register_field_group(
		array(
			'id'         => 'acf_' . $slug,
			'title'      => 'Magic User Profile Page',
			'slug'       => $slug,
			'fields'     => array_merge(
				array(
					'page_text_tab'     => array(
						'label' => 'Page text',
						'type'  => 'tab',
					),
					'above_text'        => array(
						'label' => 'Text above Form',
						'type'  => 'wysiwyg',
					),
					'use_gravatar'      => array(
						'label'         => 'Use Gravatar images',
						'type'          => 'true_false',
						'message'       => 'Load user images using gravatar',
						'default_value' => 0,
					),
					'login_text'        => array(
						'label'         => 'Login text',
						'type'          => 'text',
						'default_value' => 'Login',
					),
					'display_name_text' => array(
						'label'         => 'Display name text',
						'type'          => 'text',
						'default_value' => 'Display name',
					),
					'first_name_text'   => array(
						'label'         => 'Firstname text',
						'type'          => 'text',
						'default_value' => 'First name',
					),
					'last_name_text'    => array(
						'label'         => 'Lastname text',
						'type'          => 'text',
						'default_value' => 'Last name',
					),
					'email_text'        => array(
						'label'         => 'Email text',
						'type'          => 'text',
						'default_value' => 'Email',
					),
					'url_text'          => array(
						'label'         => 'Url text',
						'type'          => 'text',
						'default_value' => 'Your Homepage',
					),
					'registered_text'   => array(
						'label'         => 'Registered at text',
						'type'          => 'text',
						'default_value' => 'Registered at',
					),
					'submit_text'       => array(
						'label'         => 'Submit button text',
						'type'          => 'text',
						'default_value' => 'Submit',
					),
					'below_text'        => array(
						'label' => 'Text below Form',
						'type'  => 'wysiwyg',
					),
				),
				$error_fields
			),
			'location'   => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => MAGIC_USER_ADMIN_ACCOUNT_TEMPLATE,
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
