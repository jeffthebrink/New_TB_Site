<?php
/*
Description: The Single Project
Theme: Incanto
*/
?>

<?php get_header(); ?>

<?php if( have_posts() ) { the_post(); ?>

	<?php un_heading_builder(); ?>

	<?php the_content(); ?>    
    
<?php } // end of the loop. ?>

<?php // RELATED PROJECTS

// Check Meta Options
if( redux_post_meta( UN, get_the_ID(), 'project_related' ) == '1' ){

	// Get related Post $args
	$rel_posts_args = un_related_posts_query_args(get_the_ID(), 'un-portfolio-categories', 4);
	
	// Related Posts Query
	$rel_posts_query = new WP_Query( $rel_posts_args );
	
	// Related Posts Loop
	if ( $rel_posts_query->have_posts() ) { ?> 
		
		<hr class="divider"><!-- DIVIDER -->
		
		<!-- RELATED PROJECT -->
		<section class="module">
		
			<div class="container">
		
				<!-- MODULE TITLE -->
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<h2 class="module-title font-alt"><?php _e('Related Project', UN); ?></h2>
					</div>
				</div>
				<!-- /MODULE TITLE -->
		
				<!-- WORKS GRID -->
				<div class="row">
		
					<div id="works-grid" class="works-grid works-hover-w">
		
						<!-- DO NOT DELETE THIS DIV -->
						<div class="grid-sizer"></div>
		
						<?php // Items
						while ( $rel_posts_query->have_posts() ) { // Start Item
							
							// The Post
							$rel_posts_query->the_post(); 	
							
							// Get Main Term
							$post_terms = wp_get_post_terms(get_the_ID(), 'un-portfolio-categories'); 
							if( count($post_terms) > 0 ){
								$term_name = $post_terms[0]->name;
								$term_slug = $post_terms[0]->slug;
							}else{
								$term_name = '';
								$term_slug = '';
							}
							
						?>
							
							<!-- PORTFOLIO ITEM -->
							<div class="work-item <?php echo esc_attr($term_slug); ?>"> 
								<a href="<?php echo get_the_permalink(); ?>">
									<?php echo un_get_the_post_thumbnail( get_the_ID(), 400, 400, true, true ); ?>
									<div class="work-caption font-alt">
										<h3 class="work-title"><?php the_title(); ?></h3>
										<div class="work-descr">
											<?php echo wp_kses_post($term_name); ?>
										</div>
									</div>
								</a>
							</div>
							<!-- /PORTFOLIO ITEM -->   
							
						<?php } // End Item ?>
						
					</div>
				
				</div>
				<!-- /WORKS GRID -->
		
			</div>
		
		</section>
		<!-- /RELATED PROJECT -->

	<?php } // End Loop Related ?>
	
<?php } // End If Related ?> 

<?php // Restore original Post Data
wp_reset_postdata(); ?>


<?php get_footer();