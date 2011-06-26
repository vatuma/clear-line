<?php
	$options = & ClearLineOptions::getOptions();
	$shortname = & ClearLineOptions::cfg('shortname');
	
$aria_req = ( $req ? '  aria-required="true" ' : '' );
$fields =  array(
	'author' => '<p class="comment-form-author">'
		. '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' 
		. ' <label for="author"'. ( $req ? ' class="required" ' : '' ).'>' . __( 'Name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) 
		. '</p>',
	'email'  => '<p class="comment-form-email">'
		. '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'
		. ' <label for="email" '. ( $req ? ' class="required" ' : '' ).'>' . __( 'Email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) 
		. '</p>',
	'url'    => '<p class="comment-form-url">'
		. '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />'
		. ' <label for="url">' . __( 'Website' ) . '</label>' 
		. '</p>',
	);
	
	
$args= array(
	'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="60" rows="10" aria-required="true"></textarea></p>',
	//'comment_notes_after'=>'',
);

if ($options [$shortname . '_show_allowed_tags_below_comment_box'] =='no')
{
	$args ['comment_notes_after'] ='';
}
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', THEME_DOMAIN ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>			
			<h3 id="comments-title"><?php
			printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), THEME_DOMAIN ),
					number_format_i18n( get_comments_number() ),
					'<em>' . get_the_title() . '</em>' 
				  );
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<?php paginate_comments_links();?>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments( array( 'callback' => 'clearline_comment')); //array( 'callback' => 'twentyten_comment' ) 
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<?php paginate_comments_links();?>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() && $options[$shortname.'_show_comments_off'] == 'yes') :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', THEME_DOMAIN ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form($args); ?>

</div><!-- #comments -->