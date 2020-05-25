<?php
/*
Description: Theme Functions
Theme: Incanto
*/


/*************/
/* BASIC SEO */ 
/*************/

add_filter( 'wp_title', 'un_wp_title', 10, 2 );

function un_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;
	
	$sep = ' - ';

	// If Home
	if( is_home() || is_front_page() ) {
   		return __( 'Home', UN ) . $sep . get_bloginfo( 'description' );
 	}
	
	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= $sep . sprintf( __( 'Page %s', UN ), max( $paged, $page ) );
	}
	

	return $title;
}


/***********/
/* WIDGETS */ 
/***********/

// Check Footer Sidebars distribution and return the right column class
function un_foot_sidebars_class() {
	
	$active_sidebars = 0;

	if ( is_active_sidebar( 'un-foot1-sidebar' ) ) {
		$active_sidebars++;
	}
	
	if ( is_active_sidebar( 'un-foot2-sidebar' ) ) {
		$active_sidebars++;
	}
	
	if ( is_active_sidebar( 'un-foot3-sidebar' ) ) {
		$active_sidebars++;
	}
	
	if ( is_active_sidebar( 'un-foot4-sidebar' ) ) {
		$active_sidebars++;
	}
	
	switch ($active_sidebars){
		
		case 0:
		$col_class = 'col-sm-12';
		break;
		
		case 1:
		$col_class = 'col-sm-12';
		break;
		
		case 2:
		$col_class = 'col-sm-6';
		break;
		
		case 3:
		$col_class = 'col-sm-4';
		break;
		
		case 4:
		$col_class = 'col-sm-3';
		break;
		
	}
	
	return $col_class;

}



/**************/
/* PAGINATION */ 
/**************/

function un_pagination($custom_query = null, $range = 1) {  
     
	$showitems = ($range * 2)+1;  

	global $paged;
	if(empty($paged)) $paged = 1;
	
	if($custom_query == ''){
		
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		
		if(!$pages){
			$pages = 1;
		}
		
	} else{
		
		$pages = $custom_query->max_num_pages;
		
		if(!$pages){
			$pages = 1;
		}
		
	}

     if(1 != $pages){				
						 
		echo '
		<!-- PAGINATION -->
		<div class="row">
			<div class="col-sm-12 text-center m-t-60">
				<ul class="pagination font-alt">';
				
					if($paged > 1 && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($paged - 1).'"><i class="fa fa-angle-left"></i></a></li>';
					
					for ($i=1; $i <= $pages; $i++) {
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
							echo ($paged == $i)? '<li class="active"><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
						}
					}
					
					if($paged < $pages && $showitems < $pages) echo '<li><a href="'.get_pagenum_link($paged + 1).'"><i class="fa fa-angle-right"></i></a></li>'; 
	
		echo '
				</ul>
			</div>		
		</div>
		<!-- /PAGINATION -->';
		
     }
}




/*******************/
/* HEADING BUILDER */ 
/*******************/

