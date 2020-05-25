<?php
/*
Description: WooCommerce Setup
Theme: Incanto
*/


// Removing Default CSS 
define('WOOCOMMERCE_USE_CSS', false);


// Define the default thumb sizes
add_action( 'after_switch_theme', 'un_woocommerce_image_dimensions', 1 );

function un_woocommerce_image_dimensions() {
	global $pagenow;
 
	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

  	$catalog = array(
		'width' 	=> '600',	// px
		'height'	=> '800',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '800',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '200',	// px
		'height'	=> '270',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}


// WOO Filter Query
add_action( 'woocommerce_product_query', 'un_woo_filter_query' );

function un_woo_filter_query( $q ){
	
	if( !is_product_category() ) {

		global $wpdb, $uncommons;
		
		$args = array();
		$args['orderby'] = '';
		$args['order'] = '';
		$args['meta_key'] = '';
		$args['cat'] = '';
		$args['search'] = '';
		
		// ORDERBY
		if( isset( $_POST['orderby'] ) ) {
			
			$orderby_value = wc_clean( $_POST['orderby'] );
			
			$orderby       = esc_attr( $orderby_value );
			$order = '';
		
			$orderby = strtolower( $orderby );
			$order   = strtoupper( $order );
			
			// default - menu_order
			$args['orderby']  = 'menu_order title';
			$args['order']    = 'ASC';
			$args['meta_key'] = '';
	
	
			switch ( $orderby ) {
				case 'rand' :
					$args['orderby']  = 'rand';
				break;
				case 'date' :
					$args['orderby']  = 'date';
					$args['order']    = 'DESC';
				break;
				case 'price' :
					$args['orderby']  = "meta_value_num {$wpdb->posts}.ID";
					$args['order']    = 'ASC';
					$args['meta_key'] = '_price';
				break;
				case 'price-desc' :
					$args['orderby']  = "meta_value_num {$wpdb->posts}.ID";
					$args['order']    = 'DESC';
					$args['meta_key'] = '_price';
				break;
				case 'title' :
					$args['orderby']  = 'title';
					$args['order']    = 'ASC';
				break;
			}
			
				
		}else{
			
			$args    = array();
			
			// default - menu_order
			$args['orderby']  = 'menu_order title';
			$args['order']    = 'ASC';
			$args['meta_key'] = '';
			
		}
		
		
		// Cat
		if( isset( $_POST['product_category'] ) && !empty($_POST['product_category']) && $_POST['product_category'] != 'All' ){
			$args['cat'] = $_POST['product_category'];
		}else{
			$args['cat'] = '';
		}
		
		
		// Key
		if( isset( $_POST['search'] ) && !empty($_POST['search']) ){
			$args['search'] = $_POST['search'];
		}else{
			$args['search'] = '';
		}
	
		$q->set( 'order', $args['order'] );	
		$q->set( 'orderby', $args['orderby'] );
		$q->set( 'meta_key', $args['meta_key'] );
		$q->set( 'product_cat', $args['cat'] );
		$q->set( 's', $args['search'] );	
		
		// Customize Limit from Options
		if( $uncommons['opt-shop-limit'] && $uncommons['opt-shop-limit'] != '0' ){
			$q->set( 'posts_per_page', $uncommons['opt-shop-limit'] );
		}
		
	}
	
}
