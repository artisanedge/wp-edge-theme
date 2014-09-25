<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package edge
 */

if ( ! function_exists( 'edge_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function edge_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<ul class="nav-links pager">

			<?php if ( get_previous_posts_link() ) : ?>
			<li class="previous"><?php previous_posts_link( __( '<span class="glyphicon glyphicon-chevron-left"></span> Newer posts', 'edge' ) ); ?></li>
			<?php endif; ?>

			<?php if ( get_next_posts_link() ) : ?>
			<li class="next"><?php next_posts_link( __( 'Older posts <span class="glyphicon glyphicon-chevron-right"></span>', 'edge' ) ); ?></li>
			<?php endif; ?>

		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'edge_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function edge_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<ul class="nav-links pager">
			<?php
				previous_post_link( '<li class="previous">%link</li>', _x( '<span class="glyphicon glyphicon-chevron-left"></span>&nbsp;%title', 'Previous post link', 'edge' ) );
				next_post_link(     '<li class="next">%link</li>',     _x( '%title&nbsp;<span class="glyphicon glyphicon-chevron-right"></span>', 'Next post link',     'edge' ) );
			?>
		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'edge_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function edge_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( '%s', 'post date', 'edge' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( '%s', 'post author', 'edge' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on"><i class="glyphicon glyphicon-time"></i> ' . $posted_on . '</span> <span class="byline"><i class="glyphicon glyphicon-user"></i> ' . $byline . '</span>';
}
endif;

if ( ! function_exists( 'edge_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function edge_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list && edge_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="glyphicon glyphicon-folder-open"></i> ' . __( '%1$s', 'edge' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ', ' );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="glyphicon glyphicon-tags"></i> ' . __( '%1$s', 'edge' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="glyphicon glyphicon-comment"></i> ';
		comments_popup_link( __( 'Leave a comment', 'edge' ), __( '1 Comment', 'edge' ), __( '% Comments', 'edge' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'edge' ), '<span class="edit-link"><i class="glyphicon glyphicon-pencil"></i> ', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function edge_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'edge_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'edge_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so edge_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so edge_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in edge_categorized_blog.
 */
function edge_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'edge_categories' );
}
add_action( 'edit_category', 'edge_category_transient_flusher' );
add_action( 'save_post',     'edge_category_transient_flusher' );
