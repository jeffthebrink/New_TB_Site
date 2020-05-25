<?php
/*
Template Name: Portfolio
Description: The Portfolio Loop Template
Theme: Incanto
*/ 
?>

<?php get_header(); ?>

<?php

/*****************/
/* PAGE SETTINGS */ 
/*****************/


// Sidebar
$sidebar = redux_post_meta( UN, get_the_ID(), 'page_sidebar' );

if( $sidebar == '1' ){
	$wrap_cols = 'col-sm-9';
}else{
	$wrap_cols = 'col-sm-12';
}

// Type
$type = redux_post_meta( UN, get_the_ID(), 'page_port_type' );

// Overlay
$overlay = redux_post_meta( UN, get_the_ID(), 'page_port_overlay' );

// Limit
$limit = redux_post_meta( UN, get_the_ID(), 'page_port_limit' );

// Filters
$filters = redux_post_meta( UN, get_the_ID(), 'page_port_filters' );

// Page Url
$page_url = get_the_permalink();

?>

<?php un_heading_builder(); ?>
    
<!-- BLOG 2 COLUMN -->
<section class="module">

    <div class="container">

        <div class="row">

            <!-- CONTENT -->
            <div class="<?php echo esc_attr($wrap_cols); ?>">
            	
                <?php if( $filters == '1' ){ ?>
                
                    <!-- FILTER -->
                    <div class="row">
            
                        <div class="col-sm-12">
                            <ul id="filters" class="filters font-alt">
                                <li><a href="#" data-filter="*" class="current"><?php _e('All', UN); ?></a></li>
                                <?php 
                                // Get Categories
                                $filters = un_get_terms_array('un-portfolio-categories');
                                
                                // Build Filters		
                                foreach($filters as $filter){
                                    
                                    echo '<li><a href="#" data-filter=".'.esc_attr($filter['slug']).'">'.$filter['name'].'</a></li>';
                            
                                } 
								?>
                            </ul>
                        </div>
    
                    </div>
                    <!-- /FILTER -->
                    
                <?php } ?>
            	
            	<?php
				
				// Paged Value
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
								
				// Limit
				if($limit){
					$post_per_page = $limit;
				}else{
					$post_per_page = '-1';
				}
				
				// Blog Query arguments
				$port_args = array (
					'post_type'              => 'un-portfolio',
					'post_status'            => 'publish',
					'pagination'             => true,
					'posts_per_page'         => $post_per_page,
					'paged'                  => $paged,
					'order'                  => 'ASC',
					'orderby'                => 'date',
				);
				
				// The Query
				$port_query = new WP_Query( $port_args );
				?>
                
                <?php if ( $port_query->have_posts() ) { ?>
                	                                    
                	<!-- WORKS GRID -->
                    <div class="works-grid-wrapper">
    
                        <div id="works-grid" class="works-grid <?php echo esc_attr($overlay); ?>">
    
                            <!-- DO NOT DELETE THIS DIV -->
                            <div class="grid-sizer"></div>
    
                            <?php while ( $port_query->have_posts() ) { $port_query->the_post(); ?>
                            
                            <?php
							// Pakery/Masonry Shapes
							$shape = redux_post_meta( UN, get_the_ID(), 'thumb_shape' );
								
							$shape_w = '400';
							$shape_h = '400';
							
							switch($shape) {
								
								case 'square':
								break;
								
								case 'wide':
								
								if( $type == 'works-grid-pakery' ){
									$shape_w = '800';
									$shape_h = '400';
								}else{
									$shape_w = '400';
									$shape_h = '400';
									$shape = 'square';
								}
								
								break;
								
								case 'tall':
								$shape_w = '400';
								$shape_h = '800';
								break;
								
								case 'wide-tall':
								
								if( $type == 'works-grid-pakery' ){
									$shape_w = '800';
									$shape_h = '800';
								}else{
									$shape_w = '400';
									$shape_h = '800';
									$shape = 'tall';
								}
								
								break;
								
							}
							
							?>
									
                            <?php   
                            echo '
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
                            ?>
                              
                                
                            <?php } // end of the loop. ?>
                    
                        </div>
    
                    </div>
                    <!-- /WORKS GRID -->
    
                    <!-- SHOW MORE -->
                    <div class="row m-t-70 text-center">
                        <div class="col-sm-12">
    
                            <button id="show-more" class="btn btn-round btn-b" data-url="<?php echo esc_url($page_url); ?>" data-ppp="<?php echo esc_attr($post_per_page); ?>"><?php _e('More projects', UN); ?></button>
    
                        </div>
                    </div>
                    <!-- /SHOW MORE -->
                     

                <?php }else{
					
					_e('No posts found', UN);
					
				} // end if have_posts() ?>
                
                <?php
				// Restore original Post Data
				wp_reset_postdata();
				?>

            </div>
            <!-- /CONTENT -->

            <?php
			if( $sidebar == '1' ){
				get_sidebar(); //include the sidebar.php
			} 
			?>

        </div>

    </div>

</section>
<!-- /BLOG 2 COLUMN -->

<?php get_footer();