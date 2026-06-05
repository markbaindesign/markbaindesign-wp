# Bot Asana Task Mirror
Last synced: 2026-06-04
Workspace GID: 512209774840
Assignee GID: 1209202434387214

## Bain Website

### BD-018 — Show the testimonial image on the project page card
- **Local ID:** BD-018
- **Asana ID:** 1215176887201347
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** None.
- **Progress:** Completed 2026-06-04. Added $t_image from the linked testimonial post thumbnail; rendered as a 40×40 round avatar in the quote attribution block alongside author name/role. Branch: bd-001-002-testimonial-cleanup.
- **Modified:** 2026-06-04T06:00:42
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176887201347

### BD-017 — Show the testimonials excerpt on the project page card
- **Local ID:** BD-017
- **Asana ID:** 1215176887201345
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Show the testimonials excerpt on the project page card, not the whole testimonial
- **Blockers:** None.
- **Progress:** Completed 2026-06-04. Changed quote source in single-bd324_projects.php from wp_strip_all_tags(post_content) to get_the_excerpt(), with stripped content as fallback. Branch: bd-003-testimonial-excerpt.
- **Modified:** 2026-06-04T06:00:42
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176887201345

### BD-015 — Populate the relationships between CPTs
- **Local ID:** BD-015
- **Asana ID:** 1215176887201325
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** BD-014 (1215176887201322)
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** 2026-06-04 — Data entry task: linking existing projects to clients, testimonials, and services in the ACF relationship fields. Fields exist (BD-014 done). Requires Mark to do the linking in WP Admin, or supply a mapping so Bainbot can script it via WP-CLI.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:43
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176887201325

### BD-014 — Add relationship fields between custom post types
- **Local ID:** BD-014
- **Asana ID:** 1215176887201322
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** BD-015 (1215176887201325)
- **Notes:** Projects should link to clients, testimonials, services... etc. Use ACF relationship fields.
- **Blockers:** None.
- **Progress:** Completed 2026-06-04. Verified already done — ACF JSON has relationship fields on all three CPTs: Projects→(Related Client, Related Testimonials, Related projects), Clients→(Related Projects, Related Testimonial), Testimonials→(Related Projects, Related Client). No code change needed.
- **Modified:** 2026-06-04T06:00:44
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176887201322

### BD-013 — Show tags on the project cards
- **Local ID:** BD-013
- **Asana ID:** 1215176887201319
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Display field data from ACF fields, such as stack, tech, service, etc.
- **Blockers:** None.
- **Progress:** Completed 2026-06-04. Added service/tool/tech-stack taxonomy terms as hairline pill tags to each portfolio archive card. Branch: bd-007-project-card-tags.
- **Modified:** 2026-06-04T06:00:45
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176887201319

### BD-012 — Fix typewriter lines
- **Local ID:** BD-012
- **Asana ID:** 1215176803742913
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** 2026-06-04 — Task has no notes describing the bug. JS logic reviewed and no obvious defect found. Need to see the site to know what's broken — is it a visual glitch, wrong caret position, words not cycling? Please add a note with what you're seeing.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:46
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176803742913

### BD-011 — Wire up ACF for content - minimal hardcoded
- **Local ID:** BD-011
- **Asana ID:** 1215176803742911
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Pages on the site should use ACF fields not hardcoded content. Wire this up.
- **Blockers:** 2026-06-04 — Scope is too broad to complete without guidance. Which pages and which fields should be ACF-driven? front-page.php, page-about.php, and page-contact.php all have hardcoded content. Need a list of which fields to extract and where — otherwise high risk of getting it wrong.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:46
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176803742911

### BD-010 — Update the Portfolio page to use Algolia search + filters
- **Local ID:** BD-010
- **Asana ID:** 1206655547490010
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** Portfolio (11205039473653)
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** BD-009 (1211300119076683)
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** None identified.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:47
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1206655547490010

