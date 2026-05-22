# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Environment

This is a **WordPress installation** running locally via **DevKinsta**. The active theme is the **Anchor Framework** parent/child theme system at `wp-content/themes/`.

- **WordPress root**: `/Users/bif/DevKinsta/public/test-theme-deka/`
- **PHP version**: 7.4+ required
- **WordPress version**: 6.4+ required, tested up to 6.8
- **Database**: MySQL via DevKinsta (`DB_NAME: testthemedeka`)
- **Local site URL**: `https://test-theme-deka.local` (managed by DevKinsta)

There is no build step, package manager, or test framework. This is a classic PHP WordPress theme — edit files and reload.

## Direction (2026-05+) — read this first

The architecture is shifting. The sections below this one describe both the **canonical model going forward** and the **legacy mechanics still in the codebase**. When in doubt, follow the direction described here, not the legacy patterns.

### Package layout (target: 3 packages → 2)

| Package | Role | Status |
|---|---|---|
| **`anchor-framework`** (theme) | Rendering + utility classes + AI code editor + admin UIs | Active — `anchor-page-assistant` will be merged in |
| **`anchor-starter-child`** (theme) and other child themes | Per-site code: brand tokens, `page-content/*.php` files, site-specific CPTs/WC overrides | Active |
| **Anchor Tools** (plugin) | Managed content components (sliders, galleries, popups, etc.) + site-level config UI | Active — stays separate, intentionally portable across themes/sites |
| **`anchor-page-assistant`** (plugin) | AI code editor, file writer, frontend chat | Being merged into `anchor-framework` |

Mental model:
- **Theme** = how the site looks and how I edit it (rendering + utilities + editor).
- **Plugin (Anchor Tools)** = what content components I can drop in (sliders, galleries, popups, site config).
- **Child theme** = this specific site.

### Page authoring model (canonical)

1. **Pages are direct-PHP files.** Each lives at `child-theme/page-content/{slug}.php` and emits raw HTML using parent utility classes + shortcodes. No section schema, no `{type, variant, props}` arrays, no per-section validators.
2. **Templates are scaffolds, not inheritance.** When creating a new page, the editor copies a template file (e.g. `templates/service-page.php`) into a fresh `page-content/{slug}.php`. From that moment on, the new file is independent — editing the template later does **not** propagate to existing pages, and editing a page does not affect the template. Conflicts impossible by design.
3. **Live propagation happens via shortcodes** — opt-in, per element. CTAs, contact bands, footers, brand info, business hours, etc. live as Anchor Tools shortcodes; editing the shortcode once updates every page that uses it. The author discipline at template-write time: anything you might want to change globally → shortcode; anything truly per-page → hardcoded inline.
4. **Site-level config** (brand colors, logos, business name, phone, address, social, fonts) lives in Anchor Tools with a media-library-picker UI similar to the existing `anchor-shortcodes` module. Renders into the page via shortcodes (`[business_phone]`, `[business_logo]`) and into the document via CSS custom properties (`--anchor-color-primary` etc.) injected in `wp_head`.
5. **AI code editor** evolves from `anchor-page-assistant`. Surfaces: file tree of all theme files, code editor (Monaco/CodeMirror), per-file chat sessions, page-template starter library, header/footer toggle per page, utility-class reference sidebar, paste-HTML-as-section flow.

### What's legacy (kept working, not the path forward)

- **Section template system** at `template-parts/sections/*.php` (`hero`, `split-content`, `iso-split`, `card-grid`, `cta-band`, etc.) — kept for backward compat with existing pages that compose them via `anchor_set_template_data()` + `get_template_part()`, and for the config-driven fallback path. Do not author new pages against this system.
- **Config-driven page paradigm** (`config/pages/*.php` arrays + `anchor_render_sections()`) — kept as fallback when no `page-content/{slug}.php` override exists. Do not migrate new pages to this path.
- **Section validators** in `inc/validation.php`, the `{type, variant, props}` template-data bridge, and the section-config props (`flush_bottom`, `dark`, `variant`) — all tied to the legacy section system.

