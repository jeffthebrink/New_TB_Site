<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_slides
 * @author      Luciano "WebCaos" Ubertini
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if ( !defined ( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( !class_exists ( 'ReduxFramework_slides' ) ) {

    /**
     * Main ReduxFramework_slides class
     *
     * @since       1.0.0
     */
    class ReduxFramework_slides {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct ( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render () {

            $defaults = array(
                'show' => array(
                    'title' => true,
                    'subtitle' => true,
                    'url' => false,
                ),
                'content_title' => __ ( 'Slide', UN )
            );

            $this->field = wp_parse_args ( $this->field, $defaults );

            echo '<div class="redux-slides-accordion" data-new-content-title="' . esc_attr ( sprintf ( __ ( 'New %s', UN ), $this->field[ 'content_title' ] ) ) . '">';

            $x = 0;

            $multi = ( isset ( $this->field[ 'multi' ] ) && $this->field[ 'multi' ] ) ? ' multiple="multiple"' : "";

            if ( isset ( $this->value ) && is_array ( $this->value ) && !empty ( $this->value ) ) {

                $slides = $this->value;

                foreach ( $slides as $slide ) {

                    if ( empty ( $slide ) ) {
                        continue;
                    }

                    $defaults = array(
                        'title' => '',
						'title_anim' => '',
                        'subtitle' => '',
						'subtitle_anim' => '',
                        'sort' => '',
                        'url' => '',
                        'image' => '',
						'dark' => '',
						'overlay' => '',
                        'thumb' => '',
                        'attachment_id' => '',
                        'height' => '',
                        'width' => '',
                        'select' => array(),
                    );
                    $slide = wp_parse_args ( $slide, $defaults );

                    if ( empty ( $slide[ 'thumb' ] ) && !empty ( $slide[ 'attachment_id' ] ) ) {
                        $img = wp_get_attachment_image_src ( $slide[ 'attachment_id' ], 'full' );
                        $slide[ 'image' ] = $img[ 0 ];
                        $slide[ 'width' ] = $img[ 1 ];
                        $slide[ 'height' ] = $img[ 2 ];
                    }

                    echo '<div class="redux-slides-accordion-group"><fieldset class="redux-field" data-id="' . $this->field[ 'id' ] . '"><h3><span class="redux-slides-header">' . $slide[ 'title' ] . '</span></h3><div>';

                    $hide = '';
                    if ( empty ( $slide[ 'image' ] ) ) {
                        $hide = ' hide';
                    }


                    echo '<div class="screenshot' . $hide . '">';
                    echo '<a class="of-uploaded-image" href="' . esc_url($slide[ 'image' ]) . '">';
                    echo '<img class="redux-slides-image" id="image_image_id_' . $x . '" src="' . $slide[ 'thumb' ] . '" alt="" target="_blank" rel="external" />';
                    echo '</a>';
                    echo '</div>';

                    echo '<div class="redux_slides_add_remove">';

                    echo '<span class="button media_upload_button" id="add_' . $x . '">' . __ ( 'Upload', UN ) . '</span>';

                    $hide = '';
                    if ( empty ( $slide[ 'image' ] ) || $slide[ 'image' ] == '' ) {
                        $hide = ' hide';
                    }

                    echo '<span class="button remove-image' . $hide . '" id="reset_' . $x . '" rel="' . $slide[ 'attachment_id' ] . '">' . __ ( 'Remove', UN ) . '</span>';

                    echo '</div>' . "\n";
					
					if($slide[ 'dark' ] == 'bg-dark' ) { $checked = 'checked="checked"'; }else{ $checked = ''; }
					
					echo '<input type="checkbox" class="checkbox" name="' . $this->field[ 'name' ] . '[' . $x . '][dark]' . $this->field['name_suffix'] . '" id="' . $this->field[ 'id' ] . '-dark_' . $x . '" value="bg-dark" '.$checked.' > ' . __('Is your Image dark?', UN);
					
					echo '<br>		
					<label>'.__('Overlay:', UN).'</label> <select id="' . $this->field[ 'id' ] . '-overlay_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][overlay]' . $this->field['name_suffix'] . '" class="slide-anim">'; ?>
						
                      <option value="" <?php if($slide[ 'overlay' ] == '' ) { echo 'selected="selected"'; } ?> ><?php _e('Overlay Effect', UN); ?></option>		
                      <option value="bg-light-90" <?php if($slide[ 'overlay' ] == 'bg-light-90' ) { echo 'selected="selected"'; } ?> >Light 90%</option>
                      <option value="bg-light-60" <?php if($slide[ 'overlay' ] == 'bg-light-60' ) { echo 'selected="selected"'; } ?> >Light 60%</option>
                      <option value="bg-light-30" <?php if($slide[ 'overlay' ] == 'bg-light-30' ) { echo 'selected="selected"'; } ?> >Light 30%</option>
                      <option value="bg-dark-90" <?php if($slide[ 'overlay' ] == 'bg-dark-90' ) { echo 'selected="selected"'; } ?> >Dark 90%</option>
                      <option value="bg-dark-60" <?php if($slide[ 'overlay' ] == 'bg-dark-60' ) { echo 'selected="selected"'; } ?> >Dark 60%</option>
                      <option value="bg-dark-30" <?php if($slide[ 'overlay' ] == 'bg-dark-30' ) { echo 'selected="selected"'; } ?> >Dark 30%</option>
                      <option value="bg-film" <?php if($slide[ 'overlay' ] == 'bg-film' ) { echo 'selected="selected"'; } ?> >Film</option>				
                    
      
					<?php echo '
					</select>';

                    echo '<ul id="' . $this->field[ 'id' ] . '-ul" class="redux-slides-list">';

                    if ( $this->field[ 'show' ][ 'title' ] ) {
                        $title_type = "text";
                    } else {
                        $title_type = "hidden";
                    }

                    $placeholder = ( isset ( $this->field[ 'placeholder' ][ 'title' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'title' ] ) : __ ( 'Title', UN );
                    echo '<li><label>'.__('Title:', UN).'</label> <br><input type="' . $title_type . '" id="' . $this->field[ 'id' ] . '-title_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][title]' . $this->field['name_suffix'] . '" value="' . esc_attr ( $slide[ 'title' ] ) . '" placeholder="' . $placeholder . '" class="full-text slide-title" />';
			
					
					echo '				
					<select id="' . $this->field[ 'id' ] . '-title_anim_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][title_anim]' . $this->field['name_suffix'] . '" class="slide-anim">'; ?>
						
                        <option value="" <?php if($slide[ 'title_anim' ] == '' ) { echo 'selected="selected"'; } ?> ><?php _e('Title Animation', UN); ?></option>
						
						<optgroup label="Attention Seekers">
						  <option value="bounce" <?php if($slide[ 'title_anim' ] == 'bounce' ) { echo 'selected="selected"'; } ?> >bounce</option>
						  <option value="flash" <?php if($slide[ 'title_anim' ] == 'flash' ) { echo 'selected="selected"'; } ?> >flash</option>
						  <option value="pulse" <?php if($slide[ 'title_anim' ] == 'pulse' ) { echo 'selected="selected"'; } ?> >pulse</option>
						  <option value="rubberBand" <?php if($slide[ 'title_anim' ] == 'rubberBand' ) { echo 'selected="selected"'; } ?> >rubberBand</option>
						  <option value="shake" <?php if($slide[ 'title_anim' ] == 'shake' ) { echo 'selected="selected"'; } ?> >shake</option>
						  <option value="swing" <?php if($slide[ 'title_anim' ] == 'swing' ) { echo 'selected="selected"'; } ?> >swing</option>
						  <option value="tada" <?php if($slide[ 'title_anim' ] == 'tada' ) { echo 'selected="selected"'; } ?> >tada</option>
						  <option value="wobble" <?php if($slide[ 'title_anim' ] == 'wobble' ) { echo 'selected="selected"'; } ?> >wobble</option>
						  <option value="jello" <?php if($slide[ 'title_anim' ] == 'jello' ) { echo 'selected="selected"'; } ?> >jello</option>
						</optgroup>
				
						<optgroup label="Bouncing Entrances">
						  <option value="bounceIn" <?php if($slide[ 'title_anim' ] == 'bounceIn' ) { echo 'selected="selected"'; } ?> >bounceIn</option>
						  <option value="bounceInDown" <?php if($slide[ 'title_anim' ] == 'bounceInDown' ) { echo 'selected="selected"'; } ?> >bounceInDown</option>
						  <option value="bounceInLeft" <?php if($slide[ 'title_anim' ] == 'bounceInLeft' ) { echo 'selected="selected"'; } ?> >bounceInLeft</option>
						  <option value="bounceInRight" <?php if($slide[ 'title_anim' ] == 'bounceInRight' ) { echo 'selected="selected"'; } ?> >bounceInRight</option>
						  <option value="bounceInUp" <?php if($slide[ 'title_anim' ] == 'bounceInUp' ) { echo 'selected="selected"'; } ?> >bounceInUp</option>
						</optgroup>
				
						<optgroup label="Bouncing Exits">
						  <option value="bounceOut" <?php if($slide[ 'title_anim' ] == 'bounceOut' ) { echo 'selected="selected"'; } ?> >bounceOut</option>
						  <option value="bounceOutDown" <?php if($slide[ 'title_anim' ] == 'bounceOutDown' ) { echo 'selected="selected"'; } ?> >bounceOutDown</option>
						  <option value="bounceOutLeft" <?php if($slide[ 'title_anim' ] == 'bounceOutLeft' ) { echo 'selected="selected"'; } ?> >bounceOutLeft</option>
						  <option value="bounceOutRight" <?php if($slide[ 'title_anim' ] == 'bounceOutRight' ) { echo 'selected="selected"'; } ?> >bounceOutRight</option>
						  <option value="bounceOutUp" <?php if($slide[ 'title_anim' ] == 'bounceOutUp' ) { echo 'selected="selected"'; } ?> >bounceOutUp</option>
						</optgroup>
				
						<optgroup label="Fading Entrances">
						  <option value="fadeIn" <?php if($slide[ 'title_anim' ] == 'fadeIn' ) { echo 'selected="selected"'; } ?> >fadeIn</option>
						  <option value="fadeInDown" <?php if($slide[ 'title_anim' ] == 'fadeInDown' ) { echo 'selected="selected"'; } ?> >fadeInDown</option>
						  <option value="fadeInDownBig" <?php if($slide[ 'title_anim' ] == 'fadeInDownBig' ) { echo 'selected="selected"'; } ?> >fadeInDownBig</option>
						  <option value="fadeInLeft" <?php if($slide[ 'title_anim' ] == 'fadeInLeft' ) { echo 'selected="selected"'; } ?> >fadeInLeft</option>
						  <option value="fadeInLeftBig" <?php if($slide[ 'title_anim' ] == 'fadeInLeftBig' ) { echo 'selected="selected"'; } ?> >fadeInLeftBig</option>
						  <option value="fadeInRight" <?php if($slide[ 'title_anim' ] == 'fadeInRight' ) { echo 'selected="selected"'; } ?> >fadeInRight</option>
						  <option value="fadeInRightBig" <?php if($slide[ 'title_anim' ] == 'fadeInRightBig' ) { echo 'selected="selected"'; } ?> >fadeInRightBig</option>
						  <option value="fadeInUp" <?php if($slide[ 'title_anim' ] == 'fadeInUp' ) { echo 'selected="selected"'; } ?> >fadeInUp</option>
						  <option value="fadeInUpBig" <?php if($slide[ 'title_anim' ] == 'fadeInUpBig' ) { echo 'selected="selected"'; } ?> >fadeInUpBig</option>
						</optgroup>
				
						<optgroup label="Fading Exits">
						  <option value="fadeOut" <?php if($slide[ 'title_anim' ] == 'fadeOut' ) { echo 'selected="selected"'; } ?> >fadeOut</option>
						  <option value="fadeOutDown" <?php if($slide[ 'title_anim' ] == 'fadeOutDown' ) { echo 'selected="selected"'; } ?> >fadeOutDown</option>
						  <option value="fadeOutDownBig" <?php if($slide[ 'title_anim' ] == 'fadeOutDownBig' ) { echo 'selected="selected"'; } ?> >fadeOutDownBig</option>
						  <option value="fadeOutLeft" <?php if($slide[ 'title_anim' ] == 'fadeOutLeft' ) { echo 'selected="selected"'; } ?> >fadeOutLeft</option>
						  <option value="fadeOutLeftBig" <?php if($slide[ 'title_anim' ] == 'fadeOutLeftBig' ) { echo 'selected="selected"'; } ?> >fadeOutLeftBig</option>
						  <option value="fadeOutRight" <?php if($slide[ 'title_anim' ] == 'fadeOutRight' ) { echo 'selected="selected"'; } ?> >fadeOutRight</option>
						  <option value="fadeOutRightBig" <?php if($slide[ 'title_anim' ] == 'fadeOutRightBig' ) { echo 'selected="selected"'; } ?> >fadeOutRightBig</option>
						  <option value="fadeOutUp" <?php if($slide[ 'title_anim' ] == 'fadeOutUp' ) { echo 'selected="selected"'; } ?> >fadeOutUp</option>
						  <option value="fadeOutUpBig" <?php if($slide[ 'title_anim' ] == 'fadeOutUpBig' ) { echo 'selected="selected"'; } ?> >fadeOutUpBig</option>
						</optgroup>
				
						<optgroup label="Flippers">
						  <option value="flip" <?php if($slide[ 'title_anim' ] == 'flip' ) { echo 'selected="selected"'; } ?> >flip</option>
						  <option value="flipInX" <?php if($slide[ 'title_anim' ] == 'flipInX' ) { echo 'selected="selected"'; } ?> >flipInX</option>
						  <option value="flipInY" <?php if($slide[ 'title_anim' ] == 'flipInY' ) { echo 'selected="selected"'; } ?> >flipInY</option>
						  <option value="flipOutX" <?php if($slide[ 'title_anim' ] == 'flipOutX' ) { echo 'selected="selected"'; } ?> >flipOutX</option>
						  <option value="flipOutY" <?php if($slide[ 'title_anim' ] == 'flipOutY' ) { echo 'selected="selected"'; } ?> >flipOutY</option>
						</optgroup>
				
						<optgroup label="Lightspeed">
						  <option value="lightSpeedIn" <?php if($slide[ 'title_anim' ] == 'lightSpeedIn' ) { echo 'selected="selected"'; } ?> >lightSpeedIn</option>
						  <option value="lightSpeedOut" <?php if($slide[ 'title_anim' ] == 'lightSpeedOut' ) { echo 'selected="selected"'; } ?> >lightSpeedOut</option>
						</optgroup>
				
						<optgroup label="Rotating Entrances">
						  <option value="rotateIn" <?php if($slide[ 'title_anim' ] == 'rotateIn' ) { echo 'selected="selected"'; } ?> >rotateIn</option>
						  <option value="rotateInDownLeft" <?php if($slide[ 'title_anim' ] == 'rotateInDownLeft' ) { echo 'selected="selected"'; } ?> >rotateInDownLeft</option>
						  <option value="rotateInDownRight" <?php if($slide[ 'title_anim' ] == 'rotateInDownRight' ) { echo 'selected="selected"'; } ?> >rotateInDownRight</option>
						  <option value="rotateInUpLeft" <?php if($slide[ 'title_anim' ] == 'rotateInUpLeft' ) { echo 'selected="selected"'; } ?> >rotateInUpLeft</option>
						  <option value="rotateInUpRight" <?php if($slide[ 'title_anim' ] == 'rotateInUpRight' ) { echo 'selected="selected"'; } ?> >rotateInUpRight</option>
						</optgroup>
				
						<optgroup label="Rotating Exits">
						  <option value="rotateOut" <?php if($slide[ 'title_anim' ] == 'rotateOut' ) { echo 'selected="selected"'; } ?> >rotateOut</option>
						  <option value="rotateOutDownLeft" <?php if($slide[ 'title_anim' ] == 'rotateOutDownLeft' ) { echo 'selected="selected"'; } ?> >rotateOutDownLeft</option>
						  <option value="rotateOutDownRight" <?php if($slide[ 'title_anim' ] == 'rotateOutDownRight' ) { echo 'selected="selected"'; } ?> >rotateOutDownRight</option>
						  <option value="rotateOutUpLeft" <?php if($slide[ 'title_anim' ] == 'rotateOutUpLeft' ) { echo 'selected="selected"'; } ?> >rotateOutUpLeft</option>
						  <option value="rotateOutUpRight" <?php if($slide[ 'title_anim' ] == 'rotateOutUpRight' ) { echo 'selected="selected"'; } ?> >rotateOutUpRight</option>
						</optgroup>
				
						<optgroup label="Sliding Entrances">
						  <option value="slideInUp" <?php if($slide[ 'title_anim' ] == 'slideInUp' ) { echo 'selected="selected"'; } ?> >slideInUp</option>
						  <option value="slideInDown" <?php if($slide[ 'title_anim' ] == 'slideInDown' ) { echo 'selected="selected"'; } ?> >slideInDown</option>
						  <option value="slideInLeft" <?php if($slide[ 'title_anim' ] == 'slideInLeft' ) { echo 'selected="selected"'; } ?> >slideInLeft</option>
						  <option value="slideInRight" <?php if($slide[ 'title_anim' ] == 'slideInRight' ) { echo 'selected="selected"'; } ?> >slideInRight</option>
				
						</optgroup>
						<optgroup label="Sliding Exits">
						  <option value="slideOutUp" <?php if($slide[ 'title_anim' ] == 'slideOutUp' ) { echo 'selected="selected"'; } ?> >slideOutUp</option>
						  <option value="slideOutDown" <?php if($slide[ 'title_anim' ] == 'slideOutDown' ) { echo 'selected="selected"'; } ?> >slideOutDown</option>
						  <option value="slideOutLeft" <?php if($slide[ 'title_anim' ] == 'slideOutLeft' ) { echo 'selected="selected"'; } ?> >slideOutLeft</option>
						  <option value="slideOutRight" <?php if($slide[ 'title_anim' ] == 'slideOutRight' ) { echo 'selected="selected"'; } ?> >slideOutRight</option>
						  
						</optgroup>
						
						<optgroup label="Zoom Entrances">
						  <option value="zoomIn" <?php if($slide[ 'title_anim' ] == 'zoomIn' ) { echo 'selected="selected"'; } ?> >zoomIn</option>
						  <option value="zoomInDown" <?php if($slide[ 'title_anim' ] == 'zoomInDown' ) { echo 'selected="selected"'; } ?> >zoomInDown</option>
						  <option value="zoomInLeft" <?php if($slide[ 'title_anim' ] == 'zoomInLeft' ) { echo 'selected="selected"'; } ?> >zoomInLeft</option>
						  <option value="zoomInRight" <?php if($slide[ 'title_anim' ] == 'zoomInRight' ) { echo 'selected="selected"'; } ?> >zoomInRight</option>
						  <option value="zoomInUp" <?php if($slide[ 'title_anim' ] == 'zoomInUp' ) { echo 'selected="selected"'; } ?> >zoomInUp</option>
						</optgroup>
						
						<optgroup label="Zoom Exits">
						  <option value="zoomOutDown" <?php if($slide[ 'title_anim' ] == 'zoomOutDown' ) { echo 'selected="selected"'; } ?> >zoomOut</option>
						  <option value="zoomOutDown" <?php if($slide[ 'title_anim' ] == 'zoomOutDown' ) { echo 'selected="selected"'; } ?> >zoomOutDown</option>
						  <option value="zoomOutLeft" <?php if($slide[ 'title_anim' ] == 'zoomOutLeft' ) { echo 'selected="selected"'; } ?> >zoomOutLeft</option>
						  <option value="zoomOutRight" <?php if($slide[ 'title_anim' ] == 'zoomOutRight' ) { echo 'selected="selected"'; } ?> >zoomOutRight</option>
						  <option value="zoomOutUp" <?php if($slide[ 'title_anim' ] == 'zoomOutUp' ) { echo 'selected="selected"'; } ?> >zoomOutUp</option>
						</optgroup>
				
						<optgroup label="Specials">
						  <option value="hinge" <?php if($slide[ 'title_anim' ] == 'hinge' ) { echo 'selected="selected"'; } ?> >hinge</option>
						  <option value="rollIn" <?php if($slide[ 'title_anim' ] == 'rollIn' ) { echo 'selected="selected"'; } ?> >rollIn</option>
						  <option value="rollOut" <?php if($slide[ 'title_anim' ] == 'rollOut' ) { echo 'selected="selected"'; } ?> >rollOut</option>
						</optgroup>
      
					<?php echo '
					</select>
					</li>';

                   
					$placeholder = ( isset ( $this->field[ 'placeholder' ][ 'subtitle' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'subtitle' ] ) : __ ( 'Description', UN );
					echo '<li><label>'.__('Subtitle:', UN).'</label>  <br><input type="text" name="' . $this->field[ 'name' ] . '[' . $x . '][subtitle]' . $this->field['name_suffix'] . '" id="' . $this->field[ 'id' ] . '-subtitle_' . $x . '" placeholder="' . $placeholder . '" class="full-text slide-title" value="' . esc_attr ( $slide[ 'subtitle' ] ) . '">';
                    
					
					echo '				
					<select id="' . $this->field[ 'id' ] . '-subtitle_anim_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][subtitle_anim]' . $this->field['name_suffix'] . '" class="slide-anim">'; ?>
						
                        <option value="" <?php if($slide[ 'subtitle_anim' ] == '' ) { echo 'selected="selected"'; } ?> ><?php _e('Subtitle Animation', UN); ?></option>
						
						<optgroup label="Attention Seekers">
						  <option value="bounce" <?php if($slide[ 'subtitle_anim' ] == 'bounce' ) { echo 'selected="selected"'; } ?> >bounce</option>
						  <option value="flash" <?php if($slide[ 'subtitle_anim' ] == 'flash' ) { echo 'selected="selected"'; } ?> >flash</option>
						  <option value="pulse" <?php if($slide[ 'subtitle_anim' ] == 'pulse' ) { echo 'selected="selected"'; } ?> >pulse</option>
						  <option value="rubberBand" <?php if($slide[ 'subtitle_anim' ] == 'rubberBand' ) { echo 'selected="selected"'; } ?> >rubberBand</option>
						  <option value="shake" <?php if($slide[ 'subtitle_anim' ] == 'shake' ) { echo 'selected="selected"'; } ?> >shake</option>
						  <option value="swing" <?php if($slide[ 'subtitle_anim' ] == 'swing' ) { echo 'selected="selected"'; } ?> >swing</option>
						  <option value="tada" <?php if($slide[ 'subtitle_anim' ] == 'tada' ) { echo 'selected="selected"'; } ?> >tada</option>
						  <option value="wobble" <?php if($slide[ 'subtitle_anim' ] == 'wobble' ) { echo 'selected="selected"'; } ?> >wobble</option>
						  <option value="jello" <?php if($slide[ 'subtitle_anim' ] == 'jello' ) { echo 'selected="selected"'; } ?> >jello</option>
						</optgroup>
				
						<optgroup label="Bouncing Entrances">
						  <option value="bounceIn" <?php if($slide[ 'subtitle_anim' ] == 'bounceIn' ) { echo 'selected="selected"'; } ?> >bounceIn</option>
						  <option value="bounceInDown" <?php if($slide[ 'subtitle_anim' ] == 'bounceInDown' ) { echo 'selected="selected"'; } ?> >bounceInDown</option>
						  <option value="bounceInLeft" <?php if($slide[ 'subtitle_anim' ] == 'bounceInLeft' ) { echo 'selected="selected"'; } ?> >bounceInLeft</option>
						  <option value="bounceInRight" <?php if($slide[ 'subtitle_anim' ] == 'bounceInRight' ) { echo 'selected="selected"'; } ?> >bounceInRight</option>
						  <option value="bounceInUp" <?php if($slide[ 'subtitle_anim' ] == 'bounceInUp' ) { echo 'selected="selected"'; } ?> >bounceInUp</option>
						</optgroup>
				
						<optgroup label="Bouncing Exits">
						  <option value="bounceOut" <?php if($slide[ 'subtitle_anim' ] == 'bounceOut' ) { echo 'selected="selected"'; } ?> >bounceOut</option>
						  <option value="bounceOutDown" <?php if($slide[ 'subtitle_anim' ] == 'bounceOutDown' ) { echo 'selected="selected"'; } ?> >bounceOutDown</option>
						  <option value="bounceOutLeft" <?php if($slide[ 'subtitle_anim' ] == 'bounceOutLeft' ) { echo 'selected="selected"'; } ?> >bounceOutLeft</option>
						  <option value="bounceOutRight" <?php if($slide[ 'subtitle_anim' ] == 'bounceOutRight' ) { echo 'selected="selected"'; } ?> >bounceOutRight</option>
						  <option value="bounceOutUp" <?php if($slide[ 'subtitle_anim' ] == 'bounceOutUp' ) { echo 'selected="selected"'; } ?> >bounceOutUp</option>
						</optgroup>
				
						<optgroup label="Fading Entrances">
						  <option value="fadeIn" <?php if($slide[ 'subtitle_anim' ] == 'fadeIn' ) { echo 'selected="selected"'; } ?> >fadeIn</option>
						  <option value="fadeInDown" <?php if($slide[ 'subtitle_anim' ] == 'fadeInDown' ) { echo 'selected="selected"'; } ?> >fadeInDown</option>
						  <option value="fadeInDownBig" <?php if($slide[ 'subtitle_anim' ] == 'fadeInDownBig' ) { echo 'selected="selected"'; } ?> >fadeInDownBig</option>
						  <option value="fadeInLeft" <?php if($slide[ 'subtitle_anim' ] == 'fadeInLeft' ) { echo 'selected="selected"'; } ?> >fadeInLeft</option>
						  <option value="fadeInLeftBig" <?php if($slide[ 'subtitle_anim' ] == 'fadeInLeftBig' ) { echo 'selected="selected"'; } ?> >fadeInLeftBig</option>
						  <option value="fadeInRight" <?php if($slide[ 'subtitle_anim' ] == 'fadeInRight' ) { echo 'selected="selected"'; } ?> >fadeInRight</option>
						  <option value="fadeInRightBig" <?php if($slide[ 'subtitle_anim' ] == 'fadeInRightBig' ) { echo 'selected="selected"'; } ?> >fadeInRightBig</option>
						  <option value="fadeInUp" <?php if($slide[ 'subtitle_anim' ] == 'fadeInUp' ) { echo 'selected="selected"'; } ?> >fadeInUp</option>
						  <option value="fadeInUpBig" <?php if($slide[ 'subtitle_anim' ] == 'fadeInUpBig' ) { echo 'selected="selected"'; } ?> >fadeInUpBig</option>
						</optgroup>
				
						<optgroup label="Fading Exits">
						  <option value="fadeOut" <?php if($slide[ 'subtitle_anim' ] == 'fadeOut' ) { echo 'selected="selected"'; } ?> >fadeOut</option>
						  <option value="fadeOutDown" <?php if($slide[ 'subtitle_anim' ] == 'fadeOutDown' ) { echo 'selected="selected"'; } ?> >fadeOutDown</option>
						  <option value="fadeOutDownBig" <?php if($slide[ 'subtitle_anim' ] == 'fadeOutDownBig' ) { echo 'selected="selected"'; } ?> >fadeOutDownBig</option>
						  <option value="fadeOutLeft" <?php if($slide[ 'subtitle_anim' ] == 'fadeOutLeft' ) { echo 'selected="selected"'; } ?> >fadeOutLeft</option>
						  <option value="fadeOutLeftBig" <?php if($slide[ 'subtitle_anim' ] == 'fadeOutLeftBig' ) { echo 'selected="selected"'; } ?> >fadeOutLeftBig</option>
						  <option value="fadeOutRight" <?php if($slide[ 'subtitle_anim' ] == 'fadeOutRight' ) { echo 'selected="selected"'; } ?> >fadeOutRight</option>
						  <option value="fadeOutRightBig" <?php if($slide[ 'subtitle_anim' ] == 'fadeOutRightBig' ) { echo 'selected="selected"'; } ?> >fadeOutRightBig</option>
						  <option value="fadeOutUp" <?php if($slide[ 'subtitle_anim' ] == 'fadeOutUp' ) { echo 'selected="selected"'; } ?> >fadeOutUp</option>
						  <option value="fadeOutUpBig" <?php if($slide[ 'subtitle_anim' ] == 'fadeOutUpBig' ) { echo 'selected="selected"'; } ?> >fadeOutUpBig</option>
						</optgroup>
				
						<optgroup label="Flippers">
						  <option value="flip" <?php if($slide[ 'subtitle_anim' ] == 'flip' ) { echo 'selected="selected"'; } ?> >flip</option>
						  <option value="flipInX" <?php if($slide[ 'subtitle_anim' ] == 'flipInX' ) { echo 'selected="selected"'; } ?> >flipInX</option>
						  <option value="flipInY" <?php if($slide[ 'subtitle_anim' ] == 'flipInY' ) { echo 'selected="selected"'; } ?> >flipInY</option>
						  <option value="flipOutX" <?php if($slide[ 'subtitle_anim' ] == 'flipOutX' ) { echo 'selected="selected"'; } ?> >flipOutX</option>
						  <option value="flipOutY" <?php if($slide[ 'subtitle_anim' ] == 'flipOutY' ) { echo 'selected="selected"'; } ?> >flipOutY</option>
						</optgroup>
				
						<optgroup label="Lightspeed">
						  <option value="lightSpeedIn" <?php if($slide[ 'subtitle_anim' ] == 'lightSpeedIn' ) { echo 'selected="selected"'; } ?> >lightSpeedIn</option>
						  <option value="lightSpeedOut" <?php if($slide[ 'subtitle_anim' ] == 'lightSpeedOut' ) { echo 'selected="selected"'; } ?> >lightSpeedOut</option>
						</optgroup>
				
						<optgroup label="Rotating Entrances">
						  <option value="rotateIn" <?php if($slide[ 'subtitle_anim' ] == 'rotateIn' ) { echo 'selected="selected"'; } ?> >rotateIn</option>
						  <option value="rotateInDownLeft" <?php if($slide[ 'subtitle_anim' ] == 'rotateInDownLeft' ) { echo 'selected="selected"'; } ?> >rotateInDownLeft</option>
						  <option value="rotateInDownRight" <?php if($slide[ 'subtitle_anim' ] == 'rotateInDownRight' ) { echo 'selected="selected"'; } ?> >rotateInDownRight</option>
						  <option value="rotateInUpLeft" <?php if($slide[ 'subtitle_anim' ] == 'rotateInUpLeft' ) { echo 'selected="selected"'; } ?> >rotateInUpLeft</option>
						  <option value="rotateInUpRight" <?php if($slide[ 'subtitle_anim' ] == 'rotateInUpRight' ) { echo 'selected="selected"'; } ?> >rotateInUpRight</option>
						</optgroup>
				
						<optgroup label="Rotating Exits">
						  <option value="rotateOut" <?php if($slide[ 'subtitle_anim' ] == 'rotateOut' ) { echo 'selected="selected"'; } ?> >rotateOut</option>
						  <option value="rotateOutDownLeft" <?php if($slide[ 'subtitle_anim' ] == 'rotateOutDownLeft' ) { echo 'selected="selected"'; } ?> >rotateOutDownLeft</option>
						  <option value="rotateOutDownRight" <?php if($slide[ 'subtitle_anim' ] == 'rotateOutDownRight' ) { echo 'selected="selected"'; } ?> >rotateOutDownRight</option>
						  <option value="rotateOutUpLeft" <?php if($slide[ 'subtitle_anim' ] == 'rotateOutUpLeft' ) { echo 'selected="selected"'; } ?> >rotateOutUpLeft</option>
						  <option value="rotateOutUpRight" <?php if($slide[ 'subtitle_anim' ] == 'rotateOutUpRight' ) { echo 'selected="selected"'; } ?> >rotateOutUpRight</option>
						</optgroup>
				
						<optgroup label="Sliding Entrances">
						  <option value="slideInUp" <?php if($slide[ 'subtitle_anim' ] == 'slideInUp' ) { echo 'selected="selected"'; } ?> >slideInUp</option>
						  <option value="slideInDown" <?php if($slide[ 'subtitle_anim' ] == 'slideInDown' ) { echo 'selected="selected"'; } ?> >slideInDown</option>
						  <option value="slideInLeft" <?php if($slide[ 'subtitle_anim' ] == 'slideInLeft' ) { echo 'selected="selected"'; } ?> >slideInLeft</option>
						  <option value="slideInRight" <?php if($slide[ 'subtitle_anim' ] == 'slideInRight' ) { echo 'selected="selected"'; } ?> >slideInRight</option>
				
						</optgroup>
						<optgroup label="Sliding Exits">
						  <option value="slideOutUp" <?php if($slide[ 'subtitle_anim' ] == 'slideOutUp' ) { echo 'selected="selected"'; } ?> >slideOutUp</option>
						  <option value="slideOutDown" <?php if($slide[ 'subtitle_anim' ] == 'slideOutDown' ) { echo 'selected="selected"'; } ?> >slideOutDown</option>
						  <option value="slideOutLeft" <?php if($slide[ 'subtitle_anim' ] == 'slideOutLeft' ) { echo 'selected="selected"'; } ?> >slideOutLeft</option>
						  <option value="slideOutRight" <?php if($slide[ 'subtitle_anim' ] == 'slideOutRight' ) { echo 'selected="selected"'; } ?> >slideOutRight</option>
						  
						</optgroup>
						
						<optgroup label="Zoom Entrances">
						  <option value="zoomIn" <?php if($slide[ 'subtitle_anim' ] == 'zoomIn' ) { echo 'selected="selected"'; } ?> >zoomIn</option>
						  <option value="zoomInDown" <?php if($slide[ 'subtitle_anim' ] == 'zoomInDown' ) { echo 'selected="selected"'; } ?> >zoomInDown</option>
						  <option value="zoomInLeft" <?php if($slide[ 'subtitle_anim' ] == 'zoomInLeft' ) { echo 'selected="selected"'; } ?> >zoomInLeft</option>
						  <option value="zoomInRight" <?php if($slide[ 'subtitle_anim' ] == 'zoomInRight' ) { echo 'selected="selected"'; } ?> >zoomInRight</option>
						  <option value="zoomInUp" <?php if($slide[ 'subtitle_anim' ] == 'zoomInUp' ) { echo 'selected="selected"'; } ?> >zoomInUp</option>
						</optgroup>
						
						<optgroup label="Zoom Exits">
						  <option value="zoomOutDown" <?php if($slide[ 'subtitle_anim' ] == 'zoomOutDown' ) { echo 'selected="selected"'; } ?> >zoomOut</option>
						  <option value="zoomOutDown" <?php if($slide[ 'subtitle_anim' ] == 'zoomOutDown' ) { echo 'selected="selected"'; } ?> >zoomOutDown</option>
						  <option value="zoomOutLeft" <?php if($slide[ 'subtitle_anim' ] == 'zoomOutLeft' ) { echo 'selected="selected"'; } ?> >zoomOutLeft</option>
						  <option value="zoomOutRight" <?php if($slide[ 'subtitle_anim' ] == 'zoomOutRight' ) { echo 'selected="selected"'; } ?> >zoomOutRight</option>
						  <option value="zoomOutUp" <?php if($slide[ 'subtitle_anim' ] == 'zoomOutUp' ) { echo 'selected="selected"'; } ?> >zoomOutUp</option>
						</optgroup>
				
						<optgroup label="Specials">
						  <option value="hinge" <?php if($slide[ 'subtitle_anim' ] == 'hinge' ) { echo 'selected="selected"'; } ?> >hinge</option>
						  <option value="rollIn" <?php if($slide[ 'subtitle_anim' ] == 'rollIn' ) { echo 'selected="selected"'; } ?> >rollIn</option>
						  <option value="rollOut" <?php if($slide[ 'subtitle_anim' ] == 'rollOut' ) { echo 'selected="selected"'; } ?> >rollOut</option>
						</optgroup>
      
					<?php echo '
					</select>
					</li>';
					

                    $placeholder = ( isset ( $this->field[ 'placeholder' ][ 'url' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'url' ] ) : __ ( 'URL', UN );
                    if ( $this->field[ 'show' ][ 'url' ] ) {
                        $url_type = "text";
                    } else {
                        $url_type = "hidden";
                    }

                    echo '<li><input type="' . $url_type . '" id="' . $this->field[ 'id' ] . '-url_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][url]' . $this->field['name_suffix'] .'" value="' . esc_attr ( $slide[ 'url' ] ) . '" class="full-text" placeholder="' . $placeholder . '" /></li>';
                    echo '<li><input type="hidden" class="slide-sort" name="' . $this->field[ 'name' ] . '[' . $x . '][sort]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-sort_' . $x . '" value="' . $slide[ 'sort' ] . '" />';
                    echo '<li><input type="hidden" class="upload-id" name="' . $this->field[ 'name' ] . '[' . $x . '][attachment_id]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-image_id_' . $x . '" value="' . $slide[ 'attachment_id' ] . '" />';
                    echo '<input type="hidden" class="upload-thumbnail" name="' . $this->field[ 'name' ] . '[' . $x . '][thumb]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-thumb_url_' . $x . '" value="' . $slide[ 'thumb' ] . '" readonly="readonly" />';
                    echo '<input type="hidden" class="upload" name="' . $this->field[ 'name' ] . '[' . $x . '][image]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-image_url_' . $x . '" value="' . $slide[ 'image' ] . '" readonly="readonly" />';
                    echo '<input type="hidden" class="upload-height" name="' . $this->field[ 'name' ] . '[' . $x . '][height]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-image_height_' . $x . '" value="' . $slide[ 'height' ] . '" />';
                    echo '<input type="hidden" class="upload-width" name="' . $this->field[ 'name' ] . '[' . $x . '][width]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-image_width_' . $x . '" value="' . $slide[ 'width' ] . '" /></li>';
                    echo '<li><a href="javascript:void(0);" class="button deletion redux-slides-remove">' . __ ( 'Delete', UN ) . '</a></li>';
                    echo '</ul></div></fieldset></div>';
                    $x ++;
                }
            }

            if ( $x == 0 ) {
                echo '<div class="redux-slides-accordion-group"><fieldset class="redux-field" data-id="' . $this->field[ 'id' ] . '"><h3><span class="redux-slides-header">' . esc_attr ( sprintf ( __ ( 'New %s', UN ), $this->field[ 'content_title' ] ) ) . '</span></h3><div>';

                $hide = ' hide';

                echo '<div class="screenshot' . $hide . '">';
                echo '<a class="of-uploaded-image" href="">';
                echo '<img class="redux-slides-image" id="image_image_id_' . $x . '" src="" alt="" target="_blank" rel="external" />';
                echo '</a>';
                echo '</div>';

                //Upload controls DIV
                echo '<div class="upload_button_div">';

                //If the user has WP3.5+ show upload/remove button
                echo '<span class="button media_upload_button" id="add_' . $x . '">' . __ ( 'Upload', UN ) . '</span>';

                echo '<span class="button remove-image' . $hide . '" id="reset_' . $x . '" rel="' . $this->parent->args[ 'opt_name' ] . '[' . $this->field[ 'id' ] . '][attachment_id]">' . __ ( 'Remove', UN ) . '</span>';

                echo '</div>' . "\n";
				
				echo '<input type="checkbox" class="checkbox" name="' . $this->field[ 'name' ] . '[' . $x . '][dark]' . $this->field['name_suffix'] . '" id="' . $this->field[ 'id' ] . '-dark_' . $x . '" value="bg-dark"> ' . __('Is your Image dark?', UN);
				
				
				echo '<br>			
				<label>'.__('Overlay:', UN).'</label> <select id="' . $this->field[ 'id' ] . '-overlay_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][overlay]' . $this->field['name_suffix'] . '" class="slide-anim">'; ?>
					
				  <option value=""><?php _e('Overlay Effect', UN); ?></option>		
				  <option value="bg-light-90">Light 90%</option>
				  <option value="bg-light-60">Light 60%</option>
				  <option value="bg-light-30">Light 30%</option>
				  <option value="bg-dark-90">Dark 90%</option>
				  <option value="bg-dark-60">Dark 60%</option>
				  <option value="bg-dark-30">Dark 30%</option>
				  <option value="bg-film">Film</option>				
				
  
				<?php echo '
				</select>';
					

                echo '<ul id="' . $this->field[ 'id' ] . '-ul" class="redux-slides-list">';
                if ( $this->field[ 'show' ][ 'title' ] ) {
                    $title_type = "text";
                } else {
                    $title_type = "hidden";
                }
                $placeholder = ( isset ( $this->field[ 'placeholder' ][ 'title' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'title' ] ) : __ ( 'Title', UN );
                echo '<li><label>'.__('Title:', UN).'</label> <br><input type="' . $title_type . '" id="' . $this->field[ 'id' ] . '-title_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][title]' . $this->field['name_suffix'] .'" value="" placeholder="' . $placeholder . '" class="full-text slide-title" />';
				
				echo '				
				<select id="' . $this->field[ 'id' ] . '-title_anim_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][title_anim]' . $this->field['name_suffix'] . '" class="slide-anim">'; ?>
                <option value="" selected="selected"><?php _e('Title Animation', UN); ?></option>
                
                <optgroup label="Attention Seekers">
                  <option value="bounce">bounce</option>
                  <option value="flash">flash</option>
                  <option value="pulse">pulse</option>
                  <option value="rubberBand">rubberBand</option>
                  <option value="shake">shake</option>
                  <option value="swing">swing</option>
                  <option value="tada">tada</option>
                  <option value="wobble">wobble</option>
                  <option value="jello">jello</option>
                </optgroup>
        
                <optgroup label="Bouncing Entrances">
                  <option value="bounceIn">bounceIn</option>
                  <option value="bounceInDown">bounceInDown</option>
                  <option value="bounceInLeft">bounceInLeft</option>
                  <option value="bounceInRight">bounceInRight</option>
                  <option value="bounceInUp">bounceInUp</option>
                </optgroup>
        
                <optgroup label="Bouncing Exits">
                  <option value="bounceOut">bounceOut</option>
                  <option value="bounceOutDown">bounceOutDown</option>
                  <option value="bounceOutLeft">bounceOutLeft</option>
                  <option value="bounceOutRight">bounceOutRight</option>
                  <option value="bounceOutUp">bounceOutUp</option>
                </optgroup>
        
                <optgroup label="Fading Entrances">
                  <option value="fadeIn">fadeIn</option>
                  <option value="fadeInDown">fadeInDown</option>
                  <option value="fadeInDownBig">fadeInDownBig</option>
                  <option value="fadeInLeft">fadeInLeft</option>
                  <option value="fadeInLeftBig">fadeInLeftBig</option>
                  <option value="fadeInRight">fadeInRight</option>
                  <option value="fadeInRightBig">fadeInRightBig</option>
                  <option value="fadeInUp">fadeInUp</option>
                  <option value="fadeInUpBig">fadeInUpBig</option>
                </optgroup>
        
                <optgroup label="Fading Exits">
                  <option value="fadeOut">fadeOut</option>
                  <option value="fadeOutDown">fadeOutDown</option>
                  <option value="fadeOutDownBig">fadeOutDownBig</option>
                  <option value="fadeOutLeft">fadeOutLeft</option>
                  <option value="fadeOutLeftBig">fadeOutLeftBig</option>
                  <option value="fadeOutRight">fadeOutRight</option>
                  <option value="fadeOutRightBig">fadeOutRightBig</option>
                  <option value="fadeOutUp">fadeOutUp</option>
                  <option value="fadeOutUpBig">fadeOutUpBig</option>
                </optgroup>
        
                <optgroup label="Flippers">
                  <option value="flip">flip</option>
                  <option value="flipInX">flipInX</option>
                  <option value="flipInY">flipInY</option>
                  <option value="flipOutX">flipOutX</option>
                  <option value="flipOutY">flipOutY</option>
                </optgroup>
        
                <optgroup label="Lightspeed">
                  <option value="lightSpeedIn">lightSpeedIn</option>
                  <option value="lightSpeedOut">lightSpeedOut</option>
                </optgroup>
        
                <optgroup label="Rotating Entrances">
                  <option value="rotateIn">rotateIn</option>
                  <option value="rotateInDownLeft">rotateInDownLeft</option>
                  <option value="rotateInDownRight">rotateInDownRight</option>
                  <option value="rotateInUpLeft">rotateInUpLeft</option>
                  <option value="rotateInUpRight">rotateInUpRight</option>
                </optgroup>
        
                <optgroup label="Rotating Exits">
                  <option value="rotateOut">rotateOut</option>
                  <option value="rotateOutDownLeft">rotateOutDownLeft</option>
                  <option value="rotateOutDownRight">rotateOutDownRight</option>
                  <option value="rotateOutUpLeft">rotateOutUpLeft</option>
                  <option value="rotateOutUpRight">rotateOutUpRight</option>
                </optgroup>
        
                <optgroup label="Sliding Entrances">
                  <option value="slideInUp">slideInUp</option>
                  <option value="slideInDown">slideInDown</option>
                  <option value="slideInLeft">slideInLeft</option>
                  <option value="slideInRight">slideInRight</option>
        
                </optgroup>
                <optgroup label="Sliding Exits">
                  <option value="slideOutUp">slideOutUp</option>
                  <option value="slideOutDown">slideOutDown</option>
                  <option value="slideOutLeft">slideOutLeft</option>
                  <option value="slideOutRight">slideOutRight</option>
                  
                </optgroup>
                
                <optgroup label="Zoom Entrances">
                  <option value="zoomIn">zoomIn</option>
                  <option value="zoomInDown">zoomInDown</option>
                  <option value="zoomInLeft">zoomInLeft</option>
                  <option value="zoomInRight">zoomInRight</option>
                  <option value="zoomInUp">zoomInUp</option>
                </optgroup>
                
                <optgroup label="Zoom Exits">
                  <option value="zoomOut">zoomOut</option>
                  <option value="zoomOutDown">zoomOutDown</option>
                  <option value="zoomOutLeft">zoomOutLeft</option>
                  <option value="zoomOutRight">zoomOutRight</option>
                  <option value="zoomOutUp">zoomOutUp</option>
                </optgroup>
        
                <optgroup label="Specials">
                  <option value="hinge">hinge</option>
                  <option value="rollIn">rollIn</option>
                  <option value="rollOut">rollOut</option>
                </optgroup>
       
                    
                <?php echo '
				</select>
				</li>';

                
				$placeholder = ( isset ( $this->field[ 'placeholder' ][ 'subtitle' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'subtitle' ] ) : __ ( 'Description', UN );
				echo '<li><label>'.__('Subtitle:', UN).'</label> <br><input type="text" name="' . $this->field[ 'name' ] . '[' . $x . '][subtitle]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-subtitle_' . $x . '" placeholder="' . $placeholder . '" class="full-text slide-title" />';
				
				
				echo '				
				<select id="' . $this->field[ 'id' ] . '-subtitle_anim_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][subtitle_anim]' . $this->field['name_suffix'] . '" class="slide-anim">'; ?>
                <option value="" selected="selected"><?php _e('Subtitle Animation', UN); ?></option>
                
                <optgroup label="Attention Seekers">
                  <option value="bounce">bounce</option>
                  <option value="flash">flash</option>
                  <option value="pulse">pulse</option>
                  <option value="rubberBand">rubberBand</option>
                  <option value="shake">shake</option>
                  <option value="swing">swing</option>
                  <option value="tada">tada</option>
                  <option value="wobble">wobble</option>
                  <option value="jello">jello</option>
                </optgroup>
        
                <optgroup label="Bouncing Entrances">
                  <option value="bounceIn">bounceIn</option>
                  <option value="bounceInDown">bounceInDown</option>
                  <option value="bounceInLeft">bounceInLeft</option>
                  <option value="bounceInRight">bounceInRight</option>
                  <option value="bounceInUp">bounceInUp</option>
                </optgroup>
        
                <optgroup label="Bouncing Exits">
                  <option value="bounceOut">bounceOut</option>
                  <option value="bounceOutDown">bounceOutDown</option>
                  <option value="bounceOutLeft">bounceOutLeft</option>
                  <option value="bounceOutRight">bounceOutRight</option>
                  <option value="bounceOutUp">bounceOutUp</option>
                </optgroup>
        
                <optgroup label="Fading Entrances">
                  <option value="fadeIn">fadeIn</option>
                  <option value="fadeInDown">fadeInDown</option>
                  <option value="fadeInDownBig">fadeInDownBig</option>
                  <option value="fadeInLeft">fadeInLeft</option>
                  <option value="fadeInLeftBig">fadeInLeftBig</option>
                  <option value="fadeInRight">fadeInRight</option>
                  <option value="fadeInRightBig">fadeInRightBig</option>
                  <option value="fadeInUp">fadeInUp</option>
                  <option value="fadeInUpBig">fadeInUpBig</option>
                </optgroup>
        
                <optgroup label="Fading Exits">
                  <option value="fadeOut">fadeOut</option>
                  <option value="fadeOutDown">fadeOutDown</option>
                  <option value="fadeOutDownBig">fadeOutDownBig</option>
                  <option value="fadeOutLeft">fadeOutLeft</option>
                  <option value="fadeOutLeftBig">fadeOutLeftBig</option>
                  <option value="fadeOutRight">fadeOutRight</option>
                  <option value="fadeOutRightBig">fadeOutRightBig</option>
                  <option value="fadeOutUp">fadeOutUp</option>
                  <option value="fadeOutUpBig">fadeOutUpBig</option>
                </optgroup>
        
                <optgroup label="Flippers">
                  <option value="flip">flip</option>
                  <option value="flipInX">flipInX</option>
                  <option value="flipInY">flipInY</option>
                  <option value="flipOutX">flipOutX</option>
                  <option value="flipOutY">flipOutY</option>
                </optgroup>
        
                <optgroup label="Lightspeed">
                  <option value="lightSpeedIn">lightSpeedIn</option>
                  <option value="lightSpeedOut">lightSpeedOut</option>
                </optgroup>
        
                <optgroup label="Rotating Entrances">
                  <option value="rotateIn">rotateIn</option>
                  <option value="rotateInDownLeft">rotateInDownLeft</option>
                  <option value="rotateInDownRight">rotateInDownRight</option>
                  <option value="rotateInUpLeft">rotateInUpLeft</option>
                  <option value="rotateInUpRight">rotateInUpRight</option>
                </optgroup>
        
                <optgroup label="Rotating Exits">
                  <option value="rotateOut">rotateOut</option>
                  <option value="rotateOutDownLeft">rotateOutDownLeft</option>
                  <option value="rotateOutDownRight">rotateOutDownRight</option>
                  <option value="rotateOutUpLeft">rotateOutUpLeft</option>
                  <option value="rotateOutUpRight">rotateOutUpRight</option>
                </optgroup>
        
                <optgroup label="Sliding Entrances">
                  <option value="slideInUp">slideInUp</option>
                  <option value="slideInDown">slideInDown</option>
                  <option value="slideInLeft">slideInLeft</option>
                  <option value="slideInRight">slideInRight</option>
        
                </optgroup>
                <optgroup label="Sliding Exits">
                  <option value="slideOutUp">slideOutUp</option>
                  <option value="slideOutDown">slideOutDown</option>
                  <option value="slideOutLeft">slideOutLeft</option>
                  <option value="slideOutRight">slideOutRight</option>
                  
                </optgroup>
                
                <optgroup label="Zoom Entrances">
                  <option value="zoomIn">zoomIn</option>
                  <option value="zoomInDown">zoomInDown</option>
                  <option value="zoomInLeft">zoomInLeft</option>
                  <option value="zoomInRight">zoomInRight</option>
                  <option value="zoomInUp">zoomInUp</option>
                </optgroup>
                
                <optgroup label="Zoom Exits">
                  <option value="zoomOut">zoomOut</option>
                  <option value="zoomOutDown">zoomOutDown</option>
                  <option value="zoomOutLeft">zoomOutLeft</option>
                  <option value="zoomOutRight">zoomOutRight</option>
                  <option value="zoomOutUp">zoomOutUp</option>
                </optgroup>
        
                <optgroup label="Specials">
                  <option value="hinge">hinge</option>
                  <option value="rollIn">rollIn</option>
                  <option value="rollOut">rollOut</option>
                </optgroup>
       
                    
                <?php echo '
				</select>
				</li>';
               
                $placeholder = ( isset ( $this->field[ 'placeholder' ][ 'url' ] ) ) ? esc_attr ( $this->field[ 'placeholder' ][ 'url' ] ) : __ ( 'URL', UN );
                if ( $this->field[ 'show' ][ 'url' ] ) {
                    $url_type = "text";
                } else {
                    $url_type = "hidden";
                }
                echo '<li><input type="' . $url_type . '" id="' . $this->field[ 'id' ] . '-url_' . $x . '" name="' . $this->field[ 'name' ] . '[' . $x . '][url]' . $this->field['name_suffix'] .'" value="" class="full-text" placeholder="' . $placeholder . '" /></li>';
                echo '<li><input type="hidden" class="slide-sort" name="' . $this->field[ 'name' ] . '[' . $x . '][sort]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-sort_' . $x . '" value="' . $x . '" />';
                echo '<li><input type="hidden" class="upload-id" name="' . $this->field[ 'name' ] . '[' . $x . '][attachment_id]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-image_id_' . $x . '" value="" />';
                echo '<input type="hidden" class="upload" name="' . $this->field[ 'name' ] . '[' . $x . '][image]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-image_url_' . $x . '" value="" readonly="readonly" />';
                echo '<input type="hidden" class="upload-height" name="' . $this->field[ 'name' ] . '[' . $x . '][height]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-image_height_' . $x . '" value="" />';
                echo '<input type="hidden" class="upload-width" name="' . $this->field[ 'name' ] . '[' . $x . '][width]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-image_width_' . $x . '" value="" /></li>';
                echo '<input type="hidden" class="upload-thumbnail" name="' . $this->field[ 'name' ] . '[' . $x . '][thumb]' . $this->field['name_suffix'] .'" id="' . $this->field[ 'id' ] . '-thumb_url_' . $x . '" value="" /></li>';
                echo '<li><a href="javascript:void(0);" class="button deletion redux-slides-remove">' . __ ( 'Delete', UN ) . '</a></li>';
                echo '</ul></div></fieldset></div>';
            }
            echo '</div><a href="javascript:void(0);" class="button redux-slides-add button-primary" rel-id="' . $this->field[ 'id' ] . '-ul" rel-name="' . $this->field[ 'name' ] . '[title][]' . $this->field['name_suffix'] .'">' . sprintf ( __ ( 'Add %s', UN ), $this->field[ 'content_title' ] ) . '</a><br/>';
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue () {

            if ( function_exists( 'wp_enqueue_media' ) ) {
                wp_enqueue_media();
            } else {
                wp_enqueue_script( 'media-upload' );
            }
                
            if ($this->parent->args['dev_mode']){
                wp_enqueue_style ('redux-field-media-css');
                
                wp_enqueue_style (
                    'redux-field-slides-css', 
                    UN_THEME_URI . 'inc/redux-ext/custom_fields/slides/field_slides.css', 
                    array('redux-extension-metaboxes-css'),
                    time (), 
                    'all'
                );
            }
            
            wp_enqueue_script(
                'redux-field-media-js',
                ReduxFramework::$_url . 'assets/js/media/media' . Redux_Functions::isMin() . '.js',
                array( 'jquery', 'redux-js' ),
                time(),
                true
            );

            wp_enqueue_script (
                'redux-field-slides-js', 
                UN_THEME_URI . 'inc/redux-ext/custom_fields/slides/field_slides' . Redux_Functions::isMin () . '.js', 
                array( 'jquery', 'jquery-ui-core', 'jquery-ui-accordion', 'jquery-ui-sortable', 'redux-field-media-js' ),
                time (), 
                true
            );
        }
    }
}