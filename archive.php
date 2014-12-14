<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid">
	<div class="content row">
		<main class="main col-sm-12 col-xs-12 nopadding" role="main">
			<?php 
			$shortcode ='[aw_block slug="theme-archive"]';
			if(is_post_type_archive( ))
			{
				$post_type = get_query_var('post_type');
				if(awesome_library::get_post_from_slug('theme-' . $post_type . '-archive','aw_block',$ignore))
					$shortcode='[aw_block slug="theme-' . $post_type . '-archive"]'; 
			}
			else if(is_tax())
			{
				$tax = $wp_query->get_queried_object();
				global $awesome_params;
				$awesome_params['default_taxonomy']=$tax->taxonomy;
				$awesome_params['default_term_slug']=$tax->slug;
				if(awesome_library::get_post_from_slug('theme-' . $tax->taxonomy . '-archive','aw_block',$ignore))
					$shortcode='[aw_block slug="theme-' . $tax->taxonomy . '-archive"]'; 
			}
			else if(is_category()){
				$cat = get_category( get_query_var( 'cat' ) );
				//$awesome_params['default_taxonomy']=$tax->taxonomy;
				$awesome_params['default_term_slug']=$cat->slug;
				if(awesome_library::get_post_from_slug('theme-category-' . $cat->slug . '-archive','aw_block',$ignore))
					$shortcode='[aw_block slug="theme-category-' . $cat->slug . '-archive"]'; 
			}
			else if( is_tag()){
				
			}
			
			echo $shortcode;
			echo do_shortcode($shortcode);
			/* global $awesome_params;
			$awesome_params['default_taxonomy']=$tax->taxonomy;
			$awesome_params['default_term_slug']=$tax->slug;
 			if(awesome_library::get_post_from_slug('theme-' . $tax->taxonomy . '-archive','aw_block',$ignore))
				echo do_shortcode('[aw_block slug="theme-' . $tax->taxonomy . '-archive"]'); 
			else
				echo do_shortcode('[aw_block slug="theme-archive"]'); */
			?>
		</main><!-- /.main -->
		<!-- <aside class="sidebar  col-sm-4 col-xs-12" role="complementary">
			<?php get_sidebar(); ?>
		</aside> --><!-- /.sidebar -->
	</div><!-- /.content -->
</div>

<?php get_footer(); ?>