If a future task touches one of these legacy pieces, evaluate whether it can be migrated to the canonical model instead of extended.

---

## Architecture: Anchor Framework

A reusable WordPress parent theme (`anchor-framework`) plus a per-client child theme (`anchor-starter-child`, currently configured for the Deka site). The parent provides the rendering engine, generic section templates, components, and CSS tokens. The child provides all client-specific markup, content, branding, CPTs, and bespoke styling.

### Parent vs. child split

Three rules:

1. **Parent owns mechanics.** Slider/carousel logic, full-width background-video sections, hero variants, animations, scroll behaviors, section scaffolds, base CSS tokens, component classes — all in `anchor-framework`. A child opts in by writing markup with parent classes (e.g., a `<video class="anchor-hero-video">` inside `.anchor-hero--video` for a bg-video hero).
2. **Children own modifiers + composition.** Token overrides (button radius, heading scale, brand colors), brand assets, and `page-content/` files composing parent components. No bespoke mechanics — if a child needs new behavior, it goes in the parent first as a generic component.
3. **Hard rule — zero domain-specific names in the parent.** Class/file/function names describe shape and role (`anchor-hero--video`, `anchor-stat-band`), never industry (no `dental-*`, `roofing-*`, `cta-insurance-*`). Keeps every parent style reusable.

**Grandchild themes** are allowed when a single site needs further customization beyond what its child theme provides — e.g. `anchor-starter-child` → `deka-site` grandchild for site-only overrides. Same rules cascade: grandchild adds tokens + page-content, never re-implements mechanics.

### Utility class system (parent)

The parent ships a scoped utility-class vocabulary that is the **primary styling tool** for child `page-content/` files. Bespoke CSS is the exception, not the rule. Goal: enough surface area to compose any layout the child themes need, without Tailwind-scale bloat.

**Class families (all `anchor-` prefixed):**

- **Grid** — `anchor-grid-{n}` for n columns (1–6+), with mobile collapse rules baked into the parent. Example collapses: `anchor-grid-6` → 3 cols (md) → 2 cols (sm); `anchor-grid-4` → 2 cols (sm); `anchor-grid-3` → 1 col (sm). Children never re-derive these breakpoints.
- **Grid center** — `anchor-grid-center` modifier that centers orphan items in the last row (the perpetually-missing CSS feature). Implementation may use flex-with-flex-basis under the hood — same visual result, hidden behind the grid-named class.
- **Flex** — `anchor-flex`, `anchor-flex-row`, `anchor-flex-col`, `anchor-flex-center`, etc. for one-dimensional layouts.
- **Reverse** — `anchor-reverse` flips order on a flex/grid section so a right-side image becomes top-of-stack on mobile via `column-reverse`. Composable with the layout utilities.
- **Typography** — text-size scale, weight, alignment, line-height, font-family token shortcuts.
- **Sizing/spacing** — max-width, margin, padding, gap on a consistent scale.

**Rules:**
- Utilities live in `anchor-framework/assets/css/utilities.css` (or equivalent), loaded with the rest of the parent CSS.
- Utilities are pure: no industry-specific names, no client-specific tokens. Values reference parent design tokens.
- Children consume utilities directly in `page-content/` markup. If a child needs a utility that doesn't exist, it goes in the parent — never inline-styled or one-off-classed in the child.
- Keep the surface area scoped to layout/display/typography/sizing essentials. Resist adding the long tail (every color, every state, every pseudo-variant) — those belong in component or token CSS, not utilities.

### Component layer (Anchor Tools plugin)

Reusable, user-managed UI components live in the **Anchor Tools** plugin at `wp-content/plugins/Anchor Tools/`, not in the theme. Themes provide structure and styling; the plugin provides the components themselves.

**Boundary:**
- **Plugin (Anchor Tools)** — anything the user manages as content with a back-end UI: testimonial sliders, video galleries, logo reels, image carousels, FAQ accordions, team grids, popups, mega menus, store locator, events, etc. Each is a self-contained module under `anchor-{name}/` with its own CPT or settings page, rendered via shortcode. Already 17 modules; new ones follow the same pattern.
- **Theme (parent + children)** — page structure, layout primitives, typography, color tokens, hero/section scaffolds, bg-video logic, navigation chrome, animations, scroll behaviors. Theme styles the *containers*; plugin fills them with managed components via shortcodes.

