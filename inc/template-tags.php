<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package cyt
 */

if ( ! function_exists( 'cyt_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function cyt_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'cyt' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'cyt_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function cyt_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'cyt' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'cyt_author_avatar' ) ) :
	/**
	 * Prints HTML with author avatar.
	 */
	function cyt_author_avatar() {
		if ( is_author() ) :
			echo get_avatar( get_the_author_meta( 'email' ), '60', '', '', array( 'class' => array( 'me-3' ) ) );
		endif;
	}
endif;

if ( ! function_exists( 'cyt_author_excerpt' ) ) :
	/**
	 * Prints HTML with author excerpt.
	 *
	 * @param int $id author id.
	 * @param int $limit excerpt character limit.
	 */
	function cyt_author_excerpt( $id, $limit = 20 ) {
		if ( (bool) get_user_by( 'id', $id ) ) :
			$word_limit               = $limit;
			$more_txt                 = __( 'Read More', 'cyt' );
			$txt_end                  = ' […]';
			$author_url               = get_author_posts_url( $id );
			$author_description       = explode( ' ', get_the_author_meta( 'description', $id ) );
			$display_author_page_link = count( $author_description ) > $word_limit ? $txt_end . ' <a href="' . esc_html( $author_url ) . '">' . $more_txt . '</a>' : '';
			$author_description_short = array_slice( $author_description, 0, ( $word_limit ) );

			return ( implode( ' ', $author_description_short ) ) . $display_author_page_link;
		endif;
	}
endif;

if ( ! function_exists( 'cyt_author_links' ) ) :
	/**
	 * Prints HTML with links information for the current author.
	 *
	 * @param int $user_id author id.
	 */
	function cyt_author_links( $user_id = false ) {
		if ( is_author() || $user_id ) :
			$text       = esc_html__( 'Author website', 'cyt' );
			$url        = get_the_author_meta( 'url', $user_id );
			$facebook   = get_the_author_meta( 'facebook', $user_id );
			$twitter    = get_the_author_meta( 'twitter', $user_id );
			$instagram  = get_the_author_meta( 'instagram', $user_id );
			$linkedin   = get_the_author_meta( 'linkedin', $user_id );
			$pinterest  = get_the_author_meta( 'pinterest', $user_id );
			$soundcloud = get_the_author_meta( 'soundcloud', $user_id );
			$tumblr     = get_the_author_meta( 'tumblr', $user_id );
			$youtube    = get_the_author_meta( 'youtube', $user_id );
			$wikipedia  = get_the_author_meta( 'wikipedia', $user_id );

			?>

			<div class="author-links">

				<?php
				if ( $url ) :
					?>
					<a href="<?php echo esc_url( $url ); ?>" rel="nofollow" target="_blank" title="<?php echo esc_attr( $text ); ?>" alt="<?php $text; ?>">
						<i class="fas fa-link"></i>
					</a>
					<?php
				endif;

				if ( $facebook ) :
					?>
					<a href="<?php echo esc_url( $facebook ); ?>" rel="nofollow" target="_blank" title="Facebook" alt="Facebook">
						<i class="fab fa-facebook-f"></i>
					</a>
					<?php
				endif;

				if ( $instagram ) :
					?>
					<a href="<?php echo esc_url( $instagram ); ?>" rel="nofollow" target="_blank" title="Instagram" alt="Instagram">
						<i class="fab fa-instagram"></i>
					</a>
					<?php
				endif;

				if ( $linkedin ) :
					?>
					<a href="<?php echo esc_url( $linkedin ); ?>" rel="nofollow" target="_blank" title="Linkedin" alt="Linkedin">
						<i class="fab fa-linkedin"></i>
					</a>
					<?php
				endif;

				if ( $pinterest ) :
					?>
					<a href="<?php echo esc_url( $pinterest ); ?>" rel="nofollow" target="_blank" title="Pinterest" alt="Pinterest">
						<i class="fab fa-pinterest"></i>
					</a>
					<?php
				endif;

				if ( $soundcloud ) :
					?>
					<a href="<?php echo esc_url( $soundcloud ); ?>" rel="nofollow" target="_blank" title="Soundcloud" alt="Soundcloud">
						<i class="fab fa-soundcloud"></i>
					</a>
					<?php
				endif;

				if ( $tumblr ) :
					?>
					<a href="<?php echo esc_url( $tumblr ); ?>" rel="nofollow" target="_blank" title="Tumblr" alt="Tumblr">
						<i class="fab fa-tumblr"></i>
					</a>
					<?php
				endif;

				if ( $twitter ) :
					?>
					<a href="https://twitter.com/<?php echo esc_attr( $twitter ); ?>" rel="nofollow" target="_blank" title="Twitter" alt="Twitter">
						<i class="fab fa-twitter"></i>
					</a>
					<?php
				endif;

				if ( $youtube ) :
					?>
					<a href="<?php echo esc_url( $youtube ); ?>" rel="nofollow" target="_blank" title="Youtube" alt="YouTube">
						<i class="fab fa-youtube"></i>
					</a>
					<?php
				endif;

				if ( $wikipedia ) :
					?>
					<a href="<?php echo esc_url( $wikipedia ); ?>" rel="nofollow" target="_blank" title="Wikipedia" alt="Wikipedia">
						<i class="fab fa-wikipedia-w"></i>
					</a>
					<?php
				endif;

				?>

			</div>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'cyt_subtitle' ) ) :
	/**
	 * Prints HTML with subtitle field.
	 */
	function cyt_subtitle() {
		$field_value = get_post_meta( get_the_ID(), 'subtitle', true );
		if ( ! empty( $field_value ) ) :
			?>
			<h3 class="entry-subtitle">
				<?php echo esc_attr( $field_value ); ?>
			</h3>
			<?php
		endif;
	}
