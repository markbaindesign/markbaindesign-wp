// Variation A — Editorial letter + form
// Same vocabulary as the single-project page A so the two pages feel
// like a set. Left column: warm intro letter + a real contact form,
// "What happens next" mini-timeline. Right column: sticky meta panel
// (email, location, hours, response time, all the channels).

const ContactA = () => {
  const W = 1440;
  return (
    <div style={{ width: W, background: 'var(--paper)', color: 'var(--ink)', fontFamily: 'var(--font-mono)' }}>
      <SiteHeaderMock />

      {/* hero */}
      <section style={{
        padding: '80px 96px 64px', borderBottom: '1px solid var(--rule)',
      }}>
        <div style={{ display: 'grid', gridTemplateColumns: '120px 1fr 280px', gap: 48, alignItems: 'baseline' }}>
          <div style={{
            fontSize: 96, fontWeight: 700, color: 'var(--rule-soft)',
            lineHeight: 0.9, letterSpacing: '-0.04em',
          }}>04</div>

          <div>
            <Bracket>Get in touch</Bracket>
            <h1 style={{
              fontSize: 72, fontWeight: 700, letterSpacing: '-0.03em',
              lineHeight: 1.05, margin: '16px 0 24px',
            }}>
              Drop me a line<span style={{ color: 'var(--clay)' }}>.</span>
            </h1>
            <p style={{
              fontSize: 22, color: 'var(--graphite)', maxWidth: '46ch',
              lineHeight: 1.5, margin: 0, textWrap: 'pretty',
            }}>
              If you're keen to find out more, there are lots of ways to get in touch — but why not start with an email? I read everything, I reply <strong style={{ color: 'var(--ink)' }}>{CONTACT.responseTime}</strong>.
            </p>
          </div>

          <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, lineHeight: 1.85 }}>
            <MetaCol label="Email"    value={CONTACT.email}    isLink href={`mailto:${CONTACT.email}`} />
            <MetaCol label="Hours"    value={CONTACT.hours} />
            <MetaCol label="Location" value={CONTACT.location} />
            <MetaCol label="Reply"    value={CONTACT.responseTime} />
          </div>
        </div>
      </section>

      {/* main: form + sticky sidebar */}
      <section style={{
        padding: '96px 96px 0',
        display: 'grid', gridTemplateColumns: '1fr 360px', gap: 80, alignItems: 'start',
      }}>
        {/* left — the letter + form */}
        <div style={{ display: 'flex', flexDirection: 'column', gap: 64 }}>
          {/* letter */}
          <div>
            <InlineHead num="01" label="Open with a few details" />
            <p style={{ fontSize: 19, color: 'var(--graphite)', lineHeight: 1.6, maxWidth: '60ch', marginTop: 24 }}>
              The more you tell me up front, the faster I can give you a useful answer. A sentence or two on what you're building, who it's for, and roughly when you need it — that's plenty for a first reply.
            </p>
            <ul style={{
              listStyle: 'none', padding: 0, margin: '24px 0 0', display: 'grid',
              gridTemplateColumns: '1fr 1fr', gap: 12,
            }}>
              {[
                'Who you are, and what you do.',
                'What you\'re trying to build — or replace.',
                'Rough timeline and budget shape.',
                'Anything I should read first (deck, doc, brief).',
              ].map((s, i) => (
                <li key={i} style={{
                  position: 'relative', paddingLeft: 28,
                  fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--ink)', lineHeight: 1.55,
                }}>
                  <span style={{ position: 'absolute', left: 0, top: 0, color: 'var(--phosphor)', fontWeight: 700 }}>✔</span>
                  {s}
                </li>
              ))}
            </ul>
          </div>

          {/* form */}
          <form onSubmit={(e) => e.preventDefault()} style={{
            background: 'var(--paper-pure)', border: '1px solid var(--rule)',
            padding: 40, display: 'flex', flexDirection: 'column', gap: 24,
            maxWidth: 760,
          }}>
            <InlineHead num="02" label="Brief form" />
            <Field label="Name" placeholder="Mark Crawford Bain" />
            <Field label="Email" type="email" placeholder="you@yours.com" />
            <Field label="Company / project" placeholder="Acme Co. — re-platforming the marketing site" />
            <Field label="Brief" textarea placeholder={`A line or two on what you're building, who it's for, and roughly when you need it.\n\nAttach links or docs in your reply — this form is intentionally short.`} />
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: 16, flexWrap: 'wrap' }}>
              <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)' }}>
                No analytics on this form. Goes straight to <span style={{ color: 'var(--ink)' }}>{CONTACT.email}</span>.
              </span>
              <CtaBtn>Send the brief →</CtaBtn>
            </div>
          </form>

          {/* what happens next */}
          <div>
            <InlineHead num="03" label="What happens next" />
            <ol style={{
              listStyle: 'none', padding: 0, margin: '32px 0 0',
              display: 'grid', gap: 16,
            }}>
              {[
                ['T+0',       'You hit send.',          'I get an email. No funnels, no auto-responders.'],
                ['T+2 days',  'I read it properly.',     'If it\'s a fit, I reply with a few questions; if not, I tell you so and try to point you somewhere good.'],
                ['T+1 week',  'A 30-minute call.',       'Free, friendly, no pitch deck. We figure out scope, rough timeline and roughly what it\'ll cost.'],
                ['T+2 weeks', 'A written proposal.',     'One PDF, scope + timeline + price. Either we\'re on, or we part as friends.'],
              ].map(([t, h, d]) => (
                <li key={t} style={{
                  display: 'grid', gridTemplateColumns: '100px 1fr', gap: 24,
                  padding: '20px 0', borderTop: '1px solid var(--rule-soft)',
                }}>
                  <span style={{
                    fontFamily: 'var(--font-mono-2)', fontSize: 12,
                    color: 'var(--clay)', textTransform: 'uppercase', letterSpacing: '0.06em',
                  }}>{t}</span>
                  <div>
                    <div style={{ fontSize: 18, fontWeight: 700, color: 'var(--ink)' }}>{h}</div>
                    <p style={{ fontSize: 15, color: 'var(--graphite)', lineHeight: 1.55, margin: '6px 0 0', maxWidth: '60ch' }}>{d}</p>
                  </div>
                </li>
              ))}
            </ol>
          </div>
        </div>

        {/* sticky sidebar */}
        <aside style={{ position: 'sticky', top: 32, alignSelf: 'start', display: 'flex', flexDirection: 'column', gap: 16 }}>
          {/* primary email card */}
          <div style={{
            background: 'var(--ink)', color: 'var(--paper)', padding: 24,
            display: 'flex', flexDirection: 'column', gap: 14, border: '1px solid var(--ink)',
          }}>
            <Bracket color="rgba(245,240,232,0.55)">Quickest path</Bracket>
            <div style={{ fontSize: 22, fontWeight: 700, letterSpacing: '-0.02em' }}>
              {CONTACT.email}
            </div>
            <a href={`mailto:${CONTACT.email}`} style={{
              padding: '14px 18px', background: 'var(--clay)', color: 'var(--paper)',
              textDecoration: 'none', textAlign: 'center', fontFamily: 'var(--font-mono)',
              fontWeight: 500, fontSize: 13, border: '1px solid var(--clay)',
            }}>Open in mail →</a>
            <button style={{
              padding: '12px 18px', background: 'transparent', color: 'var(--paper)',
              border: '1px solid rgba(245,240,232,0.35)', fontFamily: 'var(--font-mono)',
              fontSize: 12, cursor: 'pointer',
            }}>Copy address</button>
          </div>

          {/* channels */}
          <div style={{
            border: '1px solid var(--rule)', background: 'var(--paper-pure)',
            padding: 24, display: 'flex', flexDirection: 'column', gap: 16,
          }}>
            <Bracket>Other channels</Bracket>
            <SidebarChannel label="Schedule a call"  value={CONTACT.schedule}  glyph="→" />
            <SidebarChannel label="GitHub"            value={CONTACT.github}    glyph="↗" />
            <SidebarChannel label="RSS"               value={CONTACT.rss}       glyph="↗" />
          </div>

          {/* office hours */}
          <div style={{
            border: '1px solid var(--rule-soft)', padding: '16px 20px',
            fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--graphite)', lineHeight: 1.7,
          }}>
            <Bracket size={11}>Office hours</Bracket>
            <div style={{ marginTop: 8 }}>{CONTACT.hours}</div>
            <div style={{ color: 'var(--pencil)', marginTop: 2 }}>{CONTACT.location}</div>
          </div>
        </aside>
      </section>

      <SiteFooterMock />
    </div>
  );
};

