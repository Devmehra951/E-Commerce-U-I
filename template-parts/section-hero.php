<?php
/**
 * Hero section template.
 *
 * @package Ecommerce_Mobile_Theme
 */

$hero_heading    = ecommerce_mobile_theme_has_acf() ? get_field( 'hero_heading', 'option' ) : '';
$hero_subheading = ecommerce_mobile_theme_has_acf() ? get_field( 'hero_subheading', 'option' ) : '';
$hero_button     = ecommerce_mobile_theme_has_acf() ? get_field( 'hero_button_text', 'option' ) : '';
$hero_link       = ecommerce_mobile_theme_has_acf() ? get_field( 'hero_button_link', 'option' ) : '';
$hero_image_url  = ecommerce_mobile_theme_get_hero_image_url();
$hero_style      = $hero_image_url ? sprintf( 'style="background-image: url(%s);"', esc_url( $hero_image_url ) ) : '';
?>
<section class="hero fade-in" aria-labelledby="hero-title">
	<div class="hero__card" <?php echo wp_kses_post( $hero_style ); ?>>
		<div class="hero__content">
			<?php if ( ! empty( $hero_subheading ) ) : ?>
				<p class="hero__eyebrow"><?php echo esc_html( $hero_subheading ); ?></p>
			<?php endif; ?>

			<?php if ( ! empty( $hero_heading ) ) : ?>
				<h1 id="hero-title" class="hero__title"><?php echo esc_html( $hero_heading ); ?></h1>
			<?php endif; ?>

			<?php if ( ! empty( $hero_button ) && ! empty( $hero_link ) ) : ?>
				<a class="hero__button" href="<?php echo esc_url( $hero_link ); ?>">
					<?php echo esc_html( $hero_button ); ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</section>
