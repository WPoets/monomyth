<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="container-fluid no-padding">
	<div class="content row no-gutters">
		<main class="main col-md-12 col-xs-12">
			<?php 
			$module_post ='';
			
			aw2_library::get_post_from_slug('archive','aw2_core',$content);
			
			if(aw2_library::get('app.pages.archive.exists')){
	
				
				echo aw2_library::parse_shortcode(aw2_library::get('app.pages.archive.post_content'));
			}
			else if(is_post_type_archive( ))
			{
				$post_type = get_query_var('post_type');
				aw2_library::set('current_archive_name',$post_type);
				
				if(!aw2_library::get_post_from_slug( $post_type . '-archive','aw2_core',$module_post))
					aw2_library::get_post_from_slug( 'archive','aw2_core',$module_post);
			}
			else if(is_tax())
			{
				$tax = $wp_query->get_queried_object();
				aw2_library::set('default_taxonomy',$tax->taxonomy);
				aw2_library::set('default_term_slug',$tax->slug);
				aw2_library::set('current_archive_name',$tax->name);
				aw2_library::set('default_term_id',$tax->term_id);
				
				if(!aw2_library::get_post_from_slug( $tax->taxonomy . '-archive','aw2_core',$module_post))
					aw2_library::get_post_from_slug( 'archive','aw2_core',$module_post);
			}
			else if(is_category()){
				$cat = get_category( get_query_var( 'cat' ) );
				aw2_library::set('default_taxonomy','category');
				aw2_library::set('default_term_slug',$cat->slug);
				aw2_library::set('current_archive_name',$cat->name);
				aw2_library::set('default_term_id',$cat->term_id);
				
				if(!aw2_library::get_post_from_slug( $cat->slug . '-archive','aw2_core',$module_post))
					aw2_library::get_post_from_slug( 'archive','aw2_core',$module_post);
			}
			else if( is_tag()){
				//awesome2_library::setparam('default_tag',$wp_query->posts);
				aw2_library::set('current_archive_name',$cat->name);
				if(!aw2_library::get_post_from_slug( $cat->slug . '-archive','aw2_core',$module_post))
					aw2_library::get_post_from_slug( 'archive','aw2_core',$module_post);
			}
			else if( is_author()){
				//awesome2_library::setparam('default_tag',$wp_query->posts);
				if(get_query_var('author_name')) :
					$curauth = get_user_by('slug', get_query_var('author_name'));
				else :
					$curauth = get_userdata(get_query_var('author'));
				endif;

				aw2_library::set('current_author_id',$curauth->ID);
				aw2_library::set('current_author_slug',$curauth->user_login);
				aw2_library::set('current_author_name',$curauth->display_name);
				aw2_library::set('current_author',$curauth);
				
				if(!aw2_library::get_post_from_slug( 'author-archive','aw2_core',$module_post))
					aw2_library::get_post_from_slug( 'archive','aw2_core',$module_post);
				
			}

			if(!empty($module_post)){
				echo aw2_library::parse_shortcode($module_post->post_content);
			}
				
			?>
		</main><!-- /.main -->
	</div><!-- /.content -->
</div>
<?php get_footer(); 


