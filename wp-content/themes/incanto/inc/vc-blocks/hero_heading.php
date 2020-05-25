<?php
/*
Description: VC Hero Heading
Theme: Incanto
*/

// Block Class 
class unHeroHeading extends WPBakeryShortCode {
    
	// Class Init
	function __construct() { 
        add_action( 'init', array( $this, 'un_hero_heading_map' ) );
        add_shortcode( 'un_hero_heading', array( $this, 'un_hero_heading_short' ) );
    }
 	
	// Block Map
    public function un_hero_heading_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Hero Head', UN),
				'base' => 'un_hero_heading',
				'description' => __('For special sections', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Loop									
					array(
						'type' => 'param_group',
						'heading' => __('Titles', UN),
						'param_name' => 'titles',	
						'description' => __('Add and sort multiple titles using different styles', UN),
						'params' => array(	
							
							// Title	
							array(
								'type' => 'textfield',
								'heading' => __('Title', UN),
								'param_name' => 'title',		   
							),
							
							// Size	
							array(
								'type' => 'dropdown',
								'heading' => __('Size', UN),
								'param_name' => 'size',	
								'value' => array( 
									__('XXL', UN) => 'mh-line-size-1', 
									__('XL', UN) => 'mh-line-size-2',
									__('L', UN) => 'mh-line-size-3',
									__('M', UN) => 'mh-line-size-4',
									__('S', UN) => 'mh-line-size-5',
									__('XS', UN) => 'mh-line-size-6',
								),
							),	
							
							// Margin Bottom	
							array(
								'type' => 'dropdown',
								'heading' => __('Bottom Margin', UN),
								'param_name' => 'margin',	
								'value' => array( 
									__('No Margin', UN) => 'm-b-0', 
									__('10 Pixels', UN) => 'm-b-10',
									__('20 Pixels', UN) => 'm-b-20',
									__('30 Pixels', UN) => 'm-b-30',
									__('40 Pixels', UN) => 'm-b-40',
									__('50 Pixels', UN) => 'm-b-50',
									__('60 Pixels', UN) => 'm-b-60',
									__('70 Pixels', UN) => 'm-b-70',
									__('80 Pixels', UN) => 'm-b-80',
									__('90 Pixels', UN) => 'm-b-90',
								),
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
	public function un_hero_heading_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'titles'	=> '',			
				), 
				$atts
			)
		);
		
		$html = '';
		
		if( $titles ){
			
			// Setup Titles
			$titles = json_decode(urldecode($titles));		
			if( !$titles || count($titles) == 0 ) { return; }
						
			$html .= '
			<!-- HERO TEXT -->
			<div class="hero-caption">
				<div class="hero-text">';
					
					foreach( $titles as $title ){
						
						switch( $title->size ){
							
							case 'mh-line-size-1':
							$html .= '<h1 class="'.$title->size.' font-alt '.$title->margin.'">'.$title->title.'</h1>';
							break;
							
							case 'mh-line-size-2':
							$html .= '<h2 class="'.$title->size.' font-alt '.$title->margin.'">'.$title->title.'</h2>';
							break;
							
							case 'mh-line-size-3':
							$html .= '<h3 class="'.$title->size.' font-alt '.$title->margin.'">'.$title->title.'</h3>';
							break;
							
							case 'mh-line-size-4':
							$html .= '<h4 class="'.$title->size.' font-alt '.$title->margin.'">'.$title->title.'</h4>';
							break;
							
							case 'mh-line-size-5':
							$html .= '<h5 class="'.$title->size.' font-alt '.$title->margin.'">'.$title->title.'</h5>';
							break;
							
							case 'mh-line-size-6':
							$html .= '<h6 class="'.$title->size.' font-alt '.$title->margin.'">'.$title->title.'</h6>';
							break;
							
						}
					
					}
					
			$html .='	
				</div>
			</div>
			<!-- /HERO TEXT -->';
			
		}else{
			
			return;
			
		}
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unHeroHeading();			