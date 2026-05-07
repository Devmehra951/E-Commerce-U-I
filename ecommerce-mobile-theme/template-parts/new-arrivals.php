<?php
/**
 * New arrivals template.
 *
 * @package Ecommerce_Mobile_Theme
 */

$section_title = ecommerce_mobile_theme_get_option( 'section_title' );
$products      = ecommerce_mobile_theme_get_new_arrivals_query();
?>
<section class="new-arrivals-section fade-in">
	<div class="section-block__inner">
		<?php if ( $section_title ) : ?>
			<header class="section-heading">
				<h2 class="section-heading__title"><?php echo esc_html( $section_title ); ?></h2>
			</header>
		<?php endif; ?>

		<?php if ( $products->have_posts() ) : ?>
			<div class="new-arrivals-section__grid">
				<?php while ( $products->have_posts() ) : ?>
					<?php
					$products->the_post();
					$product_object = function_exists( 'wc_get_product' ) ? wc_get_product( get_the_ID() ) : null;
					?>
					<article <?php post_class( 'product-card' ); ?>>
						<a class="product-card__link" href="<?php the_permalink(); ?>">
							<div class="product-card__media product-card__media--skeleton">
								<?php if ( has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( 'woocommerce_thumbnail', array( 'class' => 'product-card__image', 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
								<?php elseif ( function_exists( 'wc_placeholder_img' ) ) : ?>
									<?php echo wc_placeholder_img( 'woocommerce_thumbnail', array( 'class' => 'product-card__image' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php endif; ?>
							</div>
							<div class="product-card__content">
								<h3 class="product-card__title"><?php the_title(); ?></h3>
								<?php if ( $product_object ) : ?>
									<div class="product-card__price"><?php echo wp_kses_post( $product_object->get_price_html() ); ?></div>
								<?php endif; ?>
							</div>
						</a>
					</article>
				<?php endwhile; ?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<div class="new-arrivals-section__empty" role="status">
				<div class="product-card product-card--placeholder">
					<div class="product-card__media product-card__media--skeleton"></div>
					<div class="product-card__content">
						<h3 class="product-card__title"><?php esc_html_e( 'Add your first product', 'ecommerce-mobile-theme' ); ?></h3>
						<p class="product-card__hint"><?php esc_html_e( 'WooCommerce products will appear here automatically.', 'ecommerce-mobile-theme' ); ?></p>
					</div>
				</div>
				<div class="product-card product-card--placeholder">
					<div class="product-card__media product-card__media--skeleton"></div>
					<div class="product-card__content">
						<h3 class="product-card__title"><?php esc_html_e( 'Select a product category', 'ecommerce-mobile-theme' ); ?></h3>
						<p class="product-card__hint"><?php esc_html_e( 'Choose it in Mobile Homepage settings.', 'ecommerce-mobile-theme' ); ?></p>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
