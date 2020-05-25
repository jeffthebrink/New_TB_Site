<?php
/*
Description: Theme Options
Theme: Incanto
*/

// Check if Redux exixts
if ( !class_exists( 'Redux' ) ) {
	return;
}


//******************//
// OPTIONS ARUMENTS //
//******************//

$un_opt_args = array(

	// Options Name
	'opt_name' => UN,
	
	// Display
	'display_name' => 'Incanto',
	'admin_bar' => true,
	'admin_bar_icon' => 'dashicons-screenoptions', 
	'allow_sub_menu' => true,
	'display_version' => false,
	'hide_reset' => true,
	'menu_type' => 'menu',
	'menu_title' => 'Incanto',
	'menu_icon' => 'dashicons-screenoptions',
	'page_icon' => 'dashicons-screenoptions',
	'page_slug' => 'incanto_options',
	'page_title' => 'Incanto Options',
	
	// Features
	'customizer' => false,
	'default_show' => true,
	'default_mark' => '*',
	'show_import_export' => true,
	'class' => 'un-redux',
	'update_notice' => false,
	'disable_tracking' => true,
	'dev_mode' => false,
	
	// Footer Infos
	'footer_text' => __('<p>Have you found a <b>issue</b> or simply need <b>support</b>? Open a <b>ticket</b> on <a href="http://support.uncommons.pro" target="_blank">http://support.uncommons.pro</a></p>', UN),
	'share_icons' => array(
		array(
			'url'   => 'http://themeforest.net/user/unCommons/portfolio/',
			'title' => 'Our Portfolio',
			'icon'  => 'el el-icon-briefcase'
		),
		array(
			'url'   => 'http://support.uncommons.pro/',
			'title' => 'Ask Support',
			'icon'  => 'el el-icon-heart'
		),
		array(
			'url'   => 'http://www.uncommons.pro/',
			'title' => 'Discover the unCommons\'s Laborator',
			'icon'  => 'el el-icon-star'
		),
		array(
			'url'   => 'https://twitter.com/unCommonsTeam',
			'title' => 'Follow us on Twitter',
			'icon'  => 'el el-icon-twitter'
		),
		array(
			'url'   => 'https://www.facebook.com/unCommons',
			'title' => 'Follow us on Facebook',
			'icon'  => 'el el-icon-facebook'
		),
		array(
			'url'   => 'https://www.behance.net/unCommons',
			'title' => 'Follow us on Behance',
			'icon'  => 'el el-icon-behance'
		),			
	),
	
);

// Set Arguments
Redux::setArgs( UN, $un_opt_args );



//******************//
// OPTIONS SECTIONS //
//******************//

// HELP
$help_section = array(
	'title'  => __('Help', UN),
	'id'     => 'help',
	'desc'   => '',
	'icon'   => 'el el-magic',
	'fields' => array(
		
		// HTML Description
		array(
			'id'       => 'opt-help-info',
			'type'     => 'raw',
			'content'  => __('
			<h2>Got you a problem using the theme?</h2>
			<h4><em>Don\'t worry! Here there\'s all you need.</em></h4>
			<br>
			<h3>1. Try to follow our <a href="http://demo.uncommons.pro/themes/wp/incanto/docs/" target="_blank">Guide</a></h3>
			<br>
			<h3>2. Ask our help <a href="http://support.uncommons.pro" target="_blank" class="un-options-button">opening a ticket</a>!</h3>
			<br>
			<h3>3. Don\'t forgive to register your license and your domain on <a href="http://license.uncommons.pro?domain='.urlencode(esc_url(get_site_url())).'" target="_blank" class="un-options-button">license.uncommons.pro</a> to unlock your theme!</h3>', UN),
		),  	
	),
);

Redux::setSection(UN, $help_section);

