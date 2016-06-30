<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
<div class="content row no-gutters">
	<main class="main  col-lg-12 col-md-12 col-sm-12 col-xs-12" role="main">
	<?php 	
		
		$module_post=null;
		
		if(!aw2_library::get_post_from_slug( 'blog-page','aw2_core',$module_post)){
			aw2_library::get_post_from_slug( 'archive','aw2_core',$module_post);
		}	

		echo aw2_library::parse_shortcode($module_post->post_content);
		
	?>
	</main><!-- /.main -->
</div><!-- /.content -->
</div><!--#container -->
<?php get_footer(); 