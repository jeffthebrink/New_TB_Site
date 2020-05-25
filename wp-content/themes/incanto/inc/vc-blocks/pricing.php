<?php
/*
Description: VC Pricing
Theme: Incanto
*/

// Block Class 
class unPricing extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_pricing_map' ) );
        add_shortcode( 'un_pricing', array( $this, 'un_pricing_short' ) );
    }
 	
	// Block Map
    public function un_pricing_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Pricing Table', UN),
				'base' => 'un_pricing',
				'description' => __('A composable pricing table', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(
					
					// Title
					array(
						'type' => 'textfield',
						'heading' => __('Pricing Title', UN),
						'param_name' => 'label',
						'holder' => 'div',		   
					),
					
					// Featured
					array(
						'type' => 'checkbox',
						'heading' => __('Featured', UN),
						'param_name' => 'featured',		   
					),
					
					// Price
					array(
						'type' => 'textfield',
						'heading' => __('Price', UN),
						'param_name' => 'price',		   
					),
					
					// Currency
					array(
						'type' => 'textfield',
						'heading' => __('Currency', UN),
						'param_name' => 'currency',		   
					),
					
					// Loop									
					array(
						'type' => 'param_group',
						'heading' => __('Features', UN),
						'param_name' => 'features',	
						'description' => __('Add and sort multiple features for your pricing table', UN),
						'params' => array(	
							
							// Feature Label
							array(
								'type' => 'textfield',
								'heading' => __('Feature Label', UN),
								'param_name' => 'label',		   
							),
							
							// Type	
							array(
								'type' => 'dropdown',
								'heading' => __('Type', UN),
								'param_name' => 'type',	
								'value' => array( 
									__('Enabled', UN) => '1', 
									__('Disabled', UN) => '0', 
								),
							),	
										
						),	   
					),
					
					// Button
					array(
						'type' => 'vc_link',
						'heading' => __('Button', UN),
						'param_name' => 'button',		   
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
	public function un_pricing_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'label'	    => 'Choose a Title',
					'featured'	=> '0',		
					'price'	    => '',		
					'currency'	=> '$',
					'features'	=> '',
					'button'	=> '',							
				), 
				$atts
			)
		);
		
		// Build Button
		$button = vc_build_link( $button );
				
		$html = '';
		
		if( $featured == true ){
			$html .= '
			<div class="price-table best font-alt">
				<h4>'.$label.'</h4>
				<p class="small">'.__('Best Choice', UN).'</p>'; 
		}else{
			$html .= '
			<div class="price-table font-alt">
				<h4>'.$label.'</h4>';
		}
		
		$html .= '<div class="borderline"></div>';
		
		if( $price ){
			$html .= '<p class="price"><span>'.$currency.'</span>'.$price.'</p>';
		}
		
		$html .= '<ul class="price-details">';
		
		if( $features ){
			
			// Setup Features
			$features = json_decode(urldecode($features));		
			if( !$features || count($features) == 0 ) { return; }
								
			foreach( $features as $feature ){
				
				if( isset($feature->type) && $feature->type == true ){
					
					$html .= '<li>'.$feature->label.'</li>';
					
				}else{
					
					$html .= '<li><span>'.$feature->label.'</span></li>';
					
				}
						
			}		
			
		}else{
			
			return;
			
		}
		
		if( !$button['target'] ){ $button['target'] = '_self'; } 
		
		$html .= '</ul>';
		
		if( $button['url'] ){			
			$html .= '<a href="'.esc_url($button['url']).'" target="'.$button['target'].'" class="btn btn-d btn-round">'.$button['title'].'</a>';			
		}
		
		$html .= '</div>';
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unPricing();			