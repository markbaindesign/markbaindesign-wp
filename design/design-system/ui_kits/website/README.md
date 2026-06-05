# Website UI Kit — Bain Design

A high-fidelity recreation of the Bain Design marketing site, built from
the live site (https://bain.design/) and the brand specimens in
`/assets/`. **Source code was not provided** — these components are
visual recreations based on observed structure and the Bain "geeky /
tasteful / dev" voice.

## Structure

| File | What it is |
|---|---|
| `index.html` | Composed homepage — header, hero, services, projects, about, contact, footer |
| `Header.jsx` | Sticky top bar with `Bd` mark and slash-separated nav |
| `Hero.jsx` | Big mono headline with blinking `_` cursor, lead, two CTAs |
| `Services.jsx` | Numbered three-row services list (Themes / Plugins / Design) |
| `Projects.jsx` | "Latest projects" 3-up card grid with bracketed metadata |
| `About.jsx` | Two-column about strip with `✔` checked list |
| `Contact.jsx` | Contact CTA + footer with "Build with ♥" sign-off |
| `Contact Page.html` | Three full-page contact treatments laid out on a design canvas |
| `Single Project Page.html` | Editorial long-scroll case-study template (`SingleProject.jsx`) |
| `Nice Words.html` | Testimonials archive — featured pull-quote, terminal filter row, 3-column masonry wall, counter strip (`NiceWordsArchive.jsx`) |
| `Single Testimonial.html` | Single review as editorial spread — giant serif pull-quote, designer's-side context, linked case study, prev/next voice strip (`SingleTestimonial.jsx`) |
| `About Page.html` | About — hero, letter-feel bio with portrait, principles ✔ list, career timeline, tools, off-the-clock, CTA (`AboutPage.jsx`) |
| `Services Page.html` | Services — hero with table-of-contents, three detailed service blocks (Themes / Plugins / Design), process bar, engagement models, FAQ, CTA (`ServicesPage.jsx`) |
| `single-project-shared.jsx` | Shared `SiteHeaderMock` / `SiteFooterMock` / `ScreenPlaceholder` used by all page templates |
| `testimonials-shared.jsx` | Testimonial data (12 reviews), filter taxonomies, counters, `InitialsAvatar` / `BracketMeta` / `FilterChip` helpers |

## Components covered

Header (logo + nav), Hero, Section title pattern (`01 / Services`),
Services row, Project card, Checked list, Bracketed metadata,
Email-as-CTA, Footer, Contact form, Single-project case-study spread,
Testimonials archive wall, Single testimonial editorial spread,
About / bio letter spread, Career timeline, Tools grid, Off-the-clock list,
Service detail block, Process bar, Engagement model cards, FAQ list,
Initials avatar, Terminal filter chips, Prev/next strip, Counter strip.

## Caveats

- All imagery is placeholder boxes (`[ project preview ]`). Drop real
  screenshots into `assets/` and wire them up.
- The `Bd` mark is rebuilt as a square text block — if you have the
  vector original, swap it in.
- Source-code access would tighten spacing, hover states, and the
  exact mobile breakpoint behavior.
