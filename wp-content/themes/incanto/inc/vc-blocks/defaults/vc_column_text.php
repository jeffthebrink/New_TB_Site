<?php
$output = $el_class = $css_animation = '';

extract( shortcode_atts( array(
	'el_class' => '',
	'css_animation' => '',
	'title' => '',
	'btn_label' => '',
	'btn_url' => '',
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_text_column wpb_content_element ' . $el_class, $this->settings['base'], $atts );
$css_class .= $this->getCSSAnimation( $css_animation );
$output .= "\n\t" . '<div class="' . esc_attr( $css_class ) . '">';
$output .= "\n\t\t" . '<div class="wpb_wrapper">';

if($title){ $output .= '<h5 class="font-alt m-t-0 m-b-20">'.$title.'</h5>'; }

$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content, true );

if($btn_label && $btn_url){ $output .= '<p><a class="section-scroll" href="'.esc_url($btn_url).'">'.$btn_label.' →</a></p>'; }

$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_text_column' );

echo wp_kses_post($output);