// Variation A — Editorial long-scroll
// Big hero band (numbered + bracketed meta + tagline + clay accent).
// Full-bleed cover image. Brief / Approach / Outcome as numbered sub-
// sections. Inline gallery. Selected wins (✔ list). Pull quote.
// Three-up related projects. Prev/next nav strip.

const SingleProject = () => {
  const W = 1440;
  return (
    <div style={{ width: W, background: 'var(--paper)', color: 'var(--ink)', fontFamily: 'var(--font-mono)' }}>
      <SiteHeaderMock />

      {/* ----- HERO ----- */}
      <section style={{
        padding: '80px 96px 64px', borderBottom: '1px solid var(--rule)',
      }}>
        <div style={{ display: 'grid', gridTemplateColumns: '120px 1fr 280px', gap: 48, alignItems: 'baseline' }}>
          <div style={{
            fontSize: 96, fontWeight: 700, color: 'var(--rule-soft)',
            lineHeight: 0.9, letterSpacing: '-0.04em',
          }}>{PROJECT.num}</div>

          <div>
            <div style={{
              fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)',
              textTransform: 'uppercase', letterSpacing: '0.08em',
            }}>
              [ {PROJECT.year} / {PROJECT.client} ]
            </div>
            <h1 style={{
              fontSize: 72, fontWeight: 700, letterSpacing: '-0.03em',
              lineHeight: 1.05, margin: '16px 0 24px',
            }}>
              {PROJECT.title}<span style={{ color: 'var(--clay)' }}>.</span>
            </h1>
            <p style={{
              fontSize: 22, color: 'var(--graphite)', maxWidth: '40ch',
              lineHeight: 1.5, margin: 0,
            }}>{PROJECT.tagline}</p>
          </div>

          {/* meta column */}
          <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, lineHeight: 1.85 }}>
            <MetaRow label="Client"   value={PROJECT.client} />
            <MetaRow label="Year"     value={PROJECT.year} />
            <MetaRow label="Duration" value={PROJECT.duration} />
            <MetaRow label="Role"     value={PROJECT.role} />
            <MetaRow label="Live"     value={PROJECT.url} link />
          </div>
        </div>
      </section>

      {/* ----- COVER IMAGE ----- */}
      <section style={{ padding: '64px 96px 0' }}>
        <ScreenPlaceholder w={W - 192} h={720} label="Hero · home page" />
      </section>

      {/* ----- BODY: BRIEF / APPROACH / OUTCOME ----- */}
      <section style={{ padding: '96px 96px 0' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '180px 1fr', gap: 48, marginBottom: 80 }}>
          <SectionLabel num="01" label="Brief" />
          <p style={{ fontSize: 20, lineHeight: 1.6, color: 'var(--graphite)', maxWidth: '60ch', margin: 0 }}>
            {PROJECT.brief}
          </p>
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: '180px 1fr', gap: 48, marginBottom: 80 }}>
          <SectionLabel num="02" label="Approach" />
          <div>
            <p style={{ fontSize: 20, lineHeight: 1.6, color: 'var(--graphite)', maxWidth: '60ch', margin: '0 0 40px' }}>
              {PROJECT.approach}
            </p>
            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 16 }}>
              <ScreenPlaceholder w={(W - 192 - 48 - 180) / 2 - 8} h={280} label="Editor · grant cycle" tone="paper" />
              <ScreenPlaceholder w={(W - 192 - 48 - 180) / 2 - 8} h={280} label="Algolia · search" tone="ink" />
            </div>
          </div>
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: '180px 1fr', gap: 48, marginBottom: 96 }}>
          <SectionLabel num="03" label="Outcome" />
          <div>
            <p style={{ fontSize: 20, lineHeight: 1.6, color: 'var(--graphite)', maxWidth: '60ch', margin: '0 0 32px' }}>
              {PROJECT.outcome}
            </p>
            <ul style={{ listStyle: 'none', padding: 0, margin: 0 }}>
              {PROJECT.wins.map((w, i) => (
                <li key={i} style={{
                  position: 'relative', paddingLeft: 32, marginBottom: 12,
                  fontSize: 16, color: 'var(--ink)', lineHeight: 1.55,
                }}>
                  <span style={{ position: 'absolute', left: 0, top: 0, color: 'var(--phosphor)', fontWeight: 700 }}>✔</span>
                  {w}
                </li>
              ))}
            </ul>
          </div>
        </div>
      </section>

      {/* ----- PULL QUOTE ----- */}
      <section style={{
        padding: '64px 96px 96px', borderTop: '1px solid var(--rule)',
        borderBottom: '1px solid var(--rule)', background: 'var(--paper-deep)',
      }}>
        <div style={{ maxWidth: 980, margin: '0 auto' }}>
          <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--clay)', textTransform: 'uppercase', letterSpacing: '0.08em', marginBottom: 16 }}>
            <span style={{ color: 'var(--pencil)' }}>"</span> Nice words <span style={{ color: 'var(--pencil)' }}>"</span>
          </div>
          <blockquote style={{
            fontFamily: 'var(--font-serif)', fontSize: 36, lineHeight: 1.35,
            color: 'var(--ink)', fontStyle: 'italic', margin: 0, fontWeight: 400,
            textWrap: 'pretty', letterSpacing: '-0.01em',
          }}>
            "{PROJECT.testimonial.quote}"
          </blockquote>
          <div style={{ marginTop: 28, fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--graphite)' }}>
            — {PROJECT.testimonial.author} <span style={{ color: 'var(--pencil)' }}>/ {PROJECT.testimonial.role}</span>
          </div>
        </div>
      </section>

      {/* ----- GALLERY ----- */}
      <section style={{ padding: '96px 96px 0' }}>
        <SectionLabel num="04" label="Selected screens" inline />
        <div style={{ marginTop: 40, display: 'grid', gridTemplateColumns: '2fr 1fr', gap: 16 }}>
          <ScreenPlaceholder w={((W - 192) * 2 / 3) - 8} h={460} label="Grant programme · index" />
          <div style={{ display: 'grid', gridTemplateRows: '1fr 1fr', gap: 16 }}>
            <ScreenPlaceholder w={((W - 192) / 3) - 8} h={222} label="Single grant cycle" tone="ink" />
            <ScreenPlaceholder w={((W - 192) / 3) - 8} h={222} label="Board dashboard" tone="paper" />
          </div>
        </div>
      </section>

      {/* ----- STACK ----- */}
      <section style={{ padding: '96px 96px 0' }}>
        <SectionLabel num="05" label="Stack" inline />
        <div style={{ marginTop: 24, display: 'flex', flexWrap: 'wrap', gap: 8 }}>
          {PROJECT.stack.map((s) => (
            <span key={s} style={{
              fontFamily: 'var(--font-mono-2)', fontSize: 13,
              padding: '8px 14px', border: '1px solid var(--rule)',
              color: 'var(--ink)', background: 'var(--paper-pure)',
            }}>{s}</span>
          ))}
        </div>
      </section>

      {/* ----- RELATED ----- */}
      <section style={{ padding: '96px 96px' }}>
        <SectionLabel num="06" label="Related" inline />
        <div style={{ marginTop: 40, display: 'grid', gridTemplateColumns: '1fr 1fr 1fr', gap: 24 }}>
          {PROJECT.related.map((r) => (
            <article key={r.title} style={{
              background: 'var(--paper-pure)', border: '1px solid var(--rule)',
              padding: '24px', display: 'flex', flexDirection: 'column', gap: 12,
            }}>
              <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.06em' }}>
                [ {r.year} / {r.tag} ]
              </div>
              <h4 style={{ fontSize: 22, margin: 0, fontWeight: 700 }}>{r.title}</h4>
              <a href="#" style={{ marginTop: 'auto', fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--link)', textDecoration: 'underline' }}>view project →</a>
            </article>
          ))}
          {/* third card — "see all" */}
          <a href="#" style={{
            background: 'var(--ink)', color: 'var(--paper)', padding: '24px',
            border: '1px solid var(--ink)', textDecoration: 'none',
            display: 'flex', flexDirection: 'column', justifyContent: 'space-between',
          }}>
            <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'rgba(245,240,232,0.55)', textTransform: 'uppercase', letterSpacing: '0.06em' }}>
              [ 47 projects shipped ]
            </div>
            <div>
              <h4 style={{ fontSize: 22, margin: 0, fontWeight: 700 }}>See all work</h4>
              <div style={{ marginTop: 12, fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--clay)' }}>
                cat portfolio.md →
              </div>
            </div>
          </a>
        </div>
      </section>

      {/* ----- PREV/NEXT ----- */}
      <section style={{
        padding: '32px 96px', borderTop: '1px solid var(--rule)',
        borderBottom: '1px solid var(--rule)',
        display: 'flex', justifyContent: 'space-between', alignItems: 'center',
        fontFamily: 'var(--font-mono-2)', fontSize: 14,
      }}>
        <a href="#" style={{ color: 'var(--ink)', textDecoration: 'none' }}>
          <span style={{ color: 'var(--pencil)' }}>← prev </span>
          <span style={{ borderBottom: '1px solid var(--ink)' }}>Mhairi McFarlane</span>
        </a>
        <a href="#" style={{ color: 'var(--ink)', textDecoration: 'none', textAlign: 'right' }}>
          <span style={{ borderBottom: '1px solid var(--ink)' }}>Buddhist Curriculum Framework</span>
          <span style={{ color: 'var(--pencil)' }}> next →</span>
        </a>
      </section>

      <SiteFooterMock />
    </div>
  );
};

// Helpers used by Variant A
function MetaRow({ label, value, link }) {
  return (
    <div style={{ display: 'grid', gridTemplateColumns: '70px 1fr', gap: 10, color: 'var(--graphite)' }}>
      <span style={{ color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.04em', fontSize: 11 }}>{label}</span>
      <span style={{ color: 'var(--ink)' }}>
        {link ? <a href="#" style={{ color: 'var(--link)', textDecoration: 'underline' }}>{value} ↗</a> : value}
      </span>
    </div>
  );
}

function SectionLabel({ num, label, inline }) {
  if (inline) {
    return (
      <div style={{ display: 'flex', alignItems: 'baseline', gap: 16 }}>
        <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em' }}>{num} /</span>
        <h3 style={{ fontSize: 32, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>{label}</h3>
      </div>
    );
  }
  return (
    <div style={{ position: 'sticky', top: 0, alignSelf: 'start' }}>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em', marginBottom: 4 }}>
        {num}
      </div>
      <h3 style={{ fontSize: 32, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>{label}</h3>
    </div>
  );
}

Object.assign(window, { SingleProject });
