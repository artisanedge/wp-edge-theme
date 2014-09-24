<?php
if ( ! function_exists( 'edge_get_viewport' ) ) :
function edge_get_viewport() {
	$viewport = "width=device-width, initial-scale=1";
	if ( wp_is_mobile() ) {
		$viewport = "width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1";
	}
	return $viewport;
}
endif;

if ( ! function_exists( 'edge_get_container_class' ) ) :
function edge_get_container_class() {
	// return 'container' or 'container-fluid'
	return 'container';
}
endif;

add_filter( 'wp_nav_menu_args', function( $args = '' ) {
	if ( isset( $args['theme_location'] ) && $args['theme_location'] == 'primary' ) {
		$args['container'] = false;
		$args['items_wrap'] = '%3$s';
	}
	return $args;
} );