endif;

if ( ! function_exists( 'cyt_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function cyt_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'cyt' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'cyt' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'cyt' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'cyt' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			if ( is_single() ) :
				?>
				<section id="author-footer">
					<h2><?php echo esc_html__( 'Author', 'cyt' ); ?></h2>
					<ul>
						<li>
							<a class="author-header"
							href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
								<?php echo get_avatar( '', 48, '', '', array( 'class' => array( 'me-3' ) ) ); ?>
								<div>
									<h3>
										<?php echo esc_attr( get_the_author_meta( 'display_name' ) ); ?>
									</h3>
									<?php
									if ( get_field( 'relation', 'user_' . get_the_author_meta( 'ID' ) ) ) :
										?>
										<h4>
											<?php
											$relation = get_field( 'relation', 'user_' . get_the_author_meta( 'ID' ) );
											echo esc_html( $relation['label'] );
											?>
										</h4>
										<?php
									endif;
									?>
								</div>
							</a>
							<p>
								<?php echo cyt_author_excerpt( get_the_author_meta( 'ID' ), 60 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</p>
							<?php echo esc_html( cyt_author_links( get_the_author_meta( 'ID' ) ) ); ?>
						</li>
					</ul>
				</section><!-- #author-footer -->

				<?php
				$collaborators = get_field( 'collaborators' );

				if ( $collaborators ) :
					?>
					<div id="collaborators">
						<h2><?php echo esc_html__( 'Collaborators', 'cyt' ); ?></h2>
						<ul>
							<?php foreach ( $collaborators as $user ) : ?>
								<li>
									<a class="collaborator-header"
									href="<?php get_author_posts_url( $user->ID ); ?>">
										<?php echo get_avatar( $user->ID, 48, '', '', array( 'class' => array( 'me-3' ) ) ); ?>
										<div>
											<h3>
												<?php echo esc_attr( $user->display_name ); ?>
											</h3>
											<?php
											if ( get_field( 'relation', 'user_' . $user->ID ) ) :
												?>
												<h4>
													<?php
													$relation = get_field( 'relation', 'user_' . $user->ID );
													echo esc_html( $relation['label'] );
													?>
												</h4>
												<?php
											endif;
											?>
										</div>
									</a>
									<p>
										<?php echo cyt_author_excerpt( $user->ID, 60 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</p>
									<?php echo esc_html( cyt_author_links( $user->ID ) ); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div><!-- #collaborators -->
					<?php
				endif;
			endif;
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'cyt' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'cyt' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'cyt_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function cyt_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php
				the_post_thumbnail();

				$get_caption = get_post( get_post_thumbnail_id() )->post_excerpt;
				if ( ! empty( $get_caption ) ) :
					?>
					<div class="thumbnail-caption"><?php echo esc_attr( $get_caption ); ?></div>
					<?php
				endif;
				?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;
