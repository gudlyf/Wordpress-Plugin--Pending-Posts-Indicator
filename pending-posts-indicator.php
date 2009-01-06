<?php
/*
Plugin Name: Pending Posts Indicator
Plugin URI: http://www.gudlyf.com/2009/01/05/wordpress-plugin-pending-posts-indicator/
Description: Will show a bubble in the left-hand admin menu of the number of posts pending review, if more than zero.
Author: Keith McDuffee
Version: 1.0
Author URI: http://www.gudlyf.com/
*/

if(!class_exists('KWM_Pending_Posts_Indicator')) {

        class KWM_Pending_Posts_Indicator {

		function KWM_Pending_Posts_Indicator() { }

		function show_pending_number($menu) {
			
			$num_posts = wp_count_posts( 'post', 'readable' );
			$status = "pending";
			$pending_count = 0;
			if ( !empty($num_posts->$status) )
				$pending_count = $num_posts->$status;

			// Use 'plugins' classes for now. May add specific ones to this later.
			$menu[5] = array( sprintf( __('Posts %s'), "<span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . "</span></span>" ), 'edit_posts', 'edit.php', '', 'wp-menu-open menu-top', 'menu-posts', 'div' );

			return $menu;
		}
	}
}
		
add_filter('add_menu_classes', array('KWM_Pending_Posts_Indicator', 'show_pending_number'), 8);

?>
