// Variation B — Channels grid + FAQ
// A page that admits there's more than one way to reach me. Hero,
// then a 3-up grid of channel cards (Email, Schedule, GitHub, Twitter,
// Real-world, RSS), then a longer brief form, then an FAQ section.

const ContactB = () => {
  const W = 1440;

  const channels = [
    {
      kind: 'Primary',  brand: 'mail',
      title: 'Email',
      addr: CONTACT.email,
      desc: 'The most reliable way to reach me. I read everything, I reply within a working day or two.',
      cta:  'Compose →',
      tone: 'ink',
    },
    {
      kind: 'Booking',  brand: 'call',
      title: 'Schedule a chat',
      addr: CONTACT.schedule,
      desc: '30 minutes, free. Useful once you\'ve got a brief shape and want to talk about scope, timing or fit.',
      cta:  'Pick a slot ↗',
      tone: 'paper',
    },
    {
      kind: 'Engineering', brand: 'gh',
      title: 'GitHub',
      addr: CONTACT.github,
      desc: 'Open-source plugins, theme experiments, code review. Drop an issue on Plain Sitemap if you found a bug.',
      cta:  'Browse repos ↗',
      tone: 'paper',
    },
    {
      kind: 'Subscribe', brand: 'rss',
      title: 'RSS',
      addr: CONTACT.rss,
      desc: 'I write once or twice a quarter — usually about WordPress internals, the indie web, or a tool worth knowing.',
      cta:  'Subscribe ↗',
      tone: 'paper',
    },
    {
      kind: 'In person', brand: 'place',
      title: 'Barcelona',
      addr: 'Eixample / Gràcia',
      desc: 'I work from home or from Antic Forn café most mornings. Happy to meet for coffee if you\'re passing through.',
      cta:  'Say hi if you\'re here',
      tone: 'paper',
    },
    {
      kind: 'Hours', brand: 'time',
      title: 'Office hours',
      addr: CONTACT.hours,
      desc: 'I close my mail client outside these. If something is genuinely on fire, mark the subject [URGENT].',
      cta:  null,
      tone: 'paper',
    },
  ];

  return (
    <div style={{ width: W, background: 'var(--paper)', color: 'var(--ink)', fontFamily: 'var(--font-mono)' }}>
      <SiteHeaderMock />

      {/* hero */}
      <section style={{ padding: '80px 96px 56px', borderBottom: '1px solid var(--rule)' }}>
        <Bracket>Get in touch</Bracket>
        <h1 style={{
          fontSize: 96, fontWeight: 700, letterSpacing: '-0.035em',
          lineHeight: 1.0, margin: '24px 0 32px', maxWidth: '18ch',
        }}>
          Lots of ways to start a conversation<span style={{ color: 'var(--clay)' }}>.</span>
        </h1>
        <p style={{ fontSize: 22, color: 'var(--graphite)', maxWidth: '60ch', lineHeight: 1.5, margin: 0, textWrap: 'pretty' }}>
          Pick whichever fits — but email is usually fastest, and the only one I check every morning. I reply <strong style={{ color: 'var(--ink)' }}>{CONTACT.responseTime}</strong>.
        </p>
      </section>

      {/* channels grid */}
      <section style={{ padding: '64px 96px' }}>
        <InlineHead num="01" label="Channels" />
        <div style={{
          marginTop: 32, display: 'grid', gridTemplateColumns: '1fr 1fr 1fr', gap: 16,
        }}>
          {channels.map((c) => <ChannelCard key={c.title} {...c} />)}
        </div>
      </section>

      {/* big form section */}
      <section style={{
        padding: '64px 96px', background: 'var(--paper-deep)',
        borderTop: '1px solid var(--rule)', borderBottom: '1px solid var(--rule)',
      }}>
        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1.4fr', gap: 80, alignItems: 'start' }}>
          <div>
            <InlineHead num="02" label="Send a brief" />
            <p style={{ marginTop: 24, fontSize: 18, color: 'var(--graphite)', lineHeight: 1.6, maxWidth: '40ch' }}>
              Faster than an open-ended "let's chat" email — fill this in once and we'll get to scope in the first reply.
            </p>
            <ul style={{ listStyle: 'none', padding: 0, margin: '32px 0 0' }}>
              {[
                'No newsletter sign-up.',
                'Goes straight to my inbox.',
                'I delete it after we close out.',
              ].map((s, i) => (
                <li key={i} style={{ position: 'relative', paddingLeft: 28, marginBottom: 10, fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--ink)' }}>
                  <span style={{ position: 'absolute', left: 0, top: 0, color: 'var(--phosphor)', fontWeight: 700 }}>✔</span>
                  {s}
                </li>
              ))}
            </ul>
          </div>

          <form onSubmit={(e) => e.preventDefault()} style={{
            background: 'var(--paper-pure)', border: '1px solid var(--rule)',
            padding: 32, display: 'flex', flexDirection: 'column', gap: 20,
          }}>
            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 16 }}>
              <CompactField label="Name" placeholder="Mark Crawford Bain" />
              <CompactField label="Email" type="email" placeholder="you@yours.com" />
            </div>
            <CompactField label="Company / project" placeholder="Acme Co. — re-platforming the marketing site" />
            <CompactField label="Type of work">
              <select style={{
                fontFamily: 'var(--font-mono)', fontSize: 15, color: 'var(--ink)',
                background: 'var(--paper)', border: '1px solid var(--rule)',
                padding: '12px 16px', appearance: 'none',
              }}>
                <option>Bespoke WordPress theme</option>
                <option>Plugin authoring / custom feature</option>
                <option>Existing site — refactor, performance, accessibility</option>
                <option>Migration from another platform</option>
                <option>Not sure yet</option>
              </select>
            </CompactField>
            <CompactField label="Rough timeline">
              <div style={{ display: 'flex', gap: 8, flexWrap: 'wrap' }}>
                {['ASAP', '< 1 month', '1–3 months', '3+ months', 'Open'].map((t, i) => (
                  <button key={t} type="button" style={{
                    fontFamily: 'var(--font-mono-2)', fontSize: 12,
                    padding: '8px 14px', border: '1px solid var(--rule)',
                    background: i === 2 ? 'var(--ink)' : 'transparent',
                    color: i === 2 ? 'var(--paper)' : 'var(--ink)',
                    cursor: 'pointer',
                  }}>{t}</button>
                ))}
              </div>
            </CompactField>
            <CompactField label="Brief" textarea placeholder="A line or two on what you're building, who it's for, and what's tricky about it." />
            <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', gap: 16, flexWrap: 'wrap' }}>
              <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)' }}>
                No analytics, no Mailchimp, no 'we'll be in touch'.
              </span>
              <CtaBtn>Send →</CtaBtn>
            </div>
          </form>
        </div>
      </section>

      {/* FAQ */}
      <section style={{ padding: '96px 96px' }}>
        <InlineHead num="03" label="Common questions" />
        <div style={{
          marginTop: 32, display: 'grid', gridTemplateColumns: '1fr 1fr', gap: 16,
        }}>
          {[
            ['Do you work with WordPress only?',
             'Yes — bespoke themes and plugins, no page builders, no parent themes. If your stack is React/Next or Astro, I can recommend a couple of friends who do that well.'],
            ['Smallest project you\'ll take on?',
             'A two-week scope is the floor; below that the on-ramp costs more than the work. I do free 30-minute consults if you\'re weighing it up.'],
            ['Do you do retainers?',
             'Yes — typically half a day a week, for clients I\'ve already shipped a build with. Two slots open at any time.'],
            ['Where are you based?',
             'Barcelona (Eixample). I work async with clients across UTC-8 to UTC+10. The overlap with US East and West coasts is the usual sticking point.'],
            ['Do you use AI?',
             'For early drafting, code skeletons, and rubber-ducking — yes. For decisions, design, and final code — no. The shipped work is mine.'],
            ['What about page builders?',
             'I don\'t use Elementor, Divi, WPBakery, or similar. They optimise for click-flow at the cost of performance, accessibility and maintainability. The Bain default is custom blocks or ACF.'],
          ].map(([q, a]) => (
            <details key={q} open style={{
              background: 'var(--paper-pure)', border: '1px solid var(--rule)',
              padding: 24,
            }}>
              <summary style={{
                fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 18,
                cursor: 'pointer', listStyle: 'none', display: 'flex', alignItems: 'baseline', gap: 12,
              }}>
                <span style={{ color: 'var(--clay)' }}>?</span> {q}
              </summary>
              <p style={{
                marginTop: 12, marginBottom: 0,
                fontSize: 15, color: 'var(--graphite)', lineHeight: 1.65, maxWidth: '60ch',
              }}>{a}</p>
            </details>
          ))}
        </div>
      </section>

      <SiteFooterMock />
    </div>
  );
};

