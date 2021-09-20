<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cyt
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<section id="sidebar">
	<aside class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside>
</section><!-- #secondary -->
