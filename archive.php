<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container">
	<div class="content row">
		<main class="main col-sm-12 col-xs-12" role="main">
			<?php 
			$tax = $wp_query->get_queried_object();
			global $awesome_params;
			$awesome_params['default_taxonomy']=$tax->taxonomy;
			$awesome_params['default_term_slug']=$tax->slug;
 			if(awesome_library::get_post_from_slug('theme-' . $tax->taxonomy . '-archive','aw_block',$ignore))
				echo do_shortcode('[aw_block slug="theme-' . $tax->taxonomy . '-archive"]'); 
			else
				echo do_shortcode('[aw_block slug="theme-archive"]');
			?>
		</main><!-- /.main -->
		<!-- <aside class="sidebar  col-sm-4 col-xs-12" role="complementary">
			<?php get_sidebar(); ?>
		</aside> --><!-- /.sidebar -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>


