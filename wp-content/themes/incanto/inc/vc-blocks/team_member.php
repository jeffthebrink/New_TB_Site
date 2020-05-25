<?php
/*
Description: VC Counter
Theme: Incanto
*/

// Block Class 
class unTeamMember extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_team_member_map' ) );
        add_shortcode( 'un_team_member', array( $this, 'un_team_member_short' ) );
    }
 	
	// Block Map
    public function un_team_member_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Team Member', UN),
				'base' => 'un_team_member',
				'description' => __('Create your team grid', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Content									
					array(
						'type' => 'attach_image',
						'heading' => __('Image', UN),
						'param_name' => 'image',	
						'description' => __('The member Image', UN),		   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Name', UN),
						'param_name' => 'name',	
						'holder' => 'div',	   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Role', UN),
						'param_name' => 'role',	
					),
					
					array(
						'type' => 'textfield',
						'heading' => __('Twitter', UN),
						'param_name' => 'tw',	
						'description' => __('Add the member Twitter url (or leave it blank to disable the icon)', UN),	
					),
					
					array(
						'type' => 'textfield',
						'heading' => __('Facebook', UN),
						'param_name' => 'fb',	
						'description' => __('Add the member Facebook url (or leave it blank to disable the icon)', UN),	
					),
					
					array(
						'type' => 'textfield',
						'heading' => __('Google Plus', UN),
						'param_name' => 'gp',	
						'description' => __('Add the member Google+ url (or leave it blank to disable the icon)', UN),	
					),
					
					// Special Features
					array(
						'type' => '',
						'param_name' => 'info_special',	
						'description' => __('<i class="fa fa-info-circle"></i> To manage special section features like the overlay, the full-height and bg you have to edit the <b>Row Options</b>', UN),	
						'group' => __('Special Features', UN),		   
					),
				),
			)
		);					  			  
	   
    } // End Block Map
	
	
	// Block Shortcode
	public function un_team_member_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'image'	=> '',
					'name'  => '',
					'role'	=> '',	
					'tw'    => '',
					'fb'    => '',
					'gp'	=> '',		
				), 
				$atts
			)
		);
		
		$html = '';
		
		// Check Image
		if ( $image > 0 ) {
			
			// Build Image
			$image_html = un_get_the_attachment( $image, 600, 'auto' );
			
			// Build Socials
			if( $tw || $fb || $gp ){
				
				$socials_html = '<ul class="social-icon-links socicon-circle">';
					
				if( $tw ){
					$socials_html .= '<li><a href="'.esc_url($tw).'"><i class="fa fa-twitter"></i></a></li>';
				}
				
				if( $fb ){
					$socials_html .= '<li><a href="'.esc_url($fb).'"><i class="fa fa-facebook"></i></a></li>';
				}
				
				if( $gp ){
					$socials_html .= '<li><a href="'.esc_url($gp).'"><i class="fa fa-google-plus"></i></a></li>';
				}
				
				$socials_html .= '</ul>';
				
			}else{
				
				$socials_html = '';
				
			}
						
			$html .= '
			<!-- TEAM MEMBER -->
			<div class="team-item">
				<div class="team-image">
					'.$image_html.'
					<div class="team-detail text-center">
						'.$socials_html.'
					</div>
				</div>
				<div class="team-descr">
					<h5 class="team-name font-alt">'.$name.'</h5>
					<div class="team-role font-serif">'.$role.'</div>
				</div>
			</div>
			<!-- /TEAM MEMBER -->';
		
			return $html;
			
		} else {
			
			return;
			
		}		
		
		$html = '';
	
		$html .= '
		';
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unTeamMember();			