<?php
/**
 * Comet theme bootstrap.
 *
 * @package Comet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the theme mod defaults.
 *
 * @return array<string, mixed>
 */
function comet_get_default_theme_mods(): array {
	return array(
		'comet_color_scheme'     => 'grey',
		'comet_layout'           => 'right',
		'comet_font_family'      => 'georgia',
		'comet_font_size'        => '16px',
		'comet_footer_text'      => '',
		'comet_show_post_author' => false,
	);
}

/**
 * Returns supported color schemes.
 *
 * @return array<string, array<string, string>>
 */
function comet_get_color_schemes(): array {
	return array(
		'grey'   => array(
			'label'        => __( 'Grey', 'comet' ),
			'page'         => '#E5E5E5',
			'border'       => '#D2D2D2',
			'widget'       => '#F3F3F3',
			'widget_title' => '#DFDFDF',
			'widget_text'  => '#7E7E7E',
			'link'         => '#B91313',
			'link_hover'   => '#E81E1E',
		),
		'red'    => array(
			'label'        => __( 'Red', 'comet' ),
			'page'         => '#E7E4E4',
			'border'       => '#E6BFBF',
			'widget'       => '#F4F2F2',
			'widget_title' => '#ECE1E1',
			'widget_text'  => '#7E7E7E',
			'link'         => '#2464B3',
			'link_hover'   => '#5F9CCF',
		),
		'blue'   => array(
			'label'        => __( 'Blue', 'comet' ),
			'page'         => '#E2E4E9',
			'border'       => '#C9D1DC',
			'widget'       => '#F2F3F4',
			'widget_title' => '#DCDFE2',
			'widget_text'  => '#7E7E7E',
			'link'         => '#B91313',
			'link_hover'   => '#E81E1E',
		),
		'green'  => array(
			'label'        => __( 'Green', 'comet' ),
			'page'         => '#E4E7E4',
			'border'       => '#CDD8CD',
			'widget'       => '#F2F4F2',
			'widget_title' => '#DBE3DC',
			'widget_text'  => '#7E7E7E',
			'link'         => '#B91313',
			'link_hover'   => '#E81E1E',
		),
		'yellow' => array(
			'label'        => __( 'Yellow', 'comet' ),
			'page'         => '#E7E7E4',
			'border'       => '#E7DBBE',
			'widget'       => '#F4F3F2',
			'widget_title' => '#ECEAE1',
			'widget_text'  => '#7E7E7E',
			'link'         => '#B91313',
			'link_hover'   => '#E81E1E',
		),
		'teal'   => array(
			'label'        => __( 'Teal', 'comet' ),
			'page'         => '#E4E7E7',
			'border'       => '#C8DDDD',
			'widget'       => '#F2F4F4',
			'widget_title' => '#DAE4E4',
			'widget_text'  => '#7E7E7E',
			'link'         => '#B91313',
			'link_hover'   => '#E81E1E',
		),
		'purple' => array(
			'label'        => __( 'Purple', 'comet' ),
			'page'         => '#E6E3E8',
			'border'       => '#D3C8DD',
			'widget'       => '#F3F2F4',
			'widget_title' => '#DEDAE4',
			'widget_text'  => '#7E7E7E',
			'link'         => '#B91313',
			'link_hover'   => '#E81E1E',
		),
	);
}

/**
 * Returns supported layout choices.
 *
 * @return array<string, string>
 */
function comet_get_layout_choices(): array {
	return array(
		'right' => __( 'Right Sidebar', 'comet' ),
		'left'  => __( 'Left Sidebar', 'comet' ),
		'both'  => __( 'Left and Right Sidebars', 'comet' ),
		'none'  => __( 'No Sidebars', 'comet' ),
	);
}

/**
 * Returns supported body font choices.
 *
 * @return array<string, array<string, string>>
 */
