<?php
/*
Description: The Comments
Theme: Incanto
*/
?>

<?php if ( !comments_open() ) {
	return;
} ?>

<div class="comments">

	<?php if ( have_comments() ) { ?>
        <h4 class="comment-title font-alt">            
			<?php
                printf( // WPCS: XSS OK
                    esc_html( _nx( '1 comment', '%1$s comments', get_comments_number(), UN ) ),
                    number_format_i18n( get_comments_number() )
                );
            ?>
        </h4>
		<hr class="divider m-b-30">
    
       
		<?php // List the comments
        wp_list_comments( array(
			'walker'            => new un_walker_comment,
			'max_depth'         => '3',
			'style'             => 'div',
			'type'              => 'all',
			'reply_text'        => __('Reply', UN),
			'avatar_size'       => 70,
			'format'            => 'html5',
			'short_ping'        => false,
			'echo'              => true,
		));
        ?>
    
    <?php } // have_comments() ?>
    

    
	
	<?php $form_fields =  array(
			
			'author' =>
				'<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input id="author" name="author" type="text" value="'.esc_attr( $commenter['comment_author'] ).'" class="form-control" placeholder="'.__( 'Name', UN ).'" required>
					</div>
				</div>',
			
			'email' =>
				'<div class="col-md-4">
					<div class="form-group">
						<input id="email" name="email" type="email" value="'.esc_attr(  $commenter['comment_author_email'] ).'" class="form-control" placeholder="'.__( 'Email', UN ).'" required>
					</div>
				</div>',
			
			'url' =>
				'<div class="col-md-4">
					<div class="form-group">
						<input id="url" name="url" type="text" value="'.esc_attr(  $commenter['comment_author_url'] ).'" class="form-control" placeholder="'.__( 'Website', UN ).'">
					</div>
				</div>
				</div>',
		); ?>
		
        <div class="comment-form">
          
            
                <?php 
                comment_form( array(
                    'id_form'           	=> 'commentform',
                    'id_submit'        		=> 'submit',
                    'class_submit'      	=> 'btn btn-round btn-g',
                    'name_submit'      		=> 'submit',
                    'title_reply'       	=> '<h4 class="comment-form-title font-alt">'.__( 'Leave a Comment', UN ).'</h4><hr class="divider m-b-30">',
                    'title_reply_to'   		=> '<h4 class="comment-form-title font-alt">'.__( 'Leave a Reply to %s', UN ).'</h4><hr class="divider m-b-30">',
                    'cancel_reply_link' 	=> ' ',
                    'label_submit'      	=> __( 'Post Comment', UN ),
                    'format'            	=> 'xhtml',
                    'must_log_in'       	=> ' ',
                    'logged_in_as'      	=> ' ',
                    'comment_notes_before'  => ' ',
                    'comment_notes_after'   => ' ',
                    'comment_field'         => '<div class="row"><div class="col-md-12"><div class="form-group"><textarea id="comment" name="comment" class="form-control" placeholder="'.__('Message', UN).'" rows="6" aria-required="true" required></textarea></div></div></div>',
                    'fields' => apply_filters( 'comment_form_default_fields', $form_fields ),
                ) ); ?>
       
            
		</div>

</div><!-- #comments -->

<?php

// COMMENTS WALKER //
class un_walker_comment extends Walker_Comment{
  
    // START_EL	         
    function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment; 
        ?>
        
        <!-- COMMENT <?php comment_ID(); ?> -->
        <div class="comment clearfix" id="comment-<?php comment_ID(); ?>">
        
        	<div class="comment-avatar">
                <?php echo ( $args['avatar_size'] != 0 ? get_avatar( $comment, $args['avatar_size'] ) :'' ); ?>
            </div>
            
            <div id="comment-content-<?php comment_ID(); ?>" class="comment-content clearfix">
                <h5 class="comment-author font-alt">
                    <?php comment_author(); ?>
                </h5>
                <div id="comment-body-<?php comment_ID(); ?>" class="comment-body">
                    <?php if( !$comment->comment_approved ) { ?>
                    	<em><?php _e('Your comment is awaiting moderation.', UN); ?></em>                     
                    <?php }else{ 
						comment_text(); 
                    } ?>
                </div>
                <div class="comment-meta font-alt"><?php echo get_comment_date(' F j, Y (H:i)'); ?> - <?php comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']) ) ); ?></div>
            </div>
      
    <?php }
 
    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
         
        </div><!-- /COMMENT <?php comment_ID(); ?> -->
         
    <?php }
     
  
}