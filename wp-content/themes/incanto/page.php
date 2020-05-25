<?php
/*
Description: The Default Page Template
Theme: Incanto
*/
?>

<?php get_header(); ?>

<?php if ( have_posts() ) { the_post(); ?>

<?php

/*****************/
/* PAGE SETTINGS */ 
/*****************/

// Sidebar
$sidebar = redux_post_meta( UN, get_the_ID(), 'page_sidebar' );

if( $sidebar == '1' ){
	$cols = 'col-sm-9';
}else{
	$cols = 'col-sm-12';
}

?>

<?php un_heading_builder(); ?>
    
<!-- SINGLE POST -->
<section class="module">

    <div class="container">

        <div class="row">

            <!-- CONTENT -->
            <div class="<?php echo esc_attr($cols); ?>">

                <article class="post post-single">

                    <!-- POST CONTENT -->
                    <div class="post-entry">
                        <?php the_content(); ?>
                    </div>
                    <!-- /POST CONTENT -->
                    
                </article>
                
                <?php // If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() ) {
					comments_template();
				} ?>

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
<!-- /SINGLE POST -->


<?php } // end of if have post. ?>

<?php get_footer();