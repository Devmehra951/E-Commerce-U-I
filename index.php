<?php
/**
 * Main fallback template.
 *
 * @package Ecommerce_Mobile_Theme
 */

get_header();
?>
<main id="primary" class="site-main mobile-container site-section">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="site-section__title"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
			</article>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No content found.', 'ecommerce-mobile-theme' ); ?></p>
	<?php endif; ?>
</main>
<?php
get_footer();
