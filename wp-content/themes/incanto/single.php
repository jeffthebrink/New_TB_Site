<?php
/*
Description: The Single Post
Theme: Incanto
*/
?>

<?php get_header(); ?>

<?php un_heading_builder(); ?>

<?php while ( have_posts() ) { the_post(); ?>

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
    
    <!-- SINGLE POST -->
    <section class="module">

        <div class="container">

            <div class="row">

                <!-- CONTENT -->
                <div class="col-sm-9">

                    <article class="post post-single">

                        <!-- MEDIA -->
                        <div class="post-media">
                            <?php if(has_post_thumbnail()){ echo un_get_the_post_thumbnail( get_the_ID(), '1000', '600', true, true ); }?>
                        </div>
                        <!-- /MEDIA -->

                        <!-- META -->
                        <div class="post-meta font-alt">
                            <?php echo wp_kses_post($post_meta); ?>
                        </div>
                        <!-- /META -->

                        <!-- HEADER -->
                        <div class="post-header">
                            <h1 class="post-title font-alt">
                                <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                            </h1>
                        </div>
                        <!-- /HEADER -->

                        <!-- POST CONTENT -->
                        <div class="post-entry">
                            <?php the_content(); ?>
                        </div>
                        <!-- /POST CONTENT -->

                        <!-- TAGS -->
                        <div class="tags">                        
                        	<?php echo get_the_tag_list();?>
                        </div>
                        <!-- /TAGS -->

                    </article>

                    <!-- AUTHOR -->
                    <div class="post-author">
                    
                        <h4 class="post-author-title font-alt"><?php _e('Author', UN); ?></h4>
                        <hr class="divider m-b-30">

                        <div class="author-bio">
                            <div class="author-avatar">
                            	<?php echo get_avatar( $author_id ); ?> 
                            </div>
                            <div class="author-content">
                                <h5 class="author-name font-alt"><?php echo wp_kses_post($author_name); ?></h5>
                                <p><?php echo wp_kses_post($author_bio); ?></p>
                                
                                <ul class="social-icon-links socicon-round">
                                	<?php if( get_the_author_meta('twitter') ){ echo '<li><a href="'.esc_url(get_the_author_meta('twitter')).'" target="_blank"><i class="fa fa-twitter"></i></a></li>'; } ?>
                                    <?php if( get_the_author_meta('facebook') ){ echo '<li><a href="'.esc_url(get_the_author_meta('facebook')).'" target="_blank"><i class="fa fa-facebook"></i></a></li>'; } ?>
                                    <?php if( get_the_author_meta('dribbble') ){ echo '<li><a href="'.esc_url(get_the_author_meta('dribbble')).'" target="_blank"><i class="fa fa-dribbble"></i></a></li>'; } ?>
                                    <?php if( get_the_author_meta('pinterest') ){ echo '<li><a href="'.esc_url(get_the_author_meta('pinterest')).'" target="_blank"><i class="fa fa-pinterest"></i></a></li>'; } ?>
                                    <?php if( get_the_author_meta('behance') ){ echo '<li><a href="'.esc_url(get_the_author_meta('behance')).'" target="_blank"><i class="fa fa-behance"></i></a></li>'; } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- /AUTHOR -->

                    <?php // If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() ) {
						comments_template();
					} ?>

                </div>
                <!-- /CONTENT -->

				<?php get_sidebar(); //include the sidebar.php ?>

            </div>

        </div>

    </section>
    <!-- /SINGLE POST -->
   

<?php } // end of the loop. ?>

<?php get_footer();
