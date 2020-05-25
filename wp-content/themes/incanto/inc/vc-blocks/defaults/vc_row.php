<?php
/*
Description: VC Row Shortcode
Theme: Incanto
*/

$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $container = $el_id = $parallax_image = $parallax = $full_height = $dark_image = $overlay = '';
extract( shortcode_atts( array(
	
	// unCommons
	'bg_source' => 'design',
	'parallax_image' => '',
	'video_url' => '',
	'video_image' => '',
	'starts_at' => '',
	'volume' => '',
	'loop' => 'true',
	'text_color' => '',
	'overlay' => '',
	'full_height' => '',
	'container' => '',
	'onepage_menu' => '',
	
	// Defaults
	'bg_image' => '',
	'bg_color' => '',
	'bg_image_repeat' => '',
	'font_color' => '',
	'padding' => '',
	'margin_bottom' => '',
	'css' => '',
	'el_id' => '',
	'el_class' => '',
	
), $atts ) );
$parallax_image_id = '';
$parallax_image_src = '';

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( 

	VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row '
	. ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) 
	. get_row_css_class()
	. $el_class 
	. vc_shortcode_custom_css_class( $css, ' ' ), 

$this->settings['base'], $atts );

// ID Building
if ( isset( $el_id ) && !empty( $el_id ) ) {
	$el_id = ' id="' . esc_attr( $el_id ) . '"'; 
}else{ 
	$el_id = '';
}

// Classes Building 
if ( isset( $css_class ) && !empty( $css_class ) ) {
	$css_class =  esc_attr( $css_class );  
}else{ 
	$css_class = '';
}

// BG Building
switch( $bg_source ) {
	
	case 'design':
	$data_attr = '';
	break;
	
	case 'parallax':
	$css_class .= ' module-parallax';
	
	if( !empty($parallax_image) ){		
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );		
		if ( !empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}		
		$data_attr = 'data-background="'.$parallax_image_src.'"';			
	}else{		
		$data_attr = '';		
	}

	break;
	
	case 'video':
	if( !isset($video_url) || empty($video_url) ){ $video_url = ''; }
	if( !isset($starts_at) || empty($starts_at) || !is_int(intval($starts_at)) ){ $starts_at = '0'; }
	if( !isset($volume) || empty($volume) || $volume == 0 ){ $volume = '0'; $mute = 'true'; }else{ $mute = 'false'; }
	if( !isset($loop) || empty($loop) ){ $loop = 'false'; }
	if( !empty($video_image) ){	
		$video_image_id = preg_replace( '/[^\d]/', '', $video_image );
		$video_image_src = wp_get_attachment_image_src( $video_image_id, 'full' );		
		if ( !empty( $video_image_src[0] ) ) {
			$video_image_src = $video_image_src[0];
		}		
		$data_attr = 'data-background="'.$video_image_src.'"';			
	}else{		
		$data_attr = '';		
	}
	$css_class .= ' video-bg';
	break;
	
}

// Full Height Feature
if( $full_height == true ){	
	$css_class .= ' module-full-height';	
}

// Overlay Feature
if( $overlay == true ){	
	$css_class .= ' '.$overlay;	
}

// Text Color
if( isset($text_color) && !empty($text_color) ){	
	$css_class .= ' '.$text_color;	
}

// Onepage Feature
if( $onepage_menu ){
	$el_id = ' id="' . un_sanitize_string($onepage_menu) . '"';
	$css_class .= ' un-onepage';
	$data_attr .= ' data-onepage-label="'.$onepage_menu.'"';
}

?>

<div<?php echo wp_kses_post($el_id); ?> class="<?php echo esc_attr($css_class); ?>" <?php echo wp_kses_post($data_attr); ?>>

    <?php 
	if( $container == true ){
		echo '<div class="container">';
		echo wpb_js_remove_wpautop( $content );
		echo '</div>';
		 
	}else{
		echo wpb_js_remove_wpautop( $content );
	}
	?>
    
    <?php
	if($bg_source == 'video' ){
    echo '
	<!-- YOUTUBE VIDEO-->
    <div class="video-player" data-property="{videoURL:\''.$video_url.'\', containment:\'.video-bg\', quality:\'large\', startAt:'.$starts_at.', autoPlay:true, loop:'.$loop.', opacity:1, showControls:false, showYTLogo:false, vol:'.$volume.', mute:'.$mute.'}"></div>
    <!-- /YOUTUBE VIDEO-->';
	} ?>

</div>



<?php //end of file