function un_heading_builder($image=null, $title=null, $subtitle=null, $overlay=null) {
	
	// Global Options
	global $uncommons;
	
	// Vars
	if( !isset($image) || empty($image) ){ $image = UN_THEME_URI.'assets/img/noimage.jpg'; }
	if( !isset($title) ){ $title = ''; }
	if( !isset($subtitle) ){ $subtitle = ''; }
	if( !isset($overlay) ){ $overlay = ''; }
		
	if( is_page_template('default') ){ 
	
		// Check Metas
		$enable = redux_post_meta( UN, get_the_ID(), 'page_head_enable' );
		
		// Options
		if( $enable == 'custom' ){
			
			$image = redux_post_meta( UN, get_the_ID(), 'page_head_image' );
			$image = $image['url'];
			$title = redux_post_meta( UN, get_the_ID(), 'page_head_title' );
			$subtitle = redux_post_meta( UN, get_the_ID(), 'page_head_subtitle' );
			$overlay = redux_post_meta( UN, get_the_ID(), 'page_head_overlay' );			
			
		}else{
			
			if( isset($uncommons['opt-standard-page-intro-image']) ){ $image = $uncommons['opt-standard-page-intro-image']['url']; }
			if( isset($uncommons['opt-standard-page-intro-title']) ){ $title = $uncommons['opt-standard-page-intro-title']; }
			if( isset($uncommons['opt-standard-page-intro-subtitle']) ){ $subtitle = $uncommons['opt-standard-page-intro-subtitle']; }
			if( isset($uncommons['opt-standard-page-intro-overlay']) ){ $overlay = $uncommons['opt-standard-page-intro-overlay']; }
			
		}
		
	}
	
	if( is_page_template('page-blog.php') ){ 
		
		// Check Metas
		$enable = redux_post_meta( UN, get_the_ID(), 'page_head_enable' );
		
		// Options
		if( $enable == 'custom' ){
			
			$image = redux_post_meta( UN, get_the_ID(), 'page_head_image' );
			$image = $image['url'];
			$title = redux_post_meta( UN, get_the_ID(), 'page_head_title' );
			$subtitle = redux_post_meta( UN, get_the_ID(), 'page_head_subtitle' );
			$overlay = redux_post_meta( UN, get_the_ID(), 'page_head_overlay' );			
			
		}else{
			
			if( isset($uncommons['opt-blog-page-intro-image']) ){ $image = $uncommons['opt-blog-page-intro-image']['url']; }
			if( isset($uncommons['opt-blog-page-intro-title']) ){ $title = $uncommons['opt-blog-page-intro-title']; }
			if( isset($uncommons['opt-blog-page-intro-subtitle']) ){ $subtitle = $uncommons['opt-blog-page-intro-subtitle']; }
			if( isset($uncommons['opt-blog-page-intro-overlay']) ){ $overlay = $uncommons['opt-blog-page-intro-overlay']; }
			
		}
		
	}
	
	if( is_page_template('page-portfolio.php') ){ 
		
		// Check Metas
		$enable = redux_post_meta( UN, get_the_ID(), 'page_head_enable' );
		
		// Options
		if( $enable == 'custom' ){
			
			$image = redux_post_meta( UN, get_the_ID(), 'page_head_image' );
			$image = $image['url'];
			$title = redux_post_meta( UN, get_the_ID(), 'page_head_title' );
			$subtitle = redux_post_meta( UN, get_the_ID(), 'page_head_subtitle' );
			$overlay = redux_post_meta( UN, get_the_ID(), 'page_head_overlay' );			
			
		}else{
			
			if( isset($uncommons['opt-portfolio-page-intro-image']) ){ $image = $uncommons['opt-portfolio-page-intro-image']['url']; }
			if( isset($uncommons['opt-portfolio-page-intro-title']) ){ $title = $uncommons['opt-portfolio-page-intro-title']; }
			if( isset($uncommons['opt-portfolio-page-intro-subtitle']) ){ $subtitle = $uncommons['opt-portfolio-page-intro-subtitle']; }
			if( isset($uncommons['opt-portfolio-page-intro-overlay']) ){ $overlay = $uncommons['opt-portfolio-page-intro-overlay']; }
			
		}
		
	}
	
	if( is_singular('post') ){ 
		
		if( isset($uncommons['opt-simple-post-intro-image']) ){ $image = $uncommons['opt-simple-post-intro-image']['url']; }
		if( isset($uncommons['opt-simple-post-intro-title']) ){ $title = $uncommons['opt-simple-post-intro-title']; }
		if( isset($uncommons['opt-simple-post-intro-subtitle']) ){ $subtitle = $uncommons['opt-simple-post-intro-subtitle']; }
		if( isset($uncommons['opt-simple-post-intro-overlay']) ){ $overlay = $uncommons['opt-simple-post-intro-overlay']; }
		
	}
	
	if( is_singular( 'un-portfolio' ) ){ 
		
		// Check Metas
		$enable = redux_post_meta( UN, get_the_ID(), 'project_head_enable' );
		
		// Options
		if( $enable == 'custom' ){
			
			$image = redux_post_meta( UN, get_the_ID(), 'project_head_image' );
			$image = $image['url'];
			$title = redux_post_meta( UN, get_the_ID(), 'project_head_title' );
			$subtitle = redux_post_meta( UN, get_the_ID(), 'project_head_subtitle' );
			$overlay = redux_post_meta( UN, get_the_ID(), 'project_head_overlay' );			
			
		}elseif( $enable == 'global' ){
			
			if( isset($uncommons['opt-simple-project-intro-image']) ){ $image = $uncommons['opt-simple-project-intro-image']['url']; }
			if( isset($uncommons['opt-simple-project-intro-title']) ){ $title = $uncommons['opt-simple-project-intro-title']; }
			if( isset($uncommons['opt-simple-project-intro-subtitle']) ){ $subtitle = $uncommons['opt-simple-project-intro-subtitle']; }
			if( isset($uncommons['opt-simple-project-intro-overlay']) ){ $overlay = $uncommons['opt-simple-project-intro-overlay']; }
			
		}else{
			
			return;
			
		}
		
	}
	
	if( is_archive() && !un_is_woocommerce() ){ 
		
		if( isset($uncommons['opt-archive-page-intro-image']) ){ 
			$image = un_set( $uncommons['opt-archive-page-intro-image']['url'], UN_THEME_URI.'assets/img/noimage.jpg' ); 
		}
		
		if( isset($uncommons['opt-archive-page-intro-title']) ){ 
			$title = un_set( $uncommons['opt-archive-page-intro-title'], get_the_archive_title() ); 
		}
		
		if( isset($uncommons['opt-archive-page-intro-subtitle']) ){ 
			$subtitle = un_set( $uncommons['opt-archive-page-intro-subtitle'], get_the_archive_description() ); 
		}
		
		if( isset($uncommons['opt-archive-page-intro-overlay']) ){ 
			$overlay = $uncommons['opt-archive-page-intro-overlay']; 
		}
		
	}
	
	if( is_search() ){ 
		
		if( isset($uncommons['opt-search-page-intro-image']) ){ 
			$image = un_set( $uncommons['opt-search-page-intro-image']['url'], UN_THEME_URI.'assets/img/noimage.jpg' ); 
		}
		
		if( isset($uncommons['opt-search-page-intro-title']) ){ 
			$title = $uncommons['opt-search-page-intro-title']; 
		}
		
		if( isset($uncommons['opt-search-page-intro-subtitle']) ){ 
			$subtitle = un_set( $uncommons['opt-search-page-intro-subtitle'], __('Results for: ', UN).esc_html( get_search_query( false ) ) ); 
		}
		
		if( isset($uncommons['opt-search-page-intro-overlay']) ){ 
			$overlay = $uncommons['opt-search-page-intro-overlay']; 
		}

	}
	
	if( is_404() ){ 
		
		if( isset($uncommons['opt-error-page-intro-image']) ){ $image = $uncommons['opt-error-page-intro-image']['url']; }
		if( isset($uncommons['opt-error-page-intro-title']) ){ $title = $uncommons['opt-error-page-intro-title']; }
		if( isset($uncommons['opt-error-page-intro-subtitle']) ){ $subtitle = $uncommons['opt-error-page-intro-subtitle']; }
		if( isset($uncommons['opt-error-page-intro-overlay']) ){ $overlay = $uncommons['opt-error-page-intro-overlay']; }
		
	}
	
	if( is_attachment() ){ 
		
		if( isset($uncommons['opt-attachment-page-intro-image']) ){ $image = $uncommons['opt-attachment-page-intro-image']['url']; }
		if( isset($uncommons['opt-attachment-page-intro-title']) ){ $title = $uncommons['opt-attachment-page-intro-title']; }
		if( isset($uncommons['opt-attachment-page-intro-subtitle']) ){ $subtitle = $uncommons['opt-attachment-page-intro-subtitle']; }
		if( isset($uncommons['opt-attachment-page-intro-overlay']) ){ $overlay = $uncommons['opt-attachment-page-intro-overlay']; }
		
	}
	
	if( un_is_woocommerce() ){
	
		if( isset($uncommons['opt-shop-head-image']) ){ $image = $uncommons['opt-shop-head-image']['url']; }
		if( isset($uncommons['opt-shop-head-title']) ){ $title = $uncommons['opt-shop-head-title']; }
		if( isset($uncommons['opt-shop-head-subtitle']) ){ $subtitle = $uncommons['opt-shop-head-subtitle']; }
		if( isset($uncommons['opt-shop-head-overlay']) ){ $overlay = $uncommons['opt-shop-head-overlay']; }

	}
	
		
	// Build the Hero Section
	echo '
	<!-- HERO -->
	<section class="module module-parallax '.$overlay.'" data-background="'.$image.'">
	
		<!-- HERO TEXT -->
		<div class="container">
	
			<div class="row">
				<div class="col-sm-12 text-center">
					<h1 class="mh-line-size-3 font-alt m-b-20">'.$title.'</h1>
					<h5 class="mh-line-size-4 font-alt">'.$subtitle.'</h5>
				</div>
			</div>
	
		</div>
		<!-- /HERO TEXT -->
	
	</section>
	<!-- /HERO -->';
	
}