The plugin documents its own architecture in `wp-content/plugins/Anchor Tools/CLAUDE.md` and the module recipe in `ADDING-MODULES.md` — those are the source of truth when working on plugin code or adding new components. The plugin's runtime AI assistant is model-agnostic (not Claude-specific).

To scaffold a new component, use the `anchor-tools-add-component` skill, which wraps the ADDING-MODULES.md recipe.

### Two rendering paradigms (legacy detail — see Direction above)

The framework supports two ways to render a page. Both run through `front-page.php` / `page.php`, which call `anchor_load_page_content($slug)` to look for a `page-content/{slug}.php` file in the **child theme** first.

1. **Direct-PHP (active paradigm).** If `page-content/{slug}.php` exists, the framework includes it directly and stops. The file decides how to render — and on the Deka site, it does so in two sub-flavors:
   - *Pure inline HTML* — the file outputs raw markup with `data-section-type="..."` attributes for CSS scoping. Used by `home.php` (the bespoke editorial homepage).
   - *Compose framework sections* — the file calls `anchor_set_template_data([...])` then `get_template_part('template-parts/sections/{type}')` for each section it wants. Used by `about.php`, `services.php`, `single-service.php`, `contact.php`. The shop templates (`archive-laser_product.php`, `single-laser_product.php`) use the higher-level `anchor_render_sections([...])` wrapper.
2. **Config-driven (legacy / fallback).** If no `page-content/` override exists, the framework falls back to `anchor_get_page_config($slug)` → `anchor_render_sections($config['sections'])` → for each section: validate → resolve media → `get_template_part()` → section template reads data via `anchor_get_template_data()`. Still active for any page that has no `page-content/` override (e.g. the blog/events pages on the Deka site).

The section-template rendering layer (`template-parts/sections/`, `inc/section-renderer.php`, `inc/validation.php`) is part of the **active public API** — child themes consume it from both paradigm 1's section-composing flavor and paradigm 2.

The decision tree at runtime:

```
Page load → anchor_determine_page_slug()
          → anchor_load_page_content($slug)?
              ├── yes → include child/page-content/{slug}.php and return
              └── no  → anchor_get_page_config($slug)
                       → anchor_render_sections() → get_template_part(...) per section
```

### Parent Theme (`anchor-framework/`)

The rendering engine. Generic, client-agnostic. Contains no client names or client CPTs.

**Key directories:**
- `inc/` — Engine: config-loader, section-renderer, media-resolver, helpers, validation, page-content-loader, plus nav walker classes (`class-anchor-nav-walker.php`, `class-anchor-footer-walker.php`, `class-anchor-mobile-walker.php`).
- `template-parts/sections/` — Generic section templates: hero, split-content, iso-split, card-grid, icon-list, cta-band, team-grid, services-tabs, testimonial-band, faq-list, contact-block, gallery-band, text-block, shortcode-block. Loaded by both the config-driven renderer *and* by direct-PHP page-content files via `anchor_set_template_data()` + `get_template_part()`.
- `template-parts/components/` — Reusable components (button, button-group, heading-group, image-wrapper, card, icon-item, quote-item, section-intro, content-sidebar, hero-carousel, rotating-text, sticky-footer).
- `template-parts/navigation/` — Header (fixed pill) and footer nav.
- `template-parts/partials/` — Reusable PHP snippets (cta-band.php, testimonials.php); included inline.
- `assets/css/` — Design token system (see CSS section below).
- `assets/js/` — `scroll-reveal.js` (IntersectionObserver, FAQ accordion, Services tabs, Expanding CTA), `navigation.js` (mobile menu, scroll behaviors).

