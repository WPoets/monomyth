<?php
/**
 * The template for displaying 404 page.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-sm-12 col-xs-12 " role="main">
			
			<?php
			$content=null;
			if(awesome2_library::get_post_from_slug( '404','aw2_page',$ignore)){
				awesome2_library::get_post_content('404','aw2_page',$content);
			}	
			else{				
				awesome2_library::get_post_content('404','aw2_core',$content);
			}
			echo awesome2_library::parse_shortcode($content);
	
			?>
			
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>