// ---- channel card ----
function ChannelCard({ kind, title, addr, desc, cta, tone, brand }) {
  const isInk = tone === 'ink';
  const fg = isInk ? 'var(--paper)' : 'var(--ink)';
  const muted = isInk ? 'rgba(245,240,232,0.65)' : 'var(--graphite)';
  return (
    <article style={{
      background: isInk ? 'var(--ink)' : 'var(--paper-pure)',
      border: '1px solid ' + (isInk ? 'var(--ink)' : 'var(--rule)'),
      color: fg, padding: 24, display: 'flex', flexDirection: 'column', gap: 16,
      minHeight: 280,
    }}>
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'baseline' }}>
        <Bracket color={isInk ? 'rgba(245,240,232,0.55)' : 'var(--pencil)'} size={11}>{kind}</Bracket>
        <ChannelGlyph brand={brand} ink={isInk} />
      </div>
      <h3 style={{ fontSize: 28, fontWeight: 700, margin: 0, letterSpacing: '-0.02em' }}>
        {title}<span style={{ color: 'var(--clay)' }}>.</span>
      </h3>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: isInk ? 'var(--clay-soft)' : 'var(--link)', textDecoration: 'underline', wordBreak: 'break-all' }}>
        {addr}
      </div>
      <p style={{ fontSize: 14, lineHeight: 1.55, color: muted, margin: 0, flex: 1 }}>
        {desc}
      </p>
      {cta && (
        <div style={{
          marginTop: 8, fontFamily: 'var(--font-mono)', fontSize: 13, fontWeight: 500,
          color: isInk ? 'var(--paper)' : 'var(--ink)', borderTop: '1px solid ' + (isInk ? 'rgba(245,240,232,0.2)' : 'var(--rule-soft)'),
          paddingTop: 12,
        }}>{cta}</div>
      )}
    </article>
  );
}

