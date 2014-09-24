<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package edge
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'edge' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'edge' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'edge' ), 'edge', '<a href="http://artisanedge.jp" rel="designer">Artisan Edge</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
