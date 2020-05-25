<?php
/*
Description: VC Accordion
Theme: Incanto
*/

// Block Class 
class unAccordion extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_accordion_map' ) );
        add_shortcode( 'un_accordion', array( $this, 'un_accordion_short' ) );
    }
 	
	// Block Map
    public function un_accordion_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Accordion', UN),
				'base' => 'un_accordion',
				'description' => __('Our version of the accordion block', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Loop									
					array(
						'type' => 'param_group',
						'heading' => __('Accordion', UN),
						'param_name' => 'accordion',	
						'description' => __('Add and sort multiple items', UN),
						'params' => array(	
								
							// Title
							array(
								'type' => 'textfield',
								'heading' => __('Title', UN),
								'param_name' => 'title',	
								'description' => __('Item Title', UN),			   
							),	
							
							// Description
							array(
								'type' => 'textarea',
								'heading' => __('Description', UN),
								'param_name' => 'description',	
								'description' => __('Item Description', UN),	   
							),
						
						),
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
	public function un_accordion_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'accordion'	=> '',			
				), 
				$atts
			)
		);
		
		$html = '';
		
		if( $accordion ){
			
			// Setup Accordion
			$accordion = json_decode(urldecode($accordion));		
			if( !$accordion || count($accordion) == 0 ) { return; }
			
			$html .='
			<!-- ACCORDIONS -->
			<div class="panel-group" id="accordion">';
				
				$i = 1;
				$in = 'in';
				
				foreach($accordion as $item){
					
					if( isset($item->title) && isset($item->description) ){
						
						$html .= '
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title font-alt">
									<a data-toggle="collapse" data-parent="#accordion" href="#support'.$i.'">
										'.$item->title.'
									</a>
								</h4>
							</div>
							<div id="support'.$i.'" class="panel-collapse collapse '.$in.'">
								<div class="panel-body">
									'.$item->description.'
								</div>
							</div>
						</div>';
						
						$i++;
						$in = '';
					
					}
					
				}
			
			$html .='
			</div>
			<!-- /ACCORDIONS -->';
		
		}else{
			
			return;
			
		}
		
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unAccordion();			