<?php
/**
 * The template for displaying search results page.
 */

get_header(); ?>
<div class="container-fluid">
	<div class="content row">
		<main class="main col-sm-12 col-xs-12 no-padding" role="main">
			
			<?php
			awesome2_library::setparam('default_collection'. '_wpquery',$wp_query);
			awesome2_library::setparam('default_collection',$wp_query->posts);
			
			awesome2_library::setparam('search_term',get_search_query());
			$content=null;
			if(awesome2_library::get_post_from_slug( 'search','aw2_page',$ignore)){
				awesome2_library::get_post_content('search','aw2_page',$content);
			}	
			else{				
				awesome2_library::get_post_content('search','aw2_core',$content);
			}
			echo awesome2_library::parse_shortcode($content);
	
			?>
			
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>