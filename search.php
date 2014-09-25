<?php
/**
 * The template for displaying search results pages.
 *
 * @package edge
 */

get_header(); ?>

	<div class="row">

		<!-- Search Results Column -->
		<div id="primary" class="<?php edge_primary_class(); ?>">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'edge' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content' );
				?>

			<?php endwhile; ?>

			<!-- Pager -->
			<div class="text-center">
				<?php function_exists( 'wp_pagenavi' ) ? wp_pagenavi() : edge_paging_nav(); ?>
			</div>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</div>

		<?php get_sidebar(); ?>
	</div>
	<!-- /.row -->

<?php get_footer(); ?>
