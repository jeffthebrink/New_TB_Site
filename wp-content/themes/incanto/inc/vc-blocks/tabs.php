<?php
/*
Description: VC Tabs
Theme: Incanto
*/

// Block Class 
class unTabs extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_tabs_map' ) );
        add_shortcode( 'un_tabs', array( $this, 'un_tabs_short' ) );
    }
 	
	// Block Map
    public function un_tabs_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Tabs', UN),
				'base' => 'un_tabs',
				'description' => __('Our version of the tabs block', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Loop									
					array(
						'type' => 'param_group',
						'heading' => __('Tabs', UN),
						'param_name' => 'tabs',	
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
	public function un_tabs_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'tabs'	=> '',			
				), 
				$atts
			)
		);
		
		$html = '';
		
		if( $tabs ){
			
			// Setup Accordion
			$tabs = json_decode(urldecode($tabs));		
			if( !$tabs || count($tabs) == 0 ) { return; }
			
			$html .='
			<!-- TABS -->
			<div role="tabpanel">';
				
				// Nav
				$html .='<ul class="nav nav-tabs font-alt" role="tablist">';
				
					$i = 1;
					$active = 'active';
					
					
					foreach($tabs as $item){
						
						if( isset($item->title) && isset($item->description) ){
							
							$html .= '<li class="'.$active.'"><a href="#item'.$i.'" data-toggle="tab">'.$item->title.'</a></li>';
							
							$i++;
							$active = '';
						
						}
						
					}
				
				$html .= '</ul>';
				
				// Content
				$html .='<div class="tab-content">';
				
					$i = 1;
					$active = 'active';
					
					
					foreach($tabs as $item){
						
						if( isset($item->title) && isset($item->description) ){
							
							$html .= '
							<div class="tab-pane '.$active.'" id="item'.$i.'">
								'.$item->description.'
							</div>';
							
							$i++;
							$active = '';
						
						}
						
					}
				
				$html .= '</div>';
			
			$html .='
			</div>
			<!-- /TABS -->';
		
		}else{
			
			return;
			
		}
		
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unTabs();			