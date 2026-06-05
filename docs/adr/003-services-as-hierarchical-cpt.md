# ADR 003 — Services as a hierarchical CPT, not pages

**Date:** 2026-05-28
**Status:** Accepted

## Context

Services content (Web Development, WordPress Themes, Plugin Development, UI/UX Design, etc.) was stored as flat WordPress pages under `/work/`. This made programmatic rendering, breadcrumbs, and child navigation awkward — each page was an island with no parent/child relationship enforced by WordPress.

## Decision

Migrate all service content to a new `bd324_services` hierarchical custom post type with archive at `/services/`. The CPT supports `post_parent`, enabling a tree structure (e.g. Development → WordPress → Theme Development). Old service pages remain published but are no longer linked from the nav.

## Consequences

- Archive template (`archive-bd324_services.php`) renders the full tree as ASCII art using a recursive PHP function.
- Single template (`single-bd324_services.php`) shows breadcrumbs, content, and child services.
- Nav items (Themes, Plugins, Design) updated to `custom` type pointing at the CPT URLs — `post_type` menu items can't have their URL overridden via WP-CLI.
- CPT archive at `/services/` takes precedence over any page with that slug.
- Content must be entered via WP admin or WP-CLI; no ACF fields defined yet for services (plain post content only).
