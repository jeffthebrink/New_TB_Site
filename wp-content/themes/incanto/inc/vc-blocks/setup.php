<?php
/*
Description: Visual Composer Setup
Theme: Incanto
*/


// Theme Integration
add_action( 'vc_before_init', 'un_vc_theme_integration' );

function un_vc_theme_integration() {
	
    if( function_exists('vc_set_as_theme') ){ 
		vc_set_as_theme(true); 
	}
	
	if( function_exists('vc_set_shortcodes_templates_dir') ){ 
		vc_set_shortcodes_templates_dir( UN_THEME_DIR . 'inc/vc-blocks/defaults' );
	}
	
}

// Default Post Types for VC
add_action( 'vc_after_init', 'un_vc_default_cpt_support' );

function un_vc_default_cpt_support() {

	$list = array(
		'page',
		'post',
		'un-portfolio',
	);
	vc_set_default_editor_post_types( $list );
	
}


/*************/
/* REMAPPING */
/*************/

// VC ROW
vc_remove_param( 'vc_row', 'parallax' ); 
vc_remove_param( 'vc_row', 'parallax_image' ); 
vc_remove_param( 'vc_row', 'full_width' );
vc_remove_param( 'vc_row', 'content_placement' );
vc_remove_param( 'vc_row', 'video_bg' ); 
vc_remove_param( 'vc_row', 'video_bg_url' );
vc_remove_param( 'vc_row', 'video_bg_parallax' );

