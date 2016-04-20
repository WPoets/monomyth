<?php

if(isset($GLOBALS['aw2_footer']))
	$local_footer=$GLOBALS['aw2_footer'];
else
	$local_footer='footer';


aw2_library::get_post_from_slug($local_footer,'aw2_core',$module_post);	
echo aw2_library::parse_shortcode($module_post->post_content);

wp_footer(); 
if (current_user_can('develop_for_awesomeui')) {
	echo '<!-- ' . get_num_queries() . ' queries in ' . timer_stop(0,3) . ' seconds -->';
}
?>
</body>
</html>