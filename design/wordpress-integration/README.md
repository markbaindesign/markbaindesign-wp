# Bain Design — WordPress Integration

Drop-in package for applying the Bain Design system to a classic PHP
WordPress theme. No block editor required, no build step.

## What's in here

```
wordpress-integration/
├── assets/css/
│   ├── tokens.css            ← CSS custom properties only (safe in editor too)
│   ├── base.css              ← Element styles, utilities, components
│   └── single-project.css    ← Single-project page styles (enqueued only on /work/*)
├── inc/
│   ├── bain-design-system.php  ← Template tags (bain_button, bain_check_list, …)
│   └── cpt-project.php       ← `project` CPT + `project_tag` taxonomy + ACF wiring
├── templates/
│   └── single-project.php    ← The /work/{slug} template (editorial long-scroll)
├── acf/
│   └── group_bain_project.json  ← ACF Pro field group (loaded automatically)
├── functions-snippet.php     ← Paste/require into your theme's functions.php
├── preview.html              ← Standalone preview of every token & component
└── README.md                 ← This file
```

## Install

1. Copy `assets/css/` and `inc/` into your theme root so you end up with:

   ```
   your-theme/
   ├── assets/css/tokens.css
   ├── assets/css/base.css
   ├── inc/bain-design-system.php
   └── functions.php
   ```

2. Open `functions-snippet.php`, copy the body, paste into the bottom of
   your theme's `functions.php`. Or `require` the file:

   ```php
   require get_theme_file_path( 'inc/bain-functions.php' );
   ```

3. Open `preview.html` in your browser to confirm the tokens render
   the way you expect before touching templates.

4. Find/replace your theme's hardcoded values with tokens. Highest-ROI
   passes, in order:

   | Search for | Replace with |
   |---|---|
   | `#fff` / `#FFFFFF` body bg | `var(--paper)` |
   | `#000` / `#111` / `#222` text | `var(--ink)` / `var(--graphite)` |
   | `border-radius: …` (any value) | `var(--radius)` (= 0) |
   | `box-shadow: 0 …px …px rgba(0,0,0,…)` | `var(--shadow-press)` or remove |
   | hardcoded `font-family` | `var(--font-mono)` |
   | `16px`/`24px`/`32px` margins | `var(--space-4)` / `--space-5` / `--space-6` |

5. Start using the template tags from `inc/bain-design-system.php` in
   your templates:

   ```php
   <?php bain_meta_bracket( 'WordPress Designer & Developer' ); ?>
   <h1>Friendly websites for interesting people.<?php bain_cursor(); ?></h1>

   <?php bain_button( 'Arrange a chat now', '/contact' ); ?>

   <?php
   bain_check_list( array(
     'Bespoke WordPress themes, built from scratch.',
     'Custom plugin development & refactor work.',
     'Fully-responsive, high-specification websites.',
   ) );
   ?>

   <?php bain_section_header( '01', 'Selected work', 'Recent projects' ); ?>

   <?php bain_sign_off(); // in footer.php ?>
   ```

## Sanity-check pass

Walk these in DevTools after wiring it up:

- [ ] Every heading is **left-aligned, never centered, never all-caps**
- [ ] Every `border-radius` resolves to `0` (computed)
- [ ] Every link is **underlined** and renders in `--link` blue —
      clay is **never** a link color
- [ ] Body line-height is ~1.65 (mono needs the air)
- [ ] Section rhythm is `--space-9` (96px) desktop / `--space-7` (48px) mobile
- [ ] Focus rings show a 2px solid ink outline at 2px offset everywhere
- [ ] No emoji anywhere except the `♥` in the sign-off

## Optional

- **Self-host the fonts.** GDPR-cleaner and faster. Replace the
  `bain-fonts` enqueue with a local `@font-face` stylesheet pointing at
  files under `assets/fonts/`. Grab the WOFF2s from
  <https://fonts.google.com/specimen/JetBrains+Mono> and
  <https://fonts.google.com/specimen/IBM+Plex+Mono>.
- **Letter layout.** Pages opted-in via `body_class` (see
  `functions-snippet.php`) get a generous left margin. Add more
  templates to the filter as needed.
- **Footer sign-off via hook.** If `footer.php` lives in a parent
  theme you can't edit, uncomment the `bain_sign_off_footer` hook at
  the bottom of `inc/bain-design-system.php`.

## Single project page

The `project` CPT, template, CSS, and ACF field group ship together as a
drop-in portfolio section.

### Install

Same as above — copy the package into your theme so you end up with:

```
your-theme/
├── inc/cpt-project.php
├── templates/single-project.php
├── acf/group_bain_project.json
└── assets/css/single-project.css
```

The `require get_theme_file_path( 'inc/cpt-project.php' )` line in
`functions-snippet.php` wires it up:

- Registers the `project` post type at `/work/{slug}` and the
  `project_tag` taxonomy at `/work/tag/{slug}`.
- Tells ACF Pro to look inside the theme's `acf/` directory for field
  groups (so the JSON loads automatically — no manual import).
- Filters `single_template` to use the packaged template even when it
  lives under `templates/`. Move it to your theme root if you'd rather
  use the default WP hierarchy.
- Enqueues `single-project.css` only on single-project views.

### Requirements

- **ACF Pro.** The template uses a small handful of fields — see
  `acf/group_bain_project.json`. If ACF isn't installed everything
  still renders (the helpers fall back to `get_post_meta`), but the
  edit UX is much worse.
- **Permalinks.** Flush them after activating (Settings → Permalinks →
  Save) so `/work/` works.

### Field model

| Field             | ACF type     | Notes |
|---|---|---|
| `tagline`         | Text         | One sentence under the title. Falls back to excerpt. |
| `client`          | Text         | Used in the [bracketed] meta line + sidebar. |
| `year`            | Number       | Falls back to publish year. |
| `duration`        | Text         | "5 months" |
| `role`            | Text         | "Design & development" |
| `live_url`        | URL          | Rendered as a `↗` external link in the meta column. |
| `brief`           | Textarea     | Section 01. |
| `approach`        | Textarea     | Section 02. |
| `approach_gallery`| Gallery (≤2) | Two images shown side-by-side under Approach. |
| `outcome`         | Textarea     | Section 03. |
| `wins`            | Repeater     | `win` (text). Rendered as a ✔ list. |
| `testimonial_quote`/`_author`/`_role` | Text + Textarea | Nice-words section. |
| `showcase_gallery`| Gallery (≤3) | Big + 2 stacked. Section 04. |
| `stack`           | Repeater     | `tech` (text). Section 05 — hairline pills. |
| `related`         | Relationship | Up to 2. Auto-picks by shared tag if empty. |
| Featured image    | core         | Full-bleed cover under the hero. |
| `menu_order`      | core         | Drives the big `01` numeral. |

### Authoring tip

The big numeral in the hero comes from `menu_order` (Page Attributes →
Order). Set `01`, `02`, etc. on each project so your portfolio reads
like a printed table of contents.

---

## Caveats

- This is a **classic theme** package. For a block / FSE theme, the
  same tokens belong inside `theme.json` under `settings.color.palette`,
  `settings.typography`, `settings.spacing.spacingSizes`. Ping me if
  you want that variant.
- The fonts are **Google substitutes** for whatever Mark may have
  licensed. Swap the `@font-face` if the real ones differ.
- `bain_project_adjacent()` uses `date_query` for prev/next. If you
  reorder projects via `menu_order` you'll want to swap that for an
  `orderby=menu_order` query.
