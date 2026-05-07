<?php
/**
 * Brands template.
 *
 * @package Ecommerce_Mobile_Theme
 */

$brand_logos  = ecommerce_mobile_theme_get_raw_option( 'brand_logos' );
$brand_labels = ecommerce_mobile_theme_get_option( 'brand_labels' );

if ( empty( $brand_logos ) && empty( $brand_labels ) ) {
	return;
}
?>
<section class="brands-section fade-in">
	<div class="section-block__inner">
		<div class="brands-section__slider swiper js-brands-slider">
			<div class="swiper-wrapper">
				<?php if ( ! empty( $brand_logos ) && is_array( $brand_logos ) ) : ?>
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
				<?php elseif ( is_array( $brand_labels ) ) : ?>
					<?php foreach ( $brand_labels as $brand_label ) : ?>
						<div class="swiper-slide brands-section__slide">
							<div class="brands-section__card brands-section__card--text">
								<span class="brands-section__label"><?php echo esc_html( $brand_label ); ?></span>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