function comet_get_font_choices(): array {
	return array(
		'georgia'   => array(
			'label' => __( 'Georgia', 'comet' ),
			'stack' => 'Georgia, Cambria, "Palatino Linotype", serif',
		),
		'verdana'   => array(
			'label' => __( 'Verdana', 'comet' ),
			'stack' => 'Verdana, Tahoma, Helvetica, Arial, sans-serif',
		),
		'tahoma'    => array(
			'label' => __( 'Tahoma', 'comet' ),
			'stack' => 'Tahoma, Verdana, Helvetica, Arial, sans-serif',
		),
		'helvetica' => array(
			'label' => __( 'Helvetica', 'comet' ),
			'stack' => 'Helvetica, Arial, sans-serif',
		),
		'trebuchet' => array(
			'label' => __( 'Trebuchet MS', 'comet' ),
			'stack' => '"Trebuchet MS", Tahoma, sans-serif',
		),
	);
}

/**
 * Returns supported font sizes.
 *
 * @return array<string, string>
 */
function comet_get_font_sizes(): array {
	return array(
		'16px' => '16px',
		'15px' => '15px',
		'14px' => '14px',
		'13px' => '13px',
		'12px' => '12px',
		'11px' => '11px',
	);
}

/**
 * Returns a theme mod with its default.
 *
 * @param string $name Theme mod name.
 * @return mixed
 */
function comet_get_theme_mod_value( string $name ) {
	$defaults = comet_get_default_theme_mods();

	return get_theme_mod( $name, $defaults[ $name ] ?? '' );
}

/**
 * Sanitizes a color scheme key.
 *
 * @param string $value Color scheme key.
 * @return string
 */
function comet_sanitize_color_scheme( string $value ): string {
	$schemes = comet_get_color_schemes();

	if ( isset( $schemes[ $value ] ) ) {
		return $value;
	}

	return comet_get_default_theme_mods()['comet_color_scheme'];
}

/**
 * Sanitizes a layout key.
 *
 * @param string $value Layout key.
 * @return string
 */
function comet_sanitize_layout( string $value ): string {
	$layouts = comet_get_layout_choices();

	if ( isset( $layouts[ $value ] ) ) {
		return $value;
	}

	return comet_get_default_theme_mods()['comet_layout'];
}

/**
 * Sanitizes a font family key.
 *
 * @param string $value Font family key.
 * @return string
 */
function comet_sanitize_font_family( string $value ): string {
	$fonts = comet_get_font_choices();

	if ( isset( $fonts[ $value ] ) ) {
		return $value;
	}

	return comet_get_default_theme_mods()['comet_font_family'];
}

/**
 * Sanitizes a font size.
 *
 * @param string $value Font size.
 * @return string
 */
function comet_sanitize_font_size( string $value ): string {
	$sizes = comet_get_font_sizes();

	if ( isset( $sizes[ $value ] ) ) {
		return $value;
	}

	return comet_get_default_theme_mods()['comet_font_size'];
}

/**
 * Sanitizes a checkbox value.
 *
 * @param mixed $checked Checkbox value.
 * @return bool
 */
function comet_sanitize_checkbox( $checked ): bool {
	return (bool) $checked;
}

/**
 * Sanitizes footer text.
 *
 * @param string $value Footer text.
 * @return string
 */
function comet_sanitize_footer_text( string $value ): string {
	return wp_kses_post( $value );
}

/**
 * Sets up theme defaults and registers support for WordPress features.
 */
function comet_setup(): void {
	load_theme_textdomain( 'comet', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 160,
			'width'       => 500,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );

	add_editor_style( 'assets/css/editor-style.css' );

	register_nav_menus(
		array(
			'primary-menu'   => __( 'Above Title', 'comet' ),
			'secondary-menu' => __( 'Below Title', 'comet' ),
		)
	);
}
add_action( 'after_setup_theme', 'comet_setup' );

/**
 * Sets the global content width.
 */
function comet_content_width(): void {
	$layout = comet_get_theme_mod_value( 'comet_layout' );
	$width  = 600;

	if ( 'both' === $layout ) {
		$width = 480;
	} elseif ( 'none' === $layout ) {
		$width = 900;
	}

	$GLOBALS['content_width'] = (int) apply_filters( 'comet_content_width', $width );
}
add_action( 'after_setup_theme', 'comet_content_width', 0 );

/**
 * Registers widget areas.
 */
function comet_widgets_init(): void {
	$shared_args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Sidebar Left', 'comet' ),
				'id'          => 'left-sidebar',
				'description' => __( 'Widgets shown in the left sidebar.', 'comet' ),
			)
		)
	);

	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Sidebar Right', 'comet' ),
				'id'          => 'right-sidebar',
				'description' => __( 'Widgets shown in the right sidebar.', 'comet' ),
			)
		)
	);
}
add_action( 'widgets_init', 'comet_widgets_init' );

