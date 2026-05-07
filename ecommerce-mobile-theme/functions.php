<?php
/**
 * Main theme bootstrap.
 *
 * @package Ecommerce_Mobile_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ecommerce_mobile_theme_setup' ) ) {
	/**
	 * Register theme support.
	 */
	function ecommerce_mobile_theme_setup() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 64,
				'width'       => 180,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support( 'woocommerce' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	}
}
add_action( 'after_setup_theme', 'ecommerce_mobile_theme_setup' );

require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/acf-fields.php';

/**
 * Get a safe default shop URL for first-run CTA output.
 *
 * @return string
 */
function ecommerce_mobile_theme_get_default_shop_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$shop_url = wc_get_page_permalink( 'shop' );

		if ( $shop_url ) {
			return $shop_url;
		}
	}

	return home_url( '/' );
}

/**
 * Return starter values used only until the site owner saves real CMS content.
 *
 * These defaults prevent a blank homepage on a fresh LocalWP install. Every value
 * is replaced by the matching ACF option as soon as it is configured in admin.
 *
 * @return array<string,mixed>
 */
function ecommerce_mobile_theme_get_starter_content() {
	return array(
		'announcement_toggle' => true,
		'announcement_text'   => __( 'Free shipping on all orders over $100', 'ecommerce-mobile-theme' ),
		'hero_heading'        => __( 'Find clothes that match your style', 'ecommerce-mobile-theme' ),
		'hero_subheading'     => __( 'Browse premium essentials and statement pieces curated for a modern wardrobe.', 'ecommerce-mobile-theme' ),
		'hero_button_text'    => __( 'Shop now', 'ecommerce-mobile-theme' ),
		'hero_button_link'    => ecommerce_mobile_theme_get_default_shop_url(),
		'section_title'       => __( 'New Arrivals', 'ecommerce-mobile-theme' ),
		'brand_labels'        => array( 'VERSACE', 'ZARA', 'GUCCI', 'PRADA', 'Calvin Klein' ),
	);
}

/**
 * Read an ACF option field safely, with a startup fallback to prevent blanks.
 *
 * @param string $field_name Field key.
 * @return mixed
 */
function ecommerce_mobile_theme_get_option( $field_name ) {
	$value = null;

	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $field_name, 'option' );
	}

	if ( null !== $value && '' !== $value && array() !== $value ) {
		return $value;
	}

	$starter_content = ecommerce_mobile_theme_get_starter_content();

	return array_key_exists( $field_name, $starter_content ) ? $starter_content[ $field_name ] : null;
}

/**
 * Get raw ACF option value without starter fallbacks.
 *
 * @param string $field_name Field key.
 * @return mixed
 */
function ecommerce_mobile_theme_get_raw_option( $field_name ) {
	if ( function_exists( 'get_field' ) ) {
		return get_field( $field_name, 'option' );
	}

	return null;
}

/**
 * Determine whether the brand slider has uploaded logo images.
 *
 * @return bool
 */
function ecommerce_mobile_theme_has_brand_logos() {
	$brand_logos = ecommerce_mobile_theme_get_raw_option( 'brand_logos' );

	return ! empty( $brand_logos ) && is_array( $brand_logos );
}

/**
 * Render the best available header logo.
 *
 * @return void
 */
function ecommerce_mobile_theme_render_logo() {
	$header_logo = ecommerce_mobile_theme_get_raw_option( 'header_logo' );

	if ( ! empty( $header_logo['url'] ) ) {
		printf(
			'<img class="site-header__logo" src="%1$s" alt="%2$s" loading="eager" decoding="async">',
			esc_url( $header_logo['url'] ),
			esc_attr( ! empty( $header_logo['alt'] ) ? $header_logo['alt'] : get_bloginfo( 'name' ) )
		);

		return;
	}

	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	echo '<span class="site-header__logo-text">' . esc_html( get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : __( 'SHOP.CO', 'ecommerce-mobile-theme' ) ) . '</span>';
}

/**
 * Fetch the selected new-arrivals products.
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
		'no_found_rows'       => true,
	);

	$product_category = ecommerce_mobile_theme_get_raw_option( 'product_category' );

	if ( $product_category ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => absint( $product_category ),
			),
		);
	}

	return new WP_Query( $args );
}

/**
 * Show setup guidance in wp-admin when required plugins/content are missing.
 *
 * @return void
 */
function ecommerce_mobile_theme_admin_notice() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$missing = array();

	if ( ! function_exists( 'get_field' ) ) {
		$missing[] = __( 'ACF Pro', 'ecommerce-mobile-theme' );
	}

	if ( ! class_exists( 'WooCommerce' ) ) {
		$missing[] = __( 'WooCommerce', 'ecommerce-mobile-theme' );
	}

	if ( empty( $missing ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%1$s <strong>%2$s</strong>.</p></div>',
		esc_html__( 'Ecommerce Mobile Theme is active. For full dynamic editing, install and activate:', 'ecommerce-mobile-theme' ),
		esc_html( implode( ', ', $missing ) )
	);
}
add_action( 'admin_notices', 'ecommerce_mobile_theme_admin_notice' );
