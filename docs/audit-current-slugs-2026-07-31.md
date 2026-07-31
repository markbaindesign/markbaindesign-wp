# Current Slugs — Audit Report
**Date:** 2026-07-31
**Task:** BD-120
**Status:** For review — recommendations only, no changes applied

---

## Summary

All post type and taxonomy rewrite slugs are registered in one place:
`public_html/wp-content/plugins/bd-custom/inc/post-types/register.php`, via the
`bd324_register_post_type()` / `bd324_register_taxonomy()` helpers in
`inc/helpers/helpers.php`. Every CPT uses `'with_front' => false`, so slugs sit
directly off the root with no `/portfolio-item/` style prefix.

| Type | Slug | Archive URL | Notes |
|---|---|---|---|
| `bd324_clients` (CPT) | `clients` | `/clients/` | flat, no taxonomy |
| `bd324_projects` (CPT) | `portfolio` | `/portfolio/` | flat — single-level `/portfolio/{slug}/` |
| `bd324_testimonials` (CPT) | `testimonials` | `/testimonials/` | flat — drops the old `/items/` segment (see BD-121 audit) |
| `bd324_services` (CPT) | `services` | `/services/` | hierarchical, has archive |
| `bd324_tools` (CPT) | `tools` | `/tools/` | has archive |
| `client-industry` (tax) | *(default)* | `/client-industry/{term}/` | no `rewrite_slug` set — falls back to taxonomy key |
| `project-category-service` (tax) | `project-category/service` | `/project-category/service/{term}/` | |
| `project-category-tool` (tax) | `project-category/tool` | `/project-category/tool/{term}/` | |
| `project-category-tech-stack` (tax) | `project-category/tech-stack` | `/project-category/tech-stack/{term}/` | |
| `project-category-profile` (tax) | `project-category/profile` | `/project-category/profile/{term}/` | |
| `tool-category` (tax) | `tool-category` | `/tool-category/{term}/` | |

## Observations & suggested improvements

1. **`client-industry` has no explicit `rewrite_slug`.** Every other taxonomy sets one; this one
   silently falls back to the taxonomy key (`client-industry`). Not broken, but worth setting
   explicitly in `register.php` for consistency and so a future rename of the taxonomy key doesn't
   silently change the URL.

2. **`project-category-*` taxonomies share one prefix (`/project-category/...`).** This is a clean,
   deliberate grouping — no change suggested, just flagging it as intentional so it isn't
   "simplified" into flat slugs later without realising the archives are namespaced together.

3. **`portfolio` is used as both the CPT rewrite slug and, historically, a taxonomy slug on the old
   site** (see BD-121 audit — old site had a `portfolio` taxonomy at `/portfolio/{term}/`). On the
   new site `/portfolio/` is unambiguous — only the CPT — but it's worth a one-line comment in
   `register.php` noting `portfolio` is deliberately CPT-only now, so nobody re-adds a
   `portfolio`-slugged taxonomy and creates a URL collision.

4. **No slug is stopword-heavy or non-descriptive** — `clients`, `portfolio`, `testimonials`,
   `services`, `tools` are all short, readable, and match how the site's own nav refers to them.
   No renames recommended on SEO/readability grounds.

5. **`tools` (CPT) vs `tool-category` (taxonomy) vs `project-category-tool` (taxonomy on
   projects)** — three similarly-named but distinct concepts. Not a URL collision (different
   slugs), but worth flagging as a naming trap for future contributors reading `register.php`
   quickly. Consider a short comment block above the taxonomy registrations distinguishing
   "tool used on a project" (`project-category-tool`) from "category of a Tools-timeline entry"
   (`tool-category`).

## No changes applied

This is an audit only — no rewrite slugs were changed. See `docs/audit-changes-url-structure-2026-07-31.md`
(BD-121) for the redirect plan covering slug changes versus the currently-live production site.
