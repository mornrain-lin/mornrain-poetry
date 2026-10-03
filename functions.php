<?php
/**
 * MornRain Poetry functions and definitions.
 *
 * @package MornRain_Poetry
 * @since   1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! defined( 'MORNRAIN_POETRY_VERSION' ) ) {
	define( 'MORNRAIN_POETRY_VERSION', '1.0.0' );
}

if ( ! function_exists( 'mornrain_poetrysetup' ) ) :
	/**
	 * Register theme defaults and WordPress feature support.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function mornrain_poetrysetup() {
		load_theme_textdomain( 'mornrain-poetry', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 64,
				'width'       => 240,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'mornrain-poetry' ),
				'footer'  => __( 'Footer Menu', 'mornrain-poetry' ),
			)
		);

		add_theme_support( 'editor-styles' );
		add_editor_style( 'assets/css/main.css' );
	}
endif;
add_action( 'after_setup_theme', 'mornrain_poetrysetup' );

if ( ! function_exists( 'mornrain_poetryscripts' ) ) :
	/**
	 * Enqueue front-end styles and scripts.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function mornrain_poetryscripts() {
		wp_enqueue_style(
			'mornrain-poetry',
			get_stylesheet_uri(),
			array(),
			MORNRAIN_POETRY_VERSION
		);

		wp_enqueue_style(
			'mornrain-poetry-main',
			get_template_directory_uri() . '/assets/css/main.css',
			array( 'mornrain-poetry' ),
			MORNRAIN_POETRY_VERSION
		);

		wp_enqueue_script(
			'mornrain-poetry-main',
			get_template_directory_uri() . '/assets/js/main.js',
			array(),
			MORNRAIN_POETRY_VERSION,
			true
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'mornrain_poetryscripts' );

if ( ! function_exists( 'mornrain_poetryexcerpt_length' ) ) :
	/**
	 * Filter the excerpt length.
	 *
	 * @since 1.0.0
	 * @param int $length Default excerpt length in words.
	 * @return int
	 */
	function mornrain_poetryexcerpt_length( $length ) {
		return 30;
	}
endif;
add_filter( 'excerpt_length', 'mornrain_poetryexcerpt_length' );

if ( ! function_exists( 'mornrain_poetryexcerpt_more' ) ) :
	/**
	 * Filter the excerpt "read more" suffix.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function mornrain_poetryexcerpt_more() {
		return '&hellip;';
	}
endif;
add_filter( 'excerpt_more', 'mornrain_poetryexcerpt_more' );

if ( ! function_exists( 'mornrain_poetrypingback_header' ) ) :
	/**
	 * Add the pingback link to the document head when needed.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	function mornrain_poetrypingback_header() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}
endif;
add_action( 'wp_head', 'mornrain_poetrypingback_header' );
