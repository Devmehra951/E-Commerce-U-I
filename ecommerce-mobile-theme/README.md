# Ecommerce Mobile Theme

A production-oriented custom WordPress + WooCommerce theme for a CMS-driven mobile homepage experience.

## Theme structure

```text
/ecommerce-mobile-theme
  ├── style.css
  ├── functions.php
  ├── front-page.php
  ├── header.php
  ├── footer.php
  ├── inc/
  │    ├── acf-fields.php
  │    ├── enqueue.php
  ├── template-parts/
  │    ├── announcement-bar.php
  │    ├── hero.php
  │    ├── brands.php
  │    ├── new-arrivals.php
  ├── assets/js/theme.js
```

## ACF setup

The theme registers its ACF Options Page and field group programmatically when ACF is active.

### Options page
- Mobile Homepage

### Fields
#### Announcement Bar
- `announcement_toggle` (true / false)
- `announcement_text` (text)

#### Header
- `header_logo` (image)

#### Hero
- `hero_image` (image)
- `hero_heading` (text)
- `hero_subheading` (textarea)
- `hero_button_text` (text)
- `hero_button_link` (url)

#### Brands
- `brand_logos` (repeater)
  - `logo_image` (image)

#### New Arrivals
- `section_title` (text)
- `product_category` (taxonomy selector for `product_cat`)

## Setup guide
1. Copy `ecommerce-mobile-theme` to `wp-content/themes/`.
2. Activate **Ecommerce Mobile Theme** from **Appearance → Themes**.
3. Install and activate:
   - WooCommerce
   - ACF Pro
4. Open **Mobile Homepage** in WordPress admin and fill in the section fields.
5. Create WooCommerce products with featured images, prices, and a product category.
6. Select that category in **Mobile Homepage → New Arrivals → Product Category**.
7. Set a static homepage in **Settings → Reading** so WordPress uses `front-page.php`.

## Dummy content example
- Announcement Text: Free shipping on all orders above $100
- Hero Heading: Elevate your everyday wardrobe
- Hero Subheading: Premium essentials crafted for modern, mobile-first shopping.
- Hero Button Text: Shop now
- Hero Button Link: `/shop`
- Section Title: New Arrivals
- Brand Logos: Upload five transparent logos

## Notes
- Brand logos use Swiper.js when available.
- Product cards use WooCommerce product data only.
- Images are lazy loaded where appropriate.
