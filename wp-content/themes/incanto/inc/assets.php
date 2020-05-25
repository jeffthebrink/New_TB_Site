<?php
/*
Description: Assets Setup
Theme: Incanto
*/

/* *************** */
/*       CSS       */
/* *************** */


// FRONTEND
add_action( 'wp_enqueue_scripts', 'un_styles' );

function un_styles() {

	// Bootstrap
	wp_enqueue_style( 'un-bootstrap-style',  UN_THEME_URI . 'assets/bootstrap/css/bootstrap.min.css' );
	
	// Plugins
	wp_enqueue_style( 'un-font-awesome-style',  UN_THEME_URI . 'assets/css/font-awesome.css' );
	wp_enqueue_style( 'un-et-line-font',  UN_THEME_URI . 'assets/css/et-line-font.css' );
	wp_enqueue_style( 'un-simpletextrotator',  UN_THEME_URI . 'assets/css/simpletextrotator.css' );
	wp_enqueue_style( 'un-magnific-popup',  UN_THEME_URI . 'assets/css/magnific-popup.css' );
	wp_enqueue_style( 'un-owl-carousel',  UN_THEME_URI . 'assets/css/owl.carousel.css' );
	wp_enqueue_style( 'un-superslides',  UN_THEME_URI . 'assets/css/superslides.css' );
	wp_enqueue_style( 'un-vertical',  UN_THEME_URI . 'assets/css/vertical.css' );
	wp_enqueue_style( 'un-animate',  UN_THEME_URI . 'assets/css/animate.css' );
	
	// Main
	wp_enqueue_style( 'un-main',  UN_THEME_URI . 'assets/css/main.css' );
	
	// Custom CSS Code
	global $uncommons;
	if( isset($uncommons['opt-adv-custom-css']) ){
		$custom_css = un_sanitize( $uncommons['opt-adv-custom-css'] );
		wp_add_inline_style( 'un-main', $custom_css );
	}
	
}

// BACKEND
add_action( 'admin_enqueue_scripts', 'un_backend_styles' );

function un_backend_styles() {
	
	// Backend
	wp_enqueue_style( 'un-et-line-font',  UN_THEME_URI . 'assets/css/et-line-font.css' );
	wp_enqueue_style( 'un-backend-style',  UN_THEME_URI . 'assets/css/backend.css' );
	
}



/* *************** */
/*       JS        */
/* *************** */


// FRONTEND
add_action('wp_enqueue_scripts', 'un_scripts');

function un_scripts() {
	
	// Load WP jQuery if not included
	wp_enqueue_script('jquery'); 
	
	
	// Load WP jQuery UI if not included
	wp_enqueue_script('jquery-ui-core');
	
	
	// Libraries
	wp_enqueue_script( 'un-bootstrap',  UN_THEME_URI . 'assets/bootstrap/js/bootstrap.min.js' );
	wp_enqueue_script( 'un-superslides',  UN_THEME_URI . 'assets/js/jquery.superslides.min.js' );
	wp_enqueue_script( 'un-ytplayer',  UN_THEME_URI . 'assets/js/jquery.mb.YTPlayer.min.js' );
	wp_enqueue_script( 'un-magnific-popup',  UN_THEME_URI . 'assets/js/jquery.magnific-popup.min.js' );
	wp_enqueue_script( 'un-owl-carousel',  UN_THEME_URI . 'assets/js/owl.carousel.min.js' );
	wp_enqueue_script( 'un-simple-text-rotator',  UN_THEME_URI . 'assets/js/jquery.simple-text-rotator.min.js' );
	wp_enqueue_script( 'un-imagesloaded',  UN_THEME_URI . 'assets/js/imagesloaded.pkgd.js' );
	wp_enqueue_script( 'un-isotope',  UN_THEME_URI . 'assets/js/isotope.pkgd.min.js' );
	wp_enqueue_script( 'un-packery',  UN_THEME_URI . 'assets/js/packery-mode.pkgd.min.js' );
	wp_enqueue_script( 'un-appear',  UN_THEME_URI . 'assets/js/appear.js' );
	wp_enqueue_script( 'un-jquery-easing',  UN_THEME_URI . 'assets/js/jquery.easing.1.3.js' );
	wp_enqueue_script( 'un-wow',  UN_THEME_URI . 'assets/js/wow.min.js' );
	wp_enqueue_script( 'un-jqbootstrapvalidation',  UN_THEME_URI . 'assets/js/jqBootstrapValidation.js' );
	wp_enqueue_script( 'un-fitvids',  UN_THEME_URI . 'assets/js/jquery.fitvids.js' );
	wp_enqueue_script( 'un-jquery-parallax',  UN_THEME_URI . 'assets/js/jquery.parallax-1.1.3.js' );
	wp_enqueue_script( 'un-maps-api',  'http://maps.google.com/maps/api/js?sensor=true' );
	
	// Theme Scripts
	wp_enqueue_script( 'un-gmaps',  UN_THEME_URI . 'assets/js/gmaps.js' );
	wp_enqueue_script( 'un-contact',  UN_THEME_URI . 'assets/js/contact.js' );
	wp_enqueue_script( 'un-custom',  UN_THEME_URI . 'assets/js/custom.js' );
	 
}


// BACKEND
add_action( 'admin_enqueue_scripts', 'un_backend_scripts', 1 );

function un_backend_scripts() {
	
	wp_enqueue_script( 'un-backend-script',  UN_THEME_URI . 'assets/js/backend.js', array( 'jquery' ) );
	
}