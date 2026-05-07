<?php
/**
 * Index fallback template.
 *
 * @package Ecommerce_Mobile_Theme
 */

get_header();
?>
<section class="content-list section-block">
	<div class="section-block__inner">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article <?php post_class( 'content-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="content-card__media" href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'large', array( 'class' => 'content-card__image', 'loading' => 'lazy', 'decoding' => 'async' ) ); ?>
						</a>
					<?php endif; ?>
					<div class="content-card__body">
						<h1 class="content-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					</div>
				</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
