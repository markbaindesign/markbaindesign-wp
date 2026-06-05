// About — full page treatment.
// Hero band → letter-feel bio with portrait → principles ✔ list →
// numbered career timeline → tools I reach for → off the clock → CTA.

const ABOUT = {
  name: 'Mark Crawford Bain',
  role: 'WordPress Designer & Developer',
  pronouns: 'he / him',
  location: 'Sant Cugat del Vallès, near Barcelona',
  email: 'mark@bain.design',
  since: 2012,
  yearsExp: '14+ years',
  lead: "I design & build bespoke WordPress sites for individuals, small businesses & start-ups. No page builders, no parent themes, no nonsense. One developer, one designer — same person, same head — from inception to launch and onwards.",
  bio: [
    "I grew up taking radios apart and putting them back together, with the predictable variation in success. I started building websites for friends at university — a magazine, then a bicycle shop, then a small press — and at some point in 2012 stopped pretending it was a side project.",
    "What I sell now is the same thing I sold then, only better-rehearsed. I read your brief carefully. I write a small, well-organised codebase to deliver it. I hand it over with documentation you'll actually open. And I am still here, on the other end of the email, two years later when you want to add a newsletter form.",
    "I work from a small studio overlooking a quiet street in Sant Cugat. I take on between six and ten engagements a year. I do not have a sales team or a project manager or a JIRA instance — I have a notebook, a calendar, and the kind of clients who came back because they liked the first time.",
  ],
  principles: [
    { title: 'Bespoke, not boilerplate',     body: "I write the theme. I write the plugin. I write the docs. Every site is coded from scratch against your actual needs, not bolted together from a marketplace." },
    { title: "Plain code, plain English",    body: "If I can't explain a technical decision in two sentences to a non-technical client, the decision is probably wrong. Same goes for the codebase your next developer will inherit." },
    { title: 'Editorial flow first',         body: "The CMS your editors use every Tuesday matters more than the homepage your competitors look at once. I design the back end with the same care as the front." },
    { title: 'Small, well-scoped engagements', body: "I'd rather ship a good 12-week build than a mediocre 12-month one. If your brief needs a team, I'll happily refer you to one." },
    { title: 'Around afterwards',            body: "A care plan, a sensible email reply window, and version-tagged plugins so upgrades don't surprise you. The work isn't over at launch." },
  ],
  timeline: [
    { year: '2012', body: 'Went full-time freelance after two years moonlighting. First clients: a small press, a magazine, a bicycle shop. All three are still on bain.design servers.' },
    { year: '2014', body: 'Moved from Edinburgh to Barcelona. First non-UK client (Catalan bookshop chain). Started writing the editorial-flow plugin that would, six years later, become Plain Sitemap.' },
    { year: '2017', body: 'Released Plain Sitemap on WordPress.org. 28,000 active installs at last count. No upsells, no admin UI, no newsletter modal.' },
    { year: '2019', body: 'Released Slow Comments — a Disqus-replacement plugin built for two specific clients, then open-sourced. 4,000 installs and a small, polite Discord.' },
    { year: '2021', body: 'Hired (briefly) by Noon Health as part-time staff. Returned to freelancing after six months — same clients, slightly better office chair.' },
    { year: '2024', body: 'Khyentse Foundation grants platform shipped in five months. Most complex single engagement to date. Worth a tea sometime if you want the war stories.' },
    { year: '2026', body: 'Currently taking two more projects for the year. If you are reading this in 2027, that probably also applies, but ask.' },
  ],
  tools: [
    { group: 'CMS / Back-end',  items: ['WordPress 6.x', 'PHP 8.2', 'ACF Pro', 'WP-CLI', 'Composer'] },
    { group: 'Front-end',       items: ['HTML / CSS', 'Vanilla JS', 'Alpine.js (rarely)', 'No build step where possible', 'Vite when not'] },
    { group: 'Editorial',       items: ['Bespoke custom post types', 'Block patterns', 'No page builders', 'Editorial workflows in plain PHP'] },
    { group: 'Studio kit',      items: ['MacBook Pro 14"', 'A Field Notes pocket notebook', 'iA Writer for drafts', 'Tot for daily plan', 'Mechanical pencil — Pentel P205'] },
  ],
  offTheClock: [
    { label: 'In the kitchen',   text: 'Slow-cooking, mostly North African and Catalan. Best loaf so far: a 36-hour sourdough. Worst: an attempt at canelones de marisco that the cat then ate.' },
    { label: 'In the water',     text: 'Open-water swimming year-round at Caldes d\'Estrac. Two friends, a thermos, twenty minutes in November.' },
    { label: 'In the shelves',   text: 'Reading whatever Mhairi McFarlane is currently writing, plus too many Penguin classics with broken spines.' },
    { label: 'On a bike',        text: 'A 1996 Peugeot frame I keep meaning to repaint. The brakes work.' },
  ],
};

