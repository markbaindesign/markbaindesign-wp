# Obsolete Files & Directories — Audit Report
**Date:** 2026-06-05
**Task:** BD-017
**Status:** Awaiting approval before any deletion

---

## Summary

| Category | Size | Action |
|---|---|---|
| `import/` directory | ~1.8 GB | Delete — gitignored, superseded by DDEV |
| `sass/` directory | ~130 KB | Delete — explicitly replaced by flat CSS |
| `log/*.log` | ~16 MB | Delete — gitignored DDEV logs |
| `source/wp-screenshot-template.psd` | ~3.8 MB | Delete — old Photoshop artefact |
| Duplicate/backup files (tracked) | <1 MB | Delete — stale copies |
| `design/wordpress-integration/` | ~50 KB | Review — prototype, possibly superseded |
| Root-level PNGs (`bain-*.png`) | ~740 KB | Review — QA screenshots in wrong location |
| `AGENTS.md` | ~3 KB | Review — Codex guide, superseded by CLAUDE.md? |
| `GAME_SPEC.md` | ~3 KB | Keep or archive |

**Total recoverable space (safe deletions):** ~1.85 GB

---

## Safe to delete

These have no active role and their removal carries no risk.

### `import/` (1.8 GB) — gitignored
The full old WordPress installation and its BackWPUp archive from the pre-DDEV setup (Sep 2025). Breakdown:
- `backwpup_XOA4MIOQ03_..._2025-09-10.tar` — 841 MB archive
- `wp-content/` — 831 MB (extracted plugins, themes, uploads from old install)
- `ymknrbhwuy.sql` — 25 MB database dump
- `wp-includes/`, `wp-admin/` — 66 MB WordPress core
- `import/dev/` — 2.6 MB (jobs CSV, dev images/audio/video assets)
- `import/screenshots/` — 464 KB (QA screenshots from old design phase)

The migration to DDEV (BD-001) is complete. This directory was the source for that migration. The `.gitignore` already excludes `/import/`.

**⚠ Before deleting:** Confirm you don't need anything from `ymknrbhwuy.sql` (the Sep 2025 DB dump) or `import/wp-content/uploads/`. If the production DB is current and uploads are in `public_html/wp-content/uploads/`, this is safe to wipe.

---

### `sass/` (~130 KB) — git-tracked
CLAUDE.md explicitly states: *"The old sass/ tree and Grunt Sass compilation are no longer used for the active design."* CSS is now authored directly in `assets/css/{tokens,base,theme}.css`.

Contents: `styles.scss`, `editor-style.scss`, `sass/partials/` (22 files including a 70 KB animate.scss), `sass/colors/`, `sass/wp/`.

Note: `grunt/watch.js` still has a `sass` watcher target. It would fail if triggered since the Sass task no longer functions, but it doesn't affect the active workflow (`grunt` just watches PHP/CSS/JS via livereload). The dead watcher target can be removed at the same time.

---

### `log/nginx-access.log` (16 MB), `log/nginx-error.log` (110 KB) — gitignored
Stale DDEV Nginx logs from Nov 2025. `*.log` is in `.gitignore`. DDEV regenerates these. Safe to delete; DDEV will recreate them.

---

### `source/wp-screenshot-template.psd` (~3.8 MB) — git-tracked
Old Photoshop template for generating WordPress.org theme screenshots. No longer relevant — this is not a distributable theme. `source/README.md` is a placeholder with a single line.

---

### Tracked duplicate/backup files
All small, clearly stale:

| File | Notes |
|---|---|
| `Gruntfile copy.js` | Backup of old Gruntfile (10 KB). Superseded by current `Gruntfile.js`. |
| `.gitignore copy` | Backup of `.gitignore`. |
| `README (1).md` | Duplicate README with "(1)" suffix — a download artifact (12 KB). |
| `colors_and_type.css` (root) | **Identical** to `design/design-system/colors_and_type.css`. Root copy is redundant. |
| `grunt/aliases.json.bak` | Backup of Grunt aliases config. |

---

### `grunt/postcss.js` and `grunt/sass.js`
Both reference the old Sass build pipeline (`assets/css/build/style.css` output path that doesn't exist). These Grunt task configs are never called in the active workflow but are loaded by `load-grunt-config`. Low priority but worth removing alongside the `sass/` directory.

---

## Review before deleting

These are tracked files that may still have a purpose.

### `design/wordpress-integration/` (~50 KB)
A standalone "drop-in package" prototype that preceded the current theme. Contains early versions of:
- `inc/bain-design-system.php` and `inc/cpt-project.php` (superseded by actual theme/plugin equivalents)
- `assets/css/` (superseded by `assets/css/` in the theme)
- `templates/single-project.php` (superseded by `single-bd324_projects.php`)
- `acf/group_bain_project.json` (superseded by `plugins/bd-custom/acf-json/`)

**Recommendation:** Archive to a `_archive/` branch or delete. Nothing in this directory is referenced by the active theme or plugin.

---

### Root-level PNGs: `bain-front.png`, `bain-full.png`, `bain-projects.png`, `bain-services.png` (~740 KB total)
Screenshots of the site from May 2026. Not referenced by code. Appear to be QA reference shots. If needed, they belong in `design/` or `docs/`. Otherwise delete.

---

### `AGENTS.md` (~3 KB)
An OpenAI Codex guide for the project. Predates the current CLAUDE.md workflow. Effectively superseded by CLAUDE.md. Safe to delete unless you intend to use Codex alongside Claude Code.

---

### `GAME_SPEC.md` (~3 KB)
Spec for the Shelf Climber mini-game (BD-020, now shipped). Could live in `docs/` as project history, or deleted as clutter. No code references it.

---

## Not obsolete — keep

| Item | Reason |
|---|---|
| `export/`, `release/` | Empty gitignored output dirs — placeholders for `grunt export`/`grunt build` |
| `design/design-system/` | Active brand reference, preview files, social assets |
| `SKILL.md` | Design system skill descriptor — used by the harness |
| `grunt/watch.js` (livereload section) | Active — watches PHP/CSS/JS for livereload |
| `docs/adr/` | ADRs 001–003 — active architectural decisions |
| `docs/projects.md` | Project structure reference |
| `content/`, `context/` | Content inbox pipeline |
| `CLAUDE.md`, `.claude/` | Active project instructions and Asana mirror |
