<?php
/**
 * New arrivals section template.
 *
 * @package Ecommerce_Mobile_Theme
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$new_arrivals_title = ecommerce_mobile_theme_has_acf() ? get_field( 'new_arrivals_title', 'option' ) : '';
$new_arrivals_query = ecommerce_mobile_theme_get_new_arrivals_query();
?>
<section class="site-section new-arrivals fade-in" aria-labelledby="new-arrivals-title">
	<h2 id="new-arrivals-title" class="site-section__title">
		<?php echo esc_html( $new_arrivals_title ? $new_arrivals_title : __( 'New Arrivals', 'ecommerce-mobile-theme' ) ); ?>
	</h2>

	<?php if ( $new_arrivals_query->have_posts() ) : ?>
		<div class="new-arrivals__grid">
			<?php while ( $new_arrivals_query->have_posts() ) : ?>
				<?php $new_arrivals_query->the_post(); ?>
				<?php $product = wc_get_product( get_the_ID() ); ?>

				<?php if ( ! $product ) : ?>
					<?php continue; ?>
				<?php endif; ?>

				<article <?php post_class( 'product-card' ); ?>>
					<a href="<?php the_permalink(); ?>" class="product-card__media" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail(
								'medium_large',
								array(
									'loading' => 'lazy',
								)
							);
						}
						?>
					</a>
					<div class="product-card__content">
						<h3 class="product-card__title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<p class="product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Add products to the selected category to populate this section.', 'ecommerce-mobile-theme' ); ?></p>
	<?php endif; ?>
</section>
