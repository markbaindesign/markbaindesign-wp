# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Personal portfolio/design studio WordPress site for Bain Design. A custom WordPress theme and companion plugin running on DDEV locally.

- **Local URL**: `https://bain.design.ddev.site`
- **Production URL**: `https://bain.design`
- **Production SSH**: `master_czajrvfzzm@178.62.31.106`
- **Theme**: `bain-design-theme` (custom, based on Underscores)
- **Plugin**: `bd-custom` (all site-specific business logic) — **must be active** for CPTs to be registered. If CPT queries return empty, check with `ddev wp plugin list`.
- **WP-CLI**: `ddev wp <command>` (runs inside DDEV container)

## Build Commands

```bash
ddev start           # start local environment
ddev stop            # stop local environment
ddev wp <cmd>        # run WP-CLI commands inside DDEV
npm install          # install Grunt plugins
grunt                # compile Sass + watch (default dev task)
grunt build          # full production build → /release
grunt export         # export WordPress install to /export
grunt import         # import archive from /import to local env
```

The watch task monitors `sass/**/*.{scss,sass}` and JS files, triggering Sass compilation and livereload on change.

## Project Structure

```
public_html/wp-content/
  themes/bain-design-theme/   # WordPress theme
    assets/css/tokens.css     # design tokens — CSS custom properties only; editor-safe
    assets/css/base.css       # element styles + brand utilities; front-end only
    assets/css/theme.css      # layout + components via @layer; depends on tokens + base
    assets/js/dist/main.min.js  # vanilla JS interaction layer (no build step)
    inc/bain-design-system.php  # PHP template-tag helpers (bain_ prefix)
    lib/                      # legacy theme setup helpers (not used by new templates)
    templates/                # template parts (postcard, portfolio, related-*)
    content-*.php             # legacy content templates by context
  plugins/bd-custom/          # custom plugin — all site business logic
    inc/
      post-types/register.php # CPT + taxonomy registration
      clients/                # client CPT queries and data
      projects/               # project CPT queries and data
      testimonials/           # testimonial CPT queries and data
      helpers/helpers.php     # shared utility functions
      acf.php                 # ACF configuration and local JSON setup
    acf-json/                 # ACF field group definitions (version-controlled)
```

## Custom Post Types & Taxonomies

All CPTs use the `bd324_` prefix:

| Post Type | Slug | URL |
|---|---|---|
| `bd324_clients` | `clients` | `/clients/` |
| `bd324_projects` | `portfolio` | `/portfolio/` |
| `bd324_testimonials` | `testimonials` | `/testimonials/` |

Project taxonomies: `project-category-service`, `project-category-tool`, `project-category-tech-stack`, `project-category-profile`
Client taxonomy: `client-industry`

## Code Conventions

- **Plugin functions**: `bd324_` prefix (e.g. `bd324_get_client_data()`)
- **Theme functions**: `mb_` prefix (e.g. `mb_widgets_init()`)
- **Design system helpers**: `bain_` prefix (e.g. `bain_meta_bracket()`, `bain_button()`, `bain_check_list()`). Live in `themes/bain-design-theme/inc/bain-design-system.php` — brand-rendering helpers, not general theme plumbing.
- **PHP opening tag**: single `<?php` only, never `<?`
- **WordPress coding standards** throughout
- **ACF** for all custom meta fields; field group JSON lives in `plugins/bd-custom/acf-json/`
- **Debugging**: Use Xdebug (breakpoints + variable inspection); avoid `echo`/`var_dump` in PHP files

## Business Logic Pattern

Data retrieval for each CPT follows a consistent pattern in the plugin's `inc/<type>/business-logic.php`:
- `bd324_get_<type>_data($id)` — top-level aggregator, conditionally loads detail data on `is_singular()`
- `bd324_get_<type>_base_data($id)` — title, permalink, excerpt, thumbnail, breadcrumb data
- `bd324_get_<type>_meta($id)` — ACF fields (detail view only)
- Related data (e.g. `bd324_get_client_testimonials()`, `bd324_get_projects_by_client()`) queried separately

## CSS Architecture

Three flat CSS files in `assets/css/`, enqueued in dependency order via `functions.php`:

| File | Purpose | Editor-safe? |
|---|---|---|
| `tokens.css` | CSS custom properties only — colors, type, spacing, motion | Yes |
| `base.css` | Element styles + brand utilities (`.meta-bracket`, `.bain-btn`, `.bain-check`, layout helpers) | No |
| `theme.css` | Layout + component styles using `@layer` | No |

Enqueue chain: `bain-fonts` → `bain-tokens` → `bain-base` → `bain-theme` → `bain-main` (JS).

**New styles go in `theme.css`** inside the appropriate `@layer`. Layers defined (in order): `layout`, `header`, `footer`, `hero`, `sections`, `archive`, `single`, `wp`. Add new named layers to the `@layer` declaration at the top of the file before using them.

The old `sass/` tree and Grunt Sass compilation are no longer used for the active design.

## Local DB setup (fresh clone or pre-migration dump)

If the database was taken before the CPT migration ran, rename the legacy types:

```sql
UPDATE wp_posts SET post_type = 'bd324_projects' WHERE post_type = 'portfolio_item';
UPDATE wp_posts SET post_type = 'bd324_testimonials' WHERE post_type = 'testimonial_item';
UPDATE wp_term_taxonomy SET taxonomy = 'project-category-service' WHERE taxonomy = 'portfolio';
UPDATE wp_term_taxonomy SET taxonomy = 'project-category-profile' WHERE taxonomy = 'project_cats';
```

Then `ddev wp rewrite flush`.

## Deployment

1. Run `grunt build` — produces a zip in `/release`
2. Run `grunt export` — archives the full WordPress install to `/export`
3. Upload the archive to staging/production and run the import script
4. Use Search-Replace-DB to update URLs in the database after import

## Asana

ASANA_PROJECT_GID: 1202804672032851
ASANA_TASK_PREFIX: BD
ASANA_PROJECT_NAME: Bain Design

## Studio PM

- **Tone:** Sweary, direct.
