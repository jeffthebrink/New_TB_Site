<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     4.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php 
if(!is_product_category()){
?>

<section class="module-small">
    <div class="container">
                        
    <form class="row" method="post">
    
    	<div class="col-sm-4 m-b-sm-20">
        
            <select name="orderby" class="orderby form-control">
            	
                <option value="menu_order" <?php if( isset($_POST['orderby']) && $_POST['orderby'] == 'menu_order' ){ echo 'selected="selected"'; } ?>><?php _e('Default sorting', UN); ?></option>
                <option value="date" <?php if( isset($_POST['orderby']) && $_POST['orderby'] == 'date' ){ echo 'selected="selected"'; } ?>><?php _e('Sort by newness', UN); ?></option>
                <option value="price" <?php if( isset($_POST['orderby']) && $_POST['orderby'] == 'price' ){ echo 'selected="selected"'; } ?>><?php _e('Sort by price: low to high', UN); ?></option>
                <option value="price-desc" <?php if( isset($_POST['orderby']) && $_POST['orderby'] == 'price-desc' ){ echo 'selected="selected"'; } ?>><?php _e('Sort by price: high to low', UN); ?></option>
                <option value="title" <?php if( isset($_POST['orderby']) && $_POST['orderby'] == 'title' ){ echo 'selected="selected"'; } ?>><?php _e('Sort by title', UN); ?></option>
                <option value="rand" <?php if( isset($_POST['orderby']) && $_POST['orderby'] == 'rand' ){ echo 'selected="selected"'; } ?>><?php _e('Random Sorting', UN); ?></option>
    
            </select>
            
        </div>
        
        <div class="col-sm-3 m-b-sm-20">
            <select name="product_category" class="form-control">
                <option value="All">All</option>
                <?php 
				// Get Product Category
				$cats = un_get_terms_array('product_cat');
				
				foreach( $cats as $cat ){
					
					if( isset($_POST['product_category']) && $_POST['product_category'] == $cat['slug'] ){
						echo '<option value="'.$cat['slug'].'" selected="select">'.$cat['name'].'</option>';
					}else{
						echo '<option value="'.$cat['slug'].'">'.$cat['name'].'</option>';
					}
					
				}
				?>
            </select>
        </div>
        
        <div class="col-sm-3 m-b-sm-20">
        	<input type="search" name="search" class="form-control" value="<?php if( isset($_POST['search']) && !empty($_POST['search']) ){ echo $_POST['search']; } ?>" placeholder="Search..." />
        </div>
        
        <div class="col-sm-2 m-b-sm-20">
        	<button type="submit" class="btn btn-block btn-round btn-g"><?php _e('Apply', UN); ?></button>
        </div>
        
    </form> 
    
    </div>
</section>

<hr class="divider"><!-- DIVIDER -->

<?php 
}
?>
