// Nice Words — testimonials archive page
// "grep -i kind reviews/*" — a wall of testimonials, terminal-flavoured.
// Layout: page header band → terminal filter row → featured quote →
// masonry-ish wall of cards → counters strip → CTA → footer.

const NiceWordsArchive = () => {
  const W = 1440;

  // Mock active filter state — visual only, no actual filtering wired up.
  const [active, setActive] = React.useState({ service: null, year: null });
  const toggle = (k, v) => setActive(a => ({ ...a, [k]: a[k] === v ? null : v }));

  const featured = TESTIMONIALS.find(t => t.id === 'khyentse');
  const rest = TESTIMONIALS.filter(t => t.id !== 'khyentse');

  // Distribute into three columns for masonry-ish wall. Pure deterministic
  // order so the page is stable across renders.
  const cols = [[], [], []];
  rest.forEach((t, i) => cols[i % 3].push(t));

  return (
    <div data-screen-label="Nice Words archive" style={{
      width: W, background: 'var(--paper)', color: 'var(--ink)', fontFamily: 'var(--font-mono)',
    }}>
      <SiteHeaderMock active="Nice Words" />

      {/* ----- PAGE HEADER ----- */}
      <section style={{ padding: '80px 96px 56px', borderBottom: '1px solid var(--rule)' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '120px 1fr 280px', gap: 48, alignItems: 'baseline' }}>
          <div style={{
            fontSize: 96, fontWeight: 700, color: 'var(--rule-soft)',
            lineHeight: 0.9, letterSpacing: '-0.04em',
          }}>NW</div>

          <div>
            <BracketMeta>{TESTIMONIALS.length} reviews / since 2014 / unedited</BracketMeta>
            <h1 style={{
              fontSize: 72, fontWeight: 700, letterSpacing: '-0.03em',
              lineHeight: 1.05, margin: '16px 0 24px',
            }}>
              Nice words<span style={{ color: 'var(--clay)' }}>.</span>
            </h1>
            <p style={{
              fontSize: 22, color: 'var(--graphite)', maxWidth: '52ch',
              lineHeight: 1.5, margin: 0,
            }}>
              Written by people who paid me money and would, in theory, do it again. Lightly trimmed for length, never for content. Sorted newest first.
            </p>
          </div>

          {/* meta column — terminal prompt */}
          <div style={{
            fontFamily: 'var(--font-mono-2)', fontSize: 13,
            border: '1px solid var(--rule)', padding: '14px 16px',
            background: 'var(--paper-deep)',
          }}>
            <div style={{ color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.06em', fontSize: 11, marginBottom: 6 }}>
              ~ /reviews
            </div>
            <div style={{ color: 'var(--ink)', lineHeight: 1.6 }}>
              <span style={{ color: 'var(--clay)' }}>$</span> grep -ri <span style={{ background: 'var(--ink)', color: 'var(--paper)', padding: '0 4px' }}>kind</span> .
            </div>
            <div style={{ color: 'var(--pencil)', lineHeight: 1.6, marginTop: 4 }}>
              {TESTIMONIALS.length} matches in {TESTIMONIALS.length} files
            </div>
            <div style={{ color: 'var(--graphite)', marginTop: 4 }}>
              <span style={{ color: 'var(--clay)' }}>$</span> _<span style={{
                display: 'inline-block', width: 8, marginLeft: 1,
                background: 'var(--ink)', height: '1em', verticalAlign: 'text-bottom',
                animation: 'ba-blink 1.06s steps(1) infinite',
              }} />
            </div>
          </div>
        </div>
      </section>

      {/* ----- FILTER ROW ----- */}
      <section style={{ padding: '32px 96px', borderBottom: '1px solid var(--rule)' }}>
        <div style={{ display: 'grid', gridTemplateColumns: '120px 1fr auto', gap: 32, alignItems: 'center' }}>
          <BracketMeta>filters</BracketMeta>

          <div style={{ display: 'flex', alignItems: 'center', gap: 18, flexWrap: 'wrap' }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
              <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.06em' }}>
                service
              </span>
              {TESTIMONIAL_FILTERS.service.map((s) => (
                <FilterChip key={s} active={active.service === s} onClick={() => toggle('service', s)}>{s}</FilterChip>
              ))}
            </div>
            <span style={{ color: 'var(--rule)' }}>│</span>
            <div style={{ display: 'flex', alignItems: 'center', gap: 8 }}>
              <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.06em' }}>
                year
              </span>
              {TESTIMONIAL_FILTERS.year.map((y) => (
                <FilterChip key={y} active={active.year === y} onClick={() => toggle('year', y)}>{y}</FilterChip>
              ))}
            </div>
          </div>

          <a href="#" style={{
            fontFamily: 'var(--font-mono-2)', fontSize: 13,
            color: 'var(--link)', textDecoration: 'underline',
          }}>clear all</a>
        </div>
      </section>

      {/* ----- FEATURED QUOTE ----- */}
      <section style={{
        padding: '80px 96px', borderBottom: '1px solid var(--rule)',
        background: 'var(--paper-deep)',
      }}>
        <div style={{ display: 'grid', gridTemplateColumns: '180px 1fr 280px', gap: 48, alignItems: 'start' }}>
          <div>
            <BracketMeta color="var(--clay)">featured</BracketMeta>
            <div style={{
              marginTop: 18, fontSize: 240, fontWeight: 700, color: 'var(--ink)',
              lineHeight: 0.8, letterSpacing: '-0.06em', fontFamily: 'var(--font-serif)',
            }}>"</div>
          </div>

          <div>
            <blockquote style={{
              fontFamily: 'var(--font-serif)', fontSize: 40, lineHeight: 1.3,
              color: 'var(--ink)', fontStyle: 'italic', margin: 0, fontWeight: 400,
              textWrap: 'pretty', letterSpacing: '-0.01em',
            }}>
              {featured.short}
            </blockquote>
            <a href={`#${featured.id}`} style={{
              display: 'inline-block', marginTop: 32,
              fontFamily: 'var(--font-mono-2)', fontSize: 14,
              color: 'var(--link)', textDecoration: 'underline',
            }}>read the full review →</a>
          </div>

          {/* author block */}
          <div style={{
            border: '1px solid var(--rule)', background: 'var(--paper)',
            padding: 20,
          }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: 14, marginBottom: 16 }}>
              <InitialsAvatar name={featured.author} size={56} />
              <div>
                <div style={{ fontSize: 16, fontWeight: 700, lineHeight: 1.2 }}>{featured.author}</div>
                <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)', marginTop: 2 }}>
                  {featured.role}
                </div>
              </div>
            </div>
            <div style={{
              fontFamily: 'var(--font-mono-2)', fontSize: 12, lineHeight: 1.85,
              borderTop: '1px solid var(--rule)', paddingTop: 12,
            }}>
              <MiniRow label="Org"     value={featured.org} />
              <MiniRow label="Where"   value={featured.location} />
              <MiniRow label="Year"    value={featured.year} />
              <MiniRow label="Project" value={featured.project} link />
            </div>
          </div>
        </div>
      </section>

      {/* ----- WALL OF CARDS ----- */}
      <section style={{ padding: '80px 96px 32px' }}>
        <div style={{ display: 'flex', alignItems: 'baseline', justifyContent: 'space-between', marginBottom: 40 }}>
          <div style={{ display: 'flex', alignItems: 'baseline', gap: 16 }}>
            <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em' }}>01 /</span>
            <h2 style={{ fontSize: 32, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>The whole archive</h2>
          </div>
          <div style={{ display: 'flex', alignItems: 'center', gap: 16, fontFamily: 'var(--font-mono-2)', fontSize: 13 }}>
            <span style={{ color: 'var(--pencil)' }}>sort:</span>
            <a href="#" style={{ color: 'var(--ink)', textDecoration: 'none', borderBottom: '1px solid var(--ink)' }}>newest</a>
            <span style={{ color: 'var(--pencil)' }}>·</span>
            <a href="#" style={{ color: 'var(--pencil)', textDecoration: 'none' }}>oldest</a>
            <span style={{ color: 'var(--pencil)' }}>·</span>
            <a href="#" style={{ color: 'var(--pencil)', textDecoration: 'none' }}>by project</a>
          </div>
        </div>

        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr 1fr', gap: 24, alignItems: 'start' }}>
          {cols.map((col, i) => (
            <div key={i} style={{ display: 'flex', flexDirection: 'column', gap: 24 }}>
              {col.map((t) => <TestimonialCard key={t.id} t={t} />)}
            </div>
          ))}
        </div>
      </section>

      {/* ----- COUNTERS STRIP ----- */}
      <section style={{
        padding: '64px 96px', borderTop: '1px solid var(--rule)',
        borderBottom: '1px solid var(--rule)', background: 'var(--ink)', color: 'var(--paper)',
      }}>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: 32 }}>
          {NICE_NUMBERS.map((c) => (
            <div key={c.label} style={{ borderLeft: '1px solid rgba(245,240,232,0.18)', paddingLeft: 24 }}>
              <div style={{
                fontSize: 96, fontWeight: 700, lineHeight: 0.9,
                letterSpacing: '-0.04em',
              }}>{c.n}</div>
              <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, marginTop: 16, textTransform: 'uppercase', letterSpacing: '0.06em' }}>
                {c.label}
              </div>
              <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'rgba(245,240,232,0.55)', marginTop: 4 }}>
                [ {c.sub} ]
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* ----- CTA ----- */}
      <section style={{ padding: '80px 96px 96px' }}>
        <div style={{
          display: 'grid', gridTemplateColumns: '1fr auto', gap: 48, alignItems: 'center',
          borderTop: '1px solid var(--rule)', borderBottom: '1px solid var(--rule)',
          padding: '40px 0',
          // double rule
          backgroundImage: 'linear-gradient(to bottom, transparent calc(100% - 1px), var(--rule) calc(100% - 1px)), linear-gradient(to bottom, transparent 2px, var(--rule) 2px, var(--rule) 3px, transparent 3px)',
          backgroundRepeat: 'no-repeat', backgroundPosition: 'top, top',
        }}>
          <div>
            <BracketMeta>want one of these</BracketMeta>
            <h3 style={{ fontSize: 40, fontWeight: 700, margin: '16px 0 12px', letterSpacing: '-0.02em', textWrap: 'pretty' }}>
              I'm taking on two more projects in 2026<span style={{ color: 'var(--clay)' }}>.</span>
            </h3>
            <p style={{ fontSize: 18, color: 'var(--graphite)', margin: 0, lineHeight: 1.5, maxWidth: '60ch' }}>
              If yours is the sort of brief these clients describe — small, well-scoped, run by humans you'd want to share an espresso with — start with an email.
            </p>
          </div>
          <a href="#" style={{
            background: 'var(--ink)', color: 'var(--paper)',
            padding: '18px 28px', fontFamily: 'var(--font-mono)', fontSize: 15,
            fontWeight: 500, textDecoration: 'none', border: '1px solid var(--ink)',
            display: 'inline-flex', alignItems: 'center', gap: 10,
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

// ───────────────────────────────────────────────────────
// Card
// ───────────────────────────────────────────────────────

const TestimonialCard = ({ t }) => {
  // Three visual sizes, picked from data.tone, so the wall breathes.
  const isLong   = t.tone === 'long';
  const isShort  = t.tone === 'short';
  const isInk    = t.pinned; // pinned testimonials get the inverted treatment.

  const bg = isInk ? 'var(--ink)' : 'var(--paper-pure)';
  const fg = isInk ? 'var(--paper)' : 'var(--ink)';
  const muted = isInk ? 'rgba(245,240,232,0.55)' : 'var(--pencil)';
  const ruleC = isInk ? 'rgba(245,240,232,0.18)' : 'var(--rule)';

  // Body text size scales with length.
  const bodyFs = isLong ? 22 : isShort ? 18 : 20;

  return (
    <article id={t.id} style={{
      background: bg, color: fg,
      border: `1px solid ${isInk ? 'var(--ink)' : 'var(--rule)'}`,
      padding: isLong ? '32px 28px' : '24px',
      display: 'flex', flexDirection: 'column', gap: 18,
    }}>
      {/* header — number + bracketed meta */}
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'baseline' }}>
        <div style={{
          fontFamily: 'var(--font-mono-2)', fontSize: 11, color: muted,
          textTransform: 'uppercase', letterSpacing: '0.06em',
        }}>
          [ {t.num} / {t.year} ]
        </div>
        {t.pinned && (
          <div style={{
            fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--clay)',
            textTransform: 'uppercase', letterSpacing: '0.06em',
          }}>★ pinned</div>
        )}
      </div>

      {/* quote */}
      <blockquote style={{
        margin: 0, fontSize: bodyFs, lineHeight: 1.5,
        color: fg, letterSpacing: '-0.005em', textWrap: 'pretty',
        fontWeight: 400, fontFamily: 'var(--font-mono)',
      }}>
        <span style={{ color: isInk ? 'var(--clay)' : 'var(--clay)' }}>"</span>
        {t.short}
        <span style={{ color: isInk ? 'var(--clay)' : 'var(--clay)' }}>"</span>
      </blockquote>

      {/* attribution */}
      <div style={{ marginTop: 'auto', display: 'flex', alignItems: 'center', gap: 12, paddingTop: 12, borderTop: `1px solid ${ruleC}` }}>
        <InitialsAvatar name={t.author} size={40} tone={isInk ? 'paper' : 'ink'} />
        <div style={{ flex: 1, minWidth: 0 }}>
          <div style={{ fontSize: 14, fontWeight: 700, lineHeight: 1.2, whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>
            {t.author}
          </div>
          <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: muted, marginTop: 2, whiteSpace: 'nowrap', overflow: 'hidden', textOverflow: 'ellipsis' }}>
            {t.role} / {t.org}
          </div>
        </div>
      </div>

      {/* footer — link to single */}
      <div style={{
        display: 'flex', justifyContent: 'space-between', alignItems: 'center',
        fontFamily: 'var(--font-mono-2)', fontSize: 12,
      }}>
        <span style={{ color: muted }}>{t.scope.slice(0, 2).join(' · ')}</span>
        <a href="#" style={{
          color: isInk ? 'var(--paper)' : 'var(--link)',
          textDecoration: 'underline',
        }}>read in full →</a>
      </div>
    </article>
  );
};

// Tiny meta row used inside the featured author block.
function MiniRow({ label, value, link }) {
  return (
    <div style={{ display: 'grid', gridTemplateColumns: '54px 1fr', gap: 8, color: 'var(--graphite)' }}>
      <span style={{ color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.04em', fontSize: 10 }}>{label}</span>
      <span style={{ color: 'var(--ink)' }}>
        {link ? <a href="#" style={{ color: 'var(--link)', textDecoration: 'underline' }}>{value} →</a> : value}
      </span>
    </div>
  );
}

Object.assign(window, { NiceWordsArchive });
