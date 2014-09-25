<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package edge
 */
?>

<!-- Page Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<hr>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'edge' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'edge' ), '<span class="edit-link"><i class="glyphicon glyphicon-pencil"></i> ', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
