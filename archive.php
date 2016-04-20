<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-md-12 col-xs-12" role="main">
			<?php 
			$content ='';
			awesome2_library::get_post_content('archive','aw2_core',$content);
			
			awesome2_library::setparam('default_collection'. '_wpquery',$wp_query);
			awesome2_library::setparam('default_collection',$wp_query->posts);
			if(is_post_type_archive( ))
			{
				$post_type = get_query_var('post_type');
				awesome2_library::setparam('current_archive_name',$post_type);
				if(awesome2_library::get_post_from_slug( $post_type . '-archive','aw2_page',$ignore))
					awesome2_library::get_post_content($post_type . '-archive','aw2_page',$content);
			}
			else if(is_tax())
			{
				$tax = $wp_query->get_queried_object();
				awesome2_library::setparam('default_taxonomy',$tax->taxonomy);
				awesome2_library::setparam('default_term_slug',$tax->slug);
				awesome2_library::setparam('current_archive_name',$tax->name);
				awesome2_library::setparam('default_term_id',$tax->term_id);
				if(awesome2_library::get_post_from_slug($tax->taxonomy . '-archive','aw2_page',$ignore))
					awesome2_library::get_post_content($tax->taxonomy . '-archive','aw2_page',$content);

			}
			else if(is_category()){
				$cat = get_category( get_query_var( 'cat' ) );
				awesome2_library::setparam('default_taxonomy','category');
				awesome2_library::setparam('default_term_slug',$cat->slug);
				awesome2_library::setparam('current_archive_name',$cat->name);
				awesome2_library::setparam('default_term_id',$cat->term_id);
				if(awesome2_library::get_post_from_slug($cat->slug . '-archive','aw2_page',$ignore))
					awesome2_library::get_post_content($cat->slug . '-archive','aw2_page',$content);
			}
			else if( is_tag()){
				//awesome2_library::setparam('default_tag',$wp_query->posts);
				awesome2_library::setparam('current_archive_name',$cat->name);
				if(awesome2_library::get_post_from_slug($cat->slug . '-archive','aw2_page',$ignore))
					awesome2_library::get_post_content($cat->slug . '-archive','aw2_page',$content);
			}
			else if( is_author()){
				//awesome2_library::setparam('default_tag',$wp_query->posts);
				if(get_query_var('author_name')) :
					$curauth = get_user_by('slug', get_query_var('author_name'));
				else :
					$curauth = get_userdata(get_query_var('author'));
				endif;

				awesome2_library::setparam('current_author_id',$curauth->ID);
				awesome2_library::setparam('current_author_slug',$curauth->user_login);
				awesome2_library::setparam('current_author_name',$curauth->display_name);
				awesome2_library::setparam('current_author',$curauth);
				if(awesome2_library::get_post_from_slug('author-archive','aw2_page',$ignore))
					awesome2_library::get_post_content( 'author-archive','aw2_page',$content);
			}

			
			echo awesome2_library::parse_shortcode($content);
			?>
		</main><!-- /.main -->
		<!-- <aside class="sidebar  col-sm-4 col-xs-12" role="complementary">
			<?php //get_sidebar(); ?>
		</aside> --><!-- /.sidebar -->
	</div><!-- /.content -->
</div>
<?php get_footer(); 


