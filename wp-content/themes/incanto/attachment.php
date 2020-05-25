<?php
/*
Description: The Attachment Page
Theme: Incanto
*/
?>

<?php get_header(); ?>

<?php un_heading_builder(); ?>

<?php while ( have_posts() ) { the_post(); ?>

    <!-- SINGLE POST -->
    <section class="module">

        <div class="container">

            <div class="row">

                <!-- CONTENT -->
                <div class="col-sm-9">

                    <article class="post post-single">

                        <!-- MEDIA -->
                        <div class="post-media">
                            <?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>
                        </div>
                        <!-- /MEDIA -->

                        <!-- HEADER -->
                        <div class="post-header">
                            <h1 class="post-title font-alt">
                               <?php echo get_the_title(); ?>
                            </h1>
                        </div>
                        <!-- /HEADER -->

                        <!-- POST CONTENT -->
                        <div class="post-entry">
                            <?php the_content(); ?>
                        </div>
                        <!-- /POST CONTENT -->
                        
                    </article>

                </div>
                <!-- /CONTENT -->

				<?php get_sidebar(); //include the sidebar.php ?>

            </div>

        </div>

    </section>
    <!-- /SINGLE POST -->
   

<?php } // end of the loop. ?>

<?php get_footer();
