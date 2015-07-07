<?php

if(isset($GLOBALS['aw2_footer']))
	$local_footer=$GLOBALS['aw2_footer'];
else
	$local_header='footer';

$footer_content=null;
awesome2_library::get_post_content($aw2_footer,'aw2_core',$footer_content);
echo do_shortcode($footer_content);
 wp_footer(); 
 if (current_user_can('develop_for_awesomeui')) {
	echo '<!-- ' . get_num_queries() . ' queries in ' . timer_stop(0,3) . ' seconds -->';
}
?>
</body>
</html>