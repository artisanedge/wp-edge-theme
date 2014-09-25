<?php
/**
 * The template for displaying all single posts.
 *
 * @package edge
 */

get_header(); ?>

	<div class="row">

		<!-- Blog Entry Column -->
		<div id="primary" class="<?php edge_primary_class(); ?>">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php edge_post_nav(); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>

		</div>

		<?php get_sidebar(); ?>
	</div>
	<!-- /.row -->

<?php get_footer(); ?>