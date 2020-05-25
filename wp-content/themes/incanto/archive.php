<?php
/*
Description: The Archive
Theme: Incanto
*/
?>

<?php get_header(); ?>

<?php un_heading_builder(); ?>
    
<!-- BLOG 2 COLUMN -->
<section class="module">

    <div class="container">

        <div class="row">

            <!-- CONTENT -->
            <div class="col-sm-9">
                
                <?php if ( have_posts() ) { ?>

                    <!-- MULTICOLUMNS -->
                    <div class="row multi-columns-row">
                    
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
                    
                        <!-- POST -->
                        <div class="col-sm-6 col-md-6 col-lg-6 m-b-60">
                            <div class="post">
                            	<?php if( has_post_thumbnail() ){ ?>
                                <div class="post-media">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <?php echo un_get_the_post_thumbnail( get_the_ID(), 900, 434, true ); ?>
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
                    
                    <?php un_pagination(); ?>
                
                <?php }else{
					
					_e('No posts found', UN);
					
				} // end if have_posts() ?>

            </div>
            <!-- /CONTENT -->

            <?php get_sidebar(); //include the sidebar.php ?>

        </div>

    </div>

</section>
<!-- /BLOG 2 COLUMN -->

<?php get_footer();