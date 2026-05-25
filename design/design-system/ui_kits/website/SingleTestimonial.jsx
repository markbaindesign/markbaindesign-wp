// Single testimonial page
// One full review, treated as an editorial spread.
// Layout: hero (numbered + meta) → giant pull quote → author + context
// columns → related project card → prev/next strip → other voices grid.

const SingleTestimonial = ({ id = 'khyentse' }) => {
  const W = 1440;
  const t = TESTIMONIALS.find(x => x.id === id) || TESTIMONIALS[0];
  const idx = TESTIMONIALS.findIndex(x => x.id === t.id);
  const prev = TESTIMONIALS[(idx - 1 + TESTIMONIALS.length) % TESTIMONIALS.length];
  const next = TESTIMONIALS[(idx + 1) % TESTIMONIALS.length];

  // Three other voices for the "more nice words" rail at the bottom.
  const others = TESTIMONIALS.filter(x => x.id !== t.id).slice(0, 3);

  return (
    <div data-screen-label="Single testimonial" style={{
      width: W, background: 'var(--paper)', color: 'var(--ink)', fontFamily: 'var(--font-mono)',
    }}>
      <SiteHeaderMock active="Nice Words" />

      {/* ----- BREADCRUMB ----- */}
      <section style={{
        padding: '20px 96px', borderBottom: '1px solid var(--rule)',
        fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)',
      }}>
        <a href="#" style={{ color: 'var(--pencil)', textDecoration: 'none' }}>~ </a>
        <span> / </span>
        <a href="#" style={{ color: 'var(--pencil)', textDecoration: 'none', borderBottom: '1px dotted var(--pencil)' }}>nice-words</a>
        <span> / </span>
        <span style={{ color: 'var(--ink)' }}>{t.id}.md</span>
      </section>

      {/* ----- HERO ----- */}
      <section style={{ padding: '64px 96px 56px', borderBottom: '1px solid var(--rule)' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '120px 1fr 280px', gap: 48, alignItems: 'baseline' }}>
          <div style={{
            fontSize: 96, fontWeight: 700, color: 'var(--rule-soft)',
            lineHeight: 0.9, letterSpacing: '-0.04em',
          }}>{t.num}</div>

          <div>
            <BracketMeta>{t.year} / {t.org} / {t.location}</BracketMeta>
            <h1 style={{
              fontSize: 56, fontWeight: 700, letterSpacing: '-0.03em',
              lineHeight: 1.05, margin: '16px 0 20px',
            }}>
              {t.author}<span style={{ color: 'var(--clay)' }}>.</span>
            </h1>
            <p style={{ fontSize: 20, color: 'var(--graphite)', margin: 0, lineHeight: 1.5, maxWidth: '46ch' }}>
              {t.role} at <strong style={{ color: 'var(--ink)', fontWeight: 500 }}>{t.org}</strong>. Wrote in to talk about the <em style={{ fontStyle: 'normal', borderBottom: '1px solid var(--clay)' }}>{t.project}</em> build.
            </p>
          </div>

          {/* meta sidebar */}
          <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, lineHeight: 1.85 }}>
            <MetaRow label="Author" value={t.author} />
            <MetaRow label="Role"   value={t.role} />
            <MetaRow label="Org"    value={t.org} />
            <MetaRow label="Where"  value={t.location} />
            <MetaRow label="Year"   value={t.year} />
            <MetaRow label="Verb."  value="Unedited" />
          </div>
        </div>
      </section>

      {/* ----- PULL QUOTE ----- */}
      <section style={{
        padding: '96px 96px 80px', background: 'var(--paper-deep)',
        borderBottom: '1px solid var(--rule)',
      }}>
        <div style={{ maxWidth: 1080, margin: '0 auto', position: 'relative' }}>
          {/* giant opening quote glyph */}
          <div style={{
            position: 'absolute', top: -20, left: -64,
            fontSize: 240, fontFamily: 'var(--font-serif)',
            color: 'var(--clay)', opacity: 0.5,
            lineHeight: 1, fontStyle: 'italic',
          }} aria-hidden>"</div>

          <blockquote style={{
            margin: 0, fontFamily: 'var(--font-serif)',
            fontSize: 44, lineHeight: 1.3, fontStyle: 'italic',
            fontWeight: 400, color: 'var(--ink)', letterSpacing: '-0.01em',
            textWrap: 'pretty',
          }}>
            {t.full}
          </blockquote>

          {/* signature row */}
          <div style={{
            marginTop: 48, display: 'flex', alignItems: 'center', gap: 18,
            paddingTop: 24, borderTop: '1px solid var(--rule)',
          }}>
            <InitialsAvatar name={t.author} size={56} />
            <div>
              <div style={{ fontSize: 18, fontWeight: 700, letterSpacing: '-0.01em' }}>
                — {t.author}
              </div>
              <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)', marginTop: 2 }}>
                {t.role} / {t.org} / {t.year}
              </div>
            </div>
            <div style={{ marginLeft: 'auto', display: 'flex', gap: 12 }}>
              <a href="#" style={{
                fontFamily: 'var(--font-mono-2)', fontSize: 13,
                padding: '10px 16px', border: '1px solid var(--rule)',
                color: 'var(--ink)', textDecoration: 'none', background: 'var(--paper)',
              }}>copy quote</a>
              <a href="#" style={{
                fontFamily: 'var(--font-mono-2)', fontSize: 13,
                padding: '10px 16px', border: '1px solid var(--ink)',
                color: 'var(--paper)', background: 'var(--ink)',
                textDecoration: 'none',
              }}>
                see the project <span style={{ color: 'var(--clay)' }}>→</span>
              </a>
            </div>
          </div>
        </div>
      </section>

      {/* ----- CONTEXT (the brief, in my words) ----- */}
      <section style={{ padding: '96px 96px 0' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '180px 1fr 320px', gap: 48, alignItems: 'start' }}>
          <SectionLabel num="A" label="Context" />

          <div>
            <p style={{ fontSize: 20, lineHeight: 1.6, color: 'var(--graphite)', maxWidth: '60ch', margin: '0 0 24px' }}>
              {ABOUT_TEXT[t.id]?.[0] || ABOUT_TEXT.default[0]}
            </p>
            <p style={{ fontSize: 18, lineHeight: 1.6, color: 'var(--graphite)', maxWidth: '60ch', margin: 0 }}>
              {ABOUT_TEXT[t.id]?.[1] || ABOUT_TEXT.default[1]}
            </p>
          </div>

          {/* scope card */}
          <aside style={{
            border: '1px solid var(--rule)', padding: 24, background: 'var(--paper-pure)',
          }}>
            <BracketMeta>scope of work</BracketMeta>
            <ul style={{ listStyle: 'none', padding: 0, margin: '16px 0 0' }}>
              {t.scope.map((s) => (
                <li key={s} style={{
                  position: 'relative', paddingLeft: 24, marginBottom: 10,
                  fontSize: 14, color: 'var(--ink)', lineHeight: 1.5,
                  fontFamily: 'var(--font-mono-2)',
                }}>
                  <span style={{ position: 'absolute', left: 0, top: 0, color: 'var(--phosphor)', fontWeight: 700 }}>✔</span>
                  {s}
                </li>
              ))}
            </ul>
          </aside>
        </div>
      </section>

      {/* ----- LINKED PROJECT ----- */}
      <section style={{ padding: '96px 96px' }}>
        <div style={{ display: 'flex', alignItems: 'baseline', gap: 16, marginBottom: 32 }}>
          <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em' }}>B /</span>
          <h3 style={{ fontSize: 32, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>The project this is about</h3>
        </div>

        <a href="#" style={{
          display: 'grid', gridTemplateColumns: '1.4fr 1fr', gap: 0,
          border: '1px solid var(--rule)', background: 'var(--paper-pure)',
          textDecoration: 'none', color: 'var(--ink)',
        }}>
          <ScreenPlaceholder w={(W - 192) * (1.4 / 2.4) - 1} h={420} label={`${t.project} · case study`} tone="paper" />
          <div style={{
            padding: 40, display: 'flex', flexDirection: 'column', justifyContent: 'space-between',
            borderLeft: '1px solid var(--rule)',
          }}>
            <div>
              <BracketMeta>case study / {t.year}</BracketMeta>
              <h4 style={{ fontSize: 36, fontWeight: 700, letterSpacing: '-0.02em', margin: '16px 0 12px', textWrap: 'pretty' }}>
                {t.project}<span style={{ color: 'var(--clay)' }}>.</span>
              </h4>
              <p style={{ fontSize: 16, color: 'var(--graphite)', lineHeight: 1.55, margin: 0, maxWidth: '40ch' }}>
                Brief, approach, outcome and the screens that ended up in the production build. The full write-up.
              </p>
            </div>
            <div style={{
              marginTop: 32, fontFamily: 'var(--font-mono-2)', fontSize: 14,
              color: 'var(--link)', textDecoration: 'underline',
            }}>read the case study →</div>
          </div>
        </a>
      </section>

      {/* ----- PREV/NEXT STRIP ----- */}
      <section style={{
        padding: '32px 96px', borderTop: '1px solid var(--rule)',
        borderBottom: '1px solid var(--rule)',
        display: 'grid', gridTemplateColumns: '1fr auto 1fr', alignItems: 'center', gap: 24,
        fontFamily: 'var(--font-mono-2)', fontSize: 14, background: 'var(--paper-deep)',
      }}>
        <a href="#" style={{ color: 'var(--ink)', textDecoration: 'none' }}>
          <div style={{ color: 'var(--pencil)', fontSize: 11, textTransform: 'uppercase', letterSpacing: '0.06em', marginBottom: 4 }}>
            ← previous voice
          </div>
          <div style={{ borderBottom: '1px solid var(--ink)', display: 'inline-block' }}>{prev.author} <span style={{ color: 'var(--pencil)' }}>/ {prev.org}</span></div>
        </a>
        <a href="#" style={{
          color: 'var(--ink)', textDecoration: 'none', fontFamily: 'var(--font-mono-2)',
          padding: '8px 14px', border: '1px solid var(--ink)',
          display: 'inline-flex', alignItems: 'center', gap: 8, whiteSpace: 'nowrap',
        }}>
          <span>⌂ all nice words</span>
        </a>
        <a href="#" style={{ color: 'var(--ink)', textDecoration: 'none', textAlign: 'right' }}>
          <div style={{ color: 'var(--pencil)', fontSize: 11, textTransform: 'uppercase', letterSpacing: '0.06em', marginBottom: 4 }}>
            next voice →
          </div>
          <div style={{ borderBottom: '1px solid var(--ink)', display: 'inline-block' }}><span style={{ color: 'var(--pencil)' }}>{next.org} /</span> {next.author}</div>
        </a>
      </section>

      {/* ----- OTHER VOICES ----- */}
      <section style={{ padding: '96px 96px' }}>
        <div style={{ display: 'flex', alignItems: 'baseline', gap: 16, marginBottom: 32 }}>
          <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em' }}>C /</span>
          <h3 style={{ fontSize: 32, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>Other voices</h3>
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr 1fr', gap: 24 }}>
          {others.map((o) => (
            <article key={o.id} style={{
              border: '1px solid var(--rule)', background: 'var(--paper-pure)',
              padding: 24, display: 'flex', flexDirection: 'column', gap: 16,
            }}>
              <BracketMeta>{o.num} / {o.year}</BracketMeta>
              <blockquote style={{ margin: 0, fontSize: 18, lineHeight: 1.5, color: 'var(--ink)' }}>
                <span style={{ color: 'var(--clay)' }}>"</span>{o.short}<span style={{ color: 'var(--clay)' }}>"</span>
              </blockquote>
              <div style={{ marginTop: 'auto', display: 'flex', alignItems: 'center', gap: 12, paddingTop: 12, borderTop: '1px solid var(--rule)' }}>
                <InitialsAvatar name={o.author} size={40} />
                <div style={{ flex: 1, minWidth: 0 }}>
                  <div style={{ fontSize: 14, fontWeight: 700, lineHeight: 1.2 }}>{o.author}</div>
                  <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)', marginTop: 2 }}>
                    {o.role} / {o.org}
                  </div>
                </div>
                <a href="#" style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--link)', textDecoration: 'underline' }}>read →</a>
              </div>
            </article>
          ))}
        </div>
      </section>

      <SiteFooterMock />
    </div>
  );
};

