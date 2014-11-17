<?php
function edge_breadcrumb( $post = false, $active = false, $echo_active = false ) {
	$str = '<ol class="breadcrumb">';
	if ( is_multisite() ) {
		$str .= '<li><a href="/">HOME</a></li>';
	} else {
		$str .= '<li><a href="' . get_bloginfo( 'url' ) . '">' . get_bloginfo( 'name' ) . '</a></li>';
	}

	$nodes = array();

	if ( is_single() || is_category() ) {
		$category = get_the_category();
		$category = $category[0];
		if ( is_single() ) {
			$category_str = '<li><a href="' . get_category_link( $category->cat_ID ) . '">' . $category->cat_name . '</a></li>';
			array_push( $nodes, $category_str );
		}
		$child_category = $category;
		while ( $child_category->category_parent ) {
			$parent_category = get_category( $child_category->category_parent, false );
			if ( $parent_category->cat_name == $active ) {
				$nodes = array();
			} else {
				$category_str = '<li><a href="' . get_category_link( $parent_category->cat_ID ) . '">' . $parent_category->cat_name . '</a></li>';
				array_push( $nodes, $category_str );
			}
			$child_category = $parent_category;
		}
	}

	if ( $post ) {
		$child = $post;
		while ( $child->post_parent ) {
			$parent = get_post( $child->post_parent );
			$parent_permalink = get_permalink( $parent->ID );
			$parent_str = '<li><a href="' . $parent_permalink . '">' . $parent->post_title . '</a></li>';
			array_push( $nodes, $parent_str );
			$child = $parent;
		}
	}

	while ( $node = array_pop( $nodes ) ) {
		$str .= $node;
	}

	if ( $echo_active ) {
		if ( $post ) {
			$str .= '<li class="active">' . $post->post_title . '</li>';
		} else if ( $active ) {
			$str .= '<li class="active">' . $active . '</li>';
		}
	}

	$str .= '</ol>';
	echo apply_filters( 'edge_breadcrumb', $str, $post, $nodes );
}

function edge_the_terms( $post, $taxonomy, $echo = true, $container = 'div' ) {
	$output = '';
	$terms =  get_the_terms( $post->ID, $taxonomy );
	foreach ( $terms as $term ) {
		$output .= '<' . $container . ' class="' . $taxonomy . '-terms">';
		$term_array = array();
		array_push( $term_array, '<a href="' . get_term_link( $term->term_id, $taxonomy ) . '" class="' . $taxonomy . '-term">' . $term->name . '</a>' );
		while ( $term->parent != 0 ) {
			$term = get_term( $term->parent, $taxonomy );
			array_push( $term_array, '<a href="' . get_term_link( $term->term_id, $taxonomy ) . '" class="' . $taxonomy . '-term">' . $term->name . '</a>' );
		}
		$first = true;
		while ( $str = array_pop( $term_array ) ) {
			if ( $first ) {
				$first = false;
			} else {
				$output .= ' &gt; ';
			}
			$output .= $str;
		}
		$output .= '</' . $container . '>';
	}
	if ( $echo ) {
		echo $output;
	} else {
		return $output;
	}
}

function edge_term_list( $taxonomy, $container_class = '', $parent = 0 ) {
	$terms = get_terms( $taxonomy, array( 'parent' => $parent ) );
	if ( count( $terms ) < 1 ) return;
	echo '<ul class="' . $container_class . '">';
	foreach ( $terms as $term ) {
		echo '<li>';
		echo '<a href="' . get_term_link( intval($term->term_id), $taxonomy ) . '" class="' . $taxonomy . '-term">' . $term->name . '</a>';
		edge_term_list( $taxonomy, '', intval( $term->term_id ), $output );
		echo '</li>';
	}
	echo '</ul>';
}

function get_hierarchical_terms( $term, $taxonomy ) {
	$terms = array();
	while ( $term ) {
		array_push( $terms, $term );
		if ( ! $term->parent ) break;
		$term = get_term( $term->parent, $taxonomy );
	}
	return $terms;
}