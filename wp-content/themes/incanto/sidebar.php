<?php
/*
Description: The Sidebar
Theme: Incanto
*/
?>

<?php if ( !is_active_sidebar( 'un-blog-sidebar' ) && !is_active_sidebar( 'un-page-sidebar' ) ) {
	return;
} ?>

<!-- SIDEBAR -->
<div class="col-sm-3 m-t-sm-60">

    <?php 
	if( is_single() || is_archive() || is_page_template( 'page-blog.php' ) ){		
		dynamic_sidebar('un-blog-sidebar'); 
	}else{
		dynamic_sidebar('un-page-sidebar'); 
	}
	?>

</div>
<!-- /SIDEBAR -->
