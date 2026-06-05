// Services — full page treatment.
// Hero band → three detailed service blocks (Themes / Plugins / Design)
// → "how we'd work together" process bar → engagement models → FAQ → CTA.

const SERVICES_DATA = [
  {
    num: '01',
    name: 'Themes',
    sub:  'Bespoke WordPress themes, coded from scratch.',
    stamp: 'no bloat ✦',
    intro: "A new theme, written by hand against your brief — no parent theme, no page builder, no jQuery. The CMS your editors use every Tuesday matters as much as the homepage your competitors look at once.",
    included: [
      'A bespoke theme in a versioned git repo, handed over with a setup README',
      'Editorial flow built around real custom post types — not shortcodes',
      'Block patterns where appropriate, full block templates where not',
      'Performance budget: Lighthouse 95+ on all four scores, on real hardware',
      'A11y baseline: WCAG AA, keyboard parity, prefers-reduced-motion',
      'A 45-minute editorial training call on Zoom, recorded and yours to keep',
    ],
    youdWantThisIf: [
      "Your current theme is a fork of a fork and nobody knows what's in it.",
      "You're tired of phoning a developer to add a section.",
      "Your editors quietly hate the publishing flow.",
    ],
    notFor: [
      "Sites that genuinely need a marketplace theme (e.g. a niche directory).",
      "Engagements under 4 weeks — not enough time to do this well.",
    ],
    typicalScope: '6–14 weeks',
    fromPrice: '£14k',
    sample: 'Khyentse Foundation, Mhairi McFarlane, The Reed Letters',
  },
  {
    num: '02',
    name: 'Plugins',
    sub:  'Custom functionality, shipped as a versioned dependency.',
    stamp: 'two on .org ✦',
    intro: "If the brief needs logic that does not belong in a theme — grant cycles, membership tiers, a bespoke importer — I write it as a single-purpose plugin and hand it over as a versioned package. Two of my plugins are free on WordPress.org with combined 32k installs; the rest are bespoke installs at one client each.",
    included: [
      'A focused plugin in its own git repo, semver-tagged, autoloaded via Composer',
      'PHPUnit tests where the logic is worth testing (most of it is)',
      'Admin UI only where strictly required — most plugins are config-as-code',
      'Settings backed by ACF / register_setting, never an options page from scratch',
      'Versioned updates via Git Updater or a private package registry',
      'Optional: a maintenance retainer for the first 12 months',
    ],
    youdWantThisIf: [
      "You're about to write a thousand-line functions.php and you know it.",
      "You need to ship the same logic across two or three client sites.",
      "Your current solution is a Zapier chain held together with hope.",
    ],
    notFor: [
      "Functionality that an existing well-maintained plugin does cleanly. I'll tell you.",
      "Plugins intended for the .org marketplace without a maintenance plan attached.",
    ],
    typicalScope: '2–8 weeks',
    fromPrice: '£4k',
    sample: 'kf-grants, Plain Sitemap, Slow Comments, allotment-membership',
  },
  {
    num: '03',
    name: 'Design',
    sub:  'Wireframing through to UI — mood-board to handoff.',
    stamp: 'pixels & all ✦',
    intro: "Often bundled with a Themes engagement, occasionally sold on its own to clients who already have a developer they like. Mood-boards, wireframes in Figma, a small design system, and a polished UI hand-off — front-end and back-end.",
    included: [
      'Discovery interviews (1–3 sessions, recorded with consent)',
      'Mood-board + visual direction — 2 routes, presented in person',
      'Wireframes for the 8–12 page types that matter',
      'A small design system: colors, type, spacing, components in Figma',
      'High-fidelity UI for hero pages + a representative editorial flow',
      'A handover doc your developer (or me) can read in one sitting',
    ],
    youdWantThisIf: [
      "You have a developer you trust and need design they can build.",
      "You're rebranding and the website is part of the launch.",
      "You want a small design system, not a 400-page Figma library.",
    ],
    notFor: [
      "Logo / identity work — I'll happily refer you to people who do this better.",
      "Pure marketing-site visual refreshes with no editorial component.",
    ],
    typicalScope: '4–10 weeks',
    fromPrice: '£8k',
    sample: 'Cobblestone, Studio Half, Noon Health (marketing)',
  },
];

