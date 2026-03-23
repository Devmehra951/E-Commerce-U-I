<?php
/**
 * Brands template.
 *
 * @package Ecommerce_Mobile_Theme
 */

$brand_logos = ecommerce_mobile_theme_get_option( 'brand_logos' );

if ( empty( $brand_logos ) || ! is_array( $brand_logos ) ) {
	return;
}
?>
<section class="brands-section fade-in">
	<div class="section-block__inner">
		<div class="brands-section__slider swiper js-brands-slider">
			<div class="swiper-wrapper">
				<?php foreach ( $brand_logos as $brand_logo ) : ?>
					<?php if ( empty( $brand_logo['logo_image']['url'] ) ) : ?>
						<?php continue; ?>
					<?php endif; ?>
					<div class="swiper-slide brands-section__slide">
						<div class="brands-section__card">
							<img class="brands-section__image" src="<?php echo esc_url( $brand_logo['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( ! empty( $brand_logo['logo_image']['alt'] ) ? $brand_logo['logo_image']['alt'] : get_bloginfo( 'name' ) ); ?>" loading="lazy" decoding="async">
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
