<?php

//Moved CORE cpt here
function monomyth_register_core_blocks(){
if ( post_type_exists( 'aw2_core' ) ) 
	return;

register_post_type('aw2_core', array(
	'label' => 'Awesome Core',
	'description' => '',
	'public' => false,
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
	'supports' => array('title','editor','revisions'),
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
	
	register_post_type('aw2_page', array(
	'label' => 'Awesome Page',
	'description' => '',
	'public' => false,
	'exclude_from_search'=>true,
	'publicly_queryable'=>false,
	'show_in_nav_menus'=>false,
	'show_ui' => true,
	'show_in_menu' => false,
	'capability_type' => 'post',
	'map_meta_cap' => true,
	'hierarchical' => false,
	'menu_icon'   => 'dashicons-schedule',
	'menu_position'   => 25,
	'rewrite' => array('slug' => 'aw2_page', 'with_front' => true),
	'query_var' => true,
	'supports' => array('title','editor','revisions'),
	'labels' => array (
	  'name' => 'Awesome Pages',
	  'singular_name' => 'Awesome Page',
	  'menu_name' => 'Awesome Pages',
	  'add_new' => 'Add Awesome Page',
	  'add_new_item' => 'Add New Awesome Page',
	  'edit' => 'Edit',
	  'edit_item' => 'Edit Awesome Page',
	  'new_item' => 'New Awesome Page',
	  'view' => 'View Awesome Page',
	  'view_item' => 'View Awesome Page',
	  'search_items' => 'Search Awesome Pages',
	  'not_found' => 'No Awesome Pages Found',
	  'not_found_in_trash' => 'No Awesome Pages Found in Trash',
	  'parent' => 'Parent Awesome Page',
	)
	) ); 
}	
add_action('init', 'monomyth_register_core_blocks');

function monomyth_register_admin_bar_menus_for_core(){
  global $wp_admin_bar;
  
  if(!current_user_can( 'develop_for_awesomeui' ))
	return;

	$menu_id = 'asf';
	$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => 'Awesome Dev', 'href' => get_admin_url(null,'admin.php?page=awesome-dev'),'meta' => array('target' => '_blank')));
	
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => 'Pages', 'id' => 'asf-pages', 'href' => get_admin_url(null,'edit.php?post_type=aw2_page'), 'meta' => array('target' => '_blank')));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => 'Core', 'id' => 'asf-core', 'href' =>get_admin_url(null,'edit.php?post_type=aw2_core'), 'meta' => array('target' => '_blank')));
}

add_action( 'admin_bar_menu', 'monomyth_register_admin_bar_menus_for_core',2000 );


