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
 * Read an ACF option field safely.
 *
 * @param string $field_name Field key.
 * @return mixed
 */
function ecommerce_mobile_theme_get_option( $field_name ) {
	if ( function_exists( 'get_field' ) ) {
		return get_field( $field_name, 'option' );
	}

	return null;
}

/**
 * Determine whether the brand slider has items.
 *
 * @return bool
 */
function ecommerce_mobile_theme_has_brand_logos() {
	$brand_logos = ecommerce_mobile_theme_get_option( 'brand_logos' );

	return ! empty( $brand_logos ) && is_array( $brand_logos );
}

/**
 * Render the best available header logo.
 *
 * @return void
 */
function ecommerce_mobile_theme_render_logo() {
	$header_logo = ecommerce_mobile_theme_get_option( 'header_logo' );

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

	echo '<span class="site-header__logo-text">' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
}

/**
 * Fetch the selected new-arrivals products.
 *
 * @return WP_Query
 */
function ecommerce_mobile_theme_get_new_arrivals_query() {
	$args = array(
		'post_type'              => 'product',
		'post_status'            => 'publish',
		'posts_per_page'         => 2,
		'ignore_sticky_posts'    => true,
		'orderby'                => 'date',
		'order'                  => 'DESC',
		'no_found_rows'          => true,
		'update_post_meta_cache' => false,
		'update_post_term_cache' => false,
	);

	$product_category = ecommerce_mobile_theme_get_option( 'product_category' );

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
