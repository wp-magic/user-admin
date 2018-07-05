<?php
// add_action( 'pre_user_query', 'hide_user_by_role' );

function hide_user_by_role( $user_query ) {
  // if ( current_user_can( 'activate_plugin' ) ) {
  //   return;
  // }

	if ( $user_query->query_vars['search'] ){
		$search_query = trim( $user_query->query_vars['search'], '*' );

		if ( $_REQUEST['s'] == $search_query ){
			global $wpdb;

 			// let's search by users first name
			$user_query->query_from .= " JOIN {$wpdb->usermeta} fname ON fname.user_id = {$wpdb->users}.ID AND fname.meta_key = 'first_name'";

			// you can add here any meta key you want to search by
			// $user_query->query_from .= " JOIN {$wpdb->usermeta} cstm ON cstm.wp_capabilities = {$wpdb->users}.ID AND cstm.wp_capabilities LIKE %author%";

 			// apply to the query
      $roles = array('author', 'editor', 'contributor');

			$user_query->query_where = 'WHERE 1=1' . $user_query->get_search_sql( $search_query, $search_by, 'both' );
      $user_query->query_where .= " WHERE wp_usermeta.meta_key = 'wp_capabilities'";
      $user_query->query_where .= " AND wp_usermeta.meta_value LIKE '%author%'";
      $user_query->query_where .= " OR wp_usermeta.meta_value LIKE '%editor%'";
      $user_query->query_where .= " OR wp_usermeta.meta_value LIKE '%subscriber%'";
		}
	}
}
