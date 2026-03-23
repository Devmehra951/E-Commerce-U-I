<?php
/**
 * ACF field registration.
 *
 * @package Ecommerce_Mobile_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the theme options page.
 *
 * @return void
 */
function ecommerce_mobile_theme_register_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Mobile Homepage Settings', 'ecommerce-mobile-theme' ),
			'menu_title' => __( 'Mobile Homepage', 'ecommerce-mobile-theme' ),
			'menu_slug'  => 'ecommerce-mobile-theme-settings',
			'capability' => 'manage_options',
			'redirect'   => false,
		)
	);
}
add_action( 'acf/init', 'ecommerce_mobile_theme_register_options_page' );

/**
 * Register local ACF fields for the theme.
 *
 * @return void
 */
function ecommerce_mobile_theme_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_ecommerce_mobile_homepage',
			'title'  => __( 'Mobile Homepage Content', 'ecommerce-mobile-theme' ),
			'fields' => array(
				array(
					'key'   => 'field_emt_tab_announcement',
					'label' => __( 'Announcement Bar', 'ecommerce-mobile-theme' ),
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_emt_announcement_toggle',
					'label'         => __( 'Show Announcement Bar', 'ecommerce-mobile-theme' ),
					'name'          => 'announcement_toggle',
					'type'          => 'true_false',
					'ui'            => 1,
					'default_value' => 1,
				),
				array(
					'key'   => 'field_emt_announcement_text',
					'label' => __( 'Announcement Text', 'ecommerce-mobile-theme' ),
					'name'  => 'announcement_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_emt_tab_header',
					'label' => __( 'Header', 'ecommerce-mobile-theme' ),
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_emt_header_logo',
					'label'         => __( 'Header Logo', 'ecommerce-mobile-theme' ),
					'name'          => 'header_logo',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'   => 'field_emt_tab_hero',
					'label' => __( 'Hero', 'ecommerce-mobile-theme' ),
					'type'  => 'tab',
				),
				array(
					'key'           => 'field_emt_hero_image',
					'label'         => __( 'Hero Background Image', 'ecommerce-mobile-theme' ),
					'name'          => 'hero_image',
					'type'          => 'image',
					'return_format' => 'array',
				),
				array(
					'key'   => 'field_emt_hero_heading',
					'label' => __( 'Hero Heading', 'ecommerce-mobile-theme' ),
					'name'  => 'hero_heading',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_emt_hero_subheading',
					'label' => __( 'Hero Subheading', 'ecommerce-mobile-theme' ),
					'name'  => 'hero_subheading',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_emt_hero_button_text',
					'label' => __( 'Hero Button Text', 'ecommerce-mobile-theme' ),
					'name'  => 'hero_button_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_emt_hero_button_link',
					'label' => __( 'Hero Button Link', 'ecommerce-mobile-theme' ),
					'name'  => 'hero_button_link',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_emt_tab_brands',
					'label' => __( 'Brands', 'ecommerce-mobile-theme' ),
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_emt_brand_logos',
					'label'        => __( 'Brand Logos', 'ecommerce-mobile-theme' ),
					'name'         => 'brand_logos',
					'type'         => 'repeater',
					'layout'       => 'row',
					'button_label' => __( 'Add Brand Logo', 'ecommerce-mobile-theme' ),
					'sub_fields'   => array(
						array(
							'key'           => 'field_emt_logo_image',
							'label'         => __( 'Logo Image', 'ecommerce-mobile-theme' ),
							'name'          => 'logo_image',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'medium',
						),
					),
				),
				array(
					'key'   => 'field_emt_tab_arrivals',
					'label' => __( 'New Arrivals', 'ecommerce-mobile-theme' ),
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_emt_section_title',
					'label' => __( 'Section Title', 'ecommerce-mobile-theme' ),
					'name'  => 'section_title',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_emt_product_category',
					'label'         => __( 'Product Category', 'ecommerce-mobile-theme' ),
					'name'          => 'product_category',
					'type'          => 'taxonomy',
					'taxonomy'      => 'product_cat',
					'field_type'    => 'select',
					'return_format' => 'id',
					'allow_null'    => 1,
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
add_action( 'acf/init', 'ecommerce_mobile_theme_register_acf_fields' );
