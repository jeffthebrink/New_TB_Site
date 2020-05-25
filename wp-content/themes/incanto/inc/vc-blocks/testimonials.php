<?php
/*
Description: VC Testimonials
Theme: Incanto
*/

// Block Class 
class unTestimonials extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_testimonials_map' ) );
        add_shortcode( 'un_testimonials', array( $this, 'un_testimonials_short' ) );
    }
 	
	// Block Map
    public function un_testimonials_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Testimonials', UN),
				'base' => 'un_testimonials',
				'description' => __('A Testimonials Carousel', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Loop									
					array(
						'type' => 'param_group',
						'heading' => __('Testimonials', UN),
						'param_name' => 'testimonials',	
						'description' => __('Add and reorder your testimonials', UN),
						'params' => array(	
							array(
								'type' => 'textarea',
								'heading' => __('Text', UN),
								'param_name' => 'text',	
							),	
							array(
								'type' => 'textfield',
								'heading' => __('Author', UN),
								'param_name' => 'author',	
							),								
						),	   
					),
					
					// Autolpay
					array(
						'type' => 'checkbox',
						'heading' => __('Enable Autoplay', UN),
						'param_name' => 'autoplay',	
					),	
					
					// Slide Delay
					array(
						'type' => 'textfield',
						'heading' => __('Slide Delay', UN),
						'param_name' => 'delay',	
						'description' => __('Use an integer value for milliseconds (default value: 5000)', UN),	
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
	public function un_testimonials_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'testimonials'	=> '',	
					'autoplay' => true,
					'delay' => '5000',
				), 
				$atts
			)
		);
	
		$testimonials = json_decode(urldecode($testimonials));
		
		if( !$testimonials || count($testimonials) == 0 ) { return; }
		
		if( $autoplay == true ){
			$autoplay = $delay;
		}else{
			$autoplay = 'false';
		}
		
		$html = '';
		
		$html .= '
		<!-- TESTIMONIALS CAROUSEL -->
		<div class="owl-carousel slider-testimonials text-center" data-autoplay="'.$autoplay.'">';
			
			foreach($testimonials as $testimonial) {
				
				$html .= '
				<!-- SLIDE -->
				<div class="item">
					<h5 class="module-icon m-b-20">
						<span class="icon-quote"></span>
					</h5>
					<div class="font-serif m-b-20">
						'.$testimonial->text.'
					</div>
					<div class="quote-author font-alt">'.$testimonial->author.'</div>
				</div>
				<!-- /SLIDE -->';
			
			}

		$html .= '
		</div>
		<!-- /TESTIMONIALS CAROUSEL -->';
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unTestimonials();			