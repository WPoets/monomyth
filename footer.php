<?php

if(isset($GLOBALS['aw2_footer']))
	$local_footer=$GLOBALS['aw2_footer'];
else
	$local_footer='footer';


$footer_content=awesome2_library::get_active_content($local_footer);
echo do_shortcode($footer_content);

 wp_footer(); 
 if (current_user_can('develop_for_awesomeui')) {
	echo '<!-- ' . get_num_queries() . ' queries in ' . timer_stop(0,3) . ' seconds -->';
}
?>
</body>
</html>