<?php
echo do_shortcode('[aw2_block slug="theme-footer"]');
 wp_footer(); 
 if (current_user_can('develop_for_awesomeui')) {
	echo '<!-- ' . get_num_queries() . ' queries in ' . timer_stop(3) . ' seconds -->';
}
?>
</body>
</html>