### BD-009 — Implement Algolia search
- **Local ID:** BD-009
- **Asana ID:** 1211300119076683
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** Search (1206905912319873), Search Plugin (1207356638466370), F: Search (1208464674309202)
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** 1211300119076685 (1211300119076685)
- **Dependents:** BD-010 (1206655547490010)
- **Notes:** No notes.
- **Blockers:** 2026-06-04 — Needs Algolia account credentials (Application ID + API key). Cannot begin implementation without these. Please add to .env or share via 1Password.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:48
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1211300119076683

### BD-007 — Restore missing hero image - about section - homepage
- **Local ID:** BD-007
- **Asana ID:** 1215176803742906
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** 2026-06-04 — The about section on front-page.php has no image column in the current template — it was removed or never added. Need the image asset (a portrait/photo) and a decision on where to put it. Please supply the image or point to it in the media library.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:49
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176803742906

### BD-025 — Configure WP Mail SMTP with Gmail credentials on production
- **Local ID:** BD-025
- **Asana ID:** 1215202472993933
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Plugin is deactivated locally after it crashed the CF7 AJAX. Must be configured with real Gmail credentials before reactivating on production. Do not reactivate without credentials in place.
- **Blockers:** 2026-06-04 — Requires Gmail OAuth credentials (Client ID + Secret) or App Password. This is a production-only task requiring SSH access and credentials only Mark holds. Cannot be done by Bainbot.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:50
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215202472993933

### BD-024 — Test contact form end-to-end on production after deploy
- **Local ID:** BD-024
- **Asana ID:** 1215202521106386
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Submit a real entry, confirm it lands at hello@bain.design. Also verify Mailpit is not used on production.
- **Blockers:** 2026-06-04 — Requires production deployment and access to hello@bain.design inbox. Blocked on BD-025 (Gmail SMTP credentials). Cannot be done by Bainbot.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:51
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215202521106386

### BD-023 — Write content for 37 placeholder portfolio projects
- **Local ID:** BD-023
- **Asana ID:** 1215202871835689
- **Section:** TO DO
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** All created as drafts (IDs 1973-2009). Each needs a description, year, client, and any screenshots/assets. Projects span 2014-2026. Start with recent ones: Beato Properties (1974), GGSA LMS (1975), SINI Rebuild (1976), BioInformatico (1973), CABPExpo (1977).
- **Blockers:** 2026-06-04 — Content work requiring Mark's knowledge of each project (brief, role, outcome, screenshots). Cannot be fabricated. Mark needs to supply project details via context/inbox/ or directly in the drafts.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:51
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215202871835689

### BD-022 — Review CF7 form layout — fields should fill the container
- **Local ID:** BD-022
- **Asana ID:** 1215202521410602
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** CSS has been through several revisions. Confirm name/email sit side by side, all fields span full width, and the form fills the right column of the 2-col grid at all viewport sizes.
- **Blockers:** None.
- **Progress:** Completed 2026-06-04. Rewrote CF7 form template with .contact-form-field wrappers; name/email side by side via .contact-form-section__form-row; stripped dead cf7-label CSS hacks; wpcf7-form is now a flex column. Branch: bd-016-cf7-form-layout.
- **Modified:** 2026-06-04T06:00:52
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215202521410602

### BD-021 — Seed CF7 form config so it survives a DB reset
- **Local ID:** BD-021
- **Asana ID:** 1215202472595671
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Form ID 1963 with meta keys _form, _mail, _messages was created manually via WP-CLI/SQL. Add a seed script or document the setup so a fresh DDEV clone does not lose it.
- **Blockers:** None.
- **Progress:** Completed 2026-06-04. Created bd-custom/inc/seed-cf7.php — recreates form 1963 with correct template, mail config, and messages. Run: ddev wp eval-file wp-content/plugins/bd-custom/inc/seed-cf7.php. Branch: bd-017-cf7-seed.
- **Modified:** 2026-06-04T06:00:53
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215202472595671

