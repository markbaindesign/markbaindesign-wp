# ADR-001: Flat CSS over Sass

**Date:** 2026-05-22  
**Status:** Accepted

## Context

The theme was originally built with a Sass pipeline: `sass/styles.scss` as entry point, Grunt compiling to `style.css`. A full design-system rebuild was started from scratch with CSS custom properties throughout.

## Decision

Replace the Sass pipeline with three hand-authored flat CSS files:

- `assets/css/tokens.css` — custom properties only, no selectors
- `assets/css/base.css` — element + utility styles
- `assets/css/theme.css` — layout and components via `@layer`

Enqueued directly in `functions.php` with explicit dependency chain. No Sass, no Grunt compile step.

## Rationale

- The design system is built entirely on CSS custom properties; there is no Sass variable inheritance to migrate.
- Removing the compile step removes a dependency and makes files directly inspectable in DevTools (no sourcemap needed).
- `@layer` in `theme.css` provides the cascade control that Sass partials previously handled.
- The old `sass/` tree references variables and mixins that no longer exist in the new system.

## Tradeoffs

- Lose Sass nesting sugar and mixins. Acceptable at this project scale — nesting is now native CSS anyway.
- The `sass/` directory remains in the repo but is no longer part of the active build. It should be removed once the theme refactor is complete and no legacy templates depend on `style.css`.

## Consequences

- New styles go in `theme.css` inside the appropriate `@layer`.
- `grunt` / `grunt build` no longer compiles theme CSS. The Sass watch task can be ignored.
- `style.css` in the theme root is still required by WordPress for theme identification headers — leave it, but it carries no component styles.
