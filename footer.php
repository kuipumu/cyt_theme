<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cyt
 */

?>

	<footer id="colophon">
		<div class="site-info">
			<div class="container">
				<a href="<?php echo esc_url( __( 'https://kuipumu.gitlab.io/blog', 'cyt' ) ); ?>">
					<?php
					/* translators: %s: Creator name, i.e. John Doe. */
					printf( esc_html__( 'Designed by %s', 'cyt' ), 'César Montilla' );
					?>
				</a>
				<span> | </span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cyt' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'cyt' ), 'WordPress' );
					?>
				</a>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
