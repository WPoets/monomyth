<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div class="content row">
	<main class="main  col-lg-8 col-md-8 col-sm-8 col-xs-12" role="main">
		<?php include roots_template_path(); ?>
	</main><!-- /.main -->
	<aside class="sidebar  col-lg-4 col-md-8 col-sm-8 col-xs-12" role="complementary">
		<?php get_sidebar(); ?>
	</aside><!-- /.sidebar -->

</div><!-- /.content -->
<?php get_footer(); ?>