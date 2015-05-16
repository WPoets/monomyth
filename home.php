<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container">
<div class="content row">
	<main class="main  col-lg-12 col-md-12 col-sm-12 col-xs-12" role="main">
		<?php 	
		awesome2_library::setparam('default_collection',$wp_query->posts);
		$content ='';
		awesome2_library::get_post_content('archive','aw2_core',$content);
		if(awesome2_library::get_post_from_slug('blog-list-page','aw2_page',$ignore))
			awesome2_library::get_post_content('blog-list-page','aw2_page',$content);
		
		echo do_shortcode($content);
		
		?>
	</main><!-- /.main -->
</div><!-- /.content -->
</div><!--#container -->
<?php get_footer(); 