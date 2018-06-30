<?php
function magic_user_admin_enqueue_styles() {
  wp_enqueue_style( 'magic_user_admin', plugin_dir_url(__FILE__ ) . 'magic-user-admin.less', -1 );
}
