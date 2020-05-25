<?php
/*
Description: unCommons Panel
*/

// unCommons Panel
add_action( 'wp_dashboard_setup', 'un_panel' );

function un_panel() {
	
	global $uncommons;
	
	$hide_option = $uncommons['opt-adv-unCommons-hide'];
	
	if ( $hide_option != '1' ) {
		
		// Remove other WP Widgets
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        //remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        //remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
		
		// Add Widget
		wp_add_dashboard_widget( 'un_panel', 'unCommons Panel', 'un_panel_display' );
		
		// Get Normal Dashboard
		global $wp_meta_boxes;
		$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
		
		// Backup and delete our new dashboard widget from the end of the array 
		$un_news_backup = array( 'un_panel' => $normal_dashboard['un_panel'] );
		unset( $normal_dashboard['un_panel'] );
	 
		// Merge the two arrays together so our widget is at the beginning 
		$sorted_dashboard = array_merge( $un_news_backup, $normal_dashboard );
	 
		// Save the sorted array back into the original metaboxes  
		$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
		
	} // IF Not Disabled by Theme Options
	
} 

// unCommons Panel Display
function un_panel_display() {
		
		$html = '';
			
		$html .= '<ul class="un-news-list">';	
		
			$html .= '<li>';
			$html .= '<div class="un-news-title"><a href="https://themeforest.net/user/uncommons/portfolio?ref=unCommons" target="_blank">Discover our themes</a></div>';
			$html .= '<div class="un-news-message">Do you like this theme? Take a look to the others too.</div>';
			$html .= '</li>';	
			
			$html .= '<li>';
			$html .= '<div class="un-news-title"><a href="http://www.uncommons.pro/studio.php" target="_blank">Do you need a Customization?</a></div>';
			$html .= '<div class="un-news-message">Get in touch with us and personalize your theme.</div>';
			$html .= '</li>';
			
			$html .= '<li>';
			$html .= '<div class="un-news-title"><a href="https://twitter.com/unCommonsTeam" target="_blank">Follow us on Twitter</a></div>';
			$html .= '<div class="un-news-message">To be always up-to-date about our offers.</div>';
			$html .= '</li>';	
			
			$html .= '<li>';
			$html .= '<div class="un-news-title"><a href="https://www.facebook.com/unCommons" target="_blank">Follow us on Facebook</a></div>';
			$html .= '<div class="un-news-message">If you don\'t follow Twitter.</div>';
			$html .= '</li>';
			
			$html .= '<li>';
			$html .= '<div class="un-news-title"><a href="http://www.support.uncommons.pro" target="_blank">Do you need Support?</a></div>';
			$html .= '<div class="un-news-message">Open a ticket, we\'ll answer you soon.</div>';
			$html .= '</li>';
		
		$html .= '</ul>';
		
		
		echo $html;
		
}