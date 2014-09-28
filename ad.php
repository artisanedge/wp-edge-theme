<?php
if ( wp_is_mobile() ) {
	if ( is_active_sidebar( 'ad-responsive' ) ) {
		dynamic_sidebar( 'ad-responsive' );
	} else if ( is_active_sidebar( 'ad-1' ) ) {
		dynamic_sidebar( 'ad-1' );
	}
} else {
	if ( is_active_sidebar( 'ad-1' ) ) {
		dynamic_sidebar( 'ad-1' );
	} else if ( is_active_sidebar( 'ad-responsive' ) ) {
		dynamic_sidebar( 'ad-responsive' );
	}
}
