<?php
/**
 * @package edge
 */
?>

<!-- Blog Post -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2>
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		</h2>
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php edge_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<div class="row">
			<div class="col-md-3">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'thumbnail' ) ); ?>
			<?php else : ?>
				<img class="thumbnail" src="http://placehold.it/150x150&amp;text=No Image" alt="">
			<?php endif; ?>
			</div>
			<div class="col-md-9">
				<?php
					$content = apply_filters( 'the_content', get_the_content() );
					$content = str_replace( ']]>', ']]&gt;', $content );
					$longstr = mb_strlen( $content ) > 200;
					$content = mb_substr( strip_tags( $content ), 0, 200 );
					echo $longstr ? "<p>$content...</p>" : "<p>$content</p>";
				?>

				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'edge' ),
						'after'  => '</div>',
					) );
				?>

				<a class="btn btn-primary pull-right" href="<?php echo esc_url( get_permalink() ); ?>"><?php _e('Continue reading <span class="glyphicon glyphicon-chevron-right"></span>', 'edge') ?></a>
			</div>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edge_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

<hr>