const PROCESS_STEPS = [
  { n: '00', name: 'Hello',     dur: '1 call',  text: 'A 30-minute call to make sure we both want this. No deck, no NDA, no PowerPoint.' },
  { n: '01', name: 'Discovery', dur: '1–2 wks', text: 'Interviews with editors, board, customers as appropriate. A short written brief at the end.' },
  { n: '02', name: 'Wireframe', dur: '1–3 wks', text: 'Low-fidelity wireframes for the 8–12 page types that matter. Reviewed in person where possible.' },
  { n: '03', name: 'Design',    dur: '2–4 wks', text: 'Two visual directions, narrowed to one, then a small design system + hero pages.' },
  { n: '04', name: 'Build',     dur: '4–10 wks', text: 'The longest phase. Weekly Friday demo on staging. You break it, I fix it.' },
  { n: '05', name: 'Launch',    dur: '1 wk',    text: 'DNS cutover, redirects, snapshots, the editorial training call. A bottle of cava on me.' },
  { n: '06', name: 'Care',      dur: 'ongoing', text: 'A 12-month care plan included; renewable yearly. Sensible reply windows, version-tagged plugins, no surprises.' },
];

const ENGAGEMENT_MODELS = [
  {
    tag: 'Project',
    name: 'Fixed project',
    body: 'Most engagements. A scoped brief, a milestone-based payment plan (30 / 30 / 30 / 10), and a single agreed delivery date. Best for new builds.',
    bullets: ['Scoped brief', 'Milestone payments', 'Single delivery date', 'Includes 12-month care plan'],
    suits: 'New builds, redesigns, plugin authoring',
  },
  {
    tag: 'Day rate',
    name: 'Day rate',
    body: 'For ongoing work, refactors, and engagements where the scope honestly cannot be known up front. Billed in half-day units, invoiced fortnightly, max 8 days a month per client.',
    bullets: ['£900 / day (2026)', 'Half-day minimum', 'Fortnightly invoicing', '8 days/month cap'],
    suits: 'Refactors, ongoing improvements, advisory',
  },
  {
    tag: 'Care',
    name: 'Care plan',
    body: 'Included free for 12 months after launch, renewable at £160/month. Updates, monitoring, backups, a sensible reply window, and the occasional small change without an invoice attached.',
    bullets: ['£160 / month', 'Updates + monitoring', '8h/quarter small changes', 'Same-week reply window'],
    suits: 'Anyone who launched with me in the past 12 months',
  },
];

const FAQS = [
  {
    q: 'Do you take on retainer / agency-of-record work?',
    a: "Not really. I'm a sole practitioner and I'd rather refer you to people who do retainer work well. I do, however, offer a yearly care plan for sites I've built — see above.",
  },
  {
    q: 'Will you work on a site somebody else built?',
    a: "Sometimes. If the codebase is sensible and the work is well-scoped, yes. If it's a tangle of inherited shortcodes and no version control, I'll usually quote a rebuild instead — and explain why.",
  },
  {
    q: 'Do you offer hosting?',
    a: "I don't. I'll happily recommend a sensible host (currently: Kinsta for clients who want managed, Hetzner for clients who want cheap and don't mind setup) and configure it on your behalf during launch.",
  },
  {
    q: "What does your contract look like?",
    a: "Two pages of plain English, drafted by a human solicitor, signed via Docusign. Includes the scope, the milestones, the payment schedule, an IP-assignment clause, and a 30-day kill switch in case you change your mind early.",
  },
  {
    q: 'Where are you based and what hours do you keep?',
    a: "Sant Cugat del Vallès, just outside Barcelona — CET. I keep European office hours, but reply windows for clients in the Americas and APAC are typically within one local working day.",
  },
  {
    q: 'How do I start?',
    a: "Email mark@bain.design with a paragraph about what you want, who it's for, and any deadline you're working against. I usually reply within a working day with either a 30-minute call invite or an honest \"this isn't the right fit\".",
  },
];