### BD-020 — Implement Shelf Climber mini-game
- **Local ID:** BD-020
- **Asana ID:** 1215202707476425
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Spec is in GAME_SPEC.md. Canvas-based platformer using Gala + Salvador ASCII sprites from footer. Gala is player, Salvador is AI patrol/chase. See spec for full mechanic detail.
- **Blockers:** None.
- **Progress:** Completed 2026-06-04. Canvas-based ASCII platformer per spec. Gala (A/D move, W/Space jump, 3 lives) vs Salvador (patrol→chase AI, random naps). 5 shelves, 5 yarn items. Win by collecting 5 or reaching top shelf. Trigger: type "gala" anywhere. Branch: bd-018-shelf-climber.
- **Modified:** 2026-06-04T06:00:54
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215202707476425


## DONE

### BD-016 — Add single services pages - create custom post type
- **Local ID:** BD-016
- **Asana ID:** 1215176803742915
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** None identified.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:01:03
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176803742915

### BD-006 — scope custom fields/taxonomies for new design
- **Local ID:** BD-006
- **Asana ID:** 1215085305620668
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Based on the new designs, create spec for the ACF fields needed for custom post types.
- **Blockers:** None.
- **Progress:** Completed 2026-05-27.
- **Modified:** 2026-06-04T06:01:03
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215085305620668

### BD-005 — Portfolio AWOL on local
- **Local ID:** BD-005
- **Asana ID:** 1215050619034020
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Fixed 2026-05-23 — projects visible on local. bd-custom active, 36 posts present. Resolved.
- **Blockers:** None.
- **Progress:** Completed 2026-05-23.
- **Modified:** 2026-06-04T06:01:01
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215050619034020

### BD-002 — audit uploads folder
- **Local ID:** BD-002
- **Asana ID:** 1215050619034004
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Completed 2026-05-23. Deleted BackWPUp backup folders (11GB). PHP files in uploads are all legitimate plugin directory-protection stubs. Old media (2008–2015, ~400MB) retained for now. Uploads reduced from 12GB to 440MB.
- **Blockers:** None.
- **Progress:** Completed 2026-05-23.
- **Modified:** 2026-06-04T06:01:00
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215050619034004

### BD-004 — Remove bower (obsolete)
- **Local ID:** BD-004
- **Asana ID:** 1211312202505933
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** None identified.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:59
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1211312202505933

### BD-003 — remove rss icon
- **Local ID:** BD-003
- **Asana ID:** 1215050619034006
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** None identified.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:58
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215050619034006

### BD-001 — move off vvv to DDEV
- **Local ID:** BD-001
- **Asana ID:** 1215050619033992
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** None identified.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:57
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215050619033992

### BD-008 — Show the admin bar
- **Local ID:** BD-008
- **Asana ID:** 1215176887201341
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** Admin bar is not showing when I view the site signed in. I think there's a filter... remove the filter so I can see the admin bar
- **Blockers:** None identified.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:56
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176887201341

### BD-019 — Remove the dedicated testimonial ACF fields on the project CPT
- **Local ID:** BD-019
- **Asana ID:** 1215176887201349
- **Section:** DONE
- **Due:** none
- **Start:** none
- **Assignee:** BainBot (1209202434387214)
- **Assignee Status:** inbox
- **Tags:** none
- **Followers:** Mark Bain (507443625075), BainBot (1209202434387214)
- **Dependencies:** none
- **Dependents:** none
- **Notes:** No notes.
- **Blockers:** None identified.
- **Progress:** Checked 2026-06-04.
- **Modified:** 2026-06-04T06:00:55
- **URL:** https://app.asana.com/1/512209774840/project/1215368887959233/task/1215176887201349

## Immediate Priorities

| ID | Task | Status |
|----|------|--------|
| BD-018 | Show the testimonial image on the project page car | no due date |
| BD-017 | Show the testimonials excerpt on the project page  | no due date |
| BD-015 | Populate the relationships between CPTs | no due date |
| BD-014 | Add relationship fields between custom post types | no due date |
| BD-013 | Show tags on the project cards | no due date |