// GENERAL SETTINGS
$general_settings_section = array(
	'title'  => __('General Settings', UN),
	'id'     => 'general_settings',
	'icon'   => 'el el-adjust-alt',
	'fields' => array(
		
		// Dark Logo	
		array(
			'id'       => 'opt-logo-dark',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('Dark Logo', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/site-logo.png',
			),
		),
		
		// Light Logo	
		array(
			'id'       => 'opt-logo-light',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('Light Logo', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/site-logo-light.png',
			),
		),
		
		// Logos Dimension
		array(
			'id'       => 'opt-logo-width',
			'type'     => 'dimensions',
			'height'   => false,
			'units'    => array('em','px','%'),
			'title'    => __('Logos width', UN),
			'subtitle' => __('You can change the width of your logos and the height will be proportional', UN),
			'desc'     => __('Pay Attention: if you have a vertical logo or you set a great width the menu bar could be enlarged.', UN),
			'output'   => array('.dark-logo', '.light-logo'),
			'default'  => array(
				'width'   => '200', 
				'units'   => 'px',
			),
		),
		
		// Standard Favicon	
		array(
			'id'       => 'opt-favicon',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('Standard Favicon', UN),
			'subtitle' => __('For the best result use a 16x16px PNG image', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/favicon.png',
			),
		),
		
		// Apple Touch Icon (S)	
		array(
			'id'       => 'opt-apple-touch-s',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('Apple Touch Icon (Small)', UN),
			'subtitle' => __('For the best result use a 57x57px PNG image', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/apple-touch-icon.png',
			),
		),
		
		// Apple Touch Icon (M)	
		array(
			'id'       => 'opt-apple-touch-m',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('Apple Touch Icon (Medium)', UN),
			'subtitle' => __('For the best result use a 72x72px PNG image', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/apple-touch-icon-72x72.png',
			),
		),
		
		// Apple Touch Icon (L)	
		array(
			'id'       => 'opt-apple-touch-l',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('Apple Touch Icon (Large)', UN),
			'subtitle' => __('For the best result use a 114x114px PNG image', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/apple-touch-icon-114x114.png',
			),
		),	
	),
);

Redux::setSection(UN, $general_settings_section);


// STYLING
$general_settings_section = array(
	'title'  => __('Styling', UN),
	'id'     => 'styling',
	'icon'   => 'el el-brush',
	'fields' => array(
		
		// Primary Font
		array(
			'id'       => 'opt-primary-font',
			'type'     => 'typography', 
			'title'    => __('Primary Font', UN),
			'google'      => true, 
			'font-style'  => false,
			'font-weight'  => false,
			'font-size'  => false,
			'subsets'  => false,
			'line-height'  => false,
			'word-spacing'  => false,
			'letter-spacing'  => false,
			'text-align'  => false,
			'text-transform'  => false,
			'color'  => false,
			'all_styles'  => true,			
			'default'     => array(
				'font-family' => 'Lato', 
				'google'      => true,
			),
			'output'   => array('body, .font-alt'),
		), 
		
		// Secondary Font
		array(
			'id'       => 'opt-secondary-font',
			'type'     => 'typography', 
			'title'    => __('Secondary Font', UN),
			'google'      => true, 
			'font-style'  => false,
			'font-weight'  => false,
			'font-size'  => false,
			'subsets'  => false,
			'line-height'  => false,
			'word-spacing'  => false,
			'letter-spacing'  => false,
			'text-align'  => false,
			'text-transform'  => false,
			'color'  => false,	
			'all_styles'  => true,			
			'default'     => array(
				'font-family' => 'Libre Baskerville', 
				'google'      => true,
			),
			'output'      => array('.font-serif'),
		),
		
		// BODY
		array(
			'id'       => 'opt-body',
			'type'     => 'color',
			'title'    => __('Body', UN), 
			'default'  => '#666666',
			'validate' => 'color',
			'transparent' => false,
			'output'      => array('body'),
		),
		
		// LINKS
		array(
			'id'       => 'opt-links',
			'type'     => 'link_color',
			'title'    => __('Links', UN), 
			'default'  => array(
				'regular'  => '#111111',
				'hover'    => '#222222',
				'active'   => '#111111',
				'visited'  => '#111111', 
			),
			'output'      => array('a'),
		),
		
		// H1
		array(
			'id'       => 'opt-h1',
			'type'     => 'typography', 
			'title'    => __('Heading 1', UN),
			'google'      => true, 
			'font-style'  => true,
			'font-weight'  => true,
			'font-size'  => true,
			'subsets'  => false,
			'line-height'  => true,
			'word-spacing'  => true,
			'letter-spacing'  => true,
			'text-align'  => false,
			'text-transform'  => true,
			'color'  => true,	
			'all_styles'  => true,			
			'default'     => array(
				'color'       => '#111', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '28px', 
				'line-height' => '40px', 
				'word-spacing' => '0',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'output' => array('h1'),
			
		),
		
		// H2
		array(
			'id'       => 'opt-h2',
			'type'     => 'typography', 
			'title'    => __('Heading 2', UN),
			'google'      => true, 
			'font-style'  => true,
			'font-weight'  => true,
			'font-size'  => true,
			'subsets'  => false,
			'line-height'  => true,
			'word-spacing'  => true,
			'letter-spacing'  => true,
			'text-align'  => false,
			'text-transform'  => true,
			'color'  => true,	
			'all_styles'  => true,			
			'default'     => array(
				'color'       => '#111', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '24px', 
				'line-height' => '34px', 
				'word-spacing' => '0',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'output' => array('h2'),
		),
		
		// H3
		array(
			'id'       => 'opt-h3',
			'type'     => 'typography', 
			'title'    => __('Heading 3', UN),
			'google'      => true, 
			'font-style'  => true,
			'font-weight'  => true,
			'font-size'  => true,
			'subsets'  => false,
			'line-height'  => true,
			'word-spacing'  => true,
			'letter-spacing'  => true,
			'text-align'  => false,
			'text-transform'  => true,
			'color'  => true,	
			'all_styles'  => true,			
			'default'     => array(
				'color'       => '#111', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '18px', 
				'line-height' => '25px', 
				'word-spacing' => '0',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'output' => array('h3'),
		),
		
		// H4
		array(
			'id'       => 'opt-h4',
			'type'     => 'typography', 
			'title'    => __('Heading 4', UN),
			'google'      => true, 
			'font-style'  => true,
			'font-weight'  => true,
			'font-size'  => true,
			'subsets'  => false,
			'line-height'  => true,
			'word-spacing'  => true,
			'letter-spacing'  => true,
			'text-align'  => false,
			'text-transform'  => true,
			'color'  => true,	
			'all_styles'  => true,			
			'default'     => array(
				'color'       => '#111', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '16px', 
				'line-height' => '22px', 
				'word-spacing' => '0',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'output' => array('h4'),
		),
		
		// H5
		array(
			'id'       => 'opt-h5',
			'type'     => 'typography', 
			'title'    => __('Heading 5', UN),
			'google'      => true, 
			'font-style'  => true,
			'font-weight'  => true,
			'font-size'  => true,
			'subsets'  => false,
			'line-height'  => true,
			'word-spacing'  => true,
			'letter-spacing'  => true,
			'text-align'  => false,
			'text-transform'  => true,
			'color'  => true,	
			'all_styles'  => true,			
			'default'     => array(
				'color'       => '#111', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '14px', 
				'line-height' => '20px', 
				'word-spacing' => '0',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'output' => array('h5'),
		),
		
		// H6
		array(
			'id'       => 'opt-h6',
			'type'     => 'typography', 
			'title'    => __('Heading 6', UN),
			'google'      => true, 
			'font-style'  => true,
			'font-weight'  => true,
			'font-size'  => true,
			'subsets'  => false,
			'line-height'  => true,
			'word-spacing'  => true,
			'letter-spacing'  => true,
			'text-align'  => false,
			'text-transform'  => true,
			'color'  => true,	
			'all_styles'  => true,			
			'default'     => array(
				'color'       => '#111', 
				'font-style'  => '400', 
				'font-family' => 'Lato', 
				'google'      => true,
				'font-size'   => '12px', 
				'line-height' => '17px', 
				'word-spacing' => '0',
				'letter-spacing' => '0',
				'text-transform' => 'none',
			),
			'output' => array('h6'),
		),
	),
);

Redux::setSection(UN, $general_settings_section);


// HEADER
$header_section = array(
	'title'  => __('Header', UN),
	'id'     => 'header',
	'icon'   => 'el el-cog',
	'fields' => array(
		
		// MENU //
		array(
		   'id' => 'menu-start',
		   'type' => 'section',
		   'title' => __('Menu Options', UN),
		   'indent' => true 
		),
		
			// Search Icon
			array(
				'id'       => 'opt-search-icon',
				'type'     => 'switch', 
				'title'    => __('Search Icon', UN),
				'default'  => true,
			),
		
		array(
		   'id' => 'menu-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
		
		// STANDARD PAGE INTRO //
		array(
		   'id' => 'standard-page-start',
		   'type' => 'section',
		   'title' => __('Standard Page Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the default page template if you don\'t specify other options into the page', UN),
		   'indent' => true 
		),
			// Image
			array(
				'id'       => 'opt-standard-page-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-standard-page-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-standard-page-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-standard-page-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'standard-page-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
		
		// BLOG PAGE INTRO //
		array(
		   'id' => 'blog-page-start',
		   'type' => 'section',
		   'title' => __('Blog Page Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the blog page template if you don\'t specify other options into the page', UN),
		   'indent' => true 
		),
			// Image
			array(
				'id'       => 'opt-blog-page-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-blog-page-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-blog-page-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-blog-page-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'blog-page-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
		
		// SIMPLE POST INTRO //
		array(
		   'id' => 'simple-post-start',
		   'type' => 'section',
		   'title' => __('Simple Post Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the post', UN),
		   'indent' => true 
		),
			// Image
			array(
				'id'       => 'opt-simple-post-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-simple-post-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-simple-post-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-simple-post-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'simple-post-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
		
		// PORTFOLIO INTRO //
		array(
		   'id' => 'portfolio-page-start',
		   'type' => 'section',
		   'title' => __('Porfolio Page Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the portfolio page template if you don\'t specify other options into the page', UN),
		   'indent' => true 
		),
			// Image
			array(
				'id'       => 'opt-portfolio-page-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-portfolio-page-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-portfolio-page-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-portfolio-page-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'portfolio-page-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
		
		// SIMPLE PROJECT INTRO //
		array(
		   'id' => 'simple-project-start',
		   'type' => 'section',
		   'title' => __('Simple Project Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the project if you enable the intro header feature in the project', UN),
		   'indent' => true,
		),
			// Image
			array(
				'id'       => 'opt-simple-project-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-simple-project-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-simple-project-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-simple-project-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'simple-project-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
		
		// ARCHIVE PAGE INTRO //
		array(
		   'id' => 'archive-page-start',
		   'type' => 'section',
		   'title' => __('Archive/Category Page Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the Archive/Category page', UN),
		   'indent' => true 
		),
			// Image
			array(
				'id'       => 'opt-archive-page-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-archive-page-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to display the archive title', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-archive-page-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-archive-page-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'archive-page-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
				
		// SEARCH PAGE INTRO //
		array(
		   'id' => 'search-page-start',
		   'type' => 'section',
		   'title' => __('Search Page Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the Search page', UN),
		   'indent' => true 
		),
			// Image
			array(
				'id'       => 'opt-search-page-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-search-page-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-search-page-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to display the search Key', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-search-page-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'search-page-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
				
		// 404 PAGE INTRO //
		array(
		   'id' => 'error-page-start',
		   'type' => 'section',
		   'title' => __('404/Error Page Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the 404/Error page', UN),
		   'indent' => true 
		),
			// Image
			array(
				'id'       => 'opt-error-page-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-error-page-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-error-page-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-error-page-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'error-page-end',
		   'type' => 'section',
		   'indent' => false 
		),
		
				
		// ATTACHMENT PAGE INTRO //
		array(
		   'id' => 'attachment-page-start',
		   'type' => 'section',
		   'title' => __('Attachment Page Intro', UN),
		   'subtitle' => __('These options will build an Intro section in the Attachment page', UN),
		   'indent' => true 
		),
			// Image
			array(
				'id'       => 'opt-attachment-page-intro-image',
				'type'     => 'media', 
				'title'    => __('BG Image', UN),
				'subtitle' => __('We advice a great jpg image (around 1920px of width)', UN),
				'default'  => array(
					'url'  => UN_THEME_URI.'assets/img/noimage.jpg'
				),
			),
			
			// Title
			array(
				'id'       => 'opt-attachment-page-intro-title',
				'type'     => 'text',
				'title'    => __('Title', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Subtitle
			array(
				'id'       => 'opt-attachment-page-intro-subtitle',
				'type'     => 'text',
				'title'    => __('Subtitle', UN),
				'subtitle' => __('Leave it blank to disable it', UN),
			),
			
			// Overlay
			array(
				'id'       => 'opt-attachment-page-intro-overlay',
				'type'     => 'select', 
				'title'    => __('Overlay', UN),
				'options'  => array(
					''            => __('None', UN),
					'bg-light-90' => __('Light 90%', UN),
					'bg-light-60' => __('Light 60%', UN),
					'bg-light-30' => __('Light 30%', UN),
					'bg-dark-90'  => __('Dark 90%', UN),
					'bg-dark-60'  => __('Dark 60%', UN),
					'bg-dark-30'  => __('Dark 30%', UN),
					'bg-film'     => __('Film', UN),
				),
				'default'  => '',
			),
		
		array(
		   'id' => 'attachment-page-end',
		   'type' => 'section',
		   'indent' => false 
		),
	),
);

Redux::setSection(UN, $header_section);


// FOOTER
$footer_section = array(
	'title'  => __('Footer', UN),
	'id'     => 'footer',
	'icon'   => 'el el-cog',
	'fields' => array(
		
		// Widgets
		array(
			'id'       => 'opt-footer-widgets',
			'type'     => 'switch', 
			'title'    => __('Footer Widgets', UN),
			'default'  => true,
		),
		
		// Footer Logo	
		array(
			'id'       => 'opt-footer-logo',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('Footer Logo', UN),
			'description' => __('Leave it blank to disable the logo', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/site-logo.png',
			),
			'required' => array('opt-footer-widgets', '=','1'),
		),
		
		// Footer Copy
		array(
			'id'               => 'opt-footer-copy',
			'type'             => 'editor',
			'title'            => __('Footer Copy', UN), 
			'default'          => '© '.date('Y').' <a href="'.esc_url(site_url()).'">'.esc_attr(get_bloginfo( 'name' )).'</a>, All Rights Reserved.',
			'args'   => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
	),
);

Redux::setSection(UN, $footer_section);


// HOME
$home_section = array(
	'title'  => __('Homepage', UN),
	'id'     => 'home',
	'icon'   => 'el el-home',
	'fields' => array(
		
		// HTML Description
		array(
			'id'       => 'opt-home-info',
			'type'     => 'raw',
			'content'  => __('
			<h2>Are you searching for the Home Options??</h2>
			<h4><em>With Incanto you can create many different Homepages using the Visual Composer!</em></h4>
			<br>
			<h3>1. Take a look to the Visual Composer <a href="https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=4030510" target="_blank">How To</a></h3>
			<br>
			<h3>2. Try to follow our <a href="http://demo.uncommons.pro/themes/wp/incanto/docs/" target="_blank">Guide</a> (we added many blocks to Visual Composer)</h3>
			<br>
			<h3>3. Now you can <a href="post-new.php?post_type=page" target="_blank">Create a new Page</a> and set it on VC Template</h3>
			<br>
			<h3>4. At the end of this process you only have to set the page as Static Page > Frontpage in the <a href="options-reading.php" target="_blank">WP Reading Options</a></h3>
			<br>
			<h3>5. Still problems? Ask our help <a href="http://support.uncommons.pro" target="_blank" class="un-options-button">opening a ticket</a>!</h3>', UN),
		),  		
	),
);

Redux::setSection(UN, $home_section);


// SHOP
if ( class_exists( 'WooCommerce' ) ) {
	
$shop_section = array(
	'title'  => __('Shop', UN),
	'id'     => 'shop',
	'icon'   => 'el el-shopping-cart',
	'fields' => array(
	
		array(
			'id'       => 'opt-shop-columns',
			'type'     => 'image_select',
			'title'    => __('Shop Page Columns', UN), 
			'options'  => array(
				'2'      => array(
					'alt'   => '2 Columns', 
					'img'   => ReduxFramework::$_url.'assets/img/2-col-portfolio.png'
				),
				'3'      => array(
					'alt'   => '3 Columns', 
					'img'   => ReduxFramework::$_url.'assets/img/3-col-portfolio.png'
				),
				'4'      => array(
					'alt'   => '4 Columns', 
					'img'  => ReduxFramework::$_url.'assets/img/4-col-portfolio.png'
				),
				'6'      => array(
					'alt'   => '6 Columns', 
					'img'   => ReduxFramework::$_url.'assets/img/6-col-portfolio.png'
				),
			),
			'default' => '3'
		),
		
		// Products Limit
		array(
			'id' => 'opt-shop-limit',
			'type' => 'slider',
			'title' => __('Products per Page', UN),
			'subtitle' => __('Leave it to 0 to use the WP Reading Options', UN),
			'default' => 9,
			'min' => 0,
			'step' => 1,
			'max' => 200,
			'display_value' => 'text',
		),		
		
		// Image
		array(
			'id'       => 'opt-shop-head-image',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('Heading BG Image', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/noimage.jpg',
			),
		),
				
		// Title
		array(					
			'id'          => 'opt-shop-head-title',
			'type'        => 'text', 
			'title'       => __('Heading Title', UN),
		),
		
		// Subtitle
		array(					
			'id'          => 'opt-shop-head-subtitle',
			'type'        => 'text', 
			'title'       => __('Heading Subtitle', UN),
		),
		
		// Overlay
		array(
			'id'       => 'opt-shop-head-overlay',
			'type'     => 'select', 
			'title'    => __('Overlay', UN),
			'options'  => array(
				''            => __('None', UN),
				'bg-light-90' => __('Light 90%', UN),
				'bg-light-60' => __('Light 60%', UN),
				'bg-light-30' => __('Light 30%', UN),
				'bg-dark-90'  => __('Dark 90%', UN),
				'bg-dark-60'  => __('Dark 60%', UN),
				'bg-dark-30'  => __('Dark 30%', UN),
				'bg-film'     => __('Film', UN),
			),
			'default'  => '',
		),	
	),
);

Redux::setSection(UN, $shop_section);

}


// ADVANCED
$advanced_section = array(
	'title'  => __('Advanced', UN),
	'id'     => 'advanced',
	'icon'   => 'el el-wrench',
	'fields' => array(
		
		// Page Loading
		array(
			'id'       => 'opt-adv-page-loading',
			'type'     => 'switch', 
			'title'    => __('Page Loading', UN),
			'default'  => true,
		),
		
		// Excerpt Lenght
		array(
			'id'       => 'opt-adv-exc-lenght',
			'type'     => 'slider', 
			'title'    => __('Excerpt Lenght', UN),
			'subtitle' => __('Note: the number refers to the words and not letters.', UN),
			'default' => 28,
			'min' => 1,
			'step' => 1,
			'max' => 1000,
			'display_value' => 'text',
		),
		
		// HIDE unCommons Panel (backend)
		array(
			'id'       => 'opt-adv-unCommons-hide',
			'type'     => 'switch', 
			'title'    => __('Hide unCommons panel', UN),
			'default'  => false,
		),
		
		// 404 Page Content
		array(
			'id'       => 'opt-adv-error-page-content',
			'type'     => 'editor',
			'title'    => __('404/Error Page Content', UN), 
			'subtitle' => __('Customize your 404 page with useful content.', UN),
			'default'  => 'We aoplogize for the inconvenient. Please use the menu to find what you were searching for.',
			'args'     => array(
				'teeny'            => true,
				'textarea_rows'    => 10
			)
		),
		
		// Head Custom Code
		array(
			'id'       => 'opt-adv-custom-head',
			'type'     => 'ace_editor',
			'title'    => __('Head Custom Code', UN),
			'subtitle' => __('Useful for Google Analytics or other scripts and codes.', UN),
			'mode'     => 'html',
			'theme'    => 'chrome',
		),
		
		// Foot Custom Code
		array(
			'id'       => 'opt-adv-custom-foot',
			'type'     => 'ace_editor',
			'title'    => __('Foot Custom Code', UN),
			'subtitle' => __('Useful for foot scripts and codes.', UN),
			'mode'     => 'html',
			'theme'    => 'chrome',
		),
		
		// Custom CSS
		array(
			'id'       => 'opt-adv-custom-css',
			'type'     => 'ace_editor',
			'title'    => __('Custom CSS', UN),
			'subtitle' => __('Useful for your CSS classes or to edit the css style without open files.', UN),
			'mode'     => 'css',
			'theme'    => 'chrome',
		),
	),
);

Redux::setSection(UN, $advanced_section);