// Local SectionLabel + MetaRow — copies of SingleProject's so this file
// stands alone (avoids duplicate-identifier hazards in Babel global scope).
function SectionLabel({ num, label }) {
  return (
    <div>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em', marginBottom: 4 }}>
        {num}
      </div>
      <h3 style={{ fontSize: 32, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>{label}</h3>
    </div>
  );
}

function MetaRow({ label, value }) {
  return (
    <div style={{ display: 'grid', gridTemplateColumns: '70px 1fr', gap: 10, color: 'var(--graphite)' }}>
      <span style={{ color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.04em', fontSize: 11 }}>{label}</span>
      <span style={{ color: 'var(--ink)' }}>{value}</span>
    </div>
  );
}

// Designer's-side context written in Bain's voice — short, plain, specific.
// One pair of paragraphs per testimonial id. A default pair covers any
// testimonial without dedicated copy.
const ABOUT_TEXT = {
  default: [
    "A short engagement, scoped over a single 45-minute call and a follow-up email. The brief was specific and the people were generous, which is half the battle.",
    "Shipped on time, on budget, and (in this case) without anyone needing to learn what a child theme is. The quote above is what came back when I asked, six months later, whether they wanted to change anything.",
  ],
  khyentse: [
    "A five-month engagement to rebuild a global grant programme on top of a bespoke WordPress theme. Two languages, three editorial roles, and a board that needed to read the same dashboard their editors were writing into.",
    "I shipped a single-purpose plugin (kf-grants) alongside the theme so the grant logic stays versioned and testable, then wired the public archive to Algolia so search stays fast as the corpus grows. The quote above is from a follow-up six months after launch.",
  ],
  mhairi: [
    "An author site rebuild for a novelist who, very reasonably, wanted to stop poking at her own WordPress install at 11pm. Bespoke theme, considered editorial flow, and one carefully-placed newsletter form.",
    "The brief was a single sentence: \"make it feel like a book, not a billboard.\" Everything past that was reading her novels, looking at her bookshelves, and editing the back end down to three custom post types.",
  ],
  noon: [
    "Originally a six-week brochure-site engagement for an early-stage health start-up. Marketing pages on WordPress, product on Next.js, shared design tokens between the two.",
    "The staging-environment side project that this quote is about is not on the invoice anywhere — but it is documented in the handover repo, which is, in fairness, where it belongs.",
  ],
};

Object.assign(window, { SingleTestimonial, ABOUT_TEXT });
