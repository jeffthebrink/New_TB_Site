<?php
/*
Description: 404 Page
Theme: Incanto
*/
?>

<?php get_header(); ?>

<?php un_heading_builder(); ?>

<!-- /HERO -->
    
<!-- SINGLE POST -->
<section class="module">

    <div class="container">

        <div class="row">

            <!-- CONTENT -->
            <div class="col-sm-9">

                <article class="post post-single">

                    <!-- POST CONTENT -->
                    <div class="post-entry">
                        <?php 
						// 404 Content
						if( isset($uncommons['opt-adv-error-page-content']) ){
							echo wp_kses_post($uncommons['opt-adv-error-page-content']);		
						}
						?>
                    </div>
                    <!-- /POST CONTENT -->
                    
                </article>

            </div>
            <!-- /CONTENT -->

            <?php get_sidebar( $name ); //include the sidebar.php ?>

        </div>

    </div>

</section>
<!-- /SINGLE POST -->

<?php get_footer();
