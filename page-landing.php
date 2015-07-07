<?php
/**
 Template Name: Landing Page
 * The template for displaying landing pages.
 */

$aw2_header='page-landing-header' ;
get_header(); ?>
<div class="container-fluid">
<div class="content row">
	<main class="main  col-lg-12 col-md-12 col-sm-12 col-xs-12" role="main">
		<?php while ( have_posts() ) : the_post(); awesome2_library::setparam('default_item',$post);?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- <header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header> --><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', '_s' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<footer class="entry-footer"></footer>
		</article><!-- #post-## -->

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		?>

		<?php endwhile; // end of the loop. ?>
	</main><!-- /.main -->
</div><!-- /.content -->
</div><!--#container -->
<?php 
$aw2_footer='page-landing-footer' ;
get_footer(); 