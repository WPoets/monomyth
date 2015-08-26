<!doctype html>
<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<?php 	global $post;awesome2_library::setparam('default_item',$post);?>
<head>
	<meta charset="utf-8">
	<?php // Google Chrome Frame for IE ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no"/>

	<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png">
	<link rel="icon" href="<?php
		global $monomyth_options;
		if(isset($monomyth_options['opt-favicon'])) {
			echo $monomyth_options['opt-favicon']['url'];
		}
	 ?>">
	<!--[if IE]>
		<link rel="shortcut icon" href="<?php
		global $monomyth_options;
		if(isset($monomyth_options['opt-favicon'])) {
			echo $monomyth_options['opt-favicon']['url'];
		}
	 ?>">
	<![endif]-->
	<?php // or, set /favicon.ico for IE10 win ?>
	<meta name="msapplication-TileColor" content="#f01d4f">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/images/win8-tile-icon.png">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="background_ovelay"></div>
<?php
if(isset($GLOBALS['aw2_header']))
	$local_header=$GLOBALS['aw2_header'];
else
	$local_header='header';
	
$post_content=awesome2_library::get_active_content($local_header);
echo awesome2_library::parse_shortcode($post_content);

