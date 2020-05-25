<?php
/*
Description: VC Intro Text Rotator
Theme: Incanto
*/

// Block Class 
class unHeroHeadingRotator extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_hero_heading_r_map' ) );
        add_shortcode( 'un_hero_heading_r', array( $this, 'un_hero_heading_r_short' ) );
    }
 	
	// Block Map
    public function un_hero_heading_r_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Hero Head Rotator', UN),
				'base' => 'un_hero_heading_r',
				'description' => __('For special sections', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Slide 1										
					array(
						'type' => 'textfield',
						'heading' => __('Surtitle', UN),
						'param_name' => 'surtitle1',	
						'description' => __('Before the Title', UN),	
						'group' => __('Slide1', UN),		   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Title', UN),
						'param_name' => 'title1',	
						'description' => __('The Biggest', UN),
						'holder' => 'div',
						'group' => __('Slide1', UN),	   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Subtitle', UN),
						'param_name' => 'subtitle1',	
						'description' => __('After the Title', UN),
						'group' => __('Slide1', UN),   
					),
					
					// Slide 2
					array(
						'type' => 'textfield',
						'heading' => __('Surtitle', UN),
						'param_name' => 'surtitle2',	
						'description' => __('Leave it blank to display the previous Surtitle', UN),	
						'group' => __('Slide2', UN),		   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Title', UN),
						'param_name' => 'title2',	
						'description' => __('Leave it blank to display the previous Title', UN),
						'group' => __('Slide2', UN),	   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Subtitle', UN),
						'param_name' => 'subtitle2',	
						'description' => __('Leave it blank to display the previous Subtitle', UN),
						'group' => __('Slide2', UN),   
					),
					
					// Slide 3
					array(
						'type' => 'textfield',
						'heading' => __('Surtitle', UN),
						'param_name' => 'surtitle3',	
						'description' => __('Leave it blank to display the previous Surtitle', UN),	
						'group' => __('Slide3', UN),		   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Title', UN),
						'param_name' => 'title3',	
						'description' => __('Leave it blank to display the previous Title', UN),
						'group' => __('Slide3', UN),	   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Subtitle', UN),
						'param_name' => 'subtitle3',	
						'description' => __('Leave it blank to display the previous Subtitle', UN),
						'group' => __('Slide3', UN),   
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
	public function un_hero_heading_r_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'surtitle1'	=> '',
					'title1'     => '',
					'subtitle1'	=> '',	
					'surtitle2'	=> '',
					'title2'     => '',
					'subtitle2'	=> '',	
					'surtitle3'	=> '',
					'title3'     => '',
					'subtitle3'	=> '',				
				), 
				$atts
			)
		);
		
		// Build Surtitle
		$surtitle = '';
		
		if($surtitle1){
			$surtitle = $surtitle1;
		}
		
		if($surtitle2){
			$surtitle .= ' | ' . $surtitle2;
		}
		
		if($surtitle3){
			$surtitle .= ' | ' . $surtitle3;
		}
		
		$surtitle_ar = explode(' | ', $surtitle);
		if( count($surtitle_ar) > 1 ){
			$surtitle = '<span class="rotate">'.$surtitle.'</span>';
		}
		
		
		// Build Title
		$title = '';
		
		if($title1){
			$title = $title1;
		}
		
		if($title2){
			$title .= ' | ' . $title2;
		}
		
		if($title3){
			$title .= ' | ' . $title3;
		}
		
		$title_ar = explode(' | ', $title);
		if( count($title_ar) > 1 ){
			$title = '<span class="rotate">'.$title.'</span>';
		}
		
		
		// Build Subtitle
		$subtitle = '';
		
		if($subtitle1){
			$subtitle = $subtitle1;
		}
		
		if($subtitle2){
			$subtitle .= ' | ' . $subtitle2;
		}
		
		if($subtitle3){
			$subtitle .= ' | ' . $subtitle3;
		}
		
		$subtitle_ar = explode(' | ', $subtitle);
		if( count($subtitle_ar) > 1 ){
			$subtitle = '<span class="rotate">'.$subtitle.'</span>';
		}
		
		
		// Build HTML
		$html = '';
	
		$html .= '
		<!-- HERO TEXT -->
		<div class="hero-caption">
			<div class="hero-text">
				<h5 class="mh-line-size-4 font-alt m-b-50">'.$surtitle.'</h5>
				<h1 class="mh-line-size-1 font-alt m-b-60">'.$title.'</h1>
				<h5 class="mh-line-size-5 font-alt m-b-50">'.$subtitle.'</h5>
			</div>
		</div>
		<!-- /HERO TEXT -->';
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unHeroHeadingRotator();			