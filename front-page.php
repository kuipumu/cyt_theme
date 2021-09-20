<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cyt
 */

get_header();
?>
<div class="site-wrapper">

	<div class="row">

		<main id="main" class="front-page">

			<section id="featured-section">

				<div id="center-featured">

				<?php
				$exclude = array();
				$count   = 0;

				$sticky  = get_option( 'sticky_posts' );
				$args    = array(
					// Arguments for your query.
					'posts_per_page'      => 1,
					'offset'              => $count,
					'post__in'            => $sticky,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				);

				// Custom query.
				$query = new WP_Query( $args );

				// Check that we have query results.
				if ( $query->have_posts() ) {
					?>
						<ul>
						<?php
						// Start looping over the query results.
						while ( $query->have_posts() ) {

							$query->the_post();
							// Contents of the queried post results go here.
							if ( ! in_array( $post->ID, $exclude ) ) :
								?>
								<li>
									<article
									<?php post_class(); ?>
									itemscope itemtype="https://schema.org/Article">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'large' ); ?>
										</a>
										<header>
											<h2>
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h2>
											<div class="entry-meta">
												<?php
												cyt_posted_by();
												?>
											</div>
										</header>
										<div><?php the_excerpt(); ?></div>
									</article>
								</li>
								<?php
							endif;
							// Add post to exclude array.
							$exclude[] = get_the_ID();
							$count++;
						}
						?>
						</ul>
					<?php

				}

				// Restore original post data.
				wp_reset_postdata();

				?>

				</div>

				<div id="end-featured">

				<?php
				$args = array(
					// Arguments for your query.
					'posts_per_page'      => 2,
					'offset'              => $count,
					'post__in'            => $sticky,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				);

				// Custom query.
				$query = new WP_Query( $args );

				// Check that we have query results.
				if ( $query->have_posts() ) {
					?>
						<ul>
						<?php
						// Start looping over the query results.
						while ( $query->have_posts() ) {

							$query->the_post();
							// Contents of the queried post results go here.
							if ( ! in_array( $post->ID, $exclude ) ) :
								?>
								<li>
									<article
									<?php post_class(); ?>
									itemscope itemtype="https://schema.org/Article">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'thumbnail' ); ?>
										</a>
										<header>
											<h2>
												<ahref="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h2>
											<div class="entry-meta">
												<?php
												cyt_posted_by();
												?>
											</div><!-- .entry-meta -->
										</header><!-- .entry-header -->
										<div class="d-lg-none"><?php the_excerpt(); ?></div>
									</article>
								</li>
								<?php
							endif;
							// Add post to exclude array.
							$exclude[] = get_the_ID();
							$count++;
						}
						?>
						</ul>
					<?php

				}

				// Restore original post data.
				wp_reset_postdata();

				?>

				</div>

				<div id="start-featured">

				<?php
				$args = array(
					// Arguments for your query.
					'posts_per_page'      => 2,
					'offset'              => $count,
					'post__in'            => $sticky,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				);

				// Custom query.
				$query = new WP_Query( $args );

				// Check that we have query results.
				if ( $query->have_posts() ) {
					?>
						<ul>
						<?php
						// Start looping over the query results.
						while ( $query->have_posts() ) {

							$query->the_post();
							// Contents of the queried post results go here.
							if ( ! in_array( $post->ID, $exclude ) ) :
								?>
								<li>
									<article
									<?php post_class(); ?>
									itemscope itemtype="https://schema.org/Article">

										<a class="col-12" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-100 h-auto mb-3' ) ); ?>
										</a>
										<header>
											<h2>
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h2>
											<div class="entry-meta">
												<?php
												cyt_posted_by();
												?>
											</div><!-- .entry-meta -->
										</header><!-- .entry-header -->
										<div class="d-lg-none"><?php the_excerpt(); ?></div>
									</article>
								</li>
								<?php
							endif;
							// Add post to exclude array.
							$exclude[] = get_the_ID();
							$count++;
						}
						?>
						</ul>
					<?php

				}

				// Restore original post data.
				wp_reset_postdata();

				?>

				</div>

			</section>

			<?php
			$categories = get_terms(
				'category',
				array( 'parent' => 0 )
			);
			$categories_custom = array();
			foreach ( $categories as $category ) {
				$order                       = get_field( 'weight', $category );
				$categories_custom[ $order ] = (object) array(
					'name'    => $category->name,
					'slug'    => $category->slug,
					'term_id' => $category->term_id,
				);
			}
			ksort( $categories_custom, SORT_NUMERIC );

			foreach ( $categories_custom as $category ) :
				?>
				<section id="section-<?php echo esc_attr( $category->name ); ?>" class="section-categories">

					<header class="section-header">
						<h2>
							<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
								<?php echo esc_attr( $category->name ); ?>
							</a>
						</h2>
					</header>

					<?php
					$args = array(
						// Arguments for your query.
						'cat'                 => $category->term_id,
						'posts_per_page'      => 4,
						'post__not_in'        => $exclude,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1,
						'no_found_rows'       => true,
					);

					// Custom query.
					$query = new WP_Query( $args );

					// Check that we have query results.
					if ( $query->have_posts() ) {
						?>
							<ul>
							<?php
							// Start looping over the query results.
							while ( $query->have_posts() ) {

								$query->the_post();
								// Contents of the queried post results go here.
								?>
								<li>
									<article
									<?php post_class(); ?>
									itemscope itemtype="https://schema.org/Article">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'thumbnail' ); ?>
										</a>
										<header>
											<h2>
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h2>
											<div class="entry-meta">
												<?php
												cyt_posted_by();
												?>
											</div>
										</header>
										<div class="d-lg-none"><?php the_excerpt(); ?></div>
									</article>
								</li>
								<?php

								// Add post to exclude array.
								$exclude[] = get_the_ID();
							}
							?>
							</ul>
						<?php
					}

					// Restore original post data.
					wp_reset_postdata();

					?>

				</section>
				<?php
			endforeach;
			?>

			<?php
			if ( have_posts() ) :

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

	</div>

</div>

<?php
get_footer();
?>
