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


require_once( 'hm-rewrites.php' ); // to ensure and give easy ability to add new rewrite rules


// Automatically compiles any .less file to css.
require_once( 'wp-less/wp-less.php' );

//enqueue required basic scripts and styles -- bootstrap css, js and app and js

function monomyth_scripts() {
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/less/bootstrap.less', false);
  wp_enqueue_style('monomyth_app', get_template_directory_uri() . '/assets/app.less', false);

  // jQuery is loaded using the same method from HTML5 Boilerplate:
  // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', array(), null, false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }


  wp_register_script('bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);
  wp_register_script('monomyth_scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);

  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap_js');
  wp_enqueue_script('monomyth_scripts');
}
add_action('wp_enqueue_scripts', 'monomyth_scripts', 100);




