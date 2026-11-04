# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

Note: entries dated before the v3 launch are grouped by development phase rather
than by release. Those phase headings carry no version number and are therefore
not linked below.

---

## [Unreleased]

### Added

- Clients archive template (`archive-bd324_clients.php`). `/clients/` had no
  template of its own and fell through to the legacy `archive.php`, which
  rendered it as unstyled default-blue links under a "Work / Archives" heading,
  12 at a time across five pages. It is now a directory index: all 51 clients in
  one alphabetical list, grouped by initial, each row carrying its industries, a
  case-study count and a link to the client profile (BD-186).

### Fixed

- The last card in a case study's Related row rendered its "See all work"
  heading in ink on its own ink fill, leaving the card as a bare
  "cat case-studies.md" strip beside two normal cards (BD-182).

---

## [3.2.0] - 2026-11-02

### Changed

- Single tool pages (`/tools/{slug}/`) now redirect to the tools timeline at
  `/tools/` with a 301, and are excluded from site search. The timeline lives
  entirely on the archive; individual tools have no template, so these URLs
  rendered an indexable blank page. `publicly_queryable => false` was tried
  first and rejected: it removes the singles but also breaks the archive,
  because `WP::parse_request()` drops the `post_type` query var for any type
  that is not publicly queryable, sending `/tools/` to the home page (BD-167)

### Removed

- `content-page.php`, whose only caller was `page.php`
- `content.php`, `content-single.php`, `content-archive.php` and `content-test.php`.
  All four were unreachable: `content.php` is only the fallback for
  `get_template_part( 'content', $slug )`, and every variant it could fall back
  from (`content-home.php`, `content-none.php`, `content-featured.php`) exists,
  while the other three had no callers at all. Each one carried calls to
  `mbdmaster_posted_on()`, `mbdmaster_post_meta()` or
  `_mbbasetheme_categorized_blog()`, which live in the unloaded legacy `lib/`
  tree and would have been fatal the moment a template rendered — the same bug
  as BD-167. No live template now calls any `lib/` function (BD-172)

### Fixed

- Pages without a dedicated template now use the site's branded page header.
  `page.php` was never updated in the v3 redesign: it opened a second `#main`
  inside the one `header.php` already provides, and wrapped content in
  `.section`/`.container`, which only exist in the unenqueued legacy
  `style.css`. The result was an unwrapped, full-bleed title and an empty
  `#secondary` sidebar for a widget area that is not registered. Affects
  `/ink-slip/` on production (BD-171)
- Attachment and `/tools/` pages no longer return HTTP 500. `single.php` called
  `mbdmaster_post_nav()`, which lives in the legacy `lib/` tree that is no
  longer loaded, making the call fatal. This affected ~235 attachment pages
  whose parent is a post or CPT, and all 28 published `bd324_tools` singles,
  which have no `single-bd324_tools.php` and fall through to `single.php`.
  Attachments parented to a page resolve to `page.php` and were unaffected
  (BD-167)

---

## [3.1.0] - 2026-09-23

### Added
- Case study ordering on the portfolio archive, driven by an ACF repeater on the
  BD Settings page (BD-135)

### Changed
- Outgoing email is blocked on non-production environments (staging, development)

### Fixed
- Contact form submissions now arrive in the inbox: mail is sent through Postmark
  instead of the Gmail mailer, which filed messages to `hello@` under Sent only
  (BD-156)

---

## [3.0.0] - 2026-08-03

First production launch of the v3 rebuild (design system, CPT migration, and
all work below since v2.6.4), plus git-based deploys to staging and
production and GA4 tracking.

### Added
- Testimonials admin list: thumbnail, related client, and related projects columns
- Template-source metabox on all template-driven pages, pointing editors to the correct PHP file
- Custom dashicons for each CPT (clients, projects, testimonials, services)
- QA workflow under `qa/` — inbox, wip, review, review-passed folders with tracking log
- Git-based deploy to staging and production (`staging`/`main` branches, sparse-checked-out on each Cloudways app)
- GA4 tracking (`inc/analytics.php`), gated to fire only when `wp_get_environment_type()` is `production` via a `DB_NAME`-keyed `WP_ENVIRONMENT_TYPE` switch in each environment's `wp-config.php`
- Production branch renamed `master` → `main`

### Fixed
- Homepage services block now links through to individual service pages
- Pager navigation (← prev / next →) on project and client singles — dir label and title now stack on two lines at all viewport widths
- Duplicate contact page (ID 125) permanently removed; contact page now unique

