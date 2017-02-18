<?php
// 1.8 Comment Form -- HTML5 Placeholders

function mbdmaster_comment_form($fields) {
    $fields['author'] = 
        '<p class="comment-form-author">
            <input required minlength="3" maxlength="30" placeholder="Your Name*" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';
 
    $fields['email'] = 
        '<p class="comment-form-email">
            <input required placeholder="Your Email*" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';
 
    $fields['url'] = 
        '<p class="comment-form-url">
            <input placeholder="Your URL (website, twitter...)" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" />
        </p>';
 
    return $fields;
}

// 1.9 Comment Field

function mbdmaster_comment_field($comment_field) {
 
    $comment_field = 
        '<p class="comment-form-comment">
            <textarea required placeholder="Enter Your Comment" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </p>';
 
    return $comment_field;
}
/*	This controls the display the list of comments on a post. It's called from "comments.php". 	*/

function mbdmaster_custom_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	
	<li class="post pingback">
		<p><?php _e( 'Incoming link:', 'mbdmaster' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'mbdmaster' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<header><?php echo get_avatar( $comment, 40 ); ?>
				<div class="comment-author vcard">
					
					<?php printf( __( '%s <span class="says">says:</span>', 'mbdmaster' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h5>
				<span class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'mbdmaster' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'mbdmaster' ), ' ' );
					?>
				</span><!-- .comment-meta .commentmetadata -->
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'mbdmaster' ); ?></em>
					<br />
				<?php endif; ?>

			</header>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
