<?php
/*
Plugin Name: Pending Posts Indicator
Plugin URI: http://wordpress.org/plugins/pending-posts-indicator/
Description: Will show a bubble in the left-hand admin menu of the number of posts pending review, if more than zero.
Author: Keith McDuffee
Version: 1.1.1
Author URI: http://cliqueclack.com/
*/

if(!class_exists('KWM_Pending_Posts_Indicator')) {

        class KWM_Pending_Posts_Indicator {

		function KWM_Pending_Posts_Indicator() { }

		function show_pending_number($menu) {
			
			$menu_pos = -1;
			$posts_menu_pos = 3;
			$num_posts = wp_count_posts( 'post', 'readable' );
			$status = "pending";
			$pending_count = 0;
			if ( !empty($num_posts->$status) )
				$pending_count = $num_posts->$status;
			foreach ( $GLOBALS['menu'] as $menuitem ) {
				$menu_pos++;
				if( $menuitem[0] == "Posts")
					$post_menu_pos = $menu_pos;
			}

			// Use 'plugins' classes for now. May add specific ones to this later.
			$menu[$post_menu_pos] = array( sprintf( __('Posts %s'), "<span class='update-plugins count-$pending_count'><span class='plugin-count'>" . number_format_i18n($pending_count) . "</span></span>" ), 'edit_posts', 'edit.php', '', 'open-if-no-js menu-top menu-icon-post', 'menu-posts', 'none' );

			return $menu;
		}
	}
}
		
add_filter('add_menu_classes', array('KWM_Pending_Posts_Indicator', 'show_pending_number'), 8);

?>