const ServicesPage = () => {
  const W = 1440;
  return (
    <div data-screen-label="Services page" style={{
      width: W, background: 'var(--paper)', color: 'var(--ink)', fontFamily: 'var(--font-mono)',
    }}>
      <SiteHeaderMock active="Services" />

      {/* ----- HERO ----- */}
      <section style={{ padding: '80px 96px 64px', borderBottom: '1px solid var(--rule)' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '120px 1fr 280px', gap: 48, alignItems: 'baseline' }}>
          <div style={{
            fontSize: 96, fontWeight: 700, color: 'var(--rule-soft)',
            lineHeight: 0.9, letterSpacing: '-0.04em',
          }}>SV</div>

          <div>
            <BracketMeta>3 services / one-stop solution / since 2012</BracketMeta>
            <h1 style={{
              fontSize: 72, fontWeight: 700, letterSpacing: '-0.03em',
              lineHeight: 1.05, margin: '16px 0 24px',
            }}>
              Services<span style={{ color: 'var(--clay)' }}>.</span>
            </h1>
            <p style={{ fontSize: 22, color: 'var(--graphite)', maxWidth: '52ch', lineHeight: 1.5, margin: 0, textWrap: 'pretty' }}>
              Three things, done thoroughly. Most engagements bundle two or three of them — the table-of-contents below is the easiest way to start.
            </p>
          </div>

          {/* mini table of contents */}
          <div style={{
            border: '1px solid var(--rule)', padding: '16px 18px', background: 'var(--paper-deep)',
            fontFamily: 'var(--font-mono-2)', fontSize: 13, lineHeight: 1.8,
          }}>
            <div style={{ color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.06em', fontSize: 11, marginBottom: 8 }}>
              on this page
            </div>
            {[
              { n: '01', label: 'Themes',           href: '#themes' },
              { n: '02', label: 'Plugins',          href: '#plugins' },
              { n: '03', label: 'Design',           href: '#design' },
              { n: '04', label: 'How we\'d work',   href: '#process' },
              { n: '05', label: 'Engagement models',href: '#models' },
              { n: '06', label: 'FAQ',              href: '#faq' },
            ].map((row) => (
              <div key={row.n} style={{ display: 'grid', gridTemplateColumns: '28px 1fr 12px', gap: 8 }}>
                <span style={{ color: 'var(--pencil)' }}>{row.n}</span>
                <a href={row.href} style={{ color: 'var(--ink)', textDecoration: 'none', borderBottom: '1px solid transparent' }}>{row.label}</a>
                <span style={{ color: 'var(--pencil)' }}>→</span>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* ----- SERVICE BLOCKS ----- */}
      {SERVICES_DATA.map((s, i) => (
        <ServiceBlock key={s.num} s={s} idx={i} />
      ))}

      {/* ----- PROCESS ----- */}
      <section id="process" style={{
        padding: '96px 96px', borderTop: '1px solid var(--rule)',
        background: 'var(--paper-deep)',
      }}>
        <div style={{ display: 'flex', alignItems: 'baseline', gap: 16, marginBottom: 40 }}>
          <BracketMeta>04</BracketMeta>
          <h2 style={{ fontSize: 40, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>
            How we'd work together<span style={{ color: 'var(--clay)' }}>.</span>
          </h2>
        </div>

        {/* horizontal process bar */}
        <ol style={{
          listStyle: 'none', padding: 0, margin: 0,
          display: 'grid', gridTemplateColumns: `repeat(${PROCESS_STEPS.length}, 1fr)`, gap: 0,
          border: '1px solid var(--ink)', background: 'var(--paper-pure)',
        }}>
          {PROCESS_STEPS.map((step, i) => (
            <li key={step.n} style={{
              padding: 20, borderLeft: i === 0 ? 'none' : '1px solid var(--rule)',
              display: 'flex', flexDirection: 'column', gap: 10, minHeight: 220,
            }}>
              <div style={{ display: 'flex', alignItems: 'baseline', justifyContent: 'space-between' }}>
                <span style={{
                  fontFamily: 'var(--font-mono)', fontSize: 22, fontWeight: 700,
                  color: 'var(--clay)', letterSpacing: '-0.03em',
                }}>{step.n}</span>
                <span style={{
                  fontFamily: 'var(--font-mono-2)', fontSize: 10, color: 'var(--pencil)',
                  textTransform: 'uppercase', letterSpacing: '0.06em', whiteSpace: 'nowrap',
                }}>{step.dur}</span>
              </div>
              <h3 style={{
                fontSize: 17, fontWeight: 700, margin: 0, letterSpacing: '-0.01em',
              }}>{step.name}</h3>
              <p style={{ fontSize: 13, lineHeight: 1.55, color: 'var(--graphite)', margin: 0 }}>{step.text}</p>
            </li>
          ))}
        </ol>

        <div style={{
          marginTop: 24, fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)',
          textAlign: 'center', letterSpacing: '0.04em',
        }}>
          ──────────  total: 8–20 weeks depending on scope  ──────────
        </div>
      </section>

      {/* ----- ENGAGEMENT MODELS ----- */}
      <section id="models" style={{ padding: '96px 96px' }}>
        <div style={{ display: 'flex', alignItems: 'baseline', gap: 16, marginBottom: 40 }}>
          <BracketMeta>05</BracketMeta>
          <h2 style={{ fontSize: 40, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>
            Engagement models<span style={{ color: 'var(--clay)' }}>.</span>
          </h2>
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr 1fr', gap: 24 }}>
          {ENGAGEMENT_MODELS.map((m, i) => (
            <article key={m.name} style={{
              background: i === 0 ? 'var(--ink)' : 'var(--paper-pure)',
              color: i === 0 ? 'var(--paper)' : 'var(--ink)',
              border: i === 0 ? '1px solid var(--ink)' : '1px solid var(--rule)',
              padding: 28, display: 'flex', flexDirection: 'column', gap: 20,
            }}>
              <div style={{
                fontFamily: 'var(--font-mono-2)', fontSize: 11,
                color: i === 0 ? 'var(--clay)' : 'var(--pencil)',
                textTransform: 'uppercase', letterSpacing: '0.06em',
              }}>[ {m.tag} ]</div>
              <h3 style={{ fontSize: 28, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>
                {m.name}{i === 0 && <span style={{ color: 'var(--clay)' }}>.</span>}
              </h3>
              <p style={{
                fontSize: 14, lineHeight: 1.6, margin: 0,
                color: i === 0 ? 'rgba(245,240,232,0.78)' : 'var(--graphite)',
              }}>{m.body}</p>
              <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
                {m.bullets.map((b) => (
                  <li key={b} style={{
                    position: 'relative', paddingLeft: 20, marginBottom: 8,
                    fontFamily: 'var(--font-mono-2)', fontSize: 13, lineHeight: 1.5,
                  }}>
                    <span style={{
                      position: 'absolute', left: 0, top: 0,
                      color: i === 0 ? 'var(--phosphor)' : 'var(--phosphor)', fontWeight: 700,
                    }}>✔</span>
                    {b}
                  </li>
                ))}
              </ul>
              <div style={{
                marginTop: 'auto', paddingTop: 16,
                borderTop: `1px solid ${i === 0 ? 'rgba(245,240,232,0.18)' : 'var(--rule)'}`,
                fontFamily: 'var(--font-mono-2)', fontSize: 12,
                color: i === 0 ? 'rgba(245,240,232,0.55)' : 'var(--pencil)',
                textTransform: 'uppercase', letterSpacing: '0.06em',
              }}>
                suits: {m.suits}
              </div>
            </article>
          ))}
        </div>
      </section>

      {/* ----- FAQ ----- */}
      <section id="faq" style={{
        padding: '96px 96px', borderTop: '1px solid var(--rule)',
        borderBottom: '1px solid var(--rule)',
      }}>
        <div style={{ display: 'grid', gridTemplateColumns: '320px 1fr', gap: 64, alignItems: 'start' }}>
          <div>
            <BracketMeta>06</BracketMeta>
            <h2 style={{ fontSize: 40, fontWeight: 700, margin: '12px 0 16px', letterSpacing: '-0.02em' }}>
              Frequently<br />asked<span style={{ color: 'var(--clay)' }}>.</span>
            </h2>
            <p style={{ fontFamily: 'var(--font-mono)', fontSize: 15, lineHeight: 1.55, color: 'var(--graphite)', margin: 0 }}>
              Genuinely frequent. If yours isn't here, write in — the answer probably ends up in this list next quarter.
            </p>
          </div>

          <dl style={{ margin: 0 }}>
            {FAQS.map((f, i) => (
              <div key={i} style={{
                borderTop: '1px solid var(--rule)',
                borderBottom: i === FAQS.length - 1 ? '1px solid var(--rule)' : 'none',
                padding: '24px 0',
                display: 'grid', gridTemplateColumns: '36px 1fr', gap: 16,
              }}>
                <span style={{
                  fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--clay)',
                  textTransform: 'uppercase', letterSpacing: '0.06em',
                }}>q{String(i + 1).padStart(2, '0')}</span>
                <div>
                  <dt style={{
                    fontFamily: 'var(--font-mono)', fontSize: 19, fontWeight: 700,
                    color: 'var(--ink)', letterSpacing: '-0.01em', marginBottom: 10,
                    textWrap: 'pretty',
                  }}>{f.q}</dt>
                  <dd style={{
                    fontFamily: 'var(--font-mono)', fontSize: 15, lineHeight: 1.6,
                    color: 'var(--graphite)', margin: 0, maxWidth: '68ch',
                  }}>{f.a}</dd>
                </div>
              </div>
            ))}
          </dl>
        </div>
      </section>

      {/* ----- CTA ----- */}
      <section style={{ padding: '96px 96px' }}>
        <div style={{
          display: 'grid', gridTemplateColumns: '1fr auto', gap: 48, alignItems: 'center',
          padding: '48px 40px', background: 'var(--paper-deep)', border: '1px solid var(--ink)',
          boxShadow: '6px 6px 0 var(--clay)',
        }}>
          <div>
            <BracketMeta>booking 2026</BracketMeta>
            <h3 style={{ fontSize: 40, fontWeight: 700, margin: '12px 0 8px', letterSpacing: '-0.02em', textWrap: 'pretty' }}>
              Two more projects this year<span style={{ color: 'var(--clay)' }}>.</span>
            </h3>
            <p style={{ fontSize: 16, color: 'var(--graphite)', margin: 0, lineHeight: 1.5, maxWidth: '60ch' }}>
              Start with a paragraph about what you want, who it's for, and any deadline. I read every one.
            </p>
          </div>
          <a href="mailto:mark@bain.design" style={{
            background: 'var(--ink)', color: 'var(--paper)',
            padding: '18px 28px', fontFamily: 'var(--font-mono)', fontSize: 15,
            fontWeight: 500, textDecoration: 'none', border: '1px solid var(--ink)',
            display: 'inline-flex', alignItems: 'center', gap: 10, whiteSpace: 'nowrap',
          }}>
            <span>Arrange a chat</span>
            <span style={{ color: 'var(--clay)' }}>→</span>
          </a>
        </div>
      </section>

      <SiteFooterMock />
    </div>
  );
};

// ────────────────────────────────────────────────
// Service block (one per service)
// ────────────────────────────────────────────────

const ServiceBlock = ({ s, idx }) => {
  return (
    <section id={s.name.toLowerCase()} style={{
      padding: '96px 96px 64px',
      borderTop: idx === 0 ? 'none' : '1px solid var(--rule)',
    }}>
      <div style={{ display: 'grid', gridTemplateColumns: '180px 1fr', gap: 48, alignItems: 'start' }}>
        {/* sticky-ish label column */}
        <div>
          <div style={{
            fontSize: 96, fontWeight: 700, color: 'var(--clay)',
            lineHeight: 0.9, letterSpacing: '-0.04em',
          }}>{s.num}</div>
          <div style={{
            marginTop: 16, fontFamily: 'var(--font-mono-2)', fontSize: 11,
            color: 'var(--paper)', background: 'var(--clay)',
            display: 'inline-block', padding: '4px 8px', whiteSpace: 'nowrap',
            transform: 'rotate(-3deg)',
          }}>{s.stamp}</div>
        </div>

        {/* main content */}
        <div>
          {/* heading row */}
          <div style={{ display: 'flex', alignItems: 'baseline', justifyContent: 'space-between', gap: 24, flexWrap: 'wrap' }}>
            <h2 style={{ fontSize: 64, fontWeight: 700, margin: 0, letterSpacing: '-0.03em' }}>
              {s.name}<span style={{ color: 'var(--clay)' }}>.</span>
            </h2>
            <div style={{
              fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)',
              display: 'flex', gap: 20, alignItems: 'baseline',
            }}>
              <div>
                <div style={{ textTransform: 'uppercase', letterSpacing: '0.06em', fontSize: 10 }}>scope</div>
                <div style={{ color: 'var(--ink)', fontSize: 14, marginTop: 2 }}>{s.typicalScope}</div>
              </div>
              <div>
                <div style={{ textTransform: 'uppercase', letterSpacing: '0.06em', fontSize: 10 }}>from</div>
                <div style={{ color: 'var(--ink)', fontSize: 14, marginTop: 2 }}>{s.fromPrice}</div>
              </div>
            </div>
          </div>

          <p style={{
            fontSize: 22, color: 'var(--graphite)', margin: '12px 0 32px',
            lineHeight: 1.45, maxWidth: '40ch',
          }}>{s.sub}</p>

          <p style={{
            fontFamily: 'var(--font-mono)', fontSize: 17, lineHeight: 1.6,
            color: 'var(--ink)', margin: '0 0 40px', maxWidth: '68ch',
          }}>{s.intro}</p>

          {/* what's included */}
          <div style={{
            background: 'var(--paper-pure)', border: '1px solid var(--rule)',
            padding: 28, marginBottom: 32,
          }}>
            <div style={{
              fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)',
              textTransform: 'uppercase', letterSpacing: '0.08em', marginBottom: 16,
            }}>[ what's included ]</div>
            <ul style={{ listStyle: 'none', padding: 0, margin: 0, display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '12px 32px' }}>
              {s.included.map((line) => (
                <li key={line} style={{
                  position: 'relative', paddingLeft: 24,
                  fontSize: 14, lineHeight: 1.5, color: 'var(--ink)',
                  fontFamily: 'var(--font-mono)',
                }}>
                  <span style={{ position: 'absolute', left: 0, top: 0, color: 'var(--phosphor)', fontWeight: 700 }}>✔</span>
                  {line}
                </li>
              ))}
            </ul>
          </div>

          {/* fit / not fit columns */}
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 24, marginBottom: 32 }}>
            <div style={{ padding: 24, background: 'var(--paper-deep)', border: '1px solid var(--rule)' }}>
              <div style={{
                fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--ink)',
                textTransform: 'uppercase', letterSpacing: '0.06em', marginBottom: 14,
              }}>You'd want this if</div>
              <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
                {s.youdWantThisIf.map((line) => (
                  <li key={line} style={{
                    position: 'relative', paddingLeft: 20, marginBottom: 8,
                    fontFamily: 'var(--font-mono)', fontSize: 14, lineHeight: 1.55, color: 'var(--ink)',
                  }}>
                    <span style={{ position: 'absolute', left: 0, top: 0, color: 'var(--clay)' }}>→</span>
                    {line}
                  </li>
                ))}
              </ul>
            </div>

            <div style={{ padding: 24, background: 'transparent', border: '1px dashed var(--rule)' }}>
              <div style={{
                fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)',
                textTransform: 'uppercase', letterSpacing: '0.06em', marginBottom: 14,
              }}>Probably not the right fit for</div>
              <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
                {s.notFor.map((line) => (
                  <li key={line} style={{
                    position: 'relative', paddingLeft: 20, marginBottom: 8,
                    fontFamily: 'var(--font-mono)', fontSize: 14, lineHeight: 1.55, color: 'var(--graphite)',
                  }}>
                    <span style={{ position: 'absolute', left: 0, top: 0, color: 'var(--pencil)' }}>×</span>
                    {line}
                  </li>
                ))}
              </ul>
            </div>
          </div>

          {/* sample + cta row */}
          <div style={{
            display: 'flex', justifyContent: 'space-between', alignItems: 'baseline',
            paddingTop: 24, borderTop: '1px solid var(--rule)', gap: 24, flexWrap: 'wrap',
          }}>
            <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)' }}>
              <span style={{ textTransform: 'uppercase', letterSpacing: '0.06em', marginRight: 8 }}>recent:</span>
              <span style={{ color: 'var(--ink)' }}>{s.sample}</span>
            </div>
            <a href="#" style={{
              fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--link)',
              textDecoration: 'underline',
            }}>scope a {s.name.toLowerCase().replace(/s$/, '')} engagement →</a>
          </div>
        </div>
      </div>
    </section>
  );
};

Object.assign(window, { ServicesPage });
