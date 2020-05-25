<?php
/*
Description: The Search Page
Theme: Incanto
*/
?>

<?php get_header(); ?>

<?php un_heading_builder(); ?>

<!-- SINGLE POST -->
<section class="module">

    <div class="container">

        <div class="row">

            <!-- CONTENT -->
            <div class="col-sm-9">

				<?php if ( have_posts() ) { ?>
                
                    <div class="row multi-columns-row">
    
                    <?php while ( have_posts() ) { the_post(); ?>
                                                        
                        <!-- POST -->
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="post">
                                <div class="post-header">
                                    <h5 class="post-title font-alt">
                                        <a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                </div>
                                <div class="post-entry">
                                    <p><?php the_excerpt(); ?></p>
                                </div>
                            </div>
                            <hr class="divider m-b-30">
                        </div>
                        
                        <!-- /POST -->                        		
                
                    <?php } ?>
                    
                    </div>
                
                    <?php un_pagination(); ?>
                
                <?php } else { ?>
                
                    <?php _e('No results', UN); ?>
                
                <?php } ?>                        
                
            </div>
            <!-- /POST CONTENT -->

            <?php get_sidebar(); //include the sidebar.php ?>

        </div>

    </div>

</section>
<!-- /SINGLE POST -->


<?php get_footer();