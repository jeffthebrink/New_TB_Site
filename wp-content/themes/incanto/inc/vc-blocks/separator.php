<?php
/*
Description: VC Separator
Theme: Incanto
*/

// Block Class 
class unSeparator extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_separator_map' ) );
        add_shortcode( 'un_separator', array( $this, 'un_separator_short' ) );
    }
 	
	// Block Map
    public function un_separator_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Separator', UN),
				'base' => 'un_separator',
				'description' => __('The section separator', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					array(
						'type' => '',
						'param_name' => 'info',	
						'description' => __('<i class="fa fa-info-circle"></i> This is a simple separator and it hasn\'t any option.', UN),		   
					),
				),
			)
		);					  			  
	   
    } // End Block Map
	
	
	// Block Shortcode
	public function un_separator_short( $atts ) {
		
		$html = '<hr class="divider">';
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unSeparator();			