// ---- helpers (named to avoid collisions with shared MetaRow) ----
function MetaCol({ label, value, isLink, href }) {
  return (
    <div style={{ display: 'grid', gridTemplateColumns: '70px 1fr', gap: 10, color: 'var(--graphite)' }}>
      <span style={{ color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.04em', fontSize: 11 }}>{label}</span>
      <span style={{ color: 'var(--ink)' }}>
        {isLink
          ? <a href={href} style={{ color: 'var(--link)', textDecoration: 'underline' }}>{value}</a>
          : value}
      </span>
    </div>
  );
}

function Field({ label, type = 'text', textarea, placeholder }) {
  const Cmp = textarea ? 'textarea' : 'input';
  return (
    <label style={{ display: 'flex', flexDirection: 'column', gap: 8 }}>
      <span style={{
        fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)',
        textTransform: 'uppercase', letterSpacing: '0.06em',
      }}>{label}</span>
      <Cmp
        type={type} rows={textarea ? 6 : undefined} placeholder={placeholder}
        style={{
          fontFamily: 'var(--font-mono)', fontSize: 15, color: 'var(--ink)',
          background: 'var(--paper)', border: '1px solid var(--rule)',
          padding: '14px 16px', resize: 'vertical', minHeight: textarea ? 160 : 'auto',
        }}
      />
    </label>
  );
}

function SidebarChannel({ label, value, glyph }) {
  return (
    <div>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.06em', marginBottom: 4 }}>{label}</div>
      <a href="#" style={{
        fontFamily: 'var(--font-mono-2)', fontSize: 13,
        color: 'var(--link)', textDecoration: 'underline',
      }}>{value} {glyph}</a>
    </div>
  );
}

Object.assign(window, { ContactA });
