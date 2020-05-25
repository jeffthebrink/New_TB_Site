<?php
/*
Description: VC Services Carousel
Theme: Incanto
*/

// Block Class 
class unServicesCarousel extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_services_carousel_map' ) );
        add_shortcode( 'un_services_carousel', array( $this, 'un_services_carousel_short' ) );
    }
 	
	// Block Map
    public function un_services_carousel_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Services Carousel', UN),
				'base' => 'un_services_carousel',
				'description' => __('A carousel of Services', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Loop									
					array(
						'type' => 'param_group',
						'heading' => __('Services', UN),
						'param_name' => 'services',	
						'description' => __('Add and sort multiple titles using different styles', UN),
						'params' => array(	
							
							// Icon									
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
							),
							
							// Title
							array(
								'type' => 'textfield',
								'heading' => __('Title', UN),
								'param_name' => 'title',	
								'description' => __('Service Title', UN),			   
							),	
							
							// Description
							array(
								'type' => 'textarea',
								'heading' => __('Description', UN),
								'param_name' => 'description',	
								'description' => __('Service Description', UN),	   
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
	public function un_services_carousel_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'services'	=> '',			
				), 
				$atts
			)
		);
		
		$html = '';
		
		if( $services ){
			
			// Setup Services
			$services = json_decode(urldecode($services));		
			if( !$services || count($services) == 0 ) { return; }
			
			$html .='
			<!-- Owl-carousel start -->
			<div class="slider-content-box owl-carousel text-center">';
				
				foreach($services as $service){
					
					$html .= '
					<!-- CONTENT BOX -->
					<div class="owl-item">
						<div class="col-sm-12">
							<div class="content-box">
								<div class="content-box-icon">
									<span class="'.$service->icon.'"></span>
								</div>
								<h5 class="content-box-title font-alt">'.$service->title.'</h5>
								<div class="content-box-text">
									'.$service->description.'
								</div>
							</div>
						</div>
					</div>
					<!-- /CONTENT BOX -->';
					
				}
			
			$html .='
			</div>
			<!-- Owl-carousel end -->';
		
		}else{
			
			return;
			
		}
		
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unServicesCarousel();			