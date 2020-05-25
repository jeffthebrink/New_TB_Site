<?php
/*
Template Name: Blog
Description: The Blog Loop Template
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
	$item_cols = 'col-sm-6 col-md-6 col-lg-6';
}else{
	$wrap_cols = 'col-sm-12';
	$item_cols = 'col-sm-4 col-md-4 col-lg-4';
}

// Masonry Feature
$masonry = redux_post_meta( UN, get_the_ID(), 'page_blog_masonry' );

?>

<?php un_heading_builder(); ?>
    
<!-- BLOG 2 COLUMN -->
<section class="module">

    <div class="container">

        <div class="row">

            <!-- CONTENT -->
            <div class="<?php echo esc_attr($wrap_cols); ?>">
            	
            	<?php
				
				// Paged Value
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				
				// Blog Query arguments
				$blog_args = array (
					'post_status'            => array( 'publish' ),
					'pagination'             => true,
					'paged'                  => $paged,
					'order'                  => 'DESC',
					'orderby'                => 'date',
				);
				
				// The Query
				$blog_query = new WP_Query( $blog_args );
				?>
                
                <?php if ( $blog_query->have_posts() ) { ?>
					
                    <?php 
					if( $masonry == '1' ){
						 echo '
						 <div id="posts-masonry" class="row posts-masonry">'; 
					}else{
						echo '
						<!-- MULTICOLUMNS -->
                   		<div class="row multi-columns-row">';
					}
					?>
                    
                    
                    <?php while ( $blog_query->have_posts() ) { $blog_query->the_post(); ?>
                    
                        <?php 
                        // Post Categories
                        $post_categories_obj = get_the_category();
                        $post_categories = '';
                        foreach($post_categories_obj as $post_category){
                            $post_categories .= '<a href="'.get_category_link($post_category->term_id).'">'.$post_category->name.'</a>, ';
                        } 
                        $post_categories = substr($post_categories, 0, -2);
                        
                        // Author Metas
                        $author_name = get_the_author_meta( 'display_name' );
                        $author_id = get_the_author_meta( 'ID' );
                        $author_bio = get_the_author_meta( 'description' );
                        
                        // Post Metas
                        $post_meta = __('By', UN).' <a href="'.get_author_posts_url( $author_id ).'">'.get_the_author_meta( 'display_name' ).'</a> / '.get_the_date('d F').' / '.$post_categories.' / '.get_comments_number().' '.__('comm.', UN);	
                        ?>
                    
                        <!-- POST -->
                        <div class="<?php echo esc_attr($item_cols); ?> m-b-60">
                            <div class="post">
                            	<?php if( has_post_thumbnail() ){ ?>
                                <div class="post-media">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                    	<?php 
										// Masonry Feature
										if ( $masonry == '1' && $blog_query->current_post % 2 == 1){
                                        	echo un_get_the_post_thumbnail( get_the_ID(), 900, 900, true ); 
										}else{
											echo un_get_the_post_thumbnail( get_the_ID(), 900, 434, true ); 
										}
										?>
                                    </a>
                                </div>
                                <?php } ?> 
                                <div class="post-meta font-alt">
                                    <?php echo wp_kses_post($post_meta); ?>
                                </div>
                                <div class="post-header">
                                    <h5 class="post-title font-alt">
                                        <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                    </h5>
                                </div>
                                <div class="post-entry">
                                    <?php the_excerpt(); ?>
                                </div>
                                <div class="post-more-link font-alt">
                                    <a href="<?php echo get_the_permalink(); ?>"><?php _e('Read more', UN); ?></a>
                                </div>
                            </div>
                        </div>
                        <!-- /POST -->
                        
                        <?php } // end of the loop. ?>
                     
                    </div>
                    <!-- /MULTICOLUMNS -->
                    
                    <?php un_pagination($blog_query); ?>
                
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