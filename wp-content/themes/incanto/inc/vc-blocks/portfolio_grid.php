<?php
/*
Description: VC Portfolio Grid
Theme: Incanto
*/

// Block Class 
class unPortfolioGrid extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_portfolio_grid_map' ) );
        add_shortcode( 'un_portfolio_grid', array( $this, 'un_portfolio_grid_short' ) );
    }
 	
	// Block Map
    public function un_portfolio_grid_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
		
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Portfolio Grid', UN),
				'base' => 'un_portfolio_grid',
				'description' => __('A multishape and filtered Grid of Projects', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
					
					// Filters
					array(
						'type' => 'checkbox',
						'heading' => __('Enable Filters', UN),
						'param_name' => 'filts',	
						'description' => __('Add dynamic filters to your projects grid', UN),	
						'value' => 'true',
					),	
					
					// Items Limit
					array(
						'type' => 'textfield',
						'heading' => __('Items Limit', UN),
						'param_name' => 'limit',	
						'description' => __('Use an integer value to limit the number of project displayed (leave in blank to display all projects)', UN),	
					),	
					
					// Ordering
					array(
						'type' => 'dropdown',
						'heading' => __('Order by', UN),
						'param_name' => 'order_by',
						'description' => __('Order your projects by title, date, etc', UN),	
						'value' => array(
							__('Title', UN) => 'title', 
							__('Date', UN) => 'date', 
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
							__('Ascending', UN) => 'ASC', 
							__('Descending', UN) => 'DESC', 
						),
					),
					
					// Disable Project URL
					array(
						'type' => 'checkbox',
						'heading' => __('Disable Project URLs', UN),
						'param_name' => 'disable_urls',	
						'description' => __('You can remove the project\'s urls (useful for the onepage mode)', UN),	
					),
					
					// Load More
					array(
						'type' => 'checkbox',
						'heading' => __('Enable Load More Button', UN),
						'param_name' => 'loadmore',	
						'description' => __('An Ajax loading of projects', UN),	
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
	public function un_portfolio_grid_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'filts' => '',
					'limit'     => '',
					'order_by'	=> 'title',	
					'order' => 'ASC',
					'disable_urls' => '',
					'loadmore' => '',							
				), 
				$atts
			)
		);
				
		$html = '';		

		// Check if Filters
		if($filts == 'true'){
			
			$html .= '
			<!-- FILTER -->
			<div class="row">
				<div class="col-sm-12">
						<ul id="filters" class="filters font-alt">
						
							<li><a href="#" data-filter="*" class="current">'.__('All', UN).'</a></li>';
			
							$filters = un_get_terms_array('un-portfolio-categories');
		
							foreach($filters as $filter){
								
								$html .= '<li><a href="#" data-filter=".'.$filter['slug'].'">'.$filter['name'].'</a></li>';
						
							}					
						
			$html .= '		
					</ul>
				</div>
	
			</div>
			<!-- /FILTER -->';
			
		}
		
		$html .= ' 
		<!-- WORKS GRID -->
		<div class="works-grid-wrapper">

			<div id="works-grid" class="works-grid works-hover-w">

				<!-- DO NOT DELETE THIS DIV -->
				<div class="grid-sizer"></div>';
				
				if(is_home() || is_front_page()){
					$paged = (get_query_var('page')) ? get_query_var('page') : 1;
				}else{
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				}
				
				if($limit){
					$post_per_page = $limit;
				}else{
					$post_per_page = '-1';
				}
				 
				// Portfolio Query Arguments
				$portfolio_args = array (
					'post_type'              => 'un-portfolio',
					'post_status'            => 'publish',
					'pagination'             => true,
					'posts_per_page'         => $post_per_page,
					'paged'                  => $paged,
					'order'                  => $order,
					'orderby'                => $order_by,
				);
				
				// Portfolio Query
				$portfolio_query = new WP_Query( $portfolio_args );
				
				// The Portfolio Loop
				if ( $portfolio_query->have_posts() ) {
					
					while ( $portfolio_query->have_posts() ) {
						
						$portfolio_query->the_post();
						
						$shape = redux_post_meta( UN, get_the_ID(), 'thumb_shape' );
						
						$shape_w = '400';
						$shape_h = '400';
						
						switch($shape) {
							
							case 'square':
							break;
							
							case 'wide':
							$shape_w = '800';
							$shape_h = '400';
							break;
							
							case 'tall':
							$shape_w = '400';
							$shape_h = '800';
							break;
							
							case 'wide-tall':
							$shape_w = '800';
							$shape_h = '800';
							break;
							
						}
						
						if( $disable_urls == 'true' ){
							
							$html .= '
							<!-- PORTFOLIO ITEM -->
							<div class="work-item '.$shape.' '.un_get_post_terms_list(get_the_ID(), 'un-portfolio-categories', 'slug', ' ').'">
								<a href="javascript:void();">
									'.un_get_the_post_thumbnail( get_the_ID(), $shape_w, $shape_h, true, true ).'
									<div class="work-caption font-alt">
										<h3 class="work-title">'.get_the_title().'</h3>
										<div class="work-descr">
											'.un_get_post_terms_list(get_the_ID(), 'un-portfolio-categories', 'name', ' / ').'
										</div>
									</div>
								</a>
							</div>
							<!-- /PORTFOLIO ITEM -->';
							
						}else{
							
							$html .= '
							<!-- PORTFOLIO ITEM -->
							<div class="work-item '.$shape.' '.un_get_post_terms_list(get_the_ID(), 'un-portfolio-categories', 'slug', ' ').'">
								<a href="'.get_the_permalink().'">
									'.un_get_the_post_thumbnail( get_the_ID(), $shape_w, $shape_h, true, true ).'
									<div class="work-caption font-alt">
										<h3 class="work-title">'.get_the_title().'</h3>
										<div class="work-descr">
											'.un_get_post_terms_list(get_the_ID(), 'un-portfolio-categories', 'name', ' / ').'
										</div>
									</div>
								</a>
							</div>
							<!-- /PORTFOLIO ITEM -->';
							
						}
				
					}
					
				} else {
					
					$html = __('No projects found', UN);
					
				}
		
		$html .= '
		
			</div>
		</div>
		<!-- /WORKS GRID -->';
		
		
		// Restore original Post Data
		wp_reset_postdata();
		
		// Check if Filters
		if( $loadmore == true && get_next_posts_link('yes', $portfolio_query->max_num_pages) ){
			
			$html .='
			<!-- SHOW MORE -->
			<div class="row m-t-70 text-center">
				<div class="col-sm-12">
	
					<button id="show-more" class="btn btn-round btn-b" data-url="'.get_permalink().'" data-ppp="'.$post_per_page.'">'.__('More projects', UN).'</button>
	
				</div>
			</div>
			<!-- /SHOW MORE -->';
		
		}
		
		
			
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unPortfolioGrid();			