<?php
/*
Description: VC Counter
Theme: Incanto
*/

// Block Class 
class unCounter extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_counter_map' ) );
        add_shortcode( 'un_counter', array( $this, 'un_counter_short' ) );
    }
 	
	// Block Map
    public function un_counter_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Counter', UN),
				'base' => 'un_counter',
				'description' => __('Animated Counter', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Content									
					array(
						'type' => 'textfield',
						'heading' => __('Number', UN),
						'param_name' => 'number',	
						'description' => __('The final value (use an integer number)', UN),		   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Suffix', UN),
						'param_name' => 'suffix',	
						'description' => __('Add a suffix to your count (for ex. K or % or other)', UN),		   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Label', UN),
						'param_name' => 'label',	
						'description' => __('The counter label', UN),	
						'holder' => 'div',
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
	public function un_counter_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'number'	=> '',
					'suffix'     => '',
					'label'	=> '',				
				), 
				$atts
			)
		);
		
		if( $number ){
			
			$number = intval( $number );
			
		}else{
			
			$number = 1234;
			
		}
		
		$html = '';
	
		$html .= '
		<!-- COUNTER -->
		<div class="counter-item">
			<div class="counter-title font-alt">
				<h5 class="font-alt counter-number" data-number="'.$number.'"><span></span>'.$suffix.'</h5>
				'.$label.'
			</div>
		</div>
		<!-- /COUNTER -->';
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unCounter();			