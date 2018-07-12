<?php
add_action( 'show_admin_bar', function () {
  if ( !current_user_can( 'edit_posts' ) ) {
    show_admin_bar( false );
  }
} );