---

## 2026-06-06 — v3 mobile polish

Mobile layout pass across all sections following design review.

### Fixed
- Hero headline wrapping, overflow, and indent on small viewports
- Services list overflow on mobile
- Contact page layout — added mobile breakpoints
- Portfolio archive — 2-column internal card layout on mobile
- Pager links on mobile — dir and title stacked (now extended to all breakpoints in Unreleased)
- Testimonial quote mark size on mobile
- Low-contrast meta-bracket on dark "See all work" card
- About-page CTA band eyebrow contrast
- Testimonial card grid overflow using `minmax(0, 1fr)`

---

## 2026-05-25 to 2026-06-03 — v3 design system build

Complete rebuild of the theme with a new flat-CSS design system. Old Sass compilation replaced with three flat CSS files (`tokens.css`, `base.css`, `theme.css`).

### Added
- New design system: CSS custom properties (tokens), element styles (base), layout/components (theme)
- About page template — full editorial layout: hero, bio letter, principles, timeline, tools, off-clock
- Services page template — tree-structured service hierarchy from CPT
- Services CPT (`bd324_services`, hierarchical)
- Single project template with case study layout and pager
- Portfolio archive with card grid and related content
- Single client template with testimonial/project links
- Tip tooltip system — hover tooltips on meta items, checklist bullets
- Logo mark easter egg — cycles glyphs on click, toast on discovery
- Nav dropdowns with tree character alignment (`├──`, `└──`)
- Services linked to testimonials via `project-category-service` taxonomy
- 404 page with cat animation placeholder
- ADRs for design decisions (`docs/adr/`)

### Changed
- Replaced legacy Sass/Grunt build with direct flat CSS authoring
- Replaced legacy ACF project fields with new case study field group
- Migrated from VVV to DDEV local environment

### Removed
- Legacy `archive-bd324_project.php` (wrong CPT slug)
- Bower dependency

---

## 2025-10-22 to 2025-11-06 — CPT migration

Custom post types rebuilt with `bd324_` prefix, content migrated.

### Added
- `bd324_projects`, `bd324_clients`, `bd324_testimonials` CPTs replacing legacy types
- Post and taxonomy factories for content migration
- Client single template with related testimonials and projects
- Testimonial template

### Changed
- Migrated all `portfolio_item` posts to `bd324_projects`
- Migrated all `testimonial_item` posts to `bd324_testimonials`
- Renamed `portfolio` taxonomy to `project-category-service`
- Renamed `project_cats` taxonomy to `project-category-profile`

---

## [2.6.4] - 2025-09-10

Sass module migration.

### Changed
- Migrated all Sass partials to `@use` / `@forward` module syntax
- Modularised Gruntfile — separate config files per task

---

## [2.6.0] - 2024-02-21

Visual refresh and archive improvements.

### Added
- Social accounts in footer
- Styled portfolio archive with pagination

### Fixed
- Hero white text
- Favicon set
- Page container width

---

## [2.5.0] - 2017-05-10

Font update.

### Changed
- Body and header fonts switched to Lota Grotesque

---

## 2.4.x — 2017-02-18 to 2017-02-22

### Added
- Tisa fonts for body text
- Hero image

### Changed
- Font weights and spacing in header
- Hero section spacing

---

## 2.3.x — 2016-04-28

### Changed
- Restructured project directory layout
- Removed legacy themes

---

## Initial release — 2014-11-21

First commit. Custom theme built on Underscores with Grunt build pipeline. Sass compilation, image optimisation, JS concat.

[Unreleased]: https://github.com/markbaindesign/markbaindesign-wp/compare/3.2.0...HEAD
[3.2.0]: https://github.com/markbaindesign/markbaindesign-wp/compare/3.1.0...3.2.0
[3.1.0]: https://github.com/markbaindesign/markbaindesign-wp/compare/3.0.0...3.1.0
[3.0.0]: https://github.com/markbaindesign/markbaindesign-wp/compare/2.6.4...3.0.0
[2.6.4]: https://github.com/markbaindesign/markbaindesign-wp/compare/2.6.0...2.6.4
[2.6.0]: https://github.com/markbaindesign/markbaindesign-wp/compare/2.5.0...2.6.0
[2.5.0]: https://github.com/markbaindesign/markbaindesign-wp/compare/2.4.1...2.5.0
