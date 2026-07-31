# URL Structure Changes: Current Production → New Site — Audit Report
**Date:** 2026-07-31
**Task:** BD-121
**Status:** For review — redirect plan proposed, no redirects created yet

---

## Method

Current production (`https://bain.design`, still serving the pre-migration WordPress install) was
sampled via its live XML sitemaps (`sitemap_index.xml` and each sub-sitemap). The new site's URL
structure was read from `bd324_register_post_type()` / `bd324_register_taxonomy()` calls in
`public_html/wp-content/plugins/bd-custom/inc/post-types/register.php` (see
`docs/audit-current-slugs-2026-07-31.md` for the full slug table). The `import/` directory (a
pre-DDEV backup of the same production site, ~1.8GB, gitignored) confirms the old post type/taxonomy
names referenced below.

## Summary of structural changes

| Content | Current production | New site | Change |
|---|---|---|---|
| Portfolio items | `/portfolio/{taxonomy-term}/{slug}/` | `/portfolio/{slug}/` | **Term segment removed** — every project URL drops one path level |
| Portfolio taxonomy archives | `/portfolio/{term}/` | `/project-category/service\|tool\|tech-stack\|profile/{term}/` | **Moved and split** — one flat `portfolio` taxonomy becomes four namespaced taxonomies under a new prefix |
| Testimonials | `/testimonials/items/{slug}/` | `/testimonials/{slug}/` | **`/items/` segment removed** |
| Testimonials archive | `/testimonials/` | `/testimonials/` | unchanged |
| Clients | *(no dedicated CPT/archive found on current production)* | `/clients/{slug}/`, archive `/clients/` | **New** — no old URLs to redirect |
| Services | `/services/` (static page) | `/services/` (hierarchical CPT archive) | same slug, different underlying content type — check for any deep old `/services/{child}/` URLs before launch (none found in sampled sitemap) |
| Tools | `/about/tools/`, `/about/tools-2024/` (static pages) | `/tools/` (CPT archive) | **Slug changed** — old pages live under `/about/`, new archive is root-level |
| Products (`asp-products`) | `/products/`, `/asp-products/{slug}/` | *(no products CPT registered)* | **Dropped** — plugin/content type not carried over |
| Work pages | `/work/`, `/work/hire-me/`, `/work/wordpress-plugin-development/`, `/work/wordpress-plugin-development/open-source-contributions/`, `/work/wordpress-themes-development/`, `/work/ui-ux-design/` | *(no equivalent found in new theme/plugin)* | **Likely dropped or restructured** — confirm with Mark before launch; these get 404s if not redirected |
| Misc static pages | `/describing-brand/`, `/stripe-checkout-result/`, `/payment-confirmation/`, `/payment-failed/`, `/payment-cvfgbc/`, `/book-an-appointment/` | *(not present in new site's registered CPTs; likely plain pages, not sampled)* | Payment/Stripe pages are almost certainly artefacts of the dropped products flow — confirm before assuming a redirect target |
| Core pages | `/`, `/about/`, `/contact/` | same | unchanged, no redirect needed |

## Redirect plan (proposed)

The **Redirection** plugin is already present at
`public_html/wp-content/plugins/redirection/`, so no new tooling is needed — rules can be added
there directly (or exported/imported as JSON for review before going live).

1. **Portfolio items** — regex redirect, strip the taxonomy segment:
   `/portfolio/[^/]+/([^/]+)/?$` → `/portfolio/$1/`
   Covers all ~11 items sampled (e.g. `/portfolio/wordpress/aerial-telly/` → `/portfolio/aerial-telly/`).
   **Risk:** if any two portfolio items share the same slug under different old taxonomy terms,
   this regex collapses them to the same new URL. Sampled data showed no duplicate slugs, but this
   should be verified against the full `portfolio_item` sitemap (only first 15 of the set were
   sampled here) before the rule goes live.

2. **Portfolio taxonomy archives** — one-to-one redirects (small, fixed list — 11 terms sampled:
   `algolia`, `animation`, `astrojs`, `branding`, `frontend`, `graphics`, `localstorage`,
   `responsive`, `vuejs`, `website`, `wordpress`). Each needs manual mapping to whichever of the
   four new `project-category-*` taxonomies it now belongs to (e.g. `wordpress` → likely
   `project-category-tech-stack`) — this mapping isn't derivable from URLs alone and needs Mark's
   input or the ACF/taxonomy-term data itself.

3. **Testimonials** — regex redirect:
   `/testimonials/items/([^/]+)/?$` → `/testimonials/$1/`

4. **Tools pages** — `/about/tools/` and `/about/tools-2024/` → `/tools/` (single redirect each,
   confirm with Mark whether `tools-2024` content is superseded or should map to a specific
   archive filter).

5. **Work / products / payment pages** — before writing redirects, confirm with Mark whether these
   are intentionally being retired (in which case redirect to the nearest living equivalent, e.g.
   `/services/`, or to `/` as a fallback) or whether content still needs a home on the new site.
   Flagging as **open question** rather than guessing a mapping.

## Open questions for Mark

- Where should `/work/*` URLs redirect? (services page? individual project pages? removed
  entirely with a blanket 404→home redirect?)
- Is the products/payment flow (`/products/`, `/asp-products/*`, `/stripe-checkout-result/`,
  `/payment-*`) being retired for good, or moving elsewhere?
- Which of the 4 new project-category taxonomies does each old `portfolio` term map to? (Needed
  to complete redirect #2 above.)

## No changes applied

This is an audit and proposed plan only — no Redirection-plugin rules have been created. See
`docs/audit-current-slugs-2026-07-31.md` (BD-120) for the new site's slug inventory this plan is
based on.
