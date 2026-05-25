# Bain Design — Design System

> Geeky. Tasteful. Dev.

A design system for **Bain Design**, the studio of Mark Crawford Bain — a
WordPress designer & developer based near Barcelona, building bespoke
websites, themes and plugins for individuals, small businesses and
start-ups since 2012.

The brand voice: warm, plain-spoken, technical-but-friendly. The visual
language: monospaced, square-cornered, terminal-adjacent, with editorial
restraint. Picture a `man` page that knows its way around a typesetter.

**Visual reference influences:**
- Bain Design's own resume + site (square `Bd` mark, mono everything, `[bracketed]` metadata, `✔` bullets, blue underlined links)
- The Claude aesthetic — warm cream paper background, ink-on-paper restraint, a single warm clay accent (`#C96442`), serif moments amid the mono

---

## Sources

This system was reverse-engineered from the live site and a small set of
artefacts the user provided. We did **not** have access to source code or
Figma. Visual decisions were calibrated against:

- **Live site** — <https://bain.design/> (home, about, portfolio)
- **Brand mark** — `assets/bain-mark-bd.png` (square Bd lockup with the
  unicode-mangled `BΛIП DΣƧIGП` wordmark)
- **Resume specimen** — `assets/bain-resume-sample.png` (a near-perfect
  encapsulation of the brand: mono headlines, `[bracketed]` metadata,
  `✔` bullets, blue underlined links)
- **Tagline** — "Friendly websites for interesting people."
- **Manifesto fragment** — "Build with ♥"
- **Voice cues** — `BΛIП DΣƧIGП — 𝕭𝖚𝖎𝖑𝖉 𝖜𝖎𝖙𝖍 ♥ — Bespoke WordPress
  Development` (page title; uses unicode font-tricks for personality)

If you have access to the WordPress theme repo or a Figma file, drop them
in — every section below should be checked against the source of truth.

---

## Index

| Path | What it is |
|---|---|
| `colors_and_type.css` | All design tokens — colors, type, spacing, borders, shadows. Import this. |
| `fonts/` | Webfonts (JetBrains Mono, IBM Plex Mono — Google Fonts substitutes) |
| `assets/` | Logo marks, favicons, ASCII patterns, sample imagery |
| `preview/` | Design-system cards rendered for the review pane |
| `ui_kits/website/` | Marketing-site UI kit — components + index.html mock |
| `SKILL.md` | Agent-skill manifest so this system can be used in Claude Code |

---

## Content fundamentals

### Voice

Three words: **geeky, tasteful, dev.** Mark writes like a senior engineer
who genuinely likes his clients. Plain English, no jargon for jargon's
sake, no marketing puffery. The technical bits are precise; the human
bits are warm.

### Person & address

- **First person, singular.** "I design & build…", "my work", "Email me".
- **"You" for the reader.** "If you're keen to find out more…"
- **"We" only** when referring to client engagements collectively
  (`Work With Us`).

### Tone & casing

- **Sentence case** for everything — headings, buttons, nav.
- **Title Case is reserved** for proper nouns (WordPress, GitHub,
  Barcelona) and named services ("Themes", "Plugins", "Design").