/***********/
/* HELPERS */ 
/***********/


// Custom print_r
function un_print($array){
	
	echo '<pre>';
	print_r($array);
	echo '</pre>';

}


// Live Resize of Post Thumbnail
function un_get_the_post_thumbnail( $id=null, $width=null, $height=null, $crop=false, $html=true ){
	
	// Check ID
	if(!$id || empty($id) || !isset($id)) {
		$id = get_the_ID();
	}
	
	// Check Sizes
	if(!$width || empty($width) || !isset($width)) {
		$width = $height;
	}
	
	if(!$height || empty($height) || !isset($height)) {
		$height = $width;
	}
	
	// Get Original URL
	$original_url = wp_get_attachment_url( get_post_thumbnail_id($id) );	
		
	// Generate New URL
	$new_url = aq_resize( $original_url, $width, $height, $crop, true, true );
	
	
	// If no original put a placeholder
	if( !$original_url ){
		$new_url = UN_THEME_URI.'assets/img/noimage.jpg';
	}
	
	// If no new image put the default
	if( $original_url && !$new_url ){
		$new_url = $original_url;
	}
	
	if($html == true){
		
		return '<img alt="" src="'.$new_url.'">';
		
	}else{
		
		return $new_url;
		
	}
		
}


// Live Resize of Attachment
function un_get_the_attachment( $att_id, $width=null, $height=null, $crop=false, $html=true ){
	
	// Check Sizes
	if(!$width || empty($width) || !isset($width)) {
		$width = $height;
	}
	
	if(!$height || empty($height) || !isset($height)) {
		$height = $width;
	}
	
	// Get Original URL
	$original_url = wp_get_attachment_url( $att_id );
	
	// Generate New URL
	$new_url = aq_resize( $original_url, $width, $height, $crop, true, true );
	
	// If no image put a placeholder
	if( !$new_url ){
		$new_url = UN_THEME_URI.'assets/img/noimage.jpg';
	}
	
	if($html == true){
		
		return '<img alt="" src="'.$new_url.'">';
		
	}else{
		
		return $new_url;
		
	}
		
}


