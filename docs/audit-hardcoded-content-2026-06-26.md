# Audit: Hardcoded Content to Replace with ACF
Date: 2026-06-26

Content that lives in PHP template files rather than ACF fields. Grouped by file and priority.

---

## page-contact.php

All editorial data is in three PHP arrays at the top of the template. Mark edited this file directly on 2026-06-26 to update location, schedule URL, hours, and FAQ answers. This is the most urgent candidate for ACF — it requires a code edit for every content update.

### `$contact` array
| Key | Current value | Priority |
|---|---|---|
| `email` | `hello@bain.design` | High — appears in multiple templates |
| `schedule` | Google Calendar URL | High — changes when booking tool changes |
| `github` | `github.com/markbaindesign` | Low |
| `rss` | `bain.design/feed` | Low |
| `location` | `Sabadell` | Medium — changed 2026-06-26 |
| `responseTime` | `within a working day or two` | Medium |
| `hours` | `09:30–19:00 CET (weekdays)` | Medium — changed 2026-06-26 |

### `$channels` array
6 channel cards with kind, title, addr, desc, cta, tone. ACF repeater on the Contact page.

### `$faq` array
5 FAQ items, each with q and a. Multiple answers edited 2026-06-26. ACF repeater on the Contact page.

**Suggested ACF group:** `Contact Page Settings` — Location: Contact page (page template = `page-contact.php`)

---

## page-about.php

All content sections are PHP arrays. The about page has never been editable without a code push.

### Portrait image
```php
$portrait_id = 1954;
```
Hardcoded attachment ID appears here AND in `front-page.php`. If the portrait is replaced, both files need a code edit. ACF image field on a sitewide or about-page options group.

### Hero meta (`about-hero__meta`)
| Key | Value | Priority |
|---|---|---|
| Where | `Sant Cugat, near Barcelona` | Medium |
| Pronouns | `he / him` | Low |
| Email | `mark@bain.design` | High |
| Since | `2012` | Low |
| Status | `Booking 2026` | High — changes each year |

### `$bio` (3 paragraphs)
Long-form editorial copy. ACF textarea or wysiwyg repeater on About page.

### `$principles` (5 items — title + body)
Stable brand copy but editorial in nature. ACF repeater.

### `$timeline` (7 entries — year + body)
The 2026 entry currently reads "Currently taking two more projects for the year" — this changes annually. ACF repeater, most likely on About page.

### `$tools` (4 groups — group label + items list)
Tool list changes occasionally (e.g. adding Alpine.js, updating PHP version). ACF group with repeater per column, or a flexible content field.

### `$off_clock` (4 items — label + text)
Leisure copy. Low priority but editorial. ACF repeater.

**Suggested ACF group:** `About Page Content` — Location: page template = `page-about.php`

---

## front-page.php

### About section portrait
```php
wp_get_attachment_image( 1954, ... )
```
Same hardcoded ID as page-about.php. Single ACF image field on a Site Options page would fix both.

### Hero sub text (line 41)
"I design & build bespoke websites for individuals, small businesses & start-ups."
ACF text field on Front Page or Site Options.

### About section intro (line 175)
"14+ years building bespoke WordPress sites from inception to execution. Based near Barcelona, working with clients worldwide."
Note: location says "Barcelona" but contact/about pages now say "Sabadell" — inconsistency introduced 2026-06-26.

### About section checklist (lines 177–182)
4 list items with inline tooltip text. ACF repeater.

### Contact section lead (line 197)
"If you're keen to find out more, there are lots of ways to get in touch — but why not start with an email?"
ACF text field.

### Email address (line 199)
`hello@bain.design` — hardcoded. Should come from a shared Site Options field alongside the `mark@bain.design` in page-about.php. Two different addresses are in use — that's intentional but both should be ACF.

**Suggested ACF group:** `Front Page Content` — Location: page template = `front-page.php`  
**Plus:** `Site Options` ACF options page for shared values (portrait image, email addresses, location).

---

## page-services.php

Clean — loops over `bd324_services` CPT. No editorial content hardcoded.

---

## Flagged inconsistency

`front-page.php` about section says "Based near Barcelona" but `page-contact.php` and `page-about.php` now say "Sabadell" following the 2026-06-26 edit. ACF site options would eliminate this drift.

---

## Recommended implementation order

1. **Site Options page** — portrait image ID, primary email, contact email, availability status. Shared across all templates. Fixes the attachment ID problem and the location inconsistency in one pass.
2. **Contact page ACF group** — `$contact`, `$channels`, `$faq` as repeaters. Most urgent: Mark is editing this as PHP directly.
3. **About page — hero meta** — availability status ("Booking 2026") and location change often enough to warrant ACF now.
4. **About page — timeline** — the current-year entry changes annually.
5. **About page — bio, principles, tools, off-clock** — stable but editorial. Lower urgency.
6. **Front page content fields** — hero sub, about intro, checklist, contact lead.
