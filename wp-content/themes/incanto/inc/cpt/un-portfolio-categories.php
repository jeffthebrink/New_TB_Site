<?php
/*
Description: Portfolio Categories CTAX
Theme: Incanto
*/
// alessio

// Portfolio Taxonomy Registration
add_action( 'init', 'un_portfolio_taxonomy_registration', 0 );

function un_portfolio_taxonomy_registration() {
	
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => __( 'Project Category', UN),
		'singular_name'     => __( 'Category', UN),
		'search_items'      => __( 'Search Categories', UN),
		'all_items'         => __( 'All Categories', UN),
		'parent_item'       => __( 'Parent Category', UN),
		'parent_item_colon' => __( 'Parent Category:', UN),
		'edit_item'         => __( 'Edit Category', UN),
		'update_item'       => __( 'Update Category', UN),
		'add_new_item'      => __( 'Add New Category', UN),
		'new_item_name'     => __( 'New Category Name', UN),
		'menu_name'         => __( 'Categories', UN),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'un-portfolio-categories' ),
	);

	register_taxonomy( 'un-portfolio-categories', array( 'un-portfolio' ), $args );
	
}