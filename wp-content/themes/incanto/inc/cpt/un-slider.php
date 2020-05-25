<?php
/*
Description: Slider CPT
Theme: Incanto
*/
// alessio

// CPT Registration
add_action( 'init', 'un_slider_registration' );

function un_slider_registration() {

	$labels = array(
		'name'               => __('Sliders', UN),
		'singular_name'      => __('Slider', UN),
		'add_new'            => __('Add New', UN),
		'add_new_item'       => __('Add New Slider', UN),
		'edit_item'          => __('Edit Slider', UN),
		'new_item'           => __('New Slider', UN),
		'all_items'          => __('All Sliders', UN),
		'view_item'          => __('View Slider', UN),
		'search_items'       => __('Search Sliders', UN),
		'not_found'          => __('No slider found', UN),
		'not_found_in_trash' => __('No slider found in Trash', UN),
		'parent_item_colon'  => '',
		'menu_name'          => __('Sliders', UN)
	  );
	
	  $args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'un-slider' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-images-alt',
		'supports'           => array( 'title' )
	  );
	
	  register_post_type( 'un-slider', $args ); 

}


// CPT custom messages
add_filter( 'post_updated_messages', 'un_slider_custom_messages' );

function un_slider_custom_messages( $messages ) {
	
  global $post, $post_ID;

  $messages['un-slider'] = array(
    0 => '',
    1 => sprintf( __('Slider updated. <a href="%s">View slider</a>', UN), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', UN),
    3 => __('Custom field deleted.', UN),
    4 => __('Slider updated.', UN),
    5 => isset($_GET['revision']) ? __('Slider restored to revision from %s', UN) : false,
    6 => __('Slider published.', UN),
    7 => __('Slider saved.', UN),
    8 => __('Slider submitted.', UN),
    9 => __('Slider scheduled.', UN),
  );

  return $messages;
  
} 