**Page templates:**
- `front-page.php` — Checks for `page-content/home.php`; falls back to config.
- `page.php` — Checks for `page-content/{slug}.php`; falls back to config.
- `home.php` — Blog posts index (featured hero + grid + sidebar).
- `archive.php` — Category/tag archives.
- `single.php` — Blog post (hero + article + sidebar + related).
- `single-anchor_event.php`, `archive-anchor_event.php` — Event CPT templates.
- `search.php`, `404.php`, `index.php` — Utility templates.

The parent CPT is `anchor_event` (with taxonomy `anchor_event_category`). The parent does **not** know about `laser_product`.

### Child Theme (`anchor-starter-child/`)

All Deka-specific code: branding, content, page markup, the laser product CPT, the Deka editorial CSS/JS.

**Direct-PHP page content (`page-content/`):** the active paradigm.
- `home.php`, `about.php`, `services.php`, `single-service.php`, `contact.php` — each is a self-contained PHP file that emits raw HTML directly. Sections are wrapped in semantic elements with `data-section-type="..."` attributes used by `deka-home.css` (etc.) for scoping.

**Config (`config/`):**
- `site.php` — Business name, contact, social links, default CTA.
- `navigation.php` — Header/footer nav structure.
- `globals.php` — Reusable section definitions (referenced as `'global:cta_band'` in legacy page configs).
- `media.php` — Static media registry (key → URL/attachment ID); merged at runtime with dynamically imported attachment IDs from the `deka_media_map` WP option.
- `data.php` — Shared entity data (services, team, products); accessible via `anchor_get_data('services')`.
- `pages/` — Config-driven page arrays for any page that hasn't been migrated to `page-content/`. Currently: `about.php`, `blog.php`, `contact.php`, `events.php`, `services.php`, `single-post.php`, `single-service.php`. The `home.php` config was deleted because the direct-PHP `page-content/home.php` is the source of truth and the config was stale.

**CSS:**
- `assets/css/client-tokens.css` — Brand color/font overrides.
- `assets/css/client-overrides.css` — One-off CSS tweaks.
- `assets/css/deka-home.css` — Front-page editorial styles (enqueued only on the front page).
- `assets/css/deka-shop.css` — Laser product shop styles (enqueued on shop/product pages).

**Custom header:** `header.php` in the child overrides the parent **for the front page only**, rendering a bespoke `deka-nav` with scroll-triggered logo variant swapping (light/dark). All other routes fall through to the parent's `header.php`.

**Child-owned CPT and templates:**
- `laser_product` (rewrite: `/shop/`) with taxonomy `laser_product_category` (rewrite: `/shop/category/`).
- `archive-laser_product.php` and `single-laser_product.php` — shop templates live in the child theme alongside the CPT registration.

### CSS Architecture

All CSS in the parent uses class-based `anchor-` prefixes with BEM-like naming. **No inline styles** in parent templates except for truly dynamic PHP values (aspect-ratio, min-height, column order). The Deka child theme uses its own scoped class names (`hero`, `manifesto`, `capabilities`, etc., scoped via `body.deka-home` and `data-section-type` attributes) inside `deka-home.css`.

**Parent CSS files (loaded in order):**
1. `variables.css` — Design tokens (colors, fonts, radii, container widths, spacing, shadows).
2. `base.css` — Reset, typography, body defaults, utility classes.
3. `layout.css` — Container, section padding, grid system, flex/text utilities.
4. `components.css` — Buttons, cards, badges, icon boxes, forms, glass effects.
5. `sections.css` — Hero, navigation, footer, all named generic-section styles.
6. `responsive.css` — Breakpoints at 640px (sm), 768px (md), 1024px (lg), 1280px (xl).

**Key parent CSS variables:**
- `--anchor-container-max` — Main container width.
- `--anchor-container-narrow` — Narrow container for text-heavy sections.
- `--anchor-section-py` / `--anchor-section-py-lg` — Responsive section vertical padding using `clamp()`.
- Nav pill: `max-width: 72rem` (hardcoded in sections.css `.anchor-nav`).

