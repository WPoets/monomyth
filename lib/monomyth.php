<?php
/*
* This file initialises all the libraries included in the theme and does all the basic setup that are needed. 
*
*
*/


//enqueue required basic scripts and styles -- bootstrap css, js and app and js

// clean ups taken from roots and bones theme framework
require( 'clean-up.php' ); 
require( 'nice-search.php' ); 
require( 'relative-urls.php' ); 
require( 'admin-cleanup.php' ); 

if ( class_exists( 'ReduxFramework' ) ) {
	require( 'theme-options.php' );
}

add_theme_support( 'post-thumbnails' );
// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
register_nav_menus(array(
'primary_navigation' => __('Primary Navigation', 'monomyth'),
));

function monomyth_widgets_init() {
  // Sidebars
  register_sidebar(array(
    'name'          => __('Primary', 'monomyth'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

  register_sidebar(array(
    'name'          => __('Footer', 'monomyth'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ));

}
add_action('widgets_init', 'monomyth_widgets_init');

function monomyth_scripts() {
  global $wp_styles;
  global $wp_scripts;
  
//  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/less/bootstrap.less', false);
  wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/less/font-awesome/font-awesome.less', false);
  wp_enqueue_style('monomyth_app', get_template_directory_uri() . '/assets/app.less', false);
  wp_enqueue_style('monomyth_ie', get_template_directory_uri() . '/assets/ie.css', false);
 
 $wp_styles->add_data( 'monomyth_ie', 'conditional', 'lt IE 10' ); // add conditional wrapper around ie stylesheet
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

  wp_register_script('html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);
  wp_register_script('respondjs', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);
  wp_register_script('bootstrap_js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);
  wp_register_script('monomyth_scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '0fc6af96786d8f267c8686338a34cd38', false);
  
  

  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap_js');
  wp_enqueue_script('html5_shiv');
  wp_enqueue_script('respondjs');
  wp_enqueue_script('monomyth_scripts');
  
   $wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
   $wp_scripts->add_data( 'respondjs', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
  
  
}
add_action('wp_enqueue_scripts', 'monomyth_scripts', 100);




function add_filters($tags, $function) {
  foreach($tags as $tag) {
    add_filter($tag, $function);
  }
}

//--- theme activation ---
function monomyth_theme_activation_action(){

}
add_action('admin_init','monomyth_theme_activation_action');


function monomyth_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'monomyth_remove_thumbnail_dimensions', 10, 3 );

function monomyth_less_path(){
	return get_template_directory().'/assets/css-cache';
}
add_filter('wp_less_cache_path','monomyth_less_path');


function monomyth_less_url(){
	return get_template_directory_uri().'/assets/css-cache';
}
add_filter('wp_less_cache_url','monomyth_less_url');