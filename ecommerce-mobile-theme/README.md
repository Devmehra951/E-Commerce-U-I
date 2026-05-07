# Ecommerce Mobile Theme

A production-oriented custom WordPress + WooCommerce theme for a CMS-driven mobile homepage experience.

## Important: install the correct folder

Copy **only** the `ecommerce-mobile-theme` folder into `wp-content/themes/`.
Do not activate the outer repository folder, for example `E-Commerce-U-I-main`, because WordPress will not load the theme files correctly from that parent folder.

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
  ├── acf-json/group_ecommerce_mobile_homepage.json
```

## Why the page was blank before

A fresh WordPress install often has no ACF option values, no hero image, no brand logos, and no WooCommerce products yet. The theme now includes starter fallbacks so the homepage is visible immediately after activation. After you save real values in **Mobile Homepage**, those admin values replace the starter content.


## Recheck status

This theme has been rechecked for fresh LocalWP/live-server activation. It includes:

- starter frontend content so activation does not show a blank page
- safe WooCommerce checks before product helper calls
- PHP syntax validation for all theme PHP files
- JSON validation for the bundled ACF export

## Required plugins for full editing

- WooCommerce
- ACF Pro, because this theme uses an options page and a repeater field

The frontend will no longer be blank if these plugins are missing, but the content will not be fully editable until they are installed and active.

## ACF setup

The theme registers its ACF Options Page and field group programmatically when ACF is active. An ACF JSON export is also included at `acf-json/group_ecommerce_mobile_homepage.json` if you prefer importing fields manually.

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

## Setup guide for LocalWP / live server

1. Copy `ecommerce-mobile-theme` to `wp-content/themes/`.
2. In WordPress admin, go to **Appearance → Themes**.
3. Activate **Ecommerce Mobile Theme**.
4. Install and activate:
   - WooCommerce
   - ACF Pro
5. Open **Mobile Homepage** in WordPress admin and save the fields.
6. Add at least two WooCommerce products with:
   - product title
   - product price
   - featured image
   - product category
7. Select the category in **Mobile Homepage → New Arrivals → Product Category**.
8. Go to **Settings → Reading** and choose your homepage. WordPress will use `front-page.php` automatically for the site front page.

## Dummy content example

- Announcement Text: Free shipping on all orders above $100
- Hero Heading: Find clothes that match your style
- Hero Subheading: Browse premium essentials and statement pieces curated for a modern wardrobe.
- Hero Button Text: Shop now
- Hero Button Link: `/shop`
- Section Title: New Arrivals
- Brand Logos: Upload five transparent logos


## PR platform note

This repository intentionally does not include a binary `screenshot.png` because the current PR system rejects binary files. If you want a WordPress theme thumbnail in **Appearance → Themes**, create a `1200x900` PNG locally and place it at `wp-content/themes/ecommerce-mobile-theme/screenshot.png` after copying the theme to your WordPress install. This optional image is not required for the theme to run.

## Troubleshooting

### Homepage is still empty
1. Confirm the active theme folder is exactly `ecommerce-mobile-theme`.
2. Clear any cache plugin or browser cache.
3. Confirm `front-page.php`, `header.php`, `footer.php`, and `template-parts/` are inside the active theme folder.
4. Save **Settings → Permalinks** once.
5. Add WooCommerce products or keep the setup placeholder cards until products are ready.

## Notes

- Brand logos use Swiper.js.
- Product cards use WooCommerce product data when products exist.
- Starter placeholders are only a first-run safety net and are replaced by ACF admin content.
- Images are lazy loaded where appropriate.
