<?php
/*
Template Name: Visual Composer Page
Description: The No-Wrap Page Template
Theme: Incanto
*/
?>

<?php get_header(); ?>

<?php while ( have_posts() ) { the_post(); ?>

	<?php the_content(); ?>    
    
<?php } // end of the loop. ?>

<?php get_footer();
