<?php
/**
 * Handles user account updates
 *
 * @package MagicUserAdmin
 * @since 0.0.1
 */

/**
 * Handle User Account Post request
 *
 * @since 0.0.1
 */
function magic_user_admin_post_account() {
	$post = magic_verify_nonce( MAGIC_USER_ADMIN_ACCOUNT_ACTION );
	if ( empty( $post ) ) {
		exit;
	}

	$arguments = array(
		'nonce'        => MAGIC_USER_ADMIN_ACCOUNT_ACTION,
		'ID'           => 'user_invalid',
		'display_name' => 'missing_display_name',
		'first_name'   => false,
		'last_name'    => false,
		'user_url'     => false,
	);

	$ctx = magic_parse_arguments( $arguments );

	$id = get_current_user_id();

	$query_id = ! empty( $ctx['query']['ID'] ) && $ctx['query']['ID'];

	if ( (int) $query_id !== (int) $id ) {
		$ctx['errors'][] = 'user_invalid';
	}

	if ( empty( $ctx['query'] ) ) {
		$ctx['errors'][] = 'query_empty';
	}

	if ( ! empty( $ctx['errors'] ) ) {
		return $ctx;
	}

	$query = $ctx['query'];

	$new_user_data = array(
		'ID'           => $id,
		'display_name' => $query['display_name'],
		'user_url'     => $query['user_url'],
		'first_name'   => $query['first_name'],
		'last_name'    => $query['last_name'],
	);

	$update = wp_update_user( $new_user_data );

	if ( is_wp_error( $update ) ) {
		$ctx['errors'][] = 'insert_user';
	}

	return $ctx;
}
