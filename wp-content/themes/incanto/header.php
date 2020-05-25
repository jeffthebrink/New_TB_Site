<?php
/*
Description: The Header
Theme: Incanto
*/
?>

<?php

//*****************//
// HEADER SETTINGS //
//*****************//

global $uncommons;

// Logos & Icons
$logo_dark = un_set( $uncommons['opt-logo-dark']['url'], UN_THEME_URI.'assets/img/site-logo.png');
$logo_light = un_set( $uncommons['opt-logo-light']['url'], UN_THEME_URI.'assets/img/site-logo-light.png' );
$favicon = un_set( $uncommons['opt-favicon']['url'], UN_THEME_URI.'assets/img/favicon.png' );
$appletouch_s = un_set( $uncommons['opt-apple-touch-s']['url'], UN_THEME_URI.'assets/img/apple-touch-icon.png' );
$appletouch_m = un_set( $uncommons['opt-apple-touch-m']['url'], UN_THEME_URI.'assets/img/apple-touch-icon-72x72.png' );
$appletouch_l = un_set( $uncommons['opt-apple-touch-l']['url'], UN_THEME_URI.'assets/img/apple-touch-icon-114-114.png' );

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php wp_title('', true); ?></title>
    
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
    <!-- Favicons -->
	<link rel="shortcut icon" href="<?php echo esc_url($favicon); ?>">
	<link rel="apple-touch-icon" href="<?php echo esc_url($appletouch_s); ?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($appletouch_m); ?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($appletouch_l); ?>">
    
    <?php 
	if( isset($uncommons['opt-adv-custom-head']) ){
		echo un_sanitize( $uncommons['opt-adv-custom-head'], true );
	} ?>
    
    <?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>

<!-- PRELOADER -->
<div class="page-loader">
    <div class="loader">Loading...</div>
</div>
<!-- /PRELOADER -->

<!-- WRAPPER -->
<div class="wrapper">

	<!-- NAVIGATION -->
    <nav class="navbar navbar-custom navbar-transparent navbar-fixed-top">

        <div class="container">
        
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#custom-collapse"> 
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
        
                <!-- LOGO -->
                <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                    <!-- IMAGE OR SIMPLE TEXT -->
                    <img class="dark-logo" src="<?php echo esc_url($logo_dark); ?>" width="95" alt="">
                    <img class="light-logo" src="<?php echo esc_url($logo_light); ?>" width="95" alt="">
                </a>
            </div>
        
            <div class="collapse navbar-collapse" id="custom-collapse">
        		
            	<?php 
				if( is_page_template( 'page-vc.php' ) && redux_post_meta( UN, get_the_ID(), 'page_vc_onepage' ) == '1' ){	
				
					$data_search = un_set( $uncommons['opt-search-icon'], '0' );
					$data_search_label = __('Search...', UN);
									
					// Onepage Menu
					echo '
					<div id="un-onepage-menu" class="menu-main-container">
						<ul id="main-menu" class="nav navbar-nav navbar-right" data-search="'.$data_search.'" data-search-label="'.$data_search_label.'">			
						</ul>
					</div>';					
				}else{					
					// Main Menu
					un_main_menu(); 					
				}
				?>
                
            </div>
        
        </div>

    </nav>    
    <!-- /NAVIGATION -->
    
