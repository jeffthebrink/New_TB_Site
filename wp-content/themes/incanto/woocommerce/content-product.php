<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 4.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop, $uncommons;

$shop_columns = $uncommons['opt-shop-columns'];

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', $shop_columns );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>

<?php switch($shop_columns) {
	
	case '2':
	echo '<div class="col-sm-6 col-md-6 col-lg-6 '. join( ' ', get_post_class($classes) ).'">';
	break;
	
	case '3':
	echo '<div class="col-sm-6 col-md-4 col-lg-4 '. join( ' ', get_post_class($classes) ).'">';
	break;
	
	case '4':
	echo '<div class="col-sm-6 col-md-3 col-lg-3 '. join( ' ', get_post_class($classes) ).'">';
	break;
	
	case '6':
	echo '<div class="col-sm-6 col-md-2 col-lg-2 '. join( ' ', get_post_class($classes) ).'">';
	break;
	
}?>

    <div class="shop-item">
    
        <div class="shop-item-image">
        
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
			<?php
                /**
                 * woocommerce_before_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                 */
                do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>
        
            <div class="shop-item-detail">
                    
					<?php
                
                        /**
                         * woocommerce_after_shop_loop_item hook
                         *
                         * @hooked woocommerce_template_loop_add_to_cart - 10
                         */
                      	do_action( 'woocommerce_after_shop_loop_item' );
                
                    ?>
                          
			</div>
            
            
        </div>
        
        <h5 class="shop-item-title font-alt"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
    
		<?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
    
    </div>

</div>