// Iconography uses unicode glyphs / ASCII (per the brand rules — no emoji).
function ChannelGlyph({ brand, ink }) {
  const map = {
    mail:  '@',
    call:  '◷',
    gh:    'gh',
    rss:   '〰',
    place: '◉',
    time:  '◴',
  };
  return (
    <span style={{
      width: 32, height: 32, border: '1px solid ' + (ink ? 'rgba(245,240,232,0.35)' : 'var(--rule)'),
      display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
      fontFamily: 'var(--font-mono-2)', fontSize: 14, fontWeight: 500,
      color: ink ? 'var(--clay-soft)' : 'var(--clay)',
    }}>{map[brand] ?? '·'}</span>
  );
}

function CompactField({ label, type = 'text', placeholder, textarea, children }) {
  const Cmp = textarea ? 'textarea' : 'input';
  return (
    <label style={{ display: 'flex', flexDirection: 'column', gap: 6 }}>
      <span style={{
        fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)',
        textTransform: 'uppercase', letterSpacing: '0.06em',
      }}>{label}</span>
      {children ?? (
        <Cmp
          type={type} rows={textarea ? 5 : undefined} placeholder={placeholder}
          style={{
            fontFamily: 'var(--font-mono)', fontSize: 15, color: 'var(--ink)',
            background: 'var(--paper)', border: '1px solid var(--rule)',
            padding: '12px 16px', resize: 'vertical', minHeight: textarea ? 140 : 'auto',
          }}
        />
      )}
    </label>
  );
}

Object.assign(window, { ContactB });
