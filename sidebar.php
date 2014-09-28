<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package edge
 */
?>

<div id="secondary" class="widget-area <?php edge_secondary_class(); ?>" role="complementary">
	<?php get_template_part( 'ad' ); ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