$vc_row_attr = array(
	
	// BG Type
	array(
		'type' => 'dropdown',
		'heading' => __( '<h3>Background Source</h3>', UN ),
		'param_name' => 'bg_source',
		'description' => __( 'Select the source for your row\'s Background', UN ),
		'value' => array( __( 'Design Options', UN ) => 'design', __('Parallax Image', UN ) => 'parallax', __( 'Video', UN ) => 'video' ),
		'weight' => 10,
	),
	
	// Parallax Options
	array(
		'type' => 'attach_image',
		'heading' => __( 'Image', UN ),
		'param_name' => 'parallax_image',
		'value' => '',
		'description' => __( 'Select image from media library.', UN ),
		'weight' => 10,
		'dependency' => array(
			'element' => 'bg_source',
			'value' => 'parallax',
		),
	),
	
	// Video Options
	array(
		'type' => 'textfield',
		'heading' => __('Youtube Url/ID', UN),
		'param_name' => 'video_url',	
		'description' => __('You can use the youtube URL or ID of your video', UN),		
		'weight' => 10,
		'dependency' => array(
			'element' => 'bg_source',
			'value' => 'video',
		),	   
	),
	array(
		'type' => 'attach_image',
		'heading' => __( 'Starting Image', UN ),
		'param_name' => 'video_image',
		'value' => '',
		'description' => __( 'Select image from media library.', UN ),
		'weight' => 10,
		'dependency' => array(
			'element' => 'bg_source',
			'value' => 'video',
		),
	),
	array(
		'type' => 'textfield',
		'heading' => __('Starts at second', UN),
		'param_name' => 'starts_at',	
		'description' => __('Use integer numbers for the seconds', UN),	
		'value' => 0,
		'weight' => 10,	
		'dependency' => array(
			'element' => 'bg_source',
			'value' => 'video',
		),	   
	),
	array(
		'type' => 'textfield',
		'heading' => __('Volume', UN),
		'param_name' => 'volume',	
		'description' => __('Use an integer number from 0 to 100', UN),	
		'value' => 0,
		'weight' => 10,	
		'dependency' => array(
			'element' => 'bg_source',
			'value' => 'video',
		),		   
	),
	array(
		'type' => 'checkbox',
		'heading' => __('Loop', UN),
		'param_name' => 'loop',	
		'value' => 'true',
		'description' => __('Repeat you video unlimited times', UN),	
		'weight' => 10,	
		'dependency' => array(
			'element' => 'bg_source',
			'value' => 'video',
		),		   
	),
	
	// SEP 1
	array(
		'type' => '',
		'param_name' => 'sep1',	
		'description' => __('<hr>', UN),	
		'weight' => 10,		   
	),
	// SEP 1
	
	// Text Color	
	array(
		'type' => 'dropdown',
		'heading' => __( '<h3>Text Color</h3>', UN ),
		'param_name' => 'text_color',
		'value' => array( __( 'Dark', UN ) => '',  __('Light', UN ) => 'bg-dark' ),
		'description' => __( 'You could need to change the text color on the base of your background.', UN ),
		'weight' => 9,
	),
	
	// SEP 2
	array(
		'type' => '',
		'param_name' => 'sep2',	
		'description' => __('<hr>', UN),	
		'weight' => 9,		   
	),
	// SEP 2
	
	// Overlay Effect
	array(
		'type' => 'dropdown',
		'heading' => __('<h3>Overlay Effect</h3>', UN),
		'param_name' => 'overlay',
		'description' => __('Add an overlay effect on your row', UN),	
		'value' => array( 
			__('None', UN) => '', 
			__('Light 90%', UN) => 'bg-light-90',
			__('Light 60%', UN) => 'bg-light-60',
			__('Light 30%', UN) => 'bg-light-30',
			__('Dark 90%', UN) => 'bg-dark-90',
			__('Dark 60%', UN) => 'bg-dark-60',
			__('Dark 30%', UN) => 'bg-dark-30',
			__('Film', UN) => 'bg-film',
		),
		'weight' => 8,		   
	),
	
	// SEP 3
	array(
		'type' => '',
		'param_name' => 'sep3',	
		'description' => __('<hr>', UN),	
		'weight' => 8,		   
	),
	// SEP 3	
	
	// Onepage Menu
	array(
		'type' => 'textfield',
		'heading' => __('Onepage Menu', UN),
		'param_name' => 'onepage_menu',	
		'description' => __('Choose a menu label if you want to link this row to a onepage menu button', UN),
		'weight' => 8,	
	),
	
	// Design Options
	array(
		'type' => 'css_editor',
		'heading' => __( '<h3>CSS box</h3>', UN ),
		'param_name' => 'css',
		'group' => __( 'Design Options', UN ),
		'weight' => 7,
	),
	
	array(
		'type' => 'checkbox',
		'heading' => __( '<h3>Full Height</h3>', UN ),
		'param_name' => 'full_height',
		'value' => array( __( 'Enable', UN ) => true ),
		'group' => __( 'Design Options', UN ),
		'weight' => 7,
	),
	
	array(
		'type' => 'checkbox',
		'heading' => __( '<h3>Boxed Container</h3>', UN ),
		'param_name' => 'container',
		'value' => array( __( 'Enable', UN ) => true ),
		'group' => __( 'Design Options', UN ),
		'weight' => 7,
	),
	
	array(
		'type' => 'textfield',
		'heading' => __('Row ID', UN),
		'param_name' => 'el_id',	
		'description' => __('Enter row ID (Note: make sure it is unique and valid according to <a href="http://www.w3schools.com/tags/att_global_id.asp" target="_blank">w3c specification</a>).', UN),	
		'group' => __( 'Design Options', UN ),
		'weight' => 6,	
			   
	),
	
	array(
		'type' => 'textfield',
		'heading' => __('Extra class name', UN),
		'param_name' => 'el_class',	
		'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', UN),	
		'group' => __( 'Design Options', UN ),
		'weight' => 6,		   
	),
	
);

vc_add_params( 'vc_row', $vc_row_attr ); 


// VC COLUMN 
$vc_column_attr = array(
	
	// Text Align
	array(
		'type' => 'dropdown',
		'heading' => __('Text Align', UN),
		'param_name' => 'txt_align',	
		'value' => array( 
			__('Auto', UN) => '', 
			__('Left', UN) => 'text-left', 
			__('Center', UN) => 'text-center',
			__('Right', UN) => 'text-right',  
			__('Justified', UN) => 'text-justify', 
		),	
		'weight' => 10,	   
	),
	
);

