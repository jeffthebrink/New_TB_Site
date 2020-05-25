<?php
/*
Description: WP Functions - Theme init
Theme: Incanto
*/

/* *************** */
/*   THEME INIT    */
/* *************** */

// Constants 
define( 'UN_THEME_URI', get_template_directory_uri().'/' );
define( 'UN_THEME_DIR', get_template_directory().'/' );
define( 'UN_THEME_NAME', 'incanto' );
define( 'UN', 'uncommons' );

// Load textdomain 
load_theme_textdomain( UN, UN_THEME_DIR . 'languages' );
	
// Setup
require(UN_THEME_DIR.'inc/setup.php');

// Assets
require(UN_THEME_DIR.'inc/assets.php');
 
// Menus  
require(UN_THEME_DIR.'inc/menus.php');

// Theme Functions
require(UN_THEME_DIR.'inc/aq_resizer.php');
require(UN_THEME_DIR.'inc/functions.php');

// CPTs
require(UN_THEME_DIR.'inc/cpt/un-portfolio.php');
require(UN_THEME_DIR.'inc/cpt/un-portfolio-categories.php');
require(UN_THEME_DIR.'inc/cpt/un-slider.php');

// Plugins
require(UN_THEME_DIR.'inc/plugins.php');  

// Widgets
require(UN_THEME_DIR.'inc/widgets/default-widgets.php');
require(UN_THEME_DIR.'inc/widgets/mega-posts.php');
require(UN_THEME_DIR.'inc/widgets/mega-projects.php');

// Redux Framework
if ( !class_exists( 'ReduxFramework' ) && file_exists( UN_THEME_DIR.'redux/framework.php' ) ) {
	require_once( UN_THEME_DIR.'redux/framework.php' );
}

// Redux Extensions
if( file_exists( UN_THEME_DIR.'inc/redux_ext.php' ) ){
	require_once( UN_THEME_DIR.'inc/redux_ext.php' );
}

// Redux Options
if ( class_exists( 'ReduxFramework' ) && file_exists( UN_THEME_DIR.'inc/options.php' ) ) {
	require_once( UN_THEME_DIR.'inc/options.php' ); 
}

// Redux Metaboxes
if ( class_exists( 'ReduxFramework' ) && file_exists( UN_THEME_DIR.'inc/metaboxes.php' ) ) {
	require_once( UN_THEME_DIR.'inc/metaboxes.php' ); 
}

// Visual Composer init
if ( defined( 'WPB_VC_VERSION' ) ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/setup.php' ); 
}

// WooCommerce Init
if ( class_exists( 'WooCommerce' ) ) {
	require_once( UN_THEME_DIR.'inc/woocommerce.php' ); 
}

// unCommons Panel Init
if( file_exists( UN_THEME_DIR.'inc/un_panel.php' ) ){
	require_once( UN_THEME_DIR.'inc/un_panel.php' ); 
}
