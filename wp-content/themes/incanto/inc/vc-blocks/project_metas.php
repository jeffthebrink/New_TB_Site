<?php
/*
Description: VC Project Metas
Theme: Incanto
*/

// Block Class 
class unProjectMetas extends WPBakeryShortCode {
    
	// Class Init
	function __construct() {
        add_action( 'init', array( $this, 'un_project_metas_map' ) );
        add_shortcode( 'un_project_metas', array( $this, 'un_project_metas_short' ) );
    }
 	
	// Block Map
    public function un_project_metas_map() {
        
		// Stop all if VC is not enabled
		if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
	
		// Map the block with vc_map()
		vc_map( 
			array(
				'name' => __('Project Metas', UN),
				'base' => 'un_project_metas',
				'description' => __('Your project informations', UN),
				'category' => __('Incanto', UN),
				'weight' => 9999,
				'icon' => UN_THEME_URI.'assets/img/apple-touch-icon.png',				
				'params' => array(	
				
					// Categories
					array(
						'type' => 'autocomplete',
						'heading' => __( 'Categories', UN ),
						'param_name' => 'categories',
						'description' => __('Leave it blank to disable it', UN),	
						'settings' => array(
							'multiple' => true,
							'sortable' => true,
							'min_length' => 1,
							'no_hide' => true,
							'groups' => false,
							'unique_values' => true,
							'display_inline' => true,
							'delay' => 300,
							'auto_focus' => true,							
						),	
					),
										
					// Realeas Date									
					array(
						'type' => 'textfield',
						'heading' => __('Release Date', UN),
						'param_name' => 'release',
						'description' => __('Leave it blank to disable it', UN),			   
					),
					
					// Project Url									
					array(
						'type' => 'vc_link',
						'heading' => __('Project Url', UN),
						'param_name' => 'project_url',	
						'description' => __('Leave it blank to disable it', UN),		  
					),	
					
					// Client Url									
					array(
						'type' => 'vc_link',
						'heading' => __('Client Url', UN),
						'param_name' => 'client_url',	
						'description' => __('Leave it blank to disable it', UN),		  
					),				
					
					// Special Features
					array(
						'type' => '',
						'param_name' => 'info_special',	
						'description' => __('<i class="fa fa-info-circle"></i> To manage special section features like the overlay, the full-height and bg you have to edit the <b>Row Options</b>', UN),	
						'group' => __('Special Features', UN),		   
					),
				),
			)
		);
		
		
		// 'Categories' Autocomplete field search
		add_filter( 'vc_autocomplete_un_project_metas_categories_callback', 'vc_autocomplete_lol_field_search', 10, 1 );
		
		function vc_autocomplete_lol_field_search( $search_string ) {
			$data = array();
			
			$vc_taxonomies = get_terms(array('un-portfolio-categories'), array('hide_empty' => false));
			
			if ( is_array( $vc_taxonomies ) && ! empty( $vc_taxonomies ) ) {
				foreach ( $vc_taxonomies as $t ) {
					if ( is_object( $t ) ) {
						$data[] = vc_get_term_object( $t );
					}
				}
			}
		
			return $data;
		}
		
		// 'Categories' Autocomplete field render
		add_filter( 'vc_autocomplete_vc_basic_grid_taxonomies_render', 'vc_autocomplete_lol_field_render', 10, 1 );		
			
		function vc_autocomplete_lol_field_render( $term=null ) {
			
			$terms = get_terms(array('un-portfolio-categories'), array('hide_empty' => false));
			$data = false;
			if ( is_array( $terms ) && 1 === count( $terms ) ) {
				$term = $terms[0];
				$data = vc_get_term_object( $term );
			}

			return $data;
		}	  			  
	   
    } // End Block Map
	
	
	// Block Shortcode
	public function un_project_metas_short( $atts ) {
		
		extract(
			shortcode_atts(
				array(
					'categories'	=> '',
					'release'     => '',
					'project_url'	=> '',	
					'client_url'	=> '',				
				), 
				$atts
			)
		);
		
		// Build Categories
		if($categories && !empty($categories)){
			
			$categories = explode(',', $categories);	
			
			$categories_html = '';		
			$prefix = '';
			
			foreach($categories as $cat){

				$categories_html .= $prefix.un_get_the_term($cat, 'un-portfolio-categories', false);
				$prefix = ', ';
				
			}
			
			 
			
			$categories_html = '<li class="font-alt">'.__('Categories', UN).': '.$categories_html.'</li>';
			
		}else{
			
			$categories_html = '';	
			
		}
		
		// Build Release Date
		if($release && !empty($release)){
			
			$release_html = '<li class="font-alt">'.__('Released', UN).': '.$release.'</li>';
			
		}else{
				
			$release_html = '';
			
		} 
		
		// Build Project Url
		$project_url = ( $project_url == '||' ) ? '' : $project_url;
				
		if($project_url && !empty($project_url)) {
			
			$project_url = vc_build_link( $project_url );
			
			if( !$project_url['target'] ){ $project_url['target'] = '_self'; }
			
			$project_url_html = '<li class="font-alt">'.__('Online', UN).': <a href="'.esc_url($project_url['url']).'" target="'.$project_url['target'].'">'.$project_url['title'].'</a></li>';
		
		}else{
			
			$project_url_html = '';
			
		}
		
		// Build Client Url
		$client_url = ( $client_url == '||' ) ? '' : $client_url;
		
		if($client_url && !empty($client_url)) {
			
			$client_url = vc_build_link( $client_url );
			
			if( !$client_url['target'] ){ $client_url['target'] = '_self'; }
			
			$client_url = '<li class="font-alt">'.__('Client', UN).': <a href="'.esc_url($client_url['url']).'" target="'.$client_url['target'].'">'.$client_url['title'].'</a></li>';
		
		}else{
			
			$project_url_html = '';
			
		}
		
		
		$html = '
		<ul class="project-details m-b-sm-30">
			'.$categories_html.$release_html.$project_url_html.$client_url.'
		</ul>';
	
		return $html;
		
	} // End Block Shortcode
	
} // End Block Class


// Block Init
new unProjectMetas();			