**Generic section wrapper pattern** (used by parent's section templates and config-driven pages):
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

### Section Config Props (legacy / config-driven path only)

Generic sections in page configs support:
- `flush_bottom` (bool) — Removes bottom padding (class `anchor-section--flush-bottom`). Use when the next section shares the same background color.
- `dark` (bool) — Navy background with white text.
- `variant` (string) — Section-specific variants (e.g., hero: full/short/centered, cta_band: light/dark/accent/card/expand).

### Template Data Bridge (legacy / config-driven path only)

Generic section templates receive `{type, variant, props}` via `anchor_get_template_data()`. Always extract props:
```php
$section = anchor_get_template_data();
$props   = ! empty( $section['props'] ) ? $section['props'] : [];
```
Components receive flat data directly (NOT wrapped in `{type, variant, props}`).

The data-inline / direct-PHP pages do not use this bridge — they emit HTML straight from local variables.

### Media Resolution

Named keys in config (e.g., `'image' => 'home_hero'`) are resolved via `anchor_resolve_media()`. Resolution order: null/empty → WP attachment ID (integer) → absolute URL → config key lookup → theme-relative path. The section renderer calls `anchor_resolve_media_in_props()` before passing data to templates. Recognized key suffixes: `image`, `photo`, `background`, `logo`, `icon_image`, and anything ending in `_image`, `_photo`, `_bg`, `_media`. Direct-PHP pages can call `anchor_resolve_media()` themselves for any media keys they need.

### Media Importer (Deka child theme)

`deka_seed_media()` in the child `functions.php` auto-imports local theme images and remote product photos into the WP Media Library on first run. It stores a `key → attachment ID` map in the `deka_media_map` WP option. The child theme overrides `anchor_get_media_config()` to merge `config/media.php` with these dynamic IDs at runtime — so media keys always resolve to real attachment IDs after seeding.

## Coding Rules

- Parent functions use the `anchor_` prefix; parent hooks use the `anchor_framework_` prefix.
- Parent CSS classes use the `anchor-` prefix with BEM naming.
- **No client- or industry-specific names in the parent theme.** No `deka_*`, `dental-*`, `roofing-*`, `cta-insurance-*` types/classes/assets in `anchor-framework/`. Parent names describe shape/role (`anchor-hero--video`, `anchor-stat-band`), never the domain. If a section feels reusable, generalize it; if it's truly bespoke to one site, leave it as inline markup in the child's `page-content/`.
- **No bespoke mechanics in child themes.** Sliders, video heroes, animations, scroll behaviors all live in the parent as generic components. A child opts in by writing markup with the right parent classes — it does not re-implement the behavior.
- **No inline styles** — use CSS classes. Only dynamic PHP values may be inline.
- Ghost buttons (`.anchor-btn--ghost`) auto-adapt: navy on light backgrounds, white on dark (via parent context selectors).
- `.anchor-heading-group` appends `heading_accent` text if it's not a substring of the heading.
- WordPress default styles are dequeued (`wp-block-library`, `global-styles`, `classic-theme-styles`).
- CPTs: `anchor_event` / `anchor_event_category` live in the parent. `laser_product` / `laser_product_category` live in the child.
- Child body classes: `deka-home` (front page), `deka-shop` (shop/product pages) — set via `body_class` filter; used for CSS scoping in `deka-home.css` and `deka-shop.css`.

## Current Status

The framework is functional. The inline-style refactor is complete (292 inline styles reduced to ~11 dynamic-only). All major pages on the Deka site are migrated to the direct-PHP / data-inline paradigm. The parent theme has been cleaned of all client-specific code (no more `deka-*` section templates, no more `laser_product` templates in the parent, no more `deka_*` validator entries). Current work is CSS polish, spacing consistency, and visual refinements for the Deka editorial sections.

### Known Items
- Noise overlay SVGs were removed (causing rendering issues).
- The expanding CTA background element uses `visibility: hidden` until scroll-activated.
- Section vertical padding uses `clamp()` for viewport-responsive spacing.
- WP uses `home.php` for the blog posts index, not `archive.php` — that's why the parent has both files with similar content.
- Config-driven `config/pages/` arrays remain only for pages not yet migrated; for migrated pages the `page-content/` file is the sole source of truth.
