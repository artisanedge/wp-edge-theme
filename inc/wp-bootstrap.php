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