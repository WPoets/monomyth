<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container">
<div class="content row">
	<main class="main  col-lg-12 col-md-12 col-sm-12 col-xs-12" role="main">
		<?php 
		
		$shortcode ='[aw2_block slug="theme-archive"]';
		awesome2_library::setparam('default_collection',$wp_query->posts);
		if(awesome2_library::get_post_from_slug('theme-home','aw_block',$ignore))
			$shortcode='[aw2_block slug="theme-home"]'; 
		
		echo do_shortcode($shortcode);
		
		?>
	</main><!-- /.main -->
</div><!-- /.content -->
</div><!--#container -->
<?php get_footer(); 