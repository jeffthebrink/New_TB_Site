<?php
/**
 * Displayed when no products are found matching the current query.
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/no-products-found.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<section class="module-small">

	<div class="container">
			
		<div class="m-t-70 m-b-70"><?php _e( 'No products were found matching your selection.', 'woocommerce' ); ?></div>
        
    </div>
   
</section>
