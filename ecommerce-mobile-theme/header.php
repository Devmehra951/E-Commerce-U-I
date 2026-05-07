<?php
/**
 * Header template.
 *
 * @package Ecommerce_Mobile_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="site-shell">
	<?php get_template_part( 'template-parts/announcement-bar' ); ?>
	<header class="site-header">
		<div class="site-header__inner">
			<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<?php ecommerce_mobile_theme_render_logo(); ?>
			</a>
			<button class="site-header__menu-button" type="button" aria-label="<?php esc_attr_e( 'Open menu', 'ecommerce-mobile-theme' ); ?>">
				<span class="site-header__menu-icon" aria-hidden="true"></span>
			</button>
		</div>
	</header>
	<main class="site-main" id="primary">
