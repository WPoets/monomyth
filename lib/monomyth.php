<?php
/*
* This file initialises all the libraries included in the theme and does all the basic setup that are needed. 
*
*
*/

//enqueue required basic scripts and styles -- bootstrap css, js and app and js
//if ( !defined('MM_PRODUCTION') )
//	define('MM_PRODUCTION', false);
	
// clean ups taken from roots and bones theme framework
//require( 'updates.php' ); 
require( 'clean-up.php' ); 
require( 'nice-search.php' ); 
require( 'relative-urls.php' ); 
require( 'admin-cleanup.php' ); 


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
	
	global $monomyth_options;
	$MM_PRODUCTION = false;
	if(isset($monomyth_options['dev_mode']))
		$MM_PRODUCTION = $monomyth_options['dev_mode'];
	
    if($MM_PRODUCTION) {
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
  global $monomyth_options;
//wp_enqueue_style('fontawesome', 'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css', false, null); 

	$MM_PRODUCTION = false;
	if(isset($monomyth_options['dev_mode']))
		$MM_PRODUCTION = $monomyth_options['dev_mode'];

	if($MM_PRODUCTION) {
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

//Moved CORE cpt here
function monomyth_register_core_blocks(){
if ( post_type_exists( 'aw2_core' ) ) 
	return;

register_post_type('aw2_core', array(
	'label' => 'Awesome Core',
	'description' => '',
	'public' => true,
	'exclude_from_search'=>true,
	'publicly_queryable'=>false,
	'show_in_nav_menus'=>false,
	'show_ui' => true,
	'show_in_menu' => false,
	'capability_type' => 'post',
	'map_meta_cap' => true,
	'hierarchical' => false,
	'menu_icon'   => 'dashicons-archive',
	'menu_position'   => 31,
	'rewrite' => array('slug' => 'aw2_core', 'with_front' => true),
	'query_var' => true,
	'supports' => array('title','editor','excerpt','revisions'),
	'labels' => array (
	  'name' => 'Awesome Core',
	  'singular_name' => 'Awesome Core',
	  'menu_name' => 'Awesome Core',
	  'add_new' => 'Add Awesome Core',
	  'add_new_item' => 'Add New Awesome Core',
	  'edit' => 'Edit',
	  'edit_item' => 'Edit Awesome Core',
	  'new_item' => 'New Awesome Core',
	  'view' => 'View Awesome Core',
	  'view_item' => 'View Awesome Core',
	  'search_items' => 'Search Awesome Core',
	  'not_found' => 'No Awesome Core Found',
	  'not_found_in_trash' => 'No Awesome Core Found in Trash',
	  'parent' => 'Parent Awesome Core',
	)
	) ); 
}	
add_action('init', 'monomyth_register_core_blocks');

function monomyth_register_menus_for_core(){
	   add_submenu_page( 'awesome-dev', 'Awesome Core - Awesome Studio Framework', 'Core', 'develop_for_awesomeui', 'edit.php?post_type=aw2_core' );
}
add_action( 'admin_menu', 'monomyth_register_menus_for_core' );

function monomyth_register_admin_bar_menus_for_core(){
  global $wp_admin_bar;
  
  if(!current_user_can( 'develop_for_awesomeui' ))
	return;

	$menu_id = 'asf';
	
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => 'Core', 'id' => 'asf-core', 'href' =>get_admin_url(null,'edit.php?post_type=aw2_core'), 'meta' => array('target' => '_blank')));
}

add_action( 'admin_bar_menu', 'monomyth_register_admin_bar_menus_for_core',2000 );

add_filter( 'clean_url', function( $url )
{
    if(strpos( $url, 'bootstrap.min.js' )) {
		// Must be a ', not "!
		return "$url' defer='defer";
	}
	// not our file
    return $url;
}, 11, 1 );