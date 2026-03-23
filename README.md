# Ecommerce Mobile Theme

A custom WordPress theme for recreating a mobile-first e-commerce homepage from the announcement bar through the New Arrivals section.

## Included files
- `style.css`
- `functions.php`
- `index.php`
- `front-page.php`
- `header.php`
- `footer.php`
- `template-parts/section-hero.php`
- `template-parts/section-brands.php`
- `template-parts/section-new-arrivals.php`
- `assets/js/theme.js`

## ACF field setup
Create an ACF field group assigned to **Options Page** with these fields:

1. `announcement_bar_text` — Text
2. `header_logo` — Image
3. `hero_image` — Image
4. `hero_heading` — Text
5. `hero_subheading` — Textarea or Text
6. `hero_button_text` — Text
7. `hero_button_link` — URL
8. `brand_section_title` — Text (optional)
9. `brand_logos` — Repeater
   - Sub field: `logo_image` — Image
10. `new_arrivals_title` — Text
11. `new_arrivals_category` — Taxonomy
   - Taxonomy: `product_cat`
   - Return format: `Term Object`
   - Field type: Select

## Setup guide
1. Copy the theme folder into `wp-content/themes/ecommerce-mobile-theme`.
2. Install and activate **Advanced Custom Fields**.
3. Install and activate **WooCommerce**.
4. Activate the theme in **Appearance > Themes**.
5. Go to **Theme Settings** in the WordPress admin and populate the option fields.
6. Create or import WooCommerce products and assign them to the selected category.
7. Set a static homepage under **Settings > Reading** and assign the homepage to use the front page template.

## Sample dummy content
- Announcement bar text: `Free shipping on orders over $150`
- Hero heading: `Discover the latest essentials`
- Hero subheading: `Curated designer pieces for your everyday wardrobe.`
- Hero button text: `Shop now`
- Brand section title: `Featured Brands`
- Brand logos: Upload 4–6 transparent PNG/SVG logo assets
- New arrivals title: `New Arrivals`
- New arrivals category: `new-arrivals`
