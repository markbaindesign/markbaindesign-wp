# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Personal portfolio/design studio WordPress site for Bain Design. A custom WordPress theme and companion plugin running on DDEV locally.

- **Local URL**: `https://bain.design.ddev.site`
- **Production URL**: `https://bain.design`
- **Production SSH**: `master_czajrvfzzm@178.62.31.106`
- **Theme**: `bain-design-theme` (custom, based on Underscores)
- **Plugin**: `bd-custom` (all site-specific business logic)
- **WP-CLI**: `ddev wp <command>` (runs inside DDEV container)

## Build Commands

```bash
ddev start           # start local environment
ddev stop            # stop local environment
ddev wp <cmd>        # run WP-CLI commands inside DDEV
npm install          # install Grunt plugins
bower install        # download Bower components
grunt copyassets     # copy bower assets to theme
grunt                # compile Sass + watch (default dev task)
grunt build          # full production build → /release
grunt export         # export WordPress install to /export
grunt import         # import archive from /import to local env
```

The watch task monitors `sass/**/*.{scss,sass}` and JS files, triggering Sass compilation and livereload on change.

## Project Structure

```
sass/                         # Sass source (compiled to theme style.css)
  styles.scss                 # main entry point
  partials/                   # variables, mixins, layout, components
  wp/                         # WordPress-specific styles
public_html/wp-content/
  themes/bain-design-theme/   # WordPress theme
    lib/                      # theme setup, helpers, includes
    templates/                # template parts (postcard, portfolio, related-*)
    content-*.php             # content templates by context
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

## Sass Architecture

Entry point `sass/styles.scss` loads in this order (do not reorder): mixins → variables → normalize → globals → layout → modules → page styles → WordPress → helpers. Use `@use` (not `@import`). New partials go in `sass/partials/` and must be added to `styles.scss`.

## Deployment

1. Run `grunt build` — produces a zip in `/release`
2. Run `grunt export` — archives the full WordPress install to `/export`
3. Upload the archive to staging/production and run the import script
4. Use Search-Replace-DB to update URLs in the database after import
