<?php
$output = $title = $values = $bgcolor = $custombgcolor = $options = $el_class = '';
extract( shortcode_atts( array(
	'title' => '',
	'values' => '',
	'bgcolor' => 'pb-dark',
	'custombgcolor' => '',
	'options' => '',
	'el_class' => ''
), $atts ) );
wp_enqueue_script( 'waypoints' );


$el_class = $this->getExtraClass( $el_class );

$bar_options = '';
$options = explode( ",", $options );
if ( in_array( "animated", $options ) ) {
	$bar_options .= " active";
}
if ( in_array( "striped", $options ) ) {
	$bar_options .= " progress-bar-striped";
} 

$customtxtcolor = $custombgcolor = '';

if ( $bgcolor == "custom" && $custombgcolor != '' ) {
	$custombgcolor = ' style="' . vc_get_css_color( 'background-color', $custombgcolor ) . '"';
	$bgcolor = "";
}
if ( $bgcolor != "" ) {
	$bgcolor = " " . $bgcolor;
}


if ( '' !== $customtxtcolor ) {
	$customtxtcolor = ' style="' . vc_get_css_color( 'color', $customtxtcolor ) . '"';
}


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_progress_bar wpb_content_element' . $el_class, $this->settings['base'], $atts );
$output = '<div class="' . $css_class . '">';
$output .='<h4 class="font-alt m-t-0 m-b-20">'.$title.'</h4>';


$values = (array) vc_param_group_parse_atts( $values );
$max_value = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
	$new_line['bgcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custombgcolor;
	$new_line['txtcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $customtxtcolor;
	if ( isset( $data['customcolor'] ) && ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) ) {
		$new_line['bgcolor'] = ' style="background-color: ' . esc_attr( $data['customcolor'] ) . ';"';
	}
	if ( isset( $data['customtxtcolor'] ) && ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) ) {
		$new_line['txtcolor'] = ' style="color: ' . esc_attr( $data['customtxtcolor'] ) . ';"';
	}

	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}

foreach ( $graph_lines_data as $line ) {
	
	// Label
	$output .= '<h6 class="progress-title font-alt">'.$line['label'].'</h6>';
	
	// <progress>
	$output .= '<div class="progress">';
		
		// Percentage value if max_value > 100
		if( $max_value > 100.00 ) {
			$line['value'] = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		}
			
		// <progress-bar>
		$output .= '<div class="progress-bar' . $bgcolor . $bar_options . '" aria-valuenow="'.$line['value'].'" role="progressbar" aria-valuemin="0" aria-valuemax="100" '.$line['bgcolor'].'>';
			
			$output .= '<span class="font-alt"></span> ';		
		
		// </progress-bar>
		$output .= '</div>';
	
	// </progress>
	$output .= '</div>'; 
	
}

$output .= '</div>';

echo vc_kses($output . $this->endBlockComment( 'progress_bar' ) . "\n");