<?php
/*
* This file initialises all the libraries included in the theme and does all the basic setup that are needed. 
*
*
*/


/**
 * Initialize the CMF metabox class.  help is currently at https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 */
add_action( 'init', 'monomyth_initialize_cmb_meta_boxes', 9999 );
function monomyth_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'cmf/init.php';
}

/**
 * Initialize the Redux Framework for options.  Help is currently at http://docs.reduxframework.com/  
 */

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/ReduxFramework/ReduxCore/framework.php' );
}

require_once( 'theme-options.php' );