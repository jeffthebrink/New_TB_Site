<?php
/*
Description: Menus Setup
Theme: Incanto
*/


// Regiter menu locations
register_nav_menu( 'mainmenu', 'Main Menu' );


// Main menu
function un_main_menu() {

	$args = array (
		'theme_location'  => 'mainmenu',
		'menu_id'         => 'main-menu',
		'echo'            => true,
		'items_wrap'      => '<ul id="%1$s" class="nav navbar-nav navbar-right">%3$s</ul>',
		'fallback_cb'     => 'un_nav_fallback',
		'depth'           => 0,
		'walker'        => new un_walker_nav_menu,
	);

	wp_nav_menu( $args ); 

}


// Alert for menu location empty
function un_nav_fallback() {
	
	echo '<a class="no-menu" href="'.admin_url( 'nav-menus.php?action=edit&menu=0' ).'">'.__('Add a Menu', UN).'</a>';
	
}


// Custom Menu Walker
class un_walker_nav_menu extends Walker_Nav_Menu {
  
// add classes to ul sub-menus
function start_lvl( &$output, $depth = 0, $args = array() ) {
   
    $classes = array('dropdown-menu');
    $class_names = implode( ' ', $classes );
  
    // build html
    $output .= "\n" . '<ul class="' . esc_attr($class_names) . '" role="menu">' . "\n";
}
  
// add main/sub classes to li's and links
 function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
	 
	global $wp_query;
    $classes = $item->classes;
	
    // children class	
	if( in_array('menu-item-has-children', $classes) ) {
		$li_classes = 'dropdown';		
	}else{
		$li_classes = '';	
	}
	
	// active class
	if( in_array('current-menu-item', $classes) || in_array('current-menu-ancestor', $classes) ){
		$li_classes .= ' active-menu';	
	}

	
    $output .= '<li id="nav-menu-item-'. $item->ID . '" class="'.esc_attr($li_classes).'">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
	if( in_array('menu-item-has-children', $classes) ) {
		$attributes .= ' data-toggle="dropdown"';
    	$attributes .= ' class="dropdown-toggle"';		
	}	
  
    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
  
    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}

} // End Custom Menu Walker


// Add the right Icon to the end of main menu
add_filter('wp_nav_menu_items','un_mainmenu_final_icon', 10, 2);

function un_mainmenu_final_icon( $items, $args ) {
		
	if( $args->theme_location == 'mainmenu' ){
		
		if( un_is_woocommerce() ){ 
				
			global $woocommerce;
			$viewing_cart = __('View your shopping cart', UN);
			$cart_url = $woocommerce->cart->get_cart_url();
		
			$cart_icon = '<li><a href="'. esc_url($cart_url) .'" title="'. $viewing_cart .'">';		
			$cart_icon .= '<i class="fa fa-shopping-cart"></i> ';
			$cart_icon .= '</a></li>';
			
			return $items . $cart_icon;
		
		}else{
			
			global $uncommons;
			
			if($uncommons['opt-search-icon']){
				return $items . '
				<li class="dropdown">
					<a href="" class="dropdown-toggle search-dropdown" data-toggle="dropdown"><i class="fa fa-search"></i></a> 
					<ul class="dropdown-menu" role="menu">
						<li>
							<div class="dropdown-search">
								<form role="form" method="get" action="'.site_url().'">
									<input type="text" name="s" class="form-control" placeholder="'.__('Search...', UN).'"> 
									<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
								</form>
							</div>
						</li>
					</ul>
				</li>';	
			}
								
		}
		
	}

    return $items;
}
