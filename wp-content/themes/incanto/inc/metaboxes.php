<?php
/*
Description: Theme Metaboxes
Theme: Incanto
*/

if ( ! function_exists( 'un_metaboxes' ) ){

function un_metaboxes( $metaboxes ) {

//******************//
//     SETTINGS     //
//******************//		

// SLIDER

// Settings
$slider_settings[] = array(

	'fields' => array(	

		// Slides
		array(					
			'id'          => 'slides',
			'type'        => 'slides',
			'title'       => __('Your Slides', UN),
			'subtitle'    => __('Create unlimited slides with drag and drop sortings.', UN),
			'placeholder' => array(
				'title'		=> __('Slide Title', UN),
				'subtitle'     => __('Slide Subtitle', UN),					
			),
		),
		
	),
);

// Register
$metaboxes[] = array(

	'id' => 'slider_settings',

	'title' => __( 'Slider Settings', UN),

	'post_types' => array( 'un-slider' ),

	'position' => 'normal',

	'priority' => 'high',

	'sidebar' => false,

	'sections' => $slider_settings

);

// SLIDER END



// PROJECT SIDE

// Settings
$project_side_settings[] = array(

	'fields' => array(	
		
		// Title
		array(					
			'id'          => 'thumb_shape',
			'type'        => 'select', 
			'title'       => __('Shape', UN),
			'subtitle'    => __('Used in the Pakery view.', UN),
			'options'  => array(
				'square' => __('Small Square', UN),
				'wide-tall' => __('Big Square', UN),
				'wide' => __('Landscape', UN),
				'tall' => __('Portrait', UN),
			),
			'default'  => 'square',
		),
	)
);

// Register
$metaboxes[] = array(

	'id' => 'project_side_settings',

	'title' => __( 'Thumbnail Shape', UN),

	'post_types' => array( 'un-portfolio' ),

	'position' => 'side',

	'priority' => 'low',

	'sections' => $project_side_settings

);

// PROJECT SIDE END


// PROJECT BOTTOM

// Settings
$project_bot_settings[] = array(

	'fields' => array(	
	
		// Enable Custom Heading
		array(
			'id'       => 'project_head_enable',
			'type'     => 'button_set',
			'title'    => __('Project Heading', UN),
			'options' => array(
				'global' => __('Global Options', UN), 
				'custom' => __('Custom', UN), 
				'off'    => __('Off', UN),
			 ), 
			'default' => 'off'
		),
		
		// Image
		array(
			'id'       => 'project_head_image',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('BG Image', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/noimage.jpg',
			),
			'required'    => array('project_head_enable', '=', 'custom'),
		),
				
		// Title
		array(					
			'id'          => 'project_head_title',
			'type'        => 'text', 
			'title'       => __('Heading Title', UN),
			'required'    => array('project_head_enable', '=', 'custom'),
		),
		
		// Subtitle
		array(					
			'id'          => 'project_head_subtitle',
			'type'        => 'text', 
			'title'       => __('Heading Subtitle', UN),
			'required'    => array('project_head_enable', '=', 'custom'),
		),
		
		// Overlay
		array(
			'id'       => 'project_head_overlay',
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
			'required'    => array('project_head_enable', '=', 'custom'),
		),
		
		// Related
		array(
			'id'       => 'project_related',
			'type'     => 'switch', 
			'title'    => __('Related Projects', UN),
			'subtitle' => __('Enable/Disable the Related', UN),
			'default'  => true,
		),	
	),
);

// Register
$metaboxes[] = array(

	'id' => 'project_bot_settings',

	'title' => __( 'Project Settings', UN),

	'post_types' => array( 'un-portfolio' ),

	'sections' => $project_bot_settings

);

// PROJECT BOTTOM END


// PAGE

// Settings
$page_settings[] = array(

	'fields' => array(	
	
		// Enable Custom Heading
		array(
			'id'       => 'page_head_enable',
			'type'     => 'button_set',
			'title'    => __('Page Heading', UN),
			'options' => array(
				'global' => __('Global Options', UN), 
				'custom' => __('Custom', UN), 
			 ), 
			'default' => 'global',
		),
		
		// Image
		array(
			'id'       => 'page_head_image',
			'type'     => 'media', 
			'url'      => true,
			'title'    => __('BG Image', UN),
			'default'  => array(
				'url' => UN_THEME_URI.'assets/img/noimage.jpg',
			),
			'required'    => array('page_head_enable', '=', 'custom'),
		),
		
		// Title
		array(					
			'id'          => 'page_head_title',
			'type'        => 'text', 
			'title'       => __('Heading Title', UN),
			'required'    => array('page_head_enable', '=', 'custom'),
		),
		
		// Subtitle
		array(					
			'id'          => 'page_head_subtitle',
			'type'        => 'text', 
			'title'       => __('Heading Subtitle', UN),
			'required'    => array('page_head_enable', '=', 'custom'),
		),
		
		// Overlay
		array(
			'id'       => 'page_head_overlay',
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
			'required'    => array('page_head_enable', '=', 'custom'),
		),
		
		// Sidebar
		array(
			'id'       => 'page_sidebar',
			'type'     => 'switch', 
			'title'    => __('Sidebar', UN),
			'subtitle' => __('Enable/Disable the Sidebar', UN),
			'default'  => true,
		),		
	),
);

// Register
$metaboxes[] = array(

	'id' => 'page_settings',

	'title' => __( 'Page Settings', UN),

	'post_types' => array( 'page' ),
	
	'page_template' => array( 'default', 'page-blog.php', 'page-portfolio.php' ),

	'sections' => $page_settings

);

// PAGE END



// PAGE-VC

// Settings
$page_vc_settings[] = array(

	'fields' => array(	
	
		// Onepage
		array(
			'id'       => 'page_vc_onepage',
			'type'     => 'switch', 
			'title'    => __('Onepage Mode', UN),
			'subtitle' => __('Enable/Disable the Onepage Mode', UN),
			'default'  => false,
		),		
	),
);

// Register
$metaboxes[] = array(

	'id' => 'page_vc_settings',

	'title' => __( 'Visual Composer Page Settings', UN), 

	'post_types' => array( 'page' ),
	
	'page_template' => array( 'page-vc.php' ),

	'sections' => $page_vc_settings

);



// PAGE-BLOG

// Settings
$page_blog_settings[] = array(

	'fields' => array(	
		
		// Masonry
		array(
			'id'       => 'page_blog_masonry',
			'type'     => 'switch', 
			'title'    => __('Masonry Style', UN),
			'subtitle' => __('Enable/Disable the Masonry Style', UN),
			'default'  => false,
		)
		
	)
);

// Register
$metaboxes[] = array(

	'id' => 'page_blog_settings',

	'title' => __( 'Blog Settings', UN),

	'post_types' => array( 'page' ),
	
	'page_template' => array( 'page-blog.php' ),

	'sections' => $page_blog_settings

);

// PAGE-BLOG END



// PAGE-PORTFOLIO

// Settings
$page_port_settings[] = array(

	'fields' => array(	
		
		// Type
		array(
			'id'       => 'page_port_type',
			'type'     => 'select', 
			'title'    => __('Portfolio Type', UN),
			'options'  => array(
				'works-grid-pakery' => __('Pakery', UN),
				'works-grid-masonry' => __('Masonry', UN),
			),
			'default'  => 'works-grid-pakery',
		),
		
		// Overlay
		array(
			'id'       => 'page_port_overlay',
			'type'     => 'select', 
			'title'    => __('Overlay Color', UN),
			'options'  => array(
				'works-hover-w' => __('White', UN),
				'works-hover-d' => __('Dark', UN),
				'works-hover-g' => __('Gradient', UN),
			),
			'default'  => 'works-hover-w',
		),
		
		// Limit Projects
		array(
			'id' => 'page_port_limit',
			'type' => 'slider',
			'title' => __('Limit the project number', UN),
			'subtitle' => __('Set 0 to display all projects', UN),
			"default" => 7,
			"min" => 0,
			"step" => 1,
			"max" => 100,
			'display_value' => 'text'
		),
		
		// Filters
		array(
			'id'       => 'page_port_filters',
			'type'     => 'switch', 
			'title'    => __('Filters', UN),
			'subtitle' => __('Enable/Disable the Filters', UN),
			'default'  => true,
		)
		
	)
);

// Register
$metaboxes[] = array(

	'id' => 'page_port_settings',

	'title' => __( 'Portfolio Settings', UN),

	'post_types' => array( 'page' ),
	
	'page_template' => array( 'page-portfolio.php' ),

	'sections' => $page_port_settings

);

// PAGE-BLOG END



// RETURN METAS
return $metaboxes;

}

add_action( 'redux/metaboxes/' . UN . '/boxes', 'un_metaboxes' );

}
