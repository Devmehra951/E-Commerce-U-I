<?php
/**
 * Announcement bar template.
 *
 * @package Ecommerce_Mobile_Theme
 */

$announcement_toggle = ecommerce_mobile_theme_get_option( 'announcement_toggle' );
$announcement_text   = ecommerce_mobile_theme_get_option( 'announcement_text' );

if ( empty( $announcement_toggle ) || empty( $announcement_text ) ) {
	return;
}
?>
<section class="announcement-bar fade-in">
	<div class="announcement-bar__inner">
		<p class="announcement-bar__text"><?php echo esc_html( $announcement_text ); ?></p>
	</div>
</section>
