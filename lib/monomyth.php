<?php
/*
* This file initialises all the libraries included in the theme and does all the basic setup that are needed. 
*
*
*/

//enqueue required basic scripts and styles -- bootstrap css, js and app and js
if ( !defined('MM_PRODUCTION') )
	define('MM_PRODUCTION', false);
	
// clean ups taken from roots and bones theme framework
require( 'clean-up.php' ); 
require( 'nice-search.php' ); 
require( 'relative-urls.php' ); 
require( 'admin-cleanup.php' ); 
require( 'wp_bootstrap_navwalker.php' ); 

// launching this stuff after theme setup
add_action( 'after_setup_theme','monomyth_theme_support' );

function monomyth_theme_support(){

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'jquery-cdn' );
	add_theme_support( 'title-tag' );
	/* Adds core WordPress HTML5 support. */
	add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );
	/* Make text widgets shortcode aware. */
	add_filter( 'widget_text', 'do_shortcode' );

	/* Don't strip tags on single post titles. */
	remove_filter( 'single_post_title', 'strip_tags' );

	// wp menus
	add_theme_support( 'menus' );
	
	if(MM_PRODUCTION) 
	{
		add_filter('acf/settings/show_admin','__return_false');
	}
	
	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(array(
		'primary_navigation' => __('Primary Navigation', 'monomyth'),
	));

}

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
  
//wp_enqueue_style('fontawesome', 'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css', false, null); 
if(MM_PRODUCTION) 
{
  wp_enqueue_style('monomyth_app', get_template_directory_uri() . '/assets/css-cache/monomyth_app.css', false, null);
}
else
{
  wp_enqueue_style('monomyth_app', get_template_directory_uri() . '/assets/app.less', false, null);
} 
 wp_enqueue_style('monomyth_ie', get_template_directory_uri() . '/assets/ie.css', false, null);
 $wp_styles->add_data( 'monomyth_ie', 'conditional', 'lt IE 10' ); // add conditional wrapper around ie stylesheet
  // jQuery is loaded using the same method from HTML5 Boilerplate:
  // Grab Google CDN's latest jQuery with a protocol relative URL; fallback to local if offline
  // It's kept in the header instead of footer to avoid conflicts with plugins.
  if (!is_admin() && current_theme_supports('jquery-cdn')) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js', array(), null, false);
  }

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

//  wp_register_script('bootstrap_js', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js', array(), null, false);
/* We need to run into issue where I can justify the use of html5_shiv as well as respondjs	 */
  //wp_register_script('html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);
  //wp_register_script('respondjs', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', array(), '0fc6af96786d8f267c8686338a34cd38', true);

  /*it is better to keep our js into site_specific plugin*/
  //wp_register_script('monomyth_scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '0fc6af96786d8f267c8686338a34cd38', false);
  
  

  wp_enqueue_script('jquery');
  wp_enqueue_script('bootstrap_js');
  //wp_enqueue_script('html5_shiv');
  //wp_enqueue_script('respondjs');
  //wp_enqueue_script('monomyth_scripts');
  
  // $wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
  // $wp_scripts->add_data( 'respondjs', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet
  
  
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


function monomyth_less_path(){
	return get_template_directory().'/assets/css-cache';
}
add_filter('wp_less_cache_path','monomyth_less_path');


function monomyth_less_url(){
	return get_template_directory_uri().'/assets/css-cache';
}
add_filter('wp_less_cache_url','monomyth_less_url');

// Add thumbnail class to thumbnail links
function monomyth_add_class_attachment_link( $html ) {
    $postid = get_the_ID();
    $html = str_replace( '<a','<a class="thumbnail"',$html );
    return $html;
}
add_filter( 'wp_get_attachment_link', 'monomyth_add_class_attachment_link', 10, 1 );

function monomyth_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

	if(!is_front_page())
	{
		$title =$title.' | '.get_bloginfo('name');
	}	

  return $title;
}
add_filter('wp_title', 'monomyth_wp_title', 10);
//for backward compatibility for time being will be removed after wordpress 4.2 release.
if ( ! function_exists( '_wp_render_title_tag' ) ) :
	function theme_slug_render_title() {
		echo '<title>' . wp_title( '|', false, 'right' ) . "</title>\n";
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
endif;

function monomyth_modify_nav_menu_args( $args )
{

	if(!isset($args['container']))
	{
		$args['container'] ='div';
	}
	if(!isset($args['container_class']) || empty($args['container_class']))
	{
		$args['container_class'] = 'collapse navbar-collapse';
	}

	if(!isset($args['walker']) || empty($args['walker']))
	{
		$args['walker'] = new wp_bootstrap_navwalker();
		$args['fallback_cb']='wp_bootstrap_navwalker::fallback';
		$args['menu_class'] =$args['menu_class'].' nav navbar-nav';
	}

	return $args;
}

add_filter( 'wp_nav_menu_args', 'monomyth_modify_nav_menu_args' );