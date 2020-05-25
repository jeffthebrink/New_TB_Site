<?php
/*
Description: VC Clients
Theme: Incanto
*/

// Block Class 
class unClients extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_clients_map' ) );
        add_shortcode( 'un_clients', array( $this, 'un_clients_short' ) );
    }
 	
	// Block Map
    public function un_clients_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Clients', UN),
				'base' => 'un_clients',
				'description' => __('A Clients block (carousel and grid)', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Loop									
					array(
						'type' => 'param_group',
						'heading' => __('Clients', UN),
						'param_name' => 'clients',	
						'description' => __('Add and reorder your clients', UN),
						'params' => array(	
							array(
								'type' => 'attach_image',
								'heading' => __('Logo', UN),
								'param_name' => 'logo',	
							),	
							array(
								'type' => 'textfield',
								'heading' => __('Url', UN),
								'param_name' => 'url',	
								'description' => __('Leave in balnk to disable the url', UN),
							),								
						),	   
					),
					
					// Type 
					array(
						'type' => 'dropdown',
						'heading' => __( 'Type', UN ),
						'param_name' => 'type',
						'value' => array( __( 'Carousel', UN ) => 'carousel',  __('Grid', UN ) => 'grid' ),
					),
					
					// Autolpay
					array(
						'type' => 'checkbox',
						'heading' => __('Enable Autoplay', UN),
						'param_name' => 'autoplay',	
						'dependency' => array(
							'element' => 'type',
							'value' => 'carousel',
						),
					),	
					
					// Slide Delay
					array(
						'type' => 'textfield',
						'heading' => __('Slide Delay', UN),
						'param_name' => 'delay',	
						'description' => __('Use an integer value for milliseconds (default value: 5000)', UN),	
						'dependency' => array(
							'element' => 'type',
							'value' => 'carousel',
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
	public function un_clients_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'clients'	=> '',
					'type' => 'carousel',
					'autoplay' => true,
					'delay' => '5000',
				), 
				$atts
			)
		);
	
		$clients = json_decode(urldecode($clients));
		
		if( !$clients || count($clients) == 0 ) { return; }
		
		if( $autoplay == true ){
			$autoplay = $delay;
		}else{
			$autoplay = 'false';
		}
		
		$html = '';
		
		if( $type == 'carousel' ){
			
			$html .= '
			<!-- CLIENTS CAROUSEL -->
			<div class="slider-clients owl-carousel text-center" data-autoplay="'.$autoplay.'">';
				
				foreach($clients as $client) {
					
					if( isset($client->logo) ){
						
						// Build Image Shape
						$logo_html = un_get_the_attachment( $client->logo, 90, '', false, true );
						
						if( isset($client->url) && !empty($client->url)){
							$logo_html = '<a href="'.esc_url($client->url).'" target="_blank">'.$logo_html.'</a>';
						}
							
						$html .= '
						<!-- Client logo start -->
						<div class="owl-item">
							<div class="col-sm-12">
								<div class="client-item">
									'.$logo_html.'
								</div>
							</div>
						</div>
						<!--  Client logo end -->';
					
					}
				
				}
		
			$html .= '
			</div>
			<!-- /CLIENTS CAROUSEL -->';
		
		}else{
			
			foreach($clients as $client) {
					
				if( isset($client->logo) ){
					
					// Build Image Shape
					$logo_html = un_get_the_attachment( $client->logo, 90, '', false, true );
					
					if( isset($client->url) && !empty($client->url)){
						$logo_html = '<a href="'.esc_url($client->url).'" target="_blank">'.$logo_html.'</a>';
					}
						
					$html .= '
					<div class="col-sm-2 col-xs-6 alt-client-item">
						'.$logo_html.'							
					</div>';
				
				}
			
			}					
						
		}
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unClients();			