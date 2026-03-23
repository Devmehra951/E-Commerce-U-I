<?php
/**
 * Theme asset loading.
 *
 * @package Ecommerce_Mobile_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue frontend assets.
 *
 * @return void
 */
function ecommerce_mobile_theme_enqueue_assets() {
	$theme = wp_get_theme();

	wp_enqueue_style( 'ecommerce-mobile-theme-style', get_stylesheet_uri(), array(), $theme->get( 'Version' ) );
	wp_enqueue_style( 'ecommerce-mobile-theme-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', array(), null );

	$script_dependencies = array();

	if ( ecommerce_mobile_theme_has_brand_logos() ) {
		wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.2.6' );
		wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.2.6', true );
		$script_dependencies[] = 'swiper';
	}

	wp_enqueue_script(
		'ecommerce-mobile-theme-script',
		get_template_directory_uri() . '/assets/js/theme.js',
		$script_dependencies,
		$theme->get( 'Version' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ecommerce_mobile_theme_enqueue_assets' );
