<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cyt
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html__( 'Skip to content', 'cyt' ); ?></a>

	<header id="masthead">

		<?php if ( has_nav_menu( 'menu-top' ) ) : ?>
		<nav id="top-navigation" aria-labelledby="<?php esc_html_e( 'Top navigation', 'cyt' ); ?>">
			<div class="container d-flex">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'menu-top',
						'container_class' => 'ms-auto menu-wrapper',
						'fallback_cb'     => '__return_false',
						'depth'           => 1,
					)
				);
				?>
			</div>
		</nav><!-- #top-navigation -->
		<?php endif; ?>

		<nav id="primary-navigation" aria-labelledby="<?php esc_html_e( 'Primary navigation', 'cyt' ); ?>">
			<div class="container">
				<?php the_custom_logo(); ?>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu-primary" aria-controls="menu-primary" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="menu-primary">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-primary',
							'container'      => false,
							'menu_class'     => '',
							'fallback_cb'    => '__return_false',
							'items_wrap'     => '<ul id="%1$s" class="navbar-nav ms-auto me-3 my-2 my-lg-0 navbar-nav-scroll %2$s" style="--bs-scroll-height: 100px;">%3$s</ul>',
							'depth'          => 2,
							'walker'         => new CyT_Wp_Nav_Menu_Walker(),
						)
					);
					?>
					<?php get_search_form(); ?>
				</div>
			</div>
		</nav><!-- #primary-navigation -->


		<?php if ( has_nav_menu( 'menu-secondary' ) ) : ?>
		<nav id="secondary-navigation" aria-labelledby="<?php esc_html_e( 'Secondary navigation', 'cyt' ); ?>">
			<div class="container d-flex">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'menu-secondary',
						'container_class' => 'me-auto menu-wrapper',
						'fallback_cb'     => '__return_false',
						'depth'           => 1,
					)
				);
				?>
			</div>
		</nav><!-- #secondary-navigation -->
		<?php endif; ?>

		<?php
		if ( function_exists( 'yoast_breadcrumb' ) && ! is_front_page() ) {
			yoast_breadcrumb( '<div id="breadcrumb"><div class="container">', '</div></div>' );
		}
		?>
	</header><!-- #masthead -->
