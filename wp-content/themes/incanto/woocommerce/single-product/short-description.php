<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>
<div itemprop="description">
	<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
</div> 

<ul class="list-unstyled">

	<?php
    
    // List of Attribures
    foreach( wc_get_attribute_taxonomies() as $attr ){
        
        $tax = 'pa_'.$attr->attribute_name;
		
        if( $attr->attribute_label ){
            $attr_name = $attr->attribute_label.': ';
        }else{
            $attr_name = $attr->attribute_name.': ';
        }
		
		$attr_values = un_get_post_terms_list( get_the_ID(), $tax, $value='name', $sep=', ' );
		
		if($attr_values){
        	echo '<li><strong>'.$attr_name.'</strong>'.$attr_values.'</li>';
		}
        
    }
    
    ?>

</ul>
