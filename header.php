<?php
/**
 * The header for the theme.
 *
 * @package Comet
 */

$has_secondary_menu = has_nav_menu( 'secondary-menu' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( is_singular() && pings_open( get_queried_object_id() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/favicon.ico' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary-content"><?php esc_html_e( 'Skip to content', 'comet' ); ?></a>

<div id="page" class="site">
	<div class="site-frame">
		<nav class="top-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'comet' ); ?>">
			<button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu-list">
				<span class="menu-toggle__label"><?php esc_html_e( 'Menu', 'comet' ); ?></span>
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-menu',
					'menu_id'        => 'primary-menu-list',
					'menu_class'     => 'menu menu--primary',
					'container'      => false,
					'fallback_cb'    => 'comet_page_menu',
					'depth'          => 3,
				)
			);
			?>
		</nav>

		<header id="masthead" class="site-header">
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo"><?php the_custom_logo(); ?></div>
				<?php endif; ?>

				<div class="site-title-group">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>

					<?php $description = get_bloginfo( 'description', 'display' ); ?>
					<?php if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo esc_html( $description ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</header>

		<?php if ( $has_secondary_menu ) : ?>
			<nav class="sub-navigation" aria-label="<?php esc_attr_e( 'Secondary menu', 'comet' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'secondary-menu',
						'menu_id'        => 'secondary-menu-list',
						'menu_class'     => 'menu menu--secondary',
						'container'      => false,
						'fallback_cb'    => false,
						'depth'          => 3,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<div id="content" class="site-layout">
			<aside id="c1" class="sidebar sidebar-left" aria-label="<?php esc_attr_e( 'Left sidebar', 'comet' ); ?>">
				<?php if ( comet_has_left_sidebar() ) : ?>
					<?php get_sidebar( 'left' ); ?>
				<?php endif; ?>
			</aside>

			<main id="primary-content" class="site-main">
				<?php if ( is_archive() || is_search() ) : ?>
					<header class="page-head archive-intro">
						<?php if ( is_search() ) : ?>
							<h1 class="archive-title">
								<?php
								printf(
									/* translators: %s: Search term. */
									esc_html__( 'Results for "%s"', 'comet' ),
									esc_html( get_search_query() )
								);
								?>
							</h1>
						<?php else : ?>
							<?php the_archive_title( '<h1 class="archive-title">', '</h1>' ); ?>
						<?php endif; ?>

						<?php $archive_description = get_the_archive_description(); ?>
						<?php if ( $archive_description ) : ?>
							<div class="archive-description"><?php echo wp_kses_post( $archive_description ); ?></div>
						<?php endif; ?>
					</header>
				<?php endif; ?>
