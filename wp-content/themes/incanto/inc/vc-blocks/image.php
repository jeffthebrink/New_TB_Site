<?php
/*
Description: VC Image Caption
Theme: Incanto
*/

// Block Class 
class unImage extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_image_map' ) );
        add_shortcode( 'un_image', array( $this, 'un_image_short' ) );
    }
 	
	// Block Map
    public function un_image_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Image', UN),
				'base' => 'un_image',
				'description' => __('Add an image using the live resizer', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Image									
					array(
						'type' => 'attach_image',
						'heading' => __('Image', UN),
						'param_name' => 'image',	
						'description' => __('Upload your image', UN),		   
					),
					
					array(
						'type' => '',
						'heading' => __('<h3>Customize the Image</h3>', UN),
						'description' => __('Leave the fields in blank to use the full image size', UN),		
						'param_name' => 'design_head',	
						'group' => __('Design Options', UN),
					),
					
					array(
						'type' => 'textfield',
						'heading' => __('Image Width', UN),
						'param_name' => 'width',	
						'description' => __('Use an integer value (es. 800), it will be converted in pixels', UN),	
						'group' => __('Design Options', UN),
					),
					
					array(
						'type' => 'textfield',
						'heading' => __('Image Height', UN),
						'param_name' => 'height',	
						'description' => __('Use an integer value (es. 800), it will be converted in pixels', UN),	
						'group' => __('Design Options', UN),
					),	
					
					array(
						'type' => 'checkbox',
						'heading' => __('Image Crop', UN),
						'param_name' => 'crop',	
						'description' => __('To crop the image to your sizes (you have to compile both sizes)', UN),	
						'group' => __('Design Options', UN),
					),	
					
					// Caption
					array(
						'type' => 'textfield',
						'heading' => __('Title', UN),
						'param_name' => 'title',	
						'description' => __('The caption title', UN),	
						'holder' => 'div',	   
					),	
					array(
						'type' => 'textfield',
						'heading' => __('Subtitle', UN),
						'param_name' => 'subtitle',	
						'description' => __('The caption subtitle', UN),	   
					),
					
					array(
						'type' => 'dropdown',
						'heading' => __( 'Caption Color', UN ),
						'param_name' => 'color',
						'value' => array( __( 'Dark', UN ) => '',  __('Light', UN ) => 'text-light' ),
						'description' => __( 'You could need to change the caption color on the base of your image.', UN ),
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
	public function un_image_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'image'	=> '',
					'width' => '',	
					'height' => '',	
					'crop' => false,	
					'title'     => '',
					'subtitle'	=> '',	
					'color' => '',	
				), 
				$atts
			)
		);
		
		
		$html = '';
		
		// Build Image
		if ( $image > 0 ) {
			
			// Build Image Shape
			if( !$width || !$height ){
				$crop = false;
			}
			
			if($width || $height) {
				$image_html = un_get_the_attachment( $image, $width, $height, $crop, true );
			}else{
				$thumbnail_obj = wpb_getImageBySize( array(
					'attach_id' => $image,
					'thumb_size' => 'full',
				) );
				
				$image_html = $thumbnail_obj['thumbnail'];
			}
			
			if( $title || $subtitle ){
				
				$html .= '
				<!-- IMAGE WITH CAPTION -->
				<div class="image-caption '.$color.'">
					<div class="caption-text">
						<h5 class="font-alt">'.$title.'</h5>
						<p class="font-serif">'.$subtitle.'</p>
					</div>
					'.$image_html.'
				</div>
				<!-- /IMAGE WITH CAPTION -->';
				
			}else{
				
				$html .= $image_html;
								
			}
		
			return $html;
			
		} else {
			
			return;
			
		}		
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unImage();			