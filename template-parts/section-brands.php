<?php
/**
 * Brand logos section template.
 *
 * @package Ecommerce_Mobile_Theme
 */

$brand_logos          = ecommerce_mobile_theme_get_brand_logos();
$brand_section_title = ecommerce_mobile_theme_has_acf() ? get_field( 'brand_section_title', 'option' ) : '';

if ( empty( $brand_logos ) ) {
	return;
}

$use_swiper_class = count( $brand_logos ) > 3 ? ' swiper' : '';
$wrapper_class    = count( $brand_logos ) > 3 ? 'swiper-wrapper' : 'brand-slider__track';
$item_class       = count( $brand_logos ) > 3 ? 'brand-slider__item swiper-slide' : 'brand-slider__item';
?>
<section class="site-section brand-slider fade-in" aria-labelledby="brand-logos-title">
	<?php if ( ! empty( $brand_section_title ) ) : ?>
		<h2 id="brand-logos-title" class="site-section__title"><?php echo esc_html( $brand_section_title ); ?></h2>
	<?php else : ?>
		<span id="brand-logos-title" class="screen-reader-text"><?php esc_html_e( 'Brand logos', 'ecommerce-mobile-theme' ); ?></span>
	<?php endif; ?>
	<div class="brand-slider__viewport<?php echo esc_attr( $use_swiper_class ); ?>">
		<div class="<?php echo esc_attr( $wrapper_class ); ?>">
			<?php foreach ( $brand_logos as $logo_row ) : ?>
				<?php if ( empty( $logo_row['logo_image']['url'] ) ) : ?>
					<?php continue; ?>
				<?php endif; ?>

				<div class="<?php echo esc_attr( $item_class ); ?>">
					<img
						src="<?php echo esc_url( $logo_row['logo_image']['url'] ); ?>"
						alt="<?php echo esc_attr( $logo_row['logo_image']['alt'] ?: __( 'Brand logo', 'ecommerce-mobile-theme' ) ); ?>"
						loading="lazy"
					>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
