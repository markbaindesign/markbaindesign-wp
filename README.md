# bain.design

Personal portfolio and design studio WordPress site for Bain Design. A custom WordPress theme
(`bain-design-theme`, based on Underscores) plus a companion plugin (`bd-custom`) that carries all
site-specific business logic.

- **Local URL:** `https://bain.design.ddev.site`
- **Production URL:** `https://bain.design`

## Requirements

- [DDEV](https://ddev.readthedocs.io/) (local environment — replaces the old grunt/bower workflow entirely)
- Docker

## Setup

```bash
ddev start           # start the local environment
ddev wp plugin list  # verify bd-custom is active
```

The `bd-custom` plugin **must be active** — it registers all custom post types. If CPT queries
come back empty, check it first.

## Development

There is no build step. CSS and JS are edited directly in the theme:

```
public_html/wp-content/
  themes/bain-design-theme/
    assets/css/tokens.css      # design tokens — CSS custom properties only; editor-safe
    assets/css/base.css        # element styles + brand utilities; front-end only
    assets/css/theme.css       # layout + components via @layer; depends on tokens + base
    assets/js/dist/main.min.js # vanilla JS interaction layer (no build step)
    inc/bain-design-system.php # PHP template-tag helpers (bain_ prefix)
    templates/                 # template parts (postcard, portfolio, related-*)
  plugins/bd-custom/
    inc/post-types/register.php  # CPT + taxonomy registration (bd324_ prefix)
    inc/helpers/helpers.php      # shared utilities
    acf-json/                    # ACF field groups (version-controlled)
```

WP-CLI runs inside the DDEV container:

```bash
ddev wp <command>
```

## Git workflow

- **Base branch:** `develop` — commit directly to `develop`; no feature branches or PRs.
- `master` is the production branch. It is behind `develop` and must never be committed to directly.

## Deployment

Production access and deployment details live in `CLAUDE.md` (kept out of this README deliberately).

## Historical note

Earlier versions of this project used an npm/bower/grunt pipeline (`grunt/`, `sass/` directories
remain from that era). That pipeline is retired: the config files it referenced (`Gruntfile.js`,
`bower.json`, `package.json`) no longer exist, and no build tooling is required to work on the
site today.
