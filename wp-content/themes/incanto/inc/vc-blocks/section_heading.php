<?php
/*
Description: VC Section Heading
Theme: Incanto
*/

// Block Class 
class unSectionHeading extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_section_heading_map' ) );
        add_shortcode( 'un_section_heading', array( $this, 'un_section_heading_short' ) );
    }
 	
	// Block Map
    public function un_section_heading_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Section Head', UN),
				'base' => 'un_section_heading',
				'description' => __('For standard sections', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Content									
					array(
						'type' => 'textfield',
						'heading' => __('Title', UN),
						'param_name' => 'title',	
						'description' => __('Leave blank to disable it', UN),
						'holder' => 'div',
						'group' => __('Content', UN),		   
					),	
					array(
						'type' => 'textarea',
						'heading' => __('Subtitle', UN),
						'param_name' => 'subtitle',	
						'description' => __('Leave blank to disable it', UN),	
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
	public function un_section_heading_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'title'     => '',
					'subtitle'	=> '',				
				), 
				$atts
			)
		);
		
		$html = '';
	
		$html .= '<!-- MODULE HEADING -->';	
		
		if($title){
			$html .= '<h2 class="module-title font-alt">'.$title.'</h2>';
		}
		
		if($subtitle){
			$html .= '<div class="module-subtitle font-serif">'.$subtitle.'</div>';
		}
		
		$html .= '<!-- /MODULE HEADING -->';	
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unSectionHeading();			