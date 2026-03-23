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
	<?php
	$announcement_text = ecommerce_mobile_theme_has_acf() ? get_field( 'announcement_bar_text', 'option' ) : '';
	$header_logo       = ecommerce_mobile_theme_has_acf() ? get_field( 'header_logo', 'option' ) : '';
	?>

	<?php if ( ! empty( $announcement_text ) ) : ?>
		<div class="announcement-bar">
			<div class="mobile-container">
				<?php echo esc_html( $announcement_text ); ?>
			</div>
		</div>
	<?php endif; ?>

	<header class="site-header" role="banner">
		<div class="site-header__inner mobile-container">
			<div class="site-header__branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<?php if ( is_array( $header_logo ) && ! empty( $header_logo['url'] ) ) : ?>
						<img
							src="<?php echo esc_url( $header_logo['url'] ); ?>"
							alt="<?php echo esc_attr( $header_logo['alt'] ?: get_bloginfo( 'name' ) ); ?>"
							loading="eager"
						>
					<?php else : ?>
						<span><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
				</a>
			</div>

			<button class="site-header__menu-button" type="button" aria-label="<?php esc_attr_e( 'Open menu', 'ecommerce-mobile-theme' ); ?>">
				<span class="site-header__menu-line" aria-hidden="true"></span>
				<span class="site-header__menu-line" aria-hidden="true"></span>
				<span class="site-header__menu-line" aria-hidden="true"></span>
			</button>
		</div>
	</header>
