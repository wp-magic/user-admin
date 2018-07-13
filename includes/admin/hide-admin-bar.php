<?php
add_action( 'after_setup_theme', function () {
  if ( !current_user_can( 'delete_posts' ) ) {
    show_admin_bar( false );
  }
} );
