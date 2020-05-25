<?php
/*
Description: WP Default Widgets
Theme: Incanto
*/

// DEFAULT WIDGETS CUSTOMIZATION //

// Search Widget
class un_WP_Widget_Search extends WP_Widget_Search {
	
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo wp_kses_post($args['before_widget']);
		
		if ( $title ) {
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
		}
		
		// Personal Search Form
		echo '
		<form role="form" action="'.home_url( '/' ).'" method="get">
			<div class="search-box">
				<input class="form-control" placeholder="'.__('Search...', UN).'" type="text" name="s" id="search" value="'.esc_html( get_search_query( false ) ).'">
				<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
			</div>
		</form>';	

		echo wp_kses_post($args['after_widget']);
		
	}
	
}


// Tag Cloud Widget
class un_WP_Widget_Tag_Cloud extends WP_Widget_Tag_Cloud {
	
	public function widget( $args, $instance ) {
		
		$current_taxonomy = $this->_get_current_taxonomy($instance);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags', UN);
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo wp_kses_post($args['before_widget']);
		if ( $title ) {
			echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
		}
		echo '<div class="tags">';

		wp_tag_cloud( apply_filters( 'widget_tag_cloud_args', array(
			'taxonomy' => $current_taxonomy
		) ) );

		echo "</div>\n";
		echo wp_kses_post($args['after_widget']);
		
	}
	
}



// DEFAULT WIDGETS REGISTRATION //

add_action('widgets_init', 'un_default_widgets_reg');

function un_default_widgets_reg() {
  register_widget("un_WP_Widget_Search");
  register_widget("un_WP_Widget_Tag_Cloud");
}