// Build the term HTML
function un_get_the_term($term_id, $taxonomy, $echo){
	
	// Get the term data
	$term = get_term($term_id, $taxonomy);
	
	// Check the data
	if ( is_object( $term ) && count($term) > 0 ) { 
		
		$url = esc_url(get_term_link( $term->slug, $taxonomy ));
		$name = $term->name;
		
	}else{

		return;
		
	}	
	
	// Check the return type
	if($echo == true){
		
		echo '<a href="'.esc_url($url).'" title="'.$term->name.'">'.$term->name.'</a>';
		
	}else{

		return '<a href="'.esc_url($url).'" title="'.$term->name.'">'.$term->name.'</a>';
		
	}

}

// Related Posts Query 
function un_related_posts_query_args( $post_id, $taxonomy='category', $n = 4 ){
	
	// Check Post Type
	$post_type = get_post_type( $post_id );
	
	// Get the terms of the post
	$terms = wp_get_post_terms( $post_id, $taxonomy );
	
	// Build an ids array
	if( $terms && count($terms) > 0 ) {
		
    	$terms_ids = array();
		
   		foreach($terms as $term){
			$terms_ids[] = $term->term_id;
		}

	}else{
		
		return;
		
	}
	
	// Build Query Args
	$args = array(
		'post_type'		 => $post_type,
		'post_status'	 => 'publish',
		'pagination'	 => false,
		'posts_per_page' => $n,
		'order'          => 'ASC',
		'orderby'        => 'title',
		'post__not_in'   => array($post_id),
		'tax_query'      => array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'term_id',
				'terms'    => $terms_ids,
			),
		)
	);
	
	// Return the $args
	return $args;
	
}


// Get post terms
function un_get_post_terms_array( $term_id, $taxonomy='category' ) {
	
	$terms = wp_get_post_terms( $term_id, $taxonomy );
	
	$result = array();
	
	foreach( $terms as $term ){
		
		$result[] = array(
			'name' => $term->name, 
			'slug' => $term->slug,
			'id'   => $term->term_id,
		);		
		
	}
	
	return $result;
	
}

