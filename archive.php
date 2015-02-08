<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container">
	<div class="content row">
		<main class="main col-md-12 col-xs-12" role="main">
			<?php 
			$shortcode ='[aw2_block slug="theme-archive"]';
			awesome2_library::setparam('default_collection',$wp_query->posts);
			if(is_post_type_archive( ))
			{
				$post_type = get_query_var('post_type');
				awesome2_library::setparam('current_archive_name',$post_type);
				if(awesome2_library::get_post_from_slug('theme-' . $post_type . '-archive','aw_block',$ignore))
					$shortcode='[aw2_block slug="theme-' . $post_type . '-archive"]'; 
			}
			else if(is_tax())
			{
				$tax = $wp_query->get_queried_object();
				awesome2_library::setparam('default_taxonomy',$tax->taxonomy);
				awesome2_library::setparam('default_term_slug',$tax->slug);
				awesome2_library::setparam('current_archive_name',$tax->name);
				if(awesome2_library::get_post_from_slug('theme-' . $tax->taxonomy . '-archive','aw_block',$ignore))
					$shortcode='[aw2_block slug="theme-' . $tax->taxonomy . '-archive"]'; 

			}
			else if(is_category()){
				$cat = get_category( get_query_var( 'cat' ) );
				awesome2_library::setparam('default_taxonomy','category');
				awesome2_library::setparam('default_term_slug',$cat->slug);
				awesome2_library::setparam('current_archive_name',$cat->name);
				if(awesome2_library::get_post_from_slug('theme-category-' . $cat->slug . '-archive','aw_block',$ignore))
					$shortcode='[aw2_block slug="theme-category-' . $cat->slug . '-archive"]'; 
			}
			else if( is_tag()){
				//awesome2_library::setparam('default_tag',$wp_query->posts);
				awesome2_library::setparam('current_archive_name',$cat->name);
				if(awesome2_library::get_post_from_slug('theme-tag-' . $cat->slug . '-archive','aw_block',$ignore))
					$shortcode='[aw2_block slug="theme-tag-' . $cat->slug . '-archive"]'; 
			}

			
			echo do_shortcode($shortcode);
			?>
		</main><!-- /.main -->
		<!-- <aside class="sidebar  col-sm-4 col-xs-12" role="complementary">
			<?php get_sidebar(); ?>
		</aside> --><!-- /.sidebar -->
	</div><!-- /.content -->
</div>
<?php get_footer(); 


