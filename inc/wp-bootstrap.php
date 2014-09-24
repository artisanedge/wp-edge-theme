<?php
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