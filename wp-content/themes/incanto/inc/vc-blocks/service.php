<?php
/*
Description: VC Service
Theme: Incanto
*/

// Block Class 
class unService extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_service_map' ) );
        add_shortcode( 'un_service', array( $this, 'un_service_short' ) );
    }
 	
	// Block Map
    public function un_service_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Service', UN),
				'base' => 'un_service',
				'description' => __('Your service box', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Content									
					array(
						'type' => 'iconpicker',
						'heading' => __( 'Icon', UN ),
						'param_name' => 'icon',
						'description' => __( 'Select the service icon', UN ),
						'settings' => array(
							'emptyIcon' => false,
							'type' => 'etline',
							'iconsPerPage' => 500,
						),
						'group' => __('Content', UN),						
					),
					array(
						'type' => 'textfield',
						'heading' => __('Title', UN),
						'param_name' => 'title',	
						'description' => __('Service Title', UN),	
						'holder' => 'div',
						'group' => __('Content', UN),		   
					),	
					array(
						'type' => 'textarea',
						'heading' => __('Description', UN),
						'param_name' => 'description',	
						'description' => __('Service Description', UN),	
						'group' => __('Content', UN),	   
					),
					array(
						'type' => 'dropdown',
						'heading' => __('Layout', UN),
						'param_name' => 'layout',	
						'description' => __('Select a Layout for the service', UN),	
						'value' => array(
							__('Icon Top', UN) => 'icontop', 
							__('Icon Left', UN) => 'iconleft', 
						),
						'group' => __('Content', UN),	   
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
	public function un_service_short( $atts, $content ) {
		
		extract(
			shortcode_atts(
				array(
					'icon'	=> '',
					'title'     => '',
					'description' => '',
					'layout'	=> 'icontop',			
				), 
				$atts
			)
		);
		
		if( $layout == 'icontop' ){
			$html = '
			<div class="content-box">
				<div class="content-box-icon">
					<span class="'.$icon.'"></span>
				</div>
				<h5 class="content-box-title font-alt">'.$title.'</h5>
				<div class="content-box-text">
					'.$description.'
				</div>
			</div>';
		}else{
			
			$html ='
			<!-- ALT CONTENT BOX -->
			<div class="alt-content-box m-t-50 text-left">
				<div class="alt-content-box-icon">
					<span class="'.$icon.'"></span>
				</div>
				<h6 class="alt-content-box-title font-alt">'.$title.'</h6>
				<div class="content-box-text">
					'.$description.'
				</div>
			</div>
			<!-- /ALT CONTENT BOX -->';
			
		}
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unService();			