<?php
/*
Description: Mega Projects Widget
Theme: Incanto
*/
 
add_action( 'widgets_init', 'un_mega_projects' );


function un_mega_projects() {
	register_widget( 'UN_Mega_Projects' );
}

class UN_Mega_Projects extends WP_Widget {

	function UN_Mega_Projects() {
		
		$widget_ops = array( 'classname' => 'un-mega-projects', 'description' => __('Display the projects as you want', UN) );
		
		WP_Widget::__construct( 'un-mega-projects', __('UN: Mega Projects', UN), $widget_ops );
		
	}
	
	// Display Widget 
	
	function widget( $args, $instance ) {
		
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Mega Projects' : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) ) {
 			$number = 5;
		}
		if ( !empty( $instance['orderby'] ) ) {
 			$orderby = $instance['orderby'];
		}else{
			$orderby = 'none';
		}
		if ( !empty( $instance['orderdir'] ) ) {
 			$orderdir = $instance['orderdir'];
		}else{
			$orderdir = 'DESC';
		}
		if ( !empty( $instance['cat_filter'] ) &&  !in_array('-1', $instance['cat_filter']) ) {
 			$cat_filter = array(array( 'taxonomy' => 'un-portfolio-categories', 'field' => 'id', 'terms' => $instance['cat_filter'] ));
		}else{
			$cat_filter = array();
		}
		
		
		// Query
		$qr_args = array (
			'post_type' => 'un-portfolio',
			'tax_query' => $cat_filter,
			'posts_per_page' => $number, 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => true,
			'orderby' => $orderby, 
			'order' => $orderdir,
		);
		
		$qr = new WP_Query( $qr_args );
		
		// START WIDGET HTML
		
		if ( $qr->have_posts() ) {
			
			// Before Widget
			echo wp_kses_post($before_widget);
	
			// Display the widget title 
			if ( $title ) {
				echo wp_kses_post($before_title . $title . $after_title);
			}
			
			echo '<div class="widget-thumb">';
        	echo '<ul>';
			
			while ($qr->have_posts()) { $qr->the_post();
				
				$post_cat_ar = wp_get_post_terms( get_the_ID(), 'un-portfolio-categories');
				$post_cat = $post_cat_ar[0]->name;
				
				echo '<li class="clearfix">';
				
					echo '<div class="widget-posts-image"><a href="'.get_the_permalink().'">'.un_get_the_post_thumbnail(get_the_ID(), 128, 128, true).'</a></div>';
					
					echo '<div class="widget-posts-body">';
					
					echo '<h6 class="widget-posts-title font-alt"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h6>';
					
					echo '<div class="widget-posts-meta">'.__('By', UN).' ';
					
					the_author_posts_link();
					
					echo ', '.get_the_date().'</div>';
	
					echo '</div>';
				
				echo '</li>';
				
			}
			
        	echo '</ul>';
			echo '</div>';
			
			// After Widget
			echo wp_kses_post($after_widget);
			
		}
		
		// Restore original Post Data
		wp_reset_postdata();
		
		
	}

	// Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];
		$instance['cat_filter'] = $new_instance['cat_filter'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['orderdir'] = $new_instance['orderdir'];

		return $instance;
		
	}

	
	function form( $instance ) {
		
		$title = isset($instance['title']) ? esc_attr($instance['title']) :  __('Mega Projects', UN);
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$cat_filter = isset($instance['cat_filter']) ? $instance['cat_filter'] : array('-1');
		$orderby = isset($instance['orderby']) ? $instance['orderby'] : 'none';
		$orderdir = isset($instance['orderdir']) ? $instance['orderdir'] : 'DESC';
?>

	
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php echo 'Title:'; ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php echo 'Number of projects to show:'; ?></label>
		<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'cat_filter' )); ?>"><?php _e('Category Filter:', UN); ?></label>
            
			<?php $categories = get_terms( 'un-portfolio-categories', array('orderby' => 'name','order' => 'ASC')); ?>
		       
       		<select multiple="multiple" id="<?php echo esc_attr($this->get_field_id( 'cat_filter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cat_filter' )).'[]'; ?>" class="widefat">
            <option <?php if ( in_array('-1', $cat_filter) ){echo 'selected="selected"';} ?> value="-1"><?php _e('All Categories', UN);?></option>
    		<?php foreach ($categories as $category) {  ?>
            <option <?php if ( $cat_filter && in_array($category->term_id, $cat_filter) ){echo 'selected="selected"';} ?> value="<?php echo esc_attr($category->term_id); ?>"><?php echo wp_kses_post($category->name); ?></option>
			<?php } ?>
    		</select>
		</p>


		 <p><label for="<?php echo esc_attr($this->get_field_id('orderby')); ?>"><?php echo 'Order projects by:'; ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'orderby' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'orderby' )); ?>" class="widefat">



            <option <?php if ($orderby == 'none' ){echo 'selected="selected"';} ?> value="none">No order</option>



            <option <?php if ($orderby == 'comment_count' ){echo 'selected="selected"';} ?> value="comment_count">Comment Count</option>



            <option <?php if ($orderby == 'date' ){echo 'selected="selected"';} ?> value="date">Creation Date</option>



            <option <?php if ($orderby == 'modified' ){echo 'selected="selected"';} ?> value="modified">Edit Date</option>



            <option <?php if ($orderby == 'title' ){echo 'selected="selected"';} ?> value="title">Title</option>



            <option <?php if ($orderby == 'rand' ){echo 'selected="selected"';} ?> value="rand">Random</option>



        </select>



        </p>
        <p><label for="<?php echo esc_attr($this->get_field_id('orderdir')); ?>"><?php echo 'Order direction:'; ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'orderdir' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'orderdir' )); ?>" class="widefat">



            <option <?php if ($orderdir == 'ASC' ){echo 'selected="selected"';} ?> value="ASC">Ascending order </option>



            <option <?php if ($orderdir == 'DESC' ){echo 'selected="selected"';} ?> value="DESC">Descending order</option>



        </select>



        </p>

	<?php
	}
}

?>