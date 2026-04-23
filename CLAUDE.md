# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Environment

This is a **WordPress installation** running locally via **DevKinsta**. The active theme is the **Anchor Framework** parent/child theme system at `wp-content/themes/`.

- **WordPress root**: `/Users/bif/DevKinsta/public/test-theme-deka/`
- **PHP version**: 7.4+ required
- **WordPress version**: 6.4+ required, tested up to 6.8
- **Database**: MySQL via DevKinsta (`DB_NAME: testthemedeka`)
- **Local site URL**: `https://testthemedeka.local` (managed by DevKinsta)

There is no build step, package manager, or test framework. This is a classic PHP WordPress theme — edit files and reload.

## Architecture: Anchor Framework

A **config-first WordPress theme system** with a reusable parent theme and a client-specific child theme.

### Parent Theme (`anchor-framework/`)

The rendering engine. Contains all templates, components, CSS, and JS.

**Data flow (config path):** Page load → `anchor_determine_page_slug()` → `anchor_load_page_content($slug)` check → if `page-content/{slug}.php` exists, include it directly; otherwise → `anchor_get_page_config($slug)` → `anchor_render_sections($config['sections'])` → for each section: validate → resolve media → `get_template_part()` → section accesses data via `anchor_get_template_data()`.

The direct-PHP path is now the **active development paradigm** for bespoke pages. Config-driven sections remain for pages not yet migrated.

**Key directories:**
- `inc/` — Engine files: config-loader, section-renderer, media-resolver, helpers, validation, **page-content-loader** + nav walker classes (`class-anchor-nav-walker.php`, `class-anchor-footer-walker.php`, `class-anchor-mobile-walker.php`)
- `template-parts/sections/` — Framework sections: hero, split-content, iso-split, card-grid, icon-list, cta-band, team-grid, services-tabs, testimonial-band, faq-list, contact-block, gallery-band, text-block, shortcode-block. **Deka editorial sections**: deka-hero, deka-manifesto, deka-capabilities, deka-lineup, deka-flagship, deka-showcase, deka-outcomes, deka-voices, deka-trust, deka-final
- `template-parts/components/` — Reusable components (button, button-group, heading-group, image-wrapper, card, icon-item, quote-item, section-intro, content-sidebar, hero-carousel, rotating-text, sticky-footer)
- `template-parts/navigation/` — Header nav (fixed pill) and footer nav
- `template-parts/partials/` — Reusable PHP snippets (cta-band.php, testimonials.php); rendered inline, not via `get_template_part()`
- `assets/css/` — Design token system (see CSS section below)
- `assets/js/` — scroll-reveal.js (IntersectionObserver + FAQ accordion + Services tabs + Expanding CTA), navigation.js (mobile menu, scroll behaviors)

**Page templates:**
- `front-page.php` — Checks for `page-content/home.php`; falls back to config-driven sections
- `page.php` — Checks for `page-content/{slug}.php`; falls back to config-driven sections
- `home.php` — Blog posts page (featured hero + grid + sidebar)
- `archive.php` — Category/tag archives (same as home.php)
- `single.php` — Blog post (hero + article + sidebar + related)
- `single-anchor_event.php` — Event post
- `archive-anchor_event.php` — Events archive
- `search.php`, `404.php`, `index.php` — Utility templates

### Child Theme (`anchor-starter-child/`)

Client-specific configuration and direct-PHP page content. The source of truth for all content and branding.

**Config files (`config/`):**
- `site.php` — Business name, contact, social links, default CTA
- `navigation.php` — Header/footer nav structure
- `globals.php` — Reusable section definitions (referenced as `'global:cta_band'` in page configs)
- `media.php` — Static media registry (key → URL/attachment ID map); at runtime this is merged with dynamically imported attachment IDs stored in the `deka_media_map` WP option (see Media Importer below)
- `data.php` — Shared entity data (services, team, products) accessible via `anchor_get_data('services')`
- `pages/` — Config-driven page section arrays (home, about, services, contact, blog, events, single-post, single-service). Pages that have a `page-content/` override still have these as fallback/reference.

**Direct-PHP pages (`page-content/`):**
The active paradigm for bespoke pages. Each file calls `anchor_render_section([...])` directly. Pages migrated so far: home.php, about.php, services.php, single-service.php, contact.php.

**CSS overrides:**
- `assets/css/client-tokens.css` — Brand color/font overrides
- `assets/css/client-overrides.css` — One-off CSS tweaks
- `assets/css/deka-home.css` — Bespoke front-page editorial styles (enqueued on front page only)
- `assets/css/deka-shop.css` — Laser product shop styles (enqueued on shop/product pages)

**Custom header:**
`header.php` in the child theme overrides the parent for the front page only, rendering a bespoke `deka-nav` with scroll-triggered logo variant swapping (light/dark). All other routes fall through to the parent's `header.php`.

