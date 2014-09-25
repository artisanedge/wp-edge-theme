<?php
function edge_breadcrumb( $post = false, $active = false ) {
	$str = '<ol class="breadcrumb">';
	$str .= '<li><a href="/">HOME</a></li>';

	$nodes = array();
	if ( $post ) {
		$child = $post;
		while ( $child->post_parent ) {
			$parent = get_post( $child->post_parent );
			$parent_permalink = get_permalink( $parent->ID );
			$parent_str = '<li><a href="' . $parent_permalink . '">' . $parent->post_title . '</a></li>';
			array_push( $nodes, $parent_str );
			$child = $parent;
		}
		while ( $node = array_pop( $nodes ) ) {
			$str .= $node;
		}
		$str .= '<li class="active">' . $post->post_title . '</li>';
	} else if ( $active ) {
		$str .= '<li class="active">' . $active . '</li>';
	}

	$str .= '</ol>';
	echo apply_filters( 'edge_breadcrumb', $str, $post, $nodes );
}
