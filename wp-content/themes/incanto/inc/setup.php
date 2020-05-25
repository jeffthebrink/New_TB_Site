<?php
/*
Description: Theme Setup
Theme: Incanto
*/

// GLOBAL THEME SETUP
add_action( 'init', 'un_theme_setup' );

function un_theme_setup() {
	
	// Options
	global $uncommons;


	// Content Width
	if ( ! isset( $content_width ) ) {
		$content_width = 1280;
	}
	
		
	// Feed Links
	add_theme_support( 'automatic-feed-links' );
	
	
	// Post Thumbnails
	add_theme_support( 'post-thumbnails', array( 'post', 'un-portfolio', 'product' ) );
	
	
	// Post Formats
	// the theme has only the standard format
	
	
	// HTML5 
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'widgets' ) );
	
	
	// Custom Image Sizes
	// Live Feature (AQ_RESIZER)
	
	
	// Woocommerce Support
	add_theme_support( 'woocommerce' );
	
	
	// Shortcode Support
	add_filter('widget_text', 'do_shortcode');	
	
	
	// Standard Sidebars (Blog, Footer 1-4)	
	$un_blog_sidebar = array(
	'name'          => __( 'Blog', UN ),
	'id'            => 'un-blog-sidebar',
	'before_widget' => '<div class="widget">',
	'after_widget'  => '</div>', 
	'before_title'  =>  '<h5 class="widget-title font-alt">',
    'after_title'   =>  '</h5>',
	);
	
	$un_page_sidebar = array(
	'name'          => __( 'Page', UN ),
	'id'            => 'un-page-sidebar',
	'before_widget' => '<div class="widget">',
	'after_widget'  => '</div>', 
	'before_title'  =>  '<h5 class="widget-title font-alt">',
    'after_title'   =>  '</h5>',
	); 
	
	$un_foot1_sidebar = array(
	'name'          => __( 'Footer 1', UN ),
	'id'            => 'un-foot1-sidebar',
	'before_widget' => '',
	'after_widget'  => '<div class="separator"></div>',
	'before_title'  =>  '<h5 class="font-alt m-t-0 m-b-20">',
    'after_title'   =>  '</h5>',
	); 
	
	$un_foot2_sidebar = array(
	'name'          => __( 'Footer 2', UN ),
	'id'            => 'un-foot2-sidebar',
	'before_widget' => '',
	'after_widget'  => '<div class="separator"></div>',
	'before_title'  =>  '<h5 class="font-alt m-t-0 m-b-20">',
    'after_title'   =>  '</h5>',
	); 
	
	$un_foot3_sidebar = array(
	'name'          => __( 'Footer 3', UN ),
	'id'            => 'un-foot3-sidebar',
	'before_widget' => '',
	'after_widget'  => '<div class="separator"></div>',
	'before_title'  =>  '<h5 class="font-alt m-t-0 m-b-20">',
    'after_title'   =>  '</h5>',
	); 
	
	$un_foot4_sidebar = array(
	'name'          => __( 'Footer 4', UN ),
	'id'            => 'un-foot4-sidebar',
	'before_widget' => '',
	'after_widget'  => '<div class="separator"></div>',
	'before_title'  =>  '<h5 class="font-alt m-t-0 m-b-20">',
    'after_title'   =>  '</h5>',
	); 
	
	register_sidebar( $un_blog_sidebar );
	register_sidebar( $un_page_sidebar );
	
	// Check Footer Options
	
	if( isset($uncommons['opt-footer-widgets']) && $uncommons['opt-footer-widgets'] == '1' ){
		register_sidebar( $un_foot1_sidebar );
		register_sidebar( $un_foot2_sidebar );
		register_sidebar( $un_foot3_sidebar );
		register_sidebar( $un_foot4_sidebar );
	}
	
	
	// The Excerpt Lenght
	add_filter('excerpt_length', 'un_excerpt_length');
	
	function un_excerpt_length($length) {
		
		global $uncommons;
		
		if( isset($uncommons['opt-adv-exc-lenght']) && !empty($uncommons['opt-adv-exc-lenght']) ){
    		return $uncommons['opt-adv-exc-lenght'];
		}else{
			return 28;
		}
		
	}

	
	// Loading Feature
	if( isset($uncommons['opt-adv-page-loading']) ){
		$page_loader = $uncommons['opt-adv-page-loading'];
	}else{
		$page_loader = '';
	}
	
	if( $page_loader != '1' ){
		
		// Add "nopreload" Class to Body
		add_filter( 'body_class', 'un_no_preload' );
		
		function un_no_preload( $classes ) {
			$classes[] = 'nopreload';
			return $classes;
		}
		
	}
	
	
	// User Profile Socials
	add_filter('user_contactmethods', 'un_user_profile_socials');
	
	function un_user_profile_socials($profile_fields) {
	
		// Add new fields
		$profile_fields['twitter'] = __('Twitter URL', UN);
		$profile_fields['facebook'] = __('Facebook URL', UN);
		$profile_fields['dribbble'] = __('Dribbble URL', UN);
		$profile_fields['pinterest'] = __('Pinterest URL', UN);
		$profile_fields['behance'] = __('Behance URL', UN);
	
		return $profile_fields;
		
	}

}