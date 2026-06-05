# ADR-002: Vanilla JS for theme interactions (no React)

**Date:** 2026-05-22  
**Status:** Accepted

## Context

The design-system UI kit (`design/design-system/ui_kits/website/`) was prototyped in React/JSX (loaded via CDN). This includes the hero cycling-caret animation, portfolio card 3D tilt, footer interactions, toast, cursor trail, and type triggers.

When wiring these into the WordPress theme, a decision was needed: ship the React runtime, or port to vanilla JS.

## Decision

Port all interactions to vanilla JS in `assets/js/dist/main.min.js`. No framework, no bundler, no build step. The file is written directly (the `.min.js` suffix is a path convention only — the file is readable).

## Rationale

- All interactions are self-contained DOM effects with no shared state that would benefit from a reactive model.
- Adding React requires a bundler (Vite/webpack), a build step, and ~40KB of gzipped runtime.
- The vanilla port of the hero animation is ~120 lines; the rest of the interactions add another ~100. Total JS shipped is smaller than React alone.
- WordPress themes should minimise JS payload; this site has no other JS framework dependency.

## Tradeoffs

- The hero animation (cycling caret with line-by-line transit, typos, false starts) is the hardest part to maintain in vanilla JS vs. the React/JSX original. The JSX in `design/design-system/ui_kits/website/Hero.jsx` remains the canonical design reference.
- If future interactivity grows significantly in complexity (e.g. a full SPA portfolio filter), revisit this decision.

## Consequences

- `assets/js/dist/main.min.js` is the single JS entrypoint. All interactions live there.
- No `node_modules` or bundler config needed for JS.
- The `design/` UI kit JSX files are design documentation, not source — they are not compiled into the theme.
- To modify hero animation behaviour, edit `initHero()` in `main.min.js` and reference `Hero.jsx` for the original logic.
