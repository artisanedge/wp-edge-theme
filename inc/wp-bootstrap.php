<?php
if ( ! function_exists( 'edge_viewport' ) ) :
function edge_viewport() {
	$viewport = "width=device-width, initial-scale=1";
	if ( wp_is_mobile() ) {
		$viewport = "width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1";
	}
	echo $viewport;
}
endif;

if ( ! function_exists( 'edge_container_class' ) ) :
function edge_container_class() {
	// return 'container' or 'container-fluid'
	echo 'container';
}
endif;

if ( ! function_exists( 'edge_primary_class' ) ) :
function edge_primary_class() {
	echo 'col-md-8';
}
endif;

if ( ! function_exists( 'edge_secondary_class' ) ) :
function edge_secondary_class() {
	echo 'col-md-4';
}
endif;

add_filter( 'wp_nav_menu_args', function( $args = '' ) {
	if ( isset( $args['theme_location'] ) && $args['theme_location'] == 'primary' ) {
		$args['container'] = false;
		$args['items_wrap'] = '%3$s';
	}
	return $args;
} );

function edge_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
?>
	<hr>
	
	<div id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
		<a class="pull-left" href="#">
			<?php echo get_avatar( $comment, 32 ); ?>
		</a>
		<div class="media-body">
			<h4 class="media-heading"><?php comment_author_link(); ?>
				<small><?php printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ); ?> <?php edit_comment_link(); ?></small>
			</h4>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<?php _e( 'Your comment is awaiting moderation.' ); ?>
			<?php endif; ?>
			<?php comment_text(); ?>
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div>
		</div>
	</div>
<?php
}