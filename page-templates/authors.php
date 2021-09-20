<?php
/**
 * Template Name: Authors Page
 *
 * This is the template that displays the website authors.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cyt
 */

get_header();
?>
<div class="site-wrapper">

	<div class="row justify-content-center align-items-stretch">

		<?php
		$args       = array(
			'meta_key' => 'id_iso_3166_1_alpha_3',
			'orderby'  => 'meta_value',
		);
		$users      = get_users( $args );
		$users_json = array();
		foreach ( $users as $user ) {
			$users_json[] = array(
				'display_name' => $user->display_name,
				'description'  => $user->description,
				'country'      => $user->id_iso_3166_1_alpha_3,
				'archive_url'  => get_author_posts_url( $user->ID ),
				'avatar'       => get_avatar( $user->ID ),
			);
		}
		?>

		<script type="text/javascript">
			jQuery( document ).ready(function() {
				var map = L.map('map', {
					minZoom: 3,
					maxZoom: 5
				}).setView([0, -65], 3);
				L.tileLayer.provider('OpenStreetMap.Mapnik').addTo(map);

				var users = <?php echo wp_json_encode( $users_json ); ?>;
				var userCountriesCount = _.countBy(users, 'country')
				var userCountries = _.compact(_.keys( userCountriesCount ));
				var filteredCountries = _.filter(countries.features, function(item) {
					return _.contains(userCountries, item.id);
				});

				L.geoJSON(filteredCountries, {
					style: function (feature) {
						return {
							color: 'var(--bs-primary)',
							fillOpacity: 0.6,
							className: 'map-country'
						};
					}
				}).on("click", function(event) {
					document.getElementById(event.layer.feature.id + '_section').scrollIntoView({ behavior: 'smooth', block: 'start' });
				}).addTo(map);
			});
		</script>

		<main id="main" class="page authors">

			<div id="map" class="bg-light ratio w-100 mb-4" style="height:300px"></div>

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

		<div class="col-lg-4 ps-lg-5 mb-4 border-start">

			<div class="pe-lg-4" style="max-height: 600px; overflow-y: auto; scroll-behavior: smooth;">

				<ul class="list-unstyled">

				<?php
				$already_echoed = array();
				foreach ( $users as $user ) :
					if ( ! in_array( $user->id_iso_3166_1_alpha_3, $already_echoed, true ) ) :
						?>
						<div id="<?php echo esc_attr( $user->id_iso_3166_1_alpha_3 ); ?>_section" class="d-flex align-items-center pt-4 pb-2 mb-4 border-bottom">
							<img class="me-3" width="42"src="<?php echo esc_url( get_template_directory_uri() ); ?>/img/flags/<?php echo esc_attr( strtolower( $user->id_iso_3166_1_alpha_3 ) ); ?>.svg">
							<h2 class="fs-3">
								<?php
								$country = get_field( 'id_iso_3166_1_alpha_3', 'user_' . $user->ID );
								echo esc_attr( $country['label'] );
								?>
							</h2>
						</div>
						<?php
					endif;

					$already_echoed[] = $user->id_iso_3166_1_alpha_3;
					?>

					<li class="border-bottom mb-4">
						<a class="d-flex align-items-center text-dark text-decoration-none mb-2" href="<?php echo esc_url( get_author_posts_url( $user->ID ) ); ?>">
							<?php echo get_avatar( $user->ID, 32, '', '', array( 'class' => array( 'me-3' ) ) ); ?>
							<div>
								<h3 class="fs-4"><?php echo esc_attr( $user->display_name ); ?></h3>
								<?php
								if ( get_field( 'relation', 'user_' . $user->ID ) ) :
									?>
									<h4 class="fs-5 text-muted">
										<?php
										$relation = get_field( 'relation', 'user_' . $user->ID );
										echo esc_attr( $relation['label'] );
										?>
									</h4>
									<?php
								endif;
								?>
							</div>
						</a>
						<p><?php echo cyt_author_excerpt( $user->ID ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					</li>
					<?php
				endforeach;
				?>

				</ul>

			</div>

		</div>

	</div>

</div>

<?php
get_footer();
?>

