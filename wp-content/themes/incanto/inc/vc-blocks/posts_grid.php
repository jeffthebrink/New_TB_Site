<?php
/*
Description: VC Posts Grid
Theme: Incanto
*/

// Block Class 
class unPostsGrid extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_posts_grid_map' ) );
        add_shortcode( 'un_posts_grid', array( $this, 'un_posts_grid_short' ) );
    }
 	
	// Block Map
    public function un_posts_grid_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Posts Grid', UN),
				'base' => 'un_posts_grid',
				'description' => __('A Grid of Posts', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Items Limit
					array(
						'type' => 'textfield',
						'heading' => __('Items Limit', UN),
						'param_name' => 'limit',	
						'description' => __('Use an integer value to limit the number of posts displayed (leave in blank to display all posts)', UN),	
					),	
					
					// Ordering
					array(
						'type' => 'dropdown',
						'heading' => __('Order by', UN),
						'param_name' => 'order_by',
						'description' => __('Order your posts by title, date, etc', UN),	
						'value' => array(
							__('Date', UN) => 'date', 
							__('Title', UN) => 'title', 							
							__('Modified Date', UN) => 'modified', 
							__('Slug', UN) => 'name',  
							__('Random', UN) => 'rand',  
						),
					),
					
					array(
						'type' => 'dropdown',
						'heading' => __('Direction', UN),
						'param_name' => 'order',
						'description' => __('Ascending or Descending order', UN),	
						'value' => array(
							__('Descending', UN) => 'DESC', 
							__('Ascending', UN) => 'ASC', 							
						),
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
	public function un_posts_grid_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'limit'     => '',
					'order_by'	=> 'date',	
					'order' => 'DESC',					
				), 
				$atts
			)
		);
		
		$html = '';		

		// Limit
		if($limit){
			$post_per_page = $limit;
		}else{
			$post_per_page = '-1';
		}
		 
		// Posts Query Arguments
		$posts_args = array (
			'post_status'            => 'publish',
			'posts_per_page'         => $post_per_page,
			'order'                  => $order,
			'orderby'                => $order_by,
		);
		 
		// Posts Query
		$posts_args = new WP_Query( $posts_args );
		
		// The Posts Loop
		if ( $posts_args->have_posts() ) {
			
			while ( $posts_args->have_posts() ) {
				
				$posts_args->the_post();
				
				$thumb_w = '400';
				$thumb_h = '200';
				
				// Author Metas
				$author_name = get_the_author_meta( 'display_name' );
				$author_id = get_the_author_meta( 'ID' );
				
				// Post Metas
				$post_meta = __('By', UN).' <a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name' ).'</a> / '.get_the_date('d F').' / '.get_comments_number().' '.__('comm.', UN);

				
				$html .= '
				<!-- POST -->
				<div class="col-sm-6 col-md-4 col-lg-4 m-b-60">
					<div class="post">
						<div class="post-media">
							<a href="'.get_the_permalink().'">
								'.un_get_the_post_thumbnail( get_the_ID(), $thumb_w, $thumb_h, true, true ).'
							</a>
						</div>
						<div class="post-meta font-alt">
							'.$post_meta.'
						</div>
						<div class="post-header">
							<h5 class="post-title font-alt">
								<a href="'.get_the_permalink().'">'.get_the_title().'</a>
							</h5>
						</div>
						<div class="post-entry">
							<p>'.get_the_excerpt().'</p>
						</div>
						<div class="post-more-link font-alt">
							<a href="'.get_the_permalink().'">'.__('Read More', UN).'</a>
						</div>
					</div>
				</div>
				<!-- /POST -->';
		
			}
			
		} else {
			
			$html = __('No posts found', UN);
			
		}
		
		
		
		// Restore original Post Data
		wp_reset_postdata();	
			
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unPostsGrid();			