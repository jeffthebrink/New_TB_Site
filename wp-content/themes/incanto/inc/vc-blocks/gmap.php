<?php
/*
Description: VC GMAP
Theme: Incanto
*/

// Block Class 
class unGmap extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_gmap_map' ) );
        add_shortcode( 'un_gmap', array( $this, 'un_gmap_short' ) );
    }
 	
	// Block Map
    public function un_gmap_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Google Map', UN),
				'base' => 'un_gmap',
				'description' => __('A custom Google Map', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Lat									
					array(
						'type' => 'textfield',
						'heading' => __('Latitude', UN),
						'param_name' => 'lat',	
						'description' => __('Marker Latitute', UN),		   
					),	
					
					// Lng									
					array(
						'type' => 'textfield',
						'heading' => __('Longitude', UN),
						'param_name' => 'lng',	
						'description' => __('Marker Longitude', UN),		   
					),	
					
					// Marker
					array(
						'type' => 'textarea',
						'heading' => __('Marker Description', UN),
						'param_name' => 'marker',	
						'description' => __('Content for the info window (HTML allowed)', UN),	  
					),
					
					// Height								
					array(
						'type' => 'textfield',
						'heading' => __('Map Height', UN),
						'param_name' => 'height',	
						'description' => __('Use an integer number (it will be converted in pixels)', UN),		   
					),
					
					// Zoom
					array(
						'type' => 'dropdown',
						'heading' => __('Map Zoom', UN),
						'param_name' => 'zoom',	
						'description' => __('Select the starting zoom for your Map', UN),	
						'value' => array(
							__('Default', UN) => '16', 
							__('1', UN) => '1', 
							__('2', UN) => '2', 
							__('3', UN) => '3', 
							__('4', UN) => '4', 
							__('5', UN) => '5', 
							__('6', UN) => '6', 
							__('7', UN) => '7', 
							__('8', UN) => '8', 
							__('9', UN) => '9', 
							__('10', UN) => '10', 
							__('11', UN) => '11', 
							__('12', UN) => '12', 
							__('13', UN) => '13', 
							__('14', UN) => '14', 
							__('15', UN) => '15', 
							__('16', UN) => '16', 
							__('17', UN) => '17', 
							__('18', UN) => '18', 
							__('19', UN) => '19', 
							__('20', UN) => '20', 
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
	public function un_gmap_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'lat'	 => '34.031428',
					'lng'    => '-118.2071542,17',
					'marker' => __('Put something in the Market Content field', UN),
					'height' => '450',
					'zoom' => '16',		
				), 
				$atts
			)
		);
		
		$html = '<div id="map" data-lat="'.$lat.'" data-lng="'.$lng.'" data-zoom="'.$zoom.'" data-icon="'.UN_THEME_URI.'assets/img/map-icon.png" style="height: '.$height.'px;">'.$marker.'</div>';	
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unGmap();			