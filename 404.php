<?php
/**
 * The template for displaying 404 page.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-sm-12 col-xs-12 ">
			
			<?php
			$content=null;
			aw2_library::get_post_from_slug( '404','aw2_core',$module_post);
			
			echo aw2_library::parse_shortcode($module_post->post_content);
	
			?>
			
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>