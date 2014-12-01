<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container">
	<div class="content row">
		<main class="main col-sm-12 col-xs-12" role="main">
			<?php while ( have_posts() ) : the_post();
			$post_type=get_post_type( $post );
	
			awesome2_library::setparam('default_item')=$post;
			if(awesome2_library::get_post_from_slug('theme-' . $post_type . '-single','aw_block',$ignore)){
				echo do_shortcode('[aw2_block slug="theme-' . $post_type . '-single"]'); 
				
			}	
			else{
				echo do_shortcode('[aw2_block slug="theme-single"]'); 
				
			}

			
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
