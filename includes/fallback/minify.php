<?php
// if ( ! defined( 'MAGIC_MINIFY' ) ) {
//   define( 'MAGIC_MINIFY', true );
//   add_action( 'wp_print_styles', function() {
//     global $wp_styles;
//     $enqueued_styles = array();
//     foreach( $wp_styles->queue as $handle ) {
//         $enqueued_styles[] = $wp_styles->registered[$handle]->src;
//     }
//     print_r($enqueued_styles);
//   } );
// }
//
// function magic_print_scripts_styles() {
//
//     $result = [];
//     $result['scripts'] = [];
//     $result['styles'] = [];
//
//     // Print all loaded Scripts
//     global $wp_scripts;
//     foreach( $wp_scripts->queue as $script ) :
//        $result['scripts'][] =  $wp_scripts->registered[$script]->src . ";";
//     endforeach;
//
//     // Print all loaded Styles (CSS)
//     global $wp_styles;
//     foreach( $wp_styles->queue as $style ) :
//        $result['styles'][] =  $wp_styles->registered[$style]->src . ";";
//     endforeach;
//
//     return $result;
// }