const AboutPage = () => {
  const W = 1440;
  return (
    <div data-screen-label="About page" style={{
      width: W, background: 'var(--paper)', color: 'var(--ink)', fontFamily: 'var(--font-mono)',
    }}>
      <SiteHeaderMock active="About" />

      {/* ----- HERO ----- */}
      <section style={{ padding: '80px 96px 64px', borderBottom: '1px solid var(--rule)' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '120px 1fr 280px', gap: 48, alignItems: 'baseline' }}>
          <div style={{
            fontSize: 96, fontWeight: 700, color: 'var(--rule-soft)',
            lineHeight: 0.9, letterSpacing: '-0.04em',
          }}>AB</div>

          <div>
            <BracketMeta>WordPress Designer &amp; Developer / since {ABOUT.since} / freelance</BracketMeta>
            <h1 style={{
              fontSize: 72, fontWeight: 700, letterSpacing: '-0.03em',
              lineHeight: 1.05, margin: '16px 0 24px',
            }}>
              {ABOUT.name}<span style={{ color: 'var(--clay)' }}>.</span>
            </h1>
            <p style={{
              fontSize: 22, color: 'var(--graphite)', maxWidth: '52ch',
              lineHeight: 1.5, margin: 0, textWrap: 'pretty',
            }}>
              {ABOUT.lead}
            </p>
          </div>

          <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, lineHeight: 1.85 }}>
            <MetaRow label="Where"   value={ABOUT.location} />
            <MetaRow label="Pronouns" value={ABOUT.pronouns} />
            <MetaRow label="Email"   value={ABOUT.email} link />
            <MetaRow label="Since"   value={ABOUT.since} />
            <MetaRow label="Status"  value="Booking 2026" />
          </div>
        </div>
      </section>

      {/* ----- BIO / LETTER ----- */}
      <section style={{ padding: '96px 96px 96px' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '380px 1fr', gap: 64, alignItems: 'start' }}>
          {/* portrait + caption */}
          <div>
            <div style={{
              aspectRatio: '4/5', width: '100%',
              background: 'var(--paper-deep)', border: '1px solid var(--rule)',
              position: 'relative',
              boxShadow: '6px 6px 0 var(--ink)',
            }}>
              {['┌','┐','└','┘'].map((g, i) => (
                <span key={g} aria-hidden style={{
                  position: 'absolute', fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)',
                  top: i < 2 ? 8 : 'auto', bottom: i >= 2 ? 8 : 'auto',
                  left: i % 2 === 0 ? 10 : 'auto', right: i % 2 === 1 ? 10 : 'auto',
                }}>{g}</span>
              ))}
              <div style={{
                position: 'absolute', inset: 0, display: 'flex', alignItems: 'center', justifyContent: 'center',
                fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)',
                textTransform: 'uppercase', letterSpacing: '0.06em',
              }}>[ portrait · b&amp;w · 4:5 ]</div>
            </div>
            <div style={{
              marginTop: 16, fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)',
              borderTop: '1px solid var(--rule)', paddingTop: 12,
            }}>
              <div>[ Sant Cugat studio · Tuesday morning ]</div>
              <div style={{ marginTop: 4, color: 'var(--graphite)' }}>photo · J. Vidal · 2024</div>
            </div>
          </div>

          {/* letter text */}
          <div>
            <BracketMeta>a short letter</BracketMeta>
            <div style={{ marginTop: 24 }}>
              {ABOUT.bio.map((p, i) => (
                <p key={i} style={{
                  fontFamily: 'var(--font-mono)', fontSize: 20, lineHeight: 1.6,
                  color: 'var(--ink)', margin: i === 0 ? '0 0 24px' : '0 0 24px',
                  maxWidth: '62ch', textWrap: 'pretty',
                }}>
                  {i === 0 ? (
                    <>
                      <span style={{ fontFamily: 'var(--font-serif)', fontSize: 56, fontStyle: 'italic', float: 'left', lineHeight: 0.9, marginRight: 10, marginTop: 6, color: 'var(--clay)' }}>{p[0]}</span>
                      {p.slice(1)}
                    </>
                  ) : p}
                </p>
              ))}
              <div style={{
                marginTop: 32, fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--graphite)',
              }}>
                — Mark <span style={{ color: 'var(--pencil)' }}> / {ABOUT.location.split(',')[0]}</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* ----- PRINCIPLES ----- */}
      <section style={{ padding: '96px 96px', borderTop: '1px solid var(--rule)', background: 'var(--paper-deep)' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '180px 1fr', gap: 48, alignItems: 'start' }}>
          <div>
            <BracketMeta>01</BracketMeta>
            <h2 style={{ fontSize: 32, fontWeight: 700, margin: '8px 0 0', letterSpacing: '-0.02em' }}>How I think about the work</h2>
            <p style={{
              fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)',
              marginTop: 24, lineHeight: 1.7, maxWidth: '32ch',
            }}>
              Five rules that have not changed since 2012. Two of them I'd defend in court.
            </p>
          </div>

          <ol style={{ listStyle: 'none', padding: 0, margin: 0 }}>
            {ABOUT.principles.map((p, i) => (
              <li key={p.title} style={{
                display: 'grid', gridTemplateColumns: '48px 1fr', gap: 24,
                padding: '24px 0', borderTop: i === 0 ? 'none' : '1px solid var(--rule)',
                alignItems: 'baseline',
              }}>
                <span style={{
                  fontFamily: 'var(--font-mono)', fontSize: 22, fontWeight: 700,
                  color: 'var(--phosphor)', letterSpacing: '-0.02em',
                }}>✔</span>
                <div>
                  <h3 style={{
                    fontSize: 22, fontWeight: 700, margin: 0, letterSpacing: '-0.01em',
                    color: 'var(--ink)',
                  }}>{p.title}<span style={{ color: 'var(--clay)' }}>.</span></h3>
                  <p style={{
                    fontSize: 16, lineHeight: 1.6, color: 'var(--graphite)',
                    margin: '8px 0 0', maxWidth: '70ch',
                  }}>{p.body}</p>
                </div>
              </li>
            ))}
          </ol>
        </div>
      </section>

      {/* ----- TIMELINE ----- */}
      <section style={{ padding: '96px 96px 64px' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '180px 1fr', gap: 48, alignItems: 'start' }}>
          <div>
            <BracketMeta>02</BracketMeta>
            <h2 style={{ fontSize: 32, fontWeight: 700, margin: '8px 0 0', letterSpacing: '-0.02em' }}>What happened, in order</h2>
            <div style={{
              marginTop: 24, fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)',
              lineHeight: 1.8, borderLeft: '2px solid var(--rule)', paddingLeft: 14,
            }}>
              cat ~/career.log<br />
              <span style={{ color: 'var(--graphite)' }}>{ABOUT.timeline.length} entries</span>
            </div>
          </div>

          <ol style={{ listStyle: 'none', padding: 0, margin: 0, position: 'relative' }}>
            {/* vertical rule */}
            <div aria-hidden style={{
              position: 'absolute', top: 8, bottom: 8, left: 60,
              borderLeft: '1px dashed var(--rule)',
            }} />
            {ABOUT.timeline.map((t, i) => (
              <li key={t.year} style={{
                display: 'grid', gridTemplateColumns: '96px 1fr', gap: 32,
                padding: '20px 0', alignItems: 'baseline', position: 'relative',
              }}>
                <div style={{
                  fontFamily: 'var(--font-mono)', fontSize: 28, fontWeight: 700,
                  color: 'var(--ink)', letterSpacing: '-0.03em', position: 'relative',
                }}>
                  {t.year}
                  {/* dot on the rule */}
                  <span aria-hidden style={{
                    position: 'absolute', top: '50%', left: 'calc(100% + 16px - 4px)',
                    width: 9, height: 9, background: i === ABOUT.timeline.length - 1 ? 'var(--clay)' : 'var(--ink)',
                    transform: 'translateY(-50%)',
                  }} />
                </div>
                <p style={{
                  fontSize: 16, lineHeight: 1.6, color: 'var(--graphite)',
                  margin: 0, maxWidth: '64ch', paddingLeft: 28,
                }}>{t.body}</p>
              </li>
            ))}
          </ol>
        </div>
      </section>

      {/* ----- TOOLS ----- */}
      <section style={{
        padding: '96px 96px', borderTop: '1px solid var(--rule)',
        borderBottom: '1px solid var(--rule)',
      }}>
        <div style={{ display: 'flex', alignItems: 'baseline', gap: 16, marginBottom: 32 }}>
          <BracketMeta>03</BracketMeta>
          <h2 style={{ fontSize: 32, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>Tools I reach for</h2>
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: 0, border: '1px solid var(--rule)', background: 'var(--paper-pure)' }}>
          {ABOUT.tools.map((g, i) => (
            <div key={g.group} style={{
              padding: 24, borderLeft: i === 0 ? 'none' : '1px solid var(--rule)',
            }}>
              <div style={{
                fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)',
                textTransform: 'uppercase', letterSpacing: '0.06em', marginBottom: 16,
              }}>{g.group}</div>
              <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
                {g.items.map((item) => (
                  <li key={item} style={{
                    position: 'relative', paddingLeft: 18, marginBottom: 8,
                    fontSize: 14, color: 'var(--ink)', lineHeight: 1.5,
                    fontFamily: 'var(--font-mono)',
                  }}>
                    <span style={{ position: 'absolute', left: 0, top: 0, color: 'var(--pencil)' }}>·</span>
                    {item}
                  </li>
                ))}
              </ul>
            </div>
          ))}
        </div>
      </section>

      {/* ----- OFF THE CLOCK ----- */}
      <section style={{ padding: '96px 96px' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1.6fr', gap: 64, alignItems: 'start' }}>
          <div>
            <BracketMeta>04</BracketMeta>
            <h2 style={{ fontSize: 32, fontWeight: 700, margin: '8px 0 0', letterSpacing: '-0.02em' }}>Off the clock<span style={{ color: 'var(--clay)' }}>.</span></h2>
            <p style={{
              fontFamily: 'var(--font-mono)', fontSize: 16, color: 'var(--graphite)',
              lineHeight: 1.6, marginTop: 24, maxWidth: '34ch',
            }}>
              Not really part of a portfolio. Included anyway, because clients keep asking and the swimming is genuinely a selling point.
            </p>
          </div>

          <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
            {ABOUT.offTheClock.map((row, i) => (
              <li key={row.label} style={{
                display: 'grid', gridTemplateColumns: '180px 1fr', gap: 24,
                padding: '20px 0', borderTop: '1px solid var(--rule)',
                borderBottom: i === ABOUT.offTheClock.length - 1 ? '1px solid var(--rule)' : 'none',
                alignItems: 'baseline',
              }}>
                <div style={{
                  fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--clay)',
                  textTransform: 'uppercase', letterSpacing: '0.06em',
                }}>{row.label}</div>
                <p style={{ fontSize: 17, lineHeight: 1.55, color: 'var(--ink)', margin: 0, maxWidth: '64ch' }}>
                  {row.text}
                </p>
              </li>
            ))}
          </ul>
        </div>
      </section>

      {/* ----- CTA ----- */}
      <section style={{ padding: '0 96px 96px' }}>
        <div style={{
          display: 'grid', gridTemplateColumns: '1fr auto', gap: 48, alignItems: 'center',
          padding: '48px 40px', background: 'var(--ink)', color: 'var(--paper)',
        }}>
          <div>
            <div style={{
              fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'rgba(245,240,232,0.55)',
              textTransform: 'uppercase', letterSpacing: '0.06em',
            }}>[ next ]</div>
            <h3 style={{ fontSize: 40, fontWeight: 700, margin: '12px 0 8px', letterSpacing: '-0.02em', textWrap: 'pretty' }}>
              Still reading? Let's start with an email<span style={{ color: 'var(--clay)' }}>.</span>
            </h3>
            <p style={{ fontSize: 16, color: 'rgba(245,240,232,0.75)', margin: 0, lineHeight: 1.5, maxWidth: '60ch' }}>
              I read every one. Usually reply within a working day, or the next morning if you wrote at midnight in another timezone.
            </p>
          </div>
          <a href={`mailto:${ABOUT.email}`} style={{
            background: 'var(--paper)', color: 'var(--ink)',
            padding: '18px 28px', fontFamily: 'var(--font-mono)', fontSize: 15,
            fontWeight: 500, textDecoration: 'none', border: '1px solid var(--paper)',
            display: 'inline-flex', alignItems: 'center', gap: 10, whiteSpace: 'nowrap',
          }}>
            <span>{ABOUT.email}</span>
            <span style={{ color: 'var(--clay)' }}>→</span>
          </a>
        </div>
      </section>

      <SiteFooterMock />
    </div>
  );
};

// Local helpers — short, scoped names so they don't clash with same-named
// helpers in other page files that may share global scope under Babel.
function MetaRow({ label, value, link }) {
  return (
    <div style={{ display: 'grid', gridTemplateColumns: '80px 1fr', gap: 10, color: 'var(--graphite)' }}>
      <span style={{ color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.04em', fontSize: 11 }}>{label}</span>
      <span style={{ color: 'var(--ink)' }}>
        {link ? <a href="#" style={{ color: 'var(--link)', textDecoration: 'underline' }}>{value} ↗</a> : value}
      </span>
    </div>
  );
}

Object.assign(window, { AboutPage });
