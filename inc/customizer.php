<?php
/**
 * Customizer support for Comet.
 *
 * @package Comet
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers Customizer settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function comet_customize_register( WP_Customize_Manager $wp_customize ): void {
	$defaults      = comet_get_default_theme_mods();
	$color_choices = array();
	$font_choices  = array();
	$font_sizes    = comet_get_font_sizes();

	foreach ( comet_get_color_schemes() as $key => $scheme ) {
		$color_choices[ $key ] = $scheme['label'];
	}

	foreach ( comet_get_font_choices() as $key => $font ) {
		$font_choices[ $key ] = $font['label'];
	}

	$wp_customize->add_section(
		'comet_colors',
		array(
			'title'    => __( 'Comet Colors', 'comet' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'comet_color_scheme',
		array(
			'default'           => $defaults['comet_color_scheme'],
			'sanitize_callback' => 'comet_sanitize_color_scheme',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'comet_color_scheme',
		array(
			'section' => 'comet_colors',
			'label'   => __( 'Color scheme', 'comet' ),
			'type'    => 'radio',
			'choices' => $color_choices,
		)
	);

	$wp_customize->add_section(
		'comet_layout',
		array(
			'title'    => __( 'Comet Layout', 'comet' ),
			'priority' => 31,
		)
	);

	$wp_customize->add_setting(
		'comet_layout',
		array(
			'default'           => $defaults['comet_layout'],
			'sanitize_callback' => 'comet_sanitize_layout',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'comet_layout',
		array(
			'section' => 'comet_layout',
			'label'   => __( 'Sidebar layout', 'comet' ),
			'type'    => 'radio',
			'choices' => comet_get_layout_choices(),
		)
	);

	$wp_customize->add_setting(
		'comet_show_post_author',
		array(
			'default'           => $defaults['comet_show_post_author'],
			'sanitize_callback' => 'comet_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'comet_show_post_author',
		array(
			'section' => 'comet_layout',
			'label'   => __( 'Display author metadata on posts', 'comet' ),
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_section(
		'comet_typography',
		array(
			'title'    => __( 'Comet Typography', 'comet' ),
			'priority' => 32,
		)
	);

	$wp_customize->add_setting(
		'comet_font_family',
		array(
			'default'           => $defaults['comet_font_family'],
			'sanitize_callback' => 'comet_sanitize_font_family',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'comet_font_family',
		array(
			'section' => 'comet_typography',
			'label'   => __( 'Body font family', 'comet' ),
			'type'    => 'select',
			'choices' => $font_choices,
		)
	);

	$wp_customize->add_setting(
		'comet_font_size',
		array(
			'default'           => $defaults['comet_font_size'],
			'sanitize_callback' => 'comet_sanitize_font_size',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'comet_font_size',
		array(
			'section' => 'comet_typography',
			'label'   => __( 'Body font size', 'comet' ),
			'type'    => 'select',
			'choices' => $font_sizes,
		)
	);

	$wp_customize->add_section(
		'comet_footer',
		array(
			'title'       => __( 'Comet Footer', 'comet' ),
			'description' => __( 'Use Additional CSS for custom styling and Site Identity for the logo.', 'comet' ),
			'priority'    => 33,
		)
	);

	$wp_customize->add_setting(
		'comet_footer_text',
		array(
			'default'           => $defaults['comet_footer_text'],
			'sanitize_callback' => 'comet_sanitize_footer_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'comet_footer_text',
		array(
			'section' => 'comet_footer',
			'label'   => __( 'Footer text', 'comet' ),
			'type'    => 'textarea',
		)
	);

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'comet_footer_text',
			array(
				'selector'        => '.site-footer__text',
				'render_callback' => 'comet_render_footer_text_partial',
			)
		);
	}
}
add_action( 'customize_register', 'comet_customize_register' );
