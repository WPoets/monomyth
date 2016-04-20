<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-sm-12 col-xs-12" role="main">
		<?php
		while ( have_posts() ) : the_post();
			$post_type=get_post_type( $post );
			$module_post=null;
			
			if(!aw2_library::get_post_from_slug( $post_type . '-single','aw2_page',$module_post)){
				aw2_library::get_post_from_slug( 'single','aw2_core',$module_post);
			}	
			
			echo aw2_library::parse_shortcode($module_post->post_content);
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		endwhile; // end of the loop. ?>
		</main><!-- /.main -->
		<!-- <aside class="sidebar  col-sm-4 col-xs-12" role="complementary">
			<?php //get_sidebar(); ?>
		</aside> --><!-- /.sidebar -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>