/**
 * Enqueues front-end assets.
 */
function comet_enqueue_assets(): void {
	$theme   = wp_get_theme();
	$version = $theme->get( 'Version' );

	wp_enqueue_style(
		'comet-style',
		get_template_directory_uri() . '/assets/css/theme.css',
		array(),
		$version
	);

	wp_add_inline_style( 'comet-style', comet_get_dynamic_styles() );

	wp_enqueue_script(
		'comet-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		$version,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'comet_enqueue_assets' );

/**
 * Enqueues Customizer preview assets.
 */
function comet_customize_preview_assets(): void {
	$theme         = wp_get_theme();
	$font_choices  = array();
	$color_schemes = array_keys( comet_get_color_schemes() );
	$layouts       = array_keys( comet_get_layout_choices() );

	foreach ( comet_get_font_choices() as $key => $font ) {
		$font_choices[ $key ] = $font['stack'];
	}

	wp_enqueue_script(
		'comet-customizer-preview',
		get_template_directory_uri() . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		$theme->get( 'Version' ),
		true
	);

	wp_add_inline_script(
		'comet-customizer-preview',
		'window.cometCustomizer = ' . wp_json_encode(
			array(
				'colorSchemes' => $color_schemes,
				'layouts'      => $layouts,
				'fontFamilies' => $font_choices,
			)
		) . ';',
		'before'
	);
}
add_action( 'customize_preview_init', 'comet_customize_preview_assets' );

/**
 * Builds inline CSS for typography settings.
 *
 * @return string
 */
function comet_get_dynamic_styles(): string {
	$font_choices = comet_get_font_choices();
	$font_family  = comet_sanitize_font_family( (string) comet_get_theme_mod_value( 'comet_font_family' ) );
	$font_size    = comet_sanitize_font_size( (string) comet_get_theme_mod_value( 'comet_font_size' ) );

	return sprintf(
		':root{--comet-body-font:%1$s;--comet-body-size:%2$s;}',
		$font_choices[ $font_family ]['stack'],
		$font_size
	);
}

/**
 * Adds contextual classes to the body element.
 *
 * @param string[] $classes Existing classes.
 * @return string[]
 */
function comet_body_classes( array $classes ): array {
	$classes[] = 'scheme-' . comet_sanitize_color_scheme( (string) comet_get_theme_mod_value( 'comet_color_scheme' ) );
	$classes[] = 'layout-' . comet_sanitize_layout( (string) comet_get_theme_mod_value( 'comet_layout' ) );

	if ( ! comet_should_show_post_author() ) {
		$classes[] = 'has-hidden-post-author';
	}

	return $classes;
}
add_filter( 'body_class', 'comet_body_classes' );

/**
 * Returns whether the left sidebar should be active in the current view.
 *
 * @return bool
 */
function comet_has_left_sidebar(): bool {
	if ( is_attachment() || is_page_template( 'wide.php' ) ) {
		return false;
	}

	return in_array( comet_sanitize_layout( (string) comet_get_theme_mod_value( 'comet_layout' ) ), array( 'left', 'both' ), true );
}

/**
 * Returns whether the right sidebar should be active in the current view.
 *
 * @return bool
 */
function comet_has_right_sidebar(): bool {
	if ( is_attachment() || is_page_template( 'wide.php' ) ) {
		return false;
	}

	return in_array( comet_sanitize_layout( (string) comet_get_theme_mod_value( 'comet_layout' ) ), array( 'right', 'both' ), true );
}

/**
 * Returns whether the post author meta should be displayed.
 *
 * @return bool
 */
function comet_should_show_post_author(): bool {
	return comet_sanitize_checkbox( comet_get_theme_mod_value( 'comet_show_post_author' ) );
}

/**
 * Fallback page menu renderer.
 *
 * @param array|string $args Menu arguments.
 */
function comet_page_menu( $args = array() ): void {
	$args = wp_parse_args(
		(array) $args,
		array(
			'menu_id'    => 'primary-menu-list',
			'menu_class' => 'menu',
		)
	);

	echo '<ul id="' . esc_attr( $args['menu_id'] ) . '" class="' . esc_attr( $args['menu_class'] ) . '">';
	wp_list_pages(
		array(
			'title_li' => '',
		)
	);
	echo '</ul>';
}

/**
 * Renders footer text.
 */
function comet_render_footer_text(): void {
	$footer_text = trim( (string) comet_get_theme_mod_value( 'comet_footer_text' ) );

	if ( '' === $footer_text ) {
		echo esc_html( comet_get_default_footer_text() );
		return;
	}

	echo wp_kses_post( $footer_text );
}

/**
 * Returns the default footer text.
 *
 * @return string
 */
function comet_get_default_footer_text(): string {
	return sprintf(
		/* translators: 1: Year, 2: Site name. */
		__( 'Copyright %1$s %2$s.', 'comet' ),
		wp_date( 'Y' ),
		get_bloginfo( 'name' )
	);
}

/**
 * Selective refresh callback for footer text.
 */
function comet_render_footer_text_partial(): void {
	comet_render_footer_text();
}

/**
 * Migrates legacy fp_options values to theme mods and core Additional CSS.
 */
function comet_migrate_legacy_options(): void {
	if ( get_option( 'comet_legacy_options_migrated' ) ) {
		return;
	}

	$legacy_options = get_option( 'fp_options' );

	if ( ! is_array( $legacy_options ) ) {
		update_option( 'comet_legacy_options_migrated', 1 );
		return;
	}

	$layout_map = array(
		'right'          => 'right',
		'left'           => 'left',
		'left and right' => 'both',
		'hidden'         => 'none',
	);

	$font_map = array(
		'Georgia'        => 'georgia',
		'Verdana'        => 'verdana',
		'Tahoma'         => 'tahoma',
		'Helvetica'      => 'helvetica',
		"'Trebuchet MS'" => 'trebuchet',
	);

	if ( ! empty( $legacy_options['fp_color'] ) ) {
		set_theme_mod( 'comet_color_scheme', comet_sanitize_color_scheme( sanitize_key( $legacy_options['fp_color'] ) ) );
	}

	if ( ! empty( $legacy_options['fp_layout'] ) ) {
		$legacy_layout = (string) $legacy_options['fp_layout'];
		set_theme_mod( 'comet_layout', comet_sanitize_layout( $layout_map[ $legacy_layout ] ?? 'right' ) );
	}

	if ( ! empty( $legacy_options['fp_font'] ) ) {
		$legacy_font = (string) $legacy_options['fp_font'];
		set_theme_mod( 'comet_font_family', comet_sanitize_font_family( $font_map[ $legacy_font ] ?? 'georgia' ) );
	}

	if ( ! empty( $legacy_options['fp_font_size'] ) ) {
		set_theme_mod( 'comet_font_size', comet_sanitize_font_size( sanitize_text_field( $legacy_options['fp_font_size'] ) ) );
	}

	if ( array_key_exists( 'fp_footer', $legacy_options ) ) {
		set_theme_mod( 'comet_footer_text', comet_sanitize_footer_text( (string) $legacy_options['fp_footer'] ) );
	}

	set_theme_mod( 'comet_show_post_author', ! empty( $legacy_options['fp_post_author'] ) );

	if ( ! empty( $legacy_options['fp_logo'] ) ) {
		$logo_id = attachment_url_to_postid( esc_url_raw( (string) $legacy_options['fp_logo'] ) );

		if ( $logo_id ) {
			set_theme_mod( 'custom_logo', $logo_id );
		}
	}

	if ( ! empty( $legacy_options['fp_css'] ) && '' === trim( wp_get_custom_css() ) ) {
		wp_update_custom_css_post( (string) $legacy_options['fp_css'] );
	}

	update_option( 'comet_legacy_options_migrated', 1 );
}
add_action( 'after_switch_theme', 'comet_migrate_legacy_options' );

/**
 * Performs migration for already-active installs that update the theme in place.
 */
function comet_maybe_migrate_legacy_options(): void {
	if ( get_option( 'comet_legacy_options_migrated' ) ) {
		return;
	}

	comet_migrate_legacy_options();
}
add_action( 'after_setup_theme', 'comet_maybe_migrate_legacy_options', 20 );

require_once get_template_directory() . '/inc/customizer.php';
