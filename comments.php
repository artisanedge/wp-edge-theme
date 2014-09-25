<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package edge
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<!-- Blog Comments -->
<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'edge' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'edge' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'edge' ) ); ?></div>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>

		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'callback' => 'edge_comment',
				) );
			?>
		</div><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'edge' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'edge' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'edge' ) ); ?></div>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'edge' ); ?></p>
	<?php endif; ?>

	<hr>

	<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = $req ? 'aria-required="true"' : '';
		comment_form( array(
			'fields' => array(
				'author' => '<div class="form-group"><label for="author" class="col-sm-3 control-label">' . __('Name') . ($req ? ' *' : '') . '</label><div class="col-sm-6"><input type="text" id="author" name="author" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . '></div></div>',
				'email' => '<div class="form-group"><label for="email" class="col-sm-3 control-label">' . __('Email') . ($req ? ' *' : '') . '</label><div class="col-sm-6"><input type="email" id="email" name="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '"" ' . $aria_req . '></div></div>',
			),
			'comment_field' => '<div class="form-group"><label for="comment" class="col-sm-3 control-label">' . _x('Comment', 'noun') . '</label><div class="col-sm-9"><textarea id="comment" name="comment" class="form-control" rows="5" aria_required="true"></textarea><span class="help-block">' . sprintf( __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</span></div></div>',
			'comment_notes_after' => null,
		) );
	?>
	
</div><!-- #comments -->

				<!-- Posted Comments -->
