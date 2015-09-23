<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid">
	<div class="content row">
		<main class="main col-sm-12 col-xs-12" role="main">
			<?php while ( have_posts() ) : the_post();
			$post_type=get_post_type( $post );
			$content=null;
			awesome2_library::setparam('default_item',$post);
			if(awesome2_library::get_post_from_slug( $post_type . '-single','aw2_page',$ignore)){
				awesome2_library::get_post_content($post_type . '-single','aw2_page',$content);
			}	
			else{				
				awesome2_library::get_post_content('single','aw2_core',$content);
			}
			echo awesome2_library::parse_shortcode($content);
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
			?>

			<?php endwhile; // end of the loop. ?>
		</main><!-- /.main -->
		<!-- <aside class="sidebar  col-sm-4 col-xs-12" role="complementary">
			<?php get_sidebar(); ?>
		</aside> --><!-- /.sidebar -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>
