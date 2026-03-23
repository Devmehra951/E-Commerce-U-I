<?php
/**
 * Theme functions and definitions.
 *
 * @package Ecommerce_Mobile_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ECOMMERCE_MOBILE_THEME_VERSION', '1.0.0' );
define( 'ECOMMERCE_MOBILE_THEME_PATH', get_template_directory() );
define( 'ECOMMERCE_MOBILE_THEME_URI', get_template_directory_uri() );

add_action( 'after_setup_theme', 'ecommerce_mobile_theme_setup' );
/**
 * Register theme supports.
 *
 * @return void
 */
function ecommerce_mobile_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'script', 'style' ) );
	add_theme_support( 'woocommerce' );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'ecommerce-mobile-theme' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'ecommerce_mobile_theme_assets' );
/**
 * Enqueue assets.
 *
 * @return void
 */
function ecommerce_mobile_theme_assets() {
	wp_enqueue_style( 'ecommerce-mobile-theme-style', get_stylesheet_uri(), array(), ECOMMERCE_MOBILE_THEME_VERSION );

	$use_swiper = ecommerce_mobile_theme_has_brand_logos() && count( ecommerce_mobile_theme_get_brand_logos() ) > 3;

	if ( $use_swiper ) {
		wp_enqueue_style(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
			array(),
			'11.1.1'
		);

		wp_enqueue_script(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
			array(),
			'11.1.1',
			true
		);
	}

	wp_enqueue_script(
		'ecommerce-mobile-theme-main',
		ECOMMERCE_MOBILE_THEME_URI . '/assets/js/theme.js',
		$use_swiper ? array( 'swiper' ) : array(),
		ECOMMERCE_MOBILE_THEME_VERSION,
		true
	);

	wp_localize_script(
		'ecommerce-mobile-theme-main',
		'ecommerceMobileTheme',
		array(
			'useSwiper' => $use_swiper,
		)
	);
}

add_action( 'acf/init', 'ecommerce_mobile_theme_register_options_page' );
add_action( 'acf/init', 'ecommerce_mobile_theme_register_field_group' );
/**
 * Register local ACF field group for theme settings.
 *
 * @return void
 */
function ecommerce_mobile_theme_register_field_group() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_ecommerce_mobile_theme_settings',
			'title'  => __( 'Ecommerce Mobile Theme Settings', 'ecommerce-mobile-theme' ),
			'fields' => array(
				array(
					'key'   => 'field_announcement_bar_text',
					'label' => __( 'Announcement Bar Text', 'ecommerce-mobile-theme' ),
					'name'  => 'announcement_bar_text',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_header_logo',
					'label'         => __( 'Header Logo', 'ecommerce-mobile-theme' ),
					'name'          => 'header_logo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
				),
				array(
					'key'           => 'field_hero_image',
					'label'         => __( 'Hero Image', 'ecommerce-mobile-theme' ),
					'name'          => 'hero_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'large',
					'library'       => 'all',
				),
				array(
					'key'   => 'field_hero_heading',
					'label' => __( 'Hero Heading', 'ecommerce-mobile-theme' ),
					'name'  => 'hero_heading',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_hero_subheading',
					'label' => __( 'Hero Subheading', 'ecommerce-mobile-theme' ),
					'name'  => 'hero_subheading',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_hero_button_text',
					'label' => __( 'Hero Button Text', 'ecommerce-mobile-theme' ),
					'name'  => 'hero_button_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_hero_button_link',
					'label' => __( 'Hero Button Link', 'ecommerce-mobile-theme' ),
					'name'  => 'hero_button_link',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_brand_section_title',
					'label' => __( 'Brand Section Title', 'ecommerce-mobile-theme' ),
					'name'  => 'brand_section_title',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_brand_logos',
					'label'        => __( 'Brand Logos', 'ecommerce-mobile-theme' ),
					'name'         => 'brand_logos',
					'type'         => 'repeater',
					'layout'       => 'table',
					'button_label' => __( 'Add Logo', 'ecommerce-mobile-theme' ),
					'sub_fields'   => array(
						array(
							'key'           => 'field_brand_logo_image',
							'label'         => __( 'Logo Image', 'ecommerce-mobile-theme' ),
							'name'          => 'logo_image',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
							'library'       => 'all',
						),
					),
				),
				array(
					'key'   => 'field_new_arrivals_title',
					'label' => __( 'New Arrivals Section Title', 'ecommerce-mobile-theme' ),
					'name'  => 'new_arrivals_title',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_new_arrivals_category',
					'label'        => __( 'New Arrivals Category', 'ecommerce-mobile-theme' ),
					'name'         => 'new_arrivals_category',
					'type'         => 'taxonomy',
					'taxonomy'     => 'product_cat',
					'field_type'   => 'select',
					'return_format'=> 'object',
					'add_term'     => 0,
					'save_terms'   => 0,
					'load_terms'   => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'ecommerce-mobile-theme-settings',
					),
				),
			),
		)
	);
}

/**
 * Register ACF options page.
 *
 * @return void
 */
function ecommerce_mobile_theme_register_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Theme Settings', 'ecommerce-mobile-theme' ),
			'menu_title' => __( 'Theme Settings', 'ecommerce-mobile-theme' ),
			'menu_slug'  => 'ecommerce-mobile-theme-settings',
			'capability' => 'manage_options',
			'redirect'   => false,
		)
	);
}

/**
 * Check whether ACF is active.
 *
 * @return bool
 */
function ecommerce_mobile_theme_has_acf() {
	return function_exists( 'get_field' );
}

/**
 * Get brand logos from options.
 *
 * @return array<int, mixed>
 */
function ecommerce_mobile_theme_get_brand_logos() {
	if ( ! ecommerce_mobile_theme_has_acf() ) {
		return array();
	}

	$logos = get_field( 'brand_logos', 'option' );

	return is_array( $logos ) ? $logos : array();
}

/**
 * Determine whether logos exist.
 *
 * @return bool
 */
function ecommerce_mobile_theme_has_brand_logos() {
	return ! empty( ecommerce_mobile_theme_get_brand_logos() );
}

/**
 * Get hero image URL.
 *
 * @return string
 */
function ecommerce_mobile_theme_get_hero_image_url() {
	if ( ! ecommerce_mobile_theme_has_acf() ) {
		return '';
	}

	$image = get_field( 'hero_image', 'option' );

	if ( is_array( $image ) && ! empty( $image['sizes']['large'] ) ) {
		return $image['sizes']['large'];
	}

	if ( is_array( $image ) && ! empty( $image['url'] ) ) {
		return $image['url'];
	}

	return '';
}

/**
 * Get new arrivals products.
 *
 * @return WP_Query
 */
function ecommerce_mobile_theme_get_new_arrivals_query() {
	$args = array(
		'post_type'           => 'product',
		'post_status'         => 'publish',
		'posts_per_page'      => 2,
		'ignore_sticky_posts' => true,
		'orderby'             => 'date',
		'order'               => 'DESC',
	);

	if ( ecommerce_mobile_theme_has_acf() ) {
		$selected_category = get_field( 'new_arrivals_category', 'option' );

		if ( $selected_category instanceof WP_Term ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => array( $selected_category->term_id ),
				),
			);
		} elseif ( is_numeric( $selected_category ) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => array( (int) $selected_category ),
				),
			);
		}
	}

	return new WP_Query( $args );
}