- **British English.** "optimising", "specialised", "favourite".
- **Em-dashes and Oxford commas welcome.** It's writerly, not breezy.
- **Numerals are written out** under ten in body copy ("two free
  open-source plugins"); digits are fine in technical context ("14+
  years", "2012").

### Vocabulary

Recurring nouns: **bespoke**, **custom**, **friendly**, **interesting**,
**high-specification**, **fully-responsive**, **from scratch**,
**one-stop solution**, **wireframing**, **mood-boarding**.

Avoid: *synergy, leverage, unlock, supercharge, AI-powered, next-gen,
robust, solutions* (as a buzzword), *crafted* (overused — "built",
"coded", "designed" are stronger).

### Microcopy patterns

- **CTAs are plain verbs.** "Arrange a chat now", "Check out my work",
  "See more projects", "Back to top". No "Click here", no "→ Learn more
  about our offerings".
- **Bracket metadata.** `[WordPress Designer & Developer]` — a single
  line of role, framed in square brackets, sits below a name.
- **Slash separators for inline pairs.** `Mark Crawford Bain / WordPress
  Designer & Developer`, `Email: mark@bain.design / Website:
  https://bain.design`.
- **Numbered sections.** `1. Professional Summary`, `2. Relevant Work
  Experience` — like a well-formatted README.

### Emoji & glyphs

- **No emoji** in product UI. The one allowed exception: **♥** (U+2665,
  not 🩷) in the "Build with ♥" footer signature.
- **Unicode glyphs as iconography.** `✔` for list bullets, `[`/`]` for
  bracketed labels, `/` as a separator, `→` for nav, `_` as a blinking
  cursor. These do the work emoji would do elsewhere.
- **Box-drawing characters** (`─ │ ┌ ┐ └ ┘ ├ ┤`) are fair game for
  decorative panels and ASCII-art accents.

### Sample copy that's on-brand

> Friendly websites for interesting people.

> I design & build bespoke websites for individuals, small businesses &
> start-ups.

> If you're keen to find out more, there are lots of ways you can get in
> touch with me, but why not start with an email?

---

## Visual foundations

### Color

A near-monochrome palette with a single saturated accent. The brand
lives in the negative space between **paper** and **ink**.

- **Ink** (`#141413`) — primary text, mark, hard rules. Warm black, not pure black.
- **Paper** (`#F5F0E8`) — page background. Warm cream, oat-tinted (Claude-influenced).
- **Paper Deep** (`#EDE6DA`) — tinted panels, hovered list rows.
- **Paper Pure** (`#FFFFFF`) — used rarely, inside form fields.
- **Graphite** (`#3D3D3A`) — secondary text, sub-headlines.
- **Pencil** (`#8C8A85`) — tertiary text, captions, metadata.
- **Rule** (`#1F1F1D`) — borders & dividers. Always thin, always full opacity.
- **Clay** (`#C96442`) — the warm-accent brand color. Used for marks, highlights, the `♥` glyph, primary CTAs. Never used as a link color.
- **Hyperlink Blue** (`#1A4FE3`) — links, always underlined. Bain signature.
- **Visited** (`#6B3FB7`) — purple visited state, classic browser.
- **Phosphor** (`#22C55E`) — terminal green, used sparingly for cursors, `OK` states and the `✔` bullet glyph.
- **Amber** (`#D89A2B`) — caution / "in progress" state.
- **Vermilion** (`#C43D2F`) — error, destructive.

Imagery is generally warm-neutral — paper-toned, mid-contrast, never
saturated. Hero photography reads as documentary, not marketing.

### Typography

**Two families, both monospace, plus one accent serif for the rare
moment of editorial flourish.**

- **Display & UI:** *JetBrains Mono* — 400 / 500 / 700.
  Used for headlines, body, buttons, labels — almost everything.
- **Code & metadata:** *IBM Plex Mono* — 400 / 500.
  Used for inline code, bracketed metadata, captions. Slightly more
  humanist than JetBrains; provides quiet contrast.
- **Editorial accent:** *PP Editorial New* (or fallback *Source Serif*)
  — used at very large sizes for portfolio quotes only. Rare.

Tracking is tight on display, normal on body. Line-height is generous
(1.6 on body) — monospace needs the air. Measure is short — 60–70 ch.
Headings are **left-aligned, never centered**, never all-caps.

### Spacing

A **4px base grid**. Tokens scale linearly to a t-shirt scale.

```
--space-1: 4px    --space-5: 24px
--space-2: 8px    --space-6: 32px
--space-3: 12px   --space-7: 48px
--space-4: 16px   --space-8: 64px
                  --space-9: 96px
```

Section rhythm is **96px** between major blocks on desktop, **48px** on
mobile. Components nest on multiples of 8px.

### Borders & corners

- **No rounded corners.** Everything is `border-radius: 0`. This is a
  load-bearing rule, not a default — it defines the brand.
- **1px hairlines** in `--rule` for dividers, card edges, table rows.
- **2px solid frames** around the Bd mark and any "framed" element
  (badges, callouts).
- A **double-rule** pattern (1px line, 2px gap, 1px line) is used for
  major section dividers — feels like a printed report.

### Shadows & elevation

Almost none. This is a flat system. The two exceptions:

- **Press shadow** — a 2px hard offset (`2px 2px 0 var(--ink)`) on
  pressable cards and the primary button on hover. No blur. It's a
  printed-stamp feel, not iOS depth.
- **Inset rule** — a 1px inset top border on sticky headers when
  content scrolls beneath.

No blurs, no glassmorphism, no soft drop shadows.

### Backgrounds & texture

The default page is solid `--paper`. Texture is opt-in and earned:

- **Optional grain** — a very subtle 2% noise PNG can be tiled on hero
  panels. Off by default.
- **Box-drawing borders** — full-width ASCII rules
  (`────────────────────`) used as section separators.
- **Big numerals** — section numbers (`01`, `02`) can sit at 240px in
  the margin as decorative type.
- No gradients. No glassmorphism. No background images behind text
  except the explicit hero portrait.

### Motion

Restrained, mechanical, never bouncy.

- **Duration:** 120ms (micro), 200ms (default), 320ms (page-level).
- **Easing:** `cubic-bezier(0.2, 0, 0, 1)` — a near-linear ease-out. No
  springs, no overshoots.
- **Hover:** color or border swap, never scale.
- **Cursor blink:** the `_` underscore cursor blinks at 1.06s intervals
  — fast enough to feel alive, slow enough to not annoy.
- **Page transitions:** none. Hard cuts.

### Hover & press

- **Links** — underline is always on. On hover, color shifts to
  `--ink`, underline thickens from 1px to 2px.
- **Buttons** — primary (`Ink on Paper`) inverts on hover (Paper on
  Ink). On active, picks up the 2px hard-offset press shadow.
- **Cards** — border thickens from 1px to 2px on hover. No transform.
- **Focus** — visible 2px solid `--ink` outline at 2px offset. Never
  removed.

### Layout rules

- **12-column grid**, 24px gutters, 1280px max content width.
- **Sticky header** with the Bd mark and inline nav. Always full-width,
  bottom rule.
- **Footer** is a plain text block — no columns, no decoration. Mark
  signs off with `Build with ♥`.
- **No hamburger menu on tablet+.** Nav is always visible.
- **Generous left margin** on long-form pages (about, blog) to create
  a "letter" feel. Right margin smaller — copy hugs the gutter.

### Use of transparency & blur

Effectively none. The system reads as a printed page; transparency
breaks that. The single exception: `rgba(14,14,14,0.04)` for hover
backgrounds on list rows.

### Imagery

- **Documentary, warm-neutral.** Project screenshots are shown
  full-frame, no device mockups, no drop shadows.
- **B&W portraits** acceptable for the about page.
- **No stock illustration. No generic isometric SaaS art.** When art is
  needed, an ASCII diagram or a hand-typed code block beats a vector.

---

## Iconography

See the `ICONOGRAPHY` section below for the long version.

**Short rule:** prefer **unicode glyphs** for inline marks, **Lucide**
(linked from CDN) for any icon that needs to be a real SVG.

Inline glyph vocabulary:

| Glyph | Meaning |
|---|---|
| `✔` | Completed item, list bullet |
| `→` | Next, link out, navigation |
| `↗` | External link |
| `_` | Cursor / prompt |
| `[ ]` | Metadata frame |
| `/` | Inline separator |
| `♥` | Signature ("Build with ♥") |
| `•` | Mid-dot separator (use sparingly) |
| `─ │ ┌ ┐ └ ┘` | Box-drawing for ASCII panels |

Lucide is used as a CDN fallback for any product icon that can't be
expressed as a glyph (e.g. RSS, GitHub, settings cogs). Stroke weight
**1.5px**, never filled.

> **Substitution flag:** the live site uses bespoke unicode-mangled
> wordmarks (`BΛIП DΣƧIGП`) and a custom `Bd` raster mark. We've
> rebuilt the `Bd` mark as an inline SVG (`assets/bd-mark.svg`) — if
> you have the original vector or webfont, please drop it in.

---

## Caveats

- **Fonts are Google substitutes.** JetBrains Mono and IBM Plex Mono
  are both on Google Fonts; if Mark uses different mono on the actual
  site, swap the `@font-face` blocks.
- **No source access.** All visual decisions were calibrated against
  the live site (HTML extraction) and two screenshots. Direct theme
  source would tighten this considerably.
- **Single product covered.** We've built one UI kit — the marketing
  website — because that's the only surface evidenced. If there's an
  admin / client portal / pitch-deck template, flag it.
