<?php
/*
Description: VC Slider
Theme: Incanto
*/

// Block Class 
class unSlider extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_slider_map' ) );
        add_shortcode( 'un_slider', array( $this, 'un_slider_short' ) );
    }
 	
	// Block Map
    public function un_slider_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Sliders List
		$sliders_list = array( __('Select a Slider', UN) => '' );
		
		$slider_query = new WP_Query( array ('post_type' => 'un-slider', 'post_status' => 'publish', 'pagination' => false, 'posts_per_page' => '-1', 'order' => 'ASC', 'orderby' => 'title') );
		if ( $slider_query->have_posts() ) {
			while ( $slider_query->have_posts() ) {
				$slider_query->the_post();				
				$sliders_list[get_the_title()] = get_the_ID();				
			}
		}
		wp_reset_postdata();
				
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Slider', UN),
				'base' => 'un_slider',
				'description' => __('A smart image slider', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Select Slider
					array(
						'type' => 'dropdown',
						'heading' => __('Select the Slider', UN),
						'param_name' => 'slider',
						'description' => __('Select on of your Sliders (you have to create at least a slider using the Sliders menu on the left', UN),	
						'value' => $sliders_list,
					),
					
					// Mode
					array(
						'type' => 'dropdown',
						'heading' => __('Slider Mode', UN),
						'param_name' => 'mode',
						'value' => array(__('Intro', UN) => 'intro', __('Standard', UN) => 'standard'),
						'description' => __('Note: the STandard mode will not show the titles', UN),	
					),
								
					// Special Features
					array(
						'type' => '',
						'param_name' => 'info_special',	
						'description' => __('<i class="fa fa-info-circle"></i> To manage special section features like the full-height you have to edit the <b>Row Options</b>', UN),	   
					),								
					
				),
			)
		);					  			  
	   
    } // End Block Map
	
	
	// Block Shortcode
	public function un_slider_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'slider' => '',	
					'mode' => 'intro',	
				), 
				$atts
			)
		);
		
		$slides = redux_post_meta( UN, $slider, 'slides' );

		$html = '';
		
		if( $mode == 'intro' ){
			
			$html .= '
			<div id="slides">
	
					<ul class="slides-container">';
						
						foreach($slides as $slide){
							
							// The Image
							if( isset($slide['image']) && !empty($slide['image']) ){ $image = $slide['image']; }else{ $image = 'http://placehold.it/2000x2000?text=You+have+to+select+an+Image'; }
							
							// The image is dark?
							if( isset($slide['dark']) ){ $dark = $slide['dark']; }else{ $dark = ''; }
							
							// The Overlay
							if( isset($slide['overlay']) ){ $overlay = $slide['overlay']; }else{ $overlay = ''; }
							
							// The Title
							if( isset($slide['title']) ){ $title = $slide['title']; }else{ $title = ''; }
							
							// The Title Animation
							if( isset($slide['title_anim']) ){ $title_anim = $slide['title_anim']; }else{ $title_anim = ''; }
							
							// The Subtitle
							if( isset($slide['subtitle']) ){ $subtitle = $slide['subtitle']; }else{ $subtitle = ''; }
							
							// The Subtitle Animation
							if( isset($slide['subtitle_anim']) ){ $subtitle_anim = $slide['subtitle_anim']; }else{ $subtitle_anim = ''; }
				
							$html .='
							<li class="'.$dark.' '.$overlay.'">
								<img src="'.$image.'" alt="'.$title.'">
		
								<!-- HERO TEXT -->
								<div class="hero-caption">
									<div class="hero-text">
										<h1 class="mh-line-size-2 font-alt m-b-50 wow '.$title_anim.'">'.$title.'</h1>
										<h5 class="mh-line-size-5 font-alt wow '.$subtitle_anim.'" data-wow-delay="0.7s">'.$subtitle.'</h5>
									</div>
								</div>
								<!-- /HERO TEXT -->
							</li>';
						}
						
	
			$html .= '</ul>
	
					<nav class="slides-navigation">
						<a href="#" class="next"><i class="fa fa-angle-right"></i></a>
						<a href="#" class="prev"><i class="fa fa-angle-left"></i></a>
					</nav>
	
				</div>';
			
		}else{
			
			$html .= '<div class="owl-carousel slider-images">';
						
				foreach($slides as $slide){
					
					// The Image
					if( isset($slide['image']) && !empty($slide['image']) ){ $image = $slide['image']; }else{ $image = 'http://placehold.it/2000x2000?text=You+have+to+select+an+Image'; }
					
					// The Overlay
					if( isset($slide['overlay']) ){ $overlay = $slide['overlay']; }else{ $overlay = ''; }
					
					$html .='
					
					<div class="item '.$overlay.'">
						<img src="'.$image.'" alt="" />
					</div>';					
					
				}
						
	
			$html .= '</div>';
			
		}
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unSlider();			