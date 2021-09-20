<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cyt
 */

get_header();
?>

<div class="site-wrapper">

	<div class="row justify-content-center">

		<main id="main" class="archive">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<div class="page-title">
						<?php
						cyt_author_avatar();
						?>
						<div>
						<?php
						the_archive_title( '<h1>', '</h1>' );
						if ( is_author() && get_field( 'relation', 'user_' . get_the_author_meta( 'ID' ) ) ) :
							?>
							<h2 class="fs-2 text-muted">
								<?php
								$relation = get_field( 'relation', 'user_' . get_the_author_meta( 'ID' ) );
								echo esc_attr( $relation['label'] );
								?>
							</h2>
							<?php
						endif;
						?>
						</div>
					</div>
					<?php
					$description = get_the_archive_description();
					if ( $description ) :
						the_archive_description( '<div class="archive-description">', '</div>' );
					endif;
					cyt_author_links();
					?>

				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the Post-Type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

		</main><!-- #main -->

	<?php
	get_sidebar();
	?>

	</div>

</div>

<?php
get_footer();
?>
