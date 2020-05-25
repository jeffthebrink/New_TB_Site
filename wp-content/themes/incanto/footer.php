<?php
/*
Description: The Footer
Theme: Incanto
*/
?>

<?php 
// Check Sidebars distribution
$col_class = un_foot_sidebars_class();
?>

<?php // Check Footer Features
		
global $uncommons;

if( $uncommons['opt-footer-widgets'] == '1' ){ ?>

    <!-- FOOTER SIDEBARS -->
    <section class="module-small bg-light">
    
        <div class="container">
    		
            <?php if( isset($uncommons['opt-footer-logo']) && !empty($uncommons['opt-footer-logo']['url']) ) { ?>
            
                <div class="row">
                    <div class="col-sm-3">
                        <!-- LOGO -->
                        <img src="<?php echo esc_url($uncommons['opt-footer-logo']['url']); ?>" alt="">
                    </div>
                </div>
            
            <?php } ?>
            
            <div class="row m-t-40">
    
                <div class="<?php echo esc_attr($col_class); ?>">
                    <?php dynamic_sidebar( 'un-foot1-sidebar' ); ?>
                </div>
    
                <div class="<?php echo esc_attr($col_class); ?>">
                    <?php dynamic_sidebar( 'un-foot2-sidebar' ); ?>
                </div>
    
                <div class="<?php echo esc_attr($col_class); ?>">
                    <?php dynamic_sidebar( 'un-foot3-sidebar' ); ?>                
                </div>
    
                <div class="<?php echo esc_attr($col_class); ?>">
                    <?php dynamic_sidebar( 'un-foot4-sidebar' ); ?>
                </div>
    
            </div>
    
    
        </div>
    
    </section>
    <!-- WIDGETS -->

<?php } ?>

<hr class="divider"><!-- DIVIDER -->

<!-- FOOTER -->
<footer class="module-small bg-light p-t-30 p-b-30">

    <div class="container">

        <div class="col-sm-12">
            <p class="copyright text-center m-b-0"><?php echo wp_kses_post($uncommons['opt-footer-copy']); ?></p>
        </div>

    </div>

</footer>
<!-- /FOOTER -->

</div> 
<!-- /WRAPPER -->

<!-- SCROLLTOP -->
<div class="scroll-up">
    <a href="#totop"><i class="fa fa-angle-double-up"></i></a>
</div>

<?php 
if( isset($uncommons['opt-adv-custom-foot']) ){
	echo un_sanitize( $uncommons['opt-adv-custom-foot'], true ); 
}
?>

<?php wp_footer(); ?>

</body>
</html>