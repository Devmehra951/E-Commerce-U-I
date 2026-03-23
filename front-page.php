<?php
/**
 * Front page template.
 *
 * @package Ecommerce_Mobile_Theme
 */

get_header();
?>
<main id="primary" class="site-main mobile-container">
	<?php get_template_part( 'template-parts/section', 'hero' ); ?>
	<?php get_template_part( 'template-parts/section', 'brands' ); ?>
	<?php get_template_part( 'template-parts/section', 'new-arrivals' ); ?>
</main>
<?php
get_footer();