// Get post terms as list
function un_get_post_terms_list( $term_id, $taxonomy='category', $value='slug', $sep=',' ) {
	
	$terms = wp_get_post_terms( $term_id, $taxonomy );
	
	$result = '';
	
	$start_sep = '';
	
	foreach( $terms as $term ){
		
		$result .= $start_sep.$term->$value;
		
		$start_sep = $sep;
		
	}
	
	return $result;
	
}


// Get taxonomy terms as array
function un_get_terms_array( $taxonomies=array('category') ) {
	
	$terms = get_terms( $taxonomies );
	
	$result = array();
	
	foreach( $terms as $term ){
		
		$result[] = array(
			'name' => $term->name, 
			'slug' => $term->slug,
			'id'   => $term->term_id,
		);		
		
	}
	
	return $result;
	
}


// Sanitize String
function un_sanitize_string( $string ) {
	
	// Remove special accented characters
	$clean_string = strtr($string, 'ŠŽšžŸÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïñòóôõöøùúûüýÿ', 'SZszYAAAAAACEEEEIIIINOOOOOOUUUUYaaaaaaceeeeiiiinoooooouuuuyy');
	
	$clean_string = strtr($clean_string, array('Þ' => 'TH', 'þ' => 'th', 'Ð' => 'DH', 'ð' => 'dh', 'ß' => 'ss', 'Œ' => 'OE', 'œ' => 'oe', 'Æ' => 'AE', 'æ' => 'ae', 'µ' => 'u'));
	
	$clean_string = preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('-', '.', ''), $clean_string);
	
	$clean_string = strtolower($clean_string);
	
	return $clean_string;
	
}


// Check if is_woocommerce 
function un_is_woocommerce() {
	
	if( (function_exists('is_woocommerce') && is_woocommerce()) || 
		(function_exists('is_cart') && is_cart()) || 
		(function_exists('is_checkout') && is_checkout()) || 
		(function_exists('is_account_page') && is_account_page()) ||
		(function_exists('is_add_payment_method_page') && is_add_payment_method_page()) ||   
		(function_exists('is_checkout_pay_page') && is_checkout_pay_page()) ||   
		(function_exists('is_order_received_page') && is_order_received_page()) ||   
		(function_exists('is_view_order_page') && is_view_order_page()) ||   
		(function_exists('is_checkout') && is_checkout())		
		) {
		return true;
	}else{
		return false;
	}
	
}

// Sanitize String
function vc_kses($string) {
	
	// We can't put the wp_kses() function on some specific Visual Composer Block because It has data attributes
	return $string;	
	
}

// Sanitize String
function un_sanitize($string, $html = false) {
	
	if($html == false) {
		
		return wp_kses($string, array());
		
	}else{
		
		$tags = wp_kses_allowed_html( 'post' );
		
		$tags['script'] = array(
			'language' => 1,
			'src'      => 1,
			'type'     => 1  
		);
			
		return wp_kses($string, $tags);
		
	}
	
}


// Custom ISSET
function un_isset( $var ){
	 
	//Check if is an Object 
	if( is_object($var) ){
		$var = (array) $var;
	}
	
	// Check if is Array
	if( is_array($var) && count($var) > 0 ){
		
		return true;
		
	}else{
		
		// String
		if ( isset($var) || !empty($var) ){
			
			return true;
			
		}
		
	}
	
	return false;
	
}

// Conditional SET
function un_set( $var, $default='' ){
	 
	//Check if is an Object 
	if( is_object($var) ){
		
		return $var;
		
	}
	
	// Check if is Array
	if( is_array($var) && count($var) > 0 ){
		
		return $var;
		
	}else{
		
		// String
		if ( isset($var) || !empty($var) ){
			
			return $var;
			
		}
		
	}
	
	return $default;
	
}



// Basic WP Function
function un_basic_wp_functions() {
	posts_nav_link();
	wp_link_pages();
	post_class();
	wp_title('', false);
	get_the_tags();
	add_theme_support( 'custom-header', array() );
	add_theme_support( 'custom-background', array() );
	wp_enqueue_script( "comment-reply" );
	add_theme_support( "title-tag" );
}


