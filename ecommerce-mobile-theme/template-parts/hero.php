<?php
/**
 * Hero template.
 *
 * @package Ecommerce_Mobile_Theme
 */

$hero_image       = ecommerce_mobile_theme_get_raw_option( 'hero_image' );
$hero_heading     = ecommerce_mobile_theme_get_option( 'hero_heading' );
$hero_subheading  = ecommerce_mobile_theme_get_option( 'hero_subheading' );
$hero_button_text = ecommerce_mobile_theme_get_option( 'hero_button_text' );
$hero_button_link = ecommerce_mobile_theme_get_option( 'hero_button_link' );
?>
<section class="hero-section fade-in">
	<div class="hero-section__media<?php echo empty( $hero_image['url'] ) ? ' hero-section__media--fallback' : ''; ?>">
		<?php if ( ! empty( $hero_image['url'] ) ) : ?>
			<img class="hero-section__image" src="<?php echo esc_url( $hero_image['url'] ); ?>" alt="<?php echo esc_attr( ! empty( $hero_image['alt'] ) ? $hero_image['alt'] : $hero_heading ); ?>" loading="eager" decoding="async">
		<?php endif; ?>
		<div class="hero-section__overlay"></div>
	</div>
	<div class="hero-section__content section-block__inner">
		<?php if ( $hero_heading ) : ?>
			<h1 class="hero-section__title"><?php echo esc_html( $hero_heading ); ?></h1>
		<?php endif; ?>
		<?php if ( $hero_subheading ) : ?>
			<p class="hero-section__description"><?php echo esc_html( $hero_subheading ); ?></p>
		<?php endif; ?>
		<?php if ( $hero_button_text && $hero_button_link ) : ?>
			<a class="button button--primary" href="<?php echo esc_url( $hero_button_link ); ?>"><?php echo esc_html( $hero_button_text ); ?></a>
		<?php endif; ?>
	</div>
</section>
