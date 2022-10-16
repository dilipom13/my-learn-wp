<?php 
if( !defined( 'MY_LEARN_THEME_INC_DIR' ) ) {
    define( 'MY_LEARN_THEME_INC_DIR', dirname( __FILE__ ) ); // inc dir
}

//include register faq post type
require MY_LEARN_THEME_INC_DIR. '/admin/mlt-faq-post-types.php';

//include admin function
require MY_LEARN_THEME_INC_DIR. '/admin/class-savemp3-admin.php';