vc_add_params( 'vc_column', $vc_column_attr ); 



// VC TEXT
vc_remove_param( 'vc_column_text', 'css' ); 

$vc_column_text_attr = array(
	
	// Title
	array(
		'type' => 'textfield',
		'heading' => __( 'Title', UN ),
		'param_name' => 'title',
		'description' => __( 'Leave it blank to disable it', UN ),
		'weight' => 10,
	),
	
	// Content
	array(
		'type' => 'textarea_html',
		'holder' => 'div',
		'heading' => __( 'Content', UN ),
		'param_name' => 'content',
		'value' => __( '<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>', UN ),
		'weight' => 9,
	),
	
	// Button
	array(
		'type' => 'textfield',
		'heading' => __( 'Button Label', UN ),
		'param_name' => 'btn_label',
		'description' => __( 'Leave it blank to disable it', UN ),
		'weight' => 8,
	),
	
	array(
		'type' => 'textfield',
		'heading' => __( 'Button URL', UN ),
		'param_name' => 'btn_url',
		'description' => __( 'Leave it blank to disable it', UN ),
		'weight' => 8,
	),
	
);

vc_add_params( 'vc_column_text', $vc_column_text_attr ); 


// VC PROGRESS BAR
vc_remove_param( 'vc_progress_bar', 'units' ); 


/***************************/
/* DEFAULT BLOCKS REMOVING */
/***************************/

vc_remove_element( 'vc_separator' );
vc_remove_element( 'vc_text_separator' );
vc_remove_element( 'vc_basic_grid' );
vc_remove_element( 'vc_teaser_grid' );
vc_remove_element( 'vc_toggle' );
vc_remove_element( 'vc_toggle_old' );
vc_remove_element( 'vc_accordion' );
vc_remove_element( 'vc_tabs' );
vc_remove_element( 'vc_tour' );
vc_remove_element( 'vc_gallery' );
vc_remove_element( 'vc_posts_grid' );
vc_remove_element( 'vc_posts_slider' );
vc_remove_element( 'vc_pie' );
vc_remove_element( 'vc_video' );
vc_remove_element( 'vc_wp_search' );
vc_remove_element( 'vc_wp_calendar' );
vc_remove_element( 'vc_wp_categories' );
vc_remove_element( 'vc_images_carousel' );
vc_remove_element( 'vc_widget_sidebar' );
vc_remove_element( 'vc_flickr' );
vc_remove_element( 'vc_media_grid' );
vc_remove_element( 'vc_masonry_grid' );
vc_remove_element( 'vc_masonry_media_grid' );
vc_remove_element( 'vc_button' );
vc_remove_element( 'vc_button2' );
vc_remove_element( 'vc_cta' );
vc_remove_element( 'vc_cta_button' );
vc_remove_element( 'vc_cta_button2' );


/****************/
/* THEME BLOCKS */
/****************/

// Intro Text
if( !class_exists('unHeroHeading') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/hero_heading.php' ); 
}

// Hero Heading Rotator
if( !class_exists('unHeroHeadingRotator') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/hero_heading_r.php' ); 
}

// Slider
if( !class_exists('unSlider') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/slider.php' ); 
}

// Section Heading
if( !class_exists('unSectionHeading') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/section_heading.php' ); 
}

// Separator
if( !class_exists('unSeparator') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/separator.php' ); 
}

// Service
if( !class_exists('unService') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/service.php' ); 
}

// Project Metas
if( !class_exists('unProjectMetas') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/project_metas.php' ); 
}

// Image
if( !class_exists('unImage') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/image.php' ); 
}

// Portfolio Grid
if( !class_exists('unPortfolioGrid') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/portfolio_grid.php' ); 
}

// Testimonials
if( !class_exists('unTestimonials') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/testimonials.php' ); 
}

// Clients
if( !class_exists('unClients') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/clients.php' ); 
}

// Posts Grid
if( !class_exists('unPostsGrid') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/posts_grid.php' ); 
}

// Counter
if( !class_exists('unCounter') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/counter.php' ); 
}

// Team Member
if( !class_exists('unTeamMember') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/team_member.php' ); 
}

// Services Carousel
if( !class_exists('unServicesCarousel') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/services_carousel.php' ); 
}

// Accordion
if( !class_exists('unAccordion') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/accordion.php' ); 
}

// Tabs
if( !class_exists('unTabs') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/tabs.php' ); 
}

// GMAP
if( !class_exists('unGmap') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/gmap.php' ); 
}

// Pricing Table
if( !class_exists('unPricing') ) {
	require_once( UN_THEME_DIR.'inc/vc-blocks/pricing.php' ); 
}			


/***********/
/* HELPERS */
/***********/				
				
// ET-LINE Icons for iconpickers										
add_filter( 'vc_iconpicker-type-etline', 'un_iconpicker_type_etline' );

function un_iconpicker_type_etline( $icons ) {
	$etline_icons = array(
		array( 'icon-mobile' => __( 'mobile', UN ) ),
		array( 'icon-laptop' => __( 'laptop', UN ) ),
		array( 'icon-desktop' => __( 'desktop', UN ) ),
		array( 'icon-tablet' => __( 'tablet', UN ) ),
		array( 'icon-phone' => __( 'phone', UN ) ),
		array( 'icon-document' => __( 'document', UN ) ),
		array( 'icon-documents' => __( 'documents', UN ) ),
		array( 'icon-search' => __( 'search', UN ) ),
		array( 'icon-clipboard' => __( 'clipboard', UN ) ),
		array( 'icon-newspaper' => __( 'newspaper', UN ) ),
		array( 'icon-notebook' => __( 'notebook', UN ) ),
		array( 'icon-book-open' => __( 'book-open', UN ) ),
		array( 'icon-browser' => __( 'browser', UN ) ),
		array( 'icon-calendar' => __( 'calendar', UN ) ),
		array( 'icon-presentation' => __( 'presentation', UN ) ),
		array( 'icon-picture' => __( 'picture', UN ) ),
		array( 'icon-pictures' => __( 'pictures', UN ) ),
		array( 'icon-video' => __( 'video', UN ) ),
		array( 'icon-camera' => __( 'camera', UN ) ),
		array( 'icon-printer' => __( 'printer', UN ) ),
		array( 'icon-toolbox' => __( 'toolbox', UN ) ),
		array( 'icon-briefcase' => __( 'briefcase', UN ) ),
		array( 'icon-wallet' => __( 'wallet', UN ) ),
		array( 'icon-gift' => __( 'gift', UN ) ),
		array( 'icon-bargraph' => __( 'bargraph', UN ) ),
		array( 'icon-grid' => __( 'grid', UN ) ),
		array( 'icon-expand' => __( 'expand', UN ) ),
		array( 'icon-focus' => __( 'focus', UN ) ),
		array( 'icon-edit' => __( 'edit', UN ) ),
		array( 'icon-adjustments' => __( 'adjustments', UN ) ),
		array( 'icon-ribbon' => __( 'ribbon', UN ) ),
		array( 'icon-hourglass' => __( 'hourglass', UN ) ),
		array( 'icon-lock' => __( 'lock', UN ) ),
		array( 'icon-megaphone' => __( 'megaphone', UN ) ),
		array( 'icon-shield' => __( 'shield', UN ) ),
		array( 'icon-trophy' => __( 'trophy', UN ) ),
		array( 'icon-flag' => __( 'flag', UN ) ),
		array( 'icon-map' => __( 'map', UN ) ),
		array( 'icon-puzzle' => __( 'puzzle', UN ) ),
		array( 'icon-basket' => __( 'basket', UN ) ),
		array( 'icon-envelope' => __( 'envelope', UN ) ),
		array( 'icon-streetsign' => __( 'streetsign', UN ) ),
		array( 'icon-telescope' => __( 'telescope', UN ) ),
		array( 'icon-gears' => __( 'gears', UN ) ),
		array( 'icon-key' => __( 'key', UN ) ),
		array( 'icon-paperclip' => __( 'paperclip', UN ) ),
		array( 'icon-attachment' => __( 'attachment', UN ) ),
		array( 'icon-pricetags' => __( 'pricetags', UN ) ),
		array( 'icon-lightbulb' => __( 'lightbulb', UN ) ),
		array( 'icon-layers' => __( 'layers', UN ) ),
		array( 'icon-pencil' => __( 'pencil', UN ) ),
		array( 'icon-tools' => __( 'tools', UN ) ),
		array( 'icon-tools-2' => __( 'tools-2', UN ) ),
		array( 'icon-scissors' => __( 'scissors', UN ) ),
		array( 'icon-paintbrush' => __( 'paintbrush', UN ) ),
		array( 'icon-magnifying-glass' => __( 'magnifying-glass', UN ) ),
		array( 'icon-circle-compass' => __( 'circle-compass', UN ) ),
		array( 'icon-linegraph' => __( 'linegraph', UN ) ),
		array( 'icon-mic' => __( 'mic', UN ) ),
		array( 'icon-strategy' => __( 'strategy', UN ) ),
		array( 'icon-beaker' => __( 'beaker', UN ) ),
		array( 'icon-caution' => __( 'caution', UN ) ),
		array( 'icon-recycle' => __( 'recycle', UN ) ),
		array( 'icon-anchor' => __( 'anchor', UN ) ),
		array( 'icon-profile-male' => __( 'profile-male', UN ) ),
		array( 'icon-profile-female' => __( 'profile-female', UN ) ),
		array( 'icon-bike' => __( 'bike', UN ) ),
		array( 'icon-wine' => __( 'wine', UN ) ),
		array( 'icon-hotairballoon' => __( 'hotairballoon', UN ) ),
		array( 'icon-globe' => __( 'globe', UN ) ),
		array( 'icon-genius' => __( 'genius', UN ) ),
		array( 'icon-map-pin' => __( 'map-pin', UN ) ),
		array( 'icon-dial' => __( 'dial', UN ) ),
		array( 'icon-chat' => __( 'chat', UN ) ),
		array( 'icon-heart' => __( 'heart', UN ) ),
		array( 'icon-cloud' => __( 'cloud', UN ) ),
		array( 'icon-upload' => __( 'upload', UN ) ),
		array( 'icon-download' => __( 'download', UN ) ),
		array( 'icon-target' => __( 'target', UN ) ),
		array( 'icon-hazardous' => __( 'hazardous', UN ) ),
		array( 'icon-piechart' => __( 'piechart', UN ) ),
		array( 'icon-speedometer' => __( 'speedometer', UN ) ),
		array( 'icon-global' => __( 'global', UN ) ),
		array( 'icon-compass' => __( 'compass', UN ) ),
		array( 'icon-lifesaver' => __( 'lifesaver', UN ) ),
		array( 'icon-clock' => __( 'clock', UN ) ),
		array( 'icon-aperture' => __( 'aperture', UN ) ),
		array( 'icon-quote' => __( 'quote', UN ) ),
		array( 'icon-scope' => __( 'scope', UN ) ),
		array( 'icon-alarmclock' => __( 'alarmclock', UN ) ),
		array( 'icon-refresh' => __( 'refresh', UN ) ),
		array( 'icon-happy' => __( 'happy', UN ) ),
		array( 'icon-sad' => __( 'sad', UN ) ),
		array( 'icon-facebook' => __( 'facebook', UN ) ),
		array( 'icon-twitter' => __( 'twitter', UN ) ),
		array( 'icon-googleplus' => __( 'googleplus', UN ) ),
		array( 'icon-rss' => __( 'rss', UN ) ),
		array( 'icon-tumblr' => __( 'tumblr', UN ) ),
		array( 'icon-linkedin' => __( 'linkedin', UN ) ),
		array( 'icon-dribbble' => __( 'dribbble', UN ) ),
	);

	return array_merge( $icons, $etline_icons );
}