**Child theme CPTs (registered in `functions.php`):**
- `laser_product` (rewrite: `/shop/`) with taxonomy `laser_product_category` (rewrite: `/shop/category/`) — separate from the parent's `anchor_event` CPT

### CSS Architecture

All CSS is class-based with `anchor-` prefix and BEM-like naming. **No inline styles** except for truly dynamic PHP values (aspect-ratio, min-height, column order).

**CSS files (loaded in order):**
1. `variables.css` — Design tokens (colors, fonts, radii, container widths, spacing, shadows)
2. `base.css` — Reset, typography, body defaults, utility classes
3. `layout.css` — Container, section padding, grid system, flex/text utilities
4. `components.css` — Buttons, cards, badges, icon boxes, forms, glass effects
5. `sections.css` — Hero, navigation, footer, all named section styles
6. `responsive.css` — Breakpoints at 640px (sm), 768px (md), 1024px (lg), 1280px (xl)

**Key CSS variables:**
- `--anchor-container-max` — Main container width (set in variables.css, used by `.anchor-container`)
- `--anchor-container-narrow` — Narrow container for text-heavy sections
- `--anchor-section-py` / `--anchor-section-py-lg` — Responsive section vertical padding using `clamp()`
- Nav pill: `max-width: 72rem` (hardcoded in sections.css `.anchor-nav`)

**Section wrapper pattern:**
```html
<section class="anchor-section [anchor-section--dark] [anchor-section--flush-bottom]">
  <div class="anchor-section-pad">
    <div class="anchor-container">
      <!-- content -->
    </div>
  </div>
</section>
```

**Hero content pattern (inner width constraint):**
```html
<div class="anchor-hero__content anchor-section-pad">
  <div class="anchor-container">
    <div class="anchor-hero__inner">  <!-- max-width: 40rem -->
      <!-- heading, text, buttons -->
    </div>
  </div>
</div>
```

### Section Config Props

Every section in page configs supports:
- `flush_bottom` (bool) — Removes bottom padding (class `anchor-section--flush-bottom`). Use when the next section shares the same background color.
- `dark` (bool) — Navy background with white text
- `variant` (string) — Section-specific variants (e.g., hero: full/short/centered, cta_band: light/dark/accent/card/expand)

### Template Data Bridge

Sections receive `{type, variant, props}` via `anchor_get_template_data()`. Always extract props:
```php
$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];
```

Components receive flat data directly (NOT wrapped in `{type, variant, props}`).

### Media Resolution

Named keys in config (e.g., `'image' => 'home_hero'`) are resolved via `anchor_resolve_media()`. Resolution order: null/empty → WP attachment ID (integer) → absolute URL → config key lookup → theme-relative path. The section renderer calls `anchor_resolve_media_in_props()` before passing data to templates. Recognized key suffixes: `image`, `photo`, `background`, `logo`, `icon_image`, and anything ending in `_image`, `_photo`, `_bg`, `_media`.

### Media Importer (Deka child theme)

`deka_seed_media()` in the child `functions.php` auto-imports local theme images and remote product photos into the WP Media Library on first run. It stores a `key → attachment ID` map in the `deka_media_map` WP option. The child theme overrides `anchor_get_media_config()` to merge `config/media.php` with these dynamic IDs at runtime — so media keys always resolve to real attachment IDs after seeding.

## Coding Rules

- All functions use `anchor_` prefix, all hooks use `anchor_framework_` prefix
- All CSS classes use `anchor-` prefix with BEM naming
- **No inline styles** — use CSS classes. Only dynamic PHP values may be inline.
- Ghost buttons (`.anchor-btn--ghost`) auto-adapt: navy on light backgrounds, white on dark (via parent context selectors)
- `.anchor-heading-group` appends `heading_accent` text if it's not a substring of the heading
- WordPress default styles are dequeued (wp-block-library, global-styles, classic-theme-styles)
- CPTs: `anchor_event` / `anchor_event_category` (parent theme); `laser_product` / `laser_product_category` (child theme)
- Child theme body classes: `deka-home` (front page), `deka-shop` (shop/product pages) — set via `body_class` filter; used for CSS scoping in `deka-home.css` and `deka-shop.css`

## Current Status

The theme framework is fully built and functional. The inline style refactor is complete (292 inline styles reduced to ~11 dynamic-only). All major pages have been **migrated to direct-PHP** (`page-content/`). Current work is CSS polish, spacing consistency, and visual refinements for the Deka editorial sections.

### Known Items
- Noise overlay SVGs have been removed (were causing rendering issues)
- The expanding CTA background element uses `visibility: hidden` until scroll-activated
- Section vertical padding uses `clamp()` for viewport-responsive spacing
- `home.php` is a copy of `archive.php` (WordPress uses `home.php` for blog posts page, not `archive.php`)
- Config-driven page arrays in `config/pages/` are kept as reference/fallback; `page-content/` overrides take effect first
