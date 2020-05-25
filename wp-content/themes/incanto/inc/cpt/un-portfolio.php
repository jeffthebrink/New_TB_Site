<?php
/*
Description: Portfolio CPT
Theme: Incanto
*/
// alessio

// CPT Registration
add_action( 'init', 'un_portfolio_registration' );

function un_portfolio_registration() {

	$labels = array(
		'name'               => __('Projects', UN),
		'singular_name'      => __('Project', UN),
		'add_new'            => __('Add New', UN),
		'add_new_item'       => __('Add New Project', UN),
		'edit_item'          => __('Edit Project', UN),
		'new_item'           => __('New Project', UN),
		'all_items'          => __('All Projects', UN),
		'view_item'          => __('View Project', UN),
		'search_items'       => __('Search Projects', UN),
		'not_found'          => __('No project found', UN),
		'not_found_in_trash' => __('No project found in Trash', UN),
		'parent_item_colon'  => '',
		'menu_name'          => __('Portfolio', UN)
	  );
	
	  $args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'un-portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'thumbnail' ) 
	  );
	
	  register_post_type( 'un-portfolio', $args ); 

}


// CPT Custom messages
add_filter( 'post_updated_messages', 'un_portfolio_custom_messages' );

function un_portfolio_custom_messages( $messages ) {
	
  global $post, $post_ID;

  $messages['un-portfolio'] = array(
    0 => '',
    1 => sprintf( __('Project updated. <a href="%s">View project</a>', UN), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.', UN),
    3 => __('Custom field deleted.', UN),
    4 => __('Project updated.', UN),
    5 => isset($_GET['revision']) ? __('Project restored to revision from %s', UN) : false,
    6 => __('Project published.', UN),
    7 => __('Project saved.', UN),
    8 => __('Project submitted.', UN),
    9 => __('Project scheduled.', UN),
  );

  return $messages;
  
} 