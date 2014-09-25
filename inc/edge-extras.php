<?php
function edge_breadcrumb( $post ) {
	$str = <<<EOT
	<ol class="breadcrumb">
		<li><a href="/">HOME</a></li>
EOT;
	$nodes = array();
	$child = $post;
	while ( $child->post_parent ) {
		$parent = get_post( $child->post_parent );
		$parent_permalink = get_permalink( $parent->ID );
		$parent_str = <<<EOT
		<li><a href="$parent_permalink">{$parent->post_title}</a></li>
EOT;
		array_push( $nodes, $parent_str );
		$child = $parent;
	}
	while ( $node = array_pop( $nodes ) ) {
		$str .= $node;
	}
	$str .= <<<EOT
		<li class="active">{$post->post_title}</li>
	</ol>
EOT;
	echo apply_filters( 'edge_breadcrumb', $str, $post, $nodes );
}
