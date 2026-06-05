// Variation C — Terminal CLI composer
// The contact page rendered as a $ shell session. `bain --help`, then a
// composer that LOOKS like a heredoc but is really a styled form. Dark.
// Very on-brand. Riskier — only ship this if the rest of the site keeps
// the joke going.

const ContactC = () => {
  const W = 1440;
  return (
    <div style={{ width: W, background: 'var(--ink)', color: 'var(--paper)', fontFamily: 'var(--font-mono)' }}>
      {/* Inverted header — paper text on ink */}
      <header style={{
        background: 'var(--ink)', color: 'var(--paper)',
        borderBottom: '1px solid rgba(245,240,232,0.18)',
        display: 'flex', alignItems: 'center', justifyContent: 'space-between',
        padding: '14px 48px',
      }}>
        <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
          <div style={{
            width: 36, height: 36, background: 'var(--paper)', color: 'var(--ink)',
            display: 'flex', alignItems: 'center', justifyContent: 'center',
            fontWeight: 700, fontSize: 18, letterSpacing: '-0.04em',
          }}>Bd</div>
          <span style={{ fontWeight: 700, fontSize: 14, color: 'var(--paper)', letterSpacing: '-0.01em' }}>BAIN DESIGN</span>
        </div>
        <nav style={{ display: 'flex', alignItems: 'center', gap: 14, fontSize: 13 }}>
          {['Home', 'About', 'Services', 'Work', 'Nice Words', 'Contact'].map((item, i, arr) => (
            <React.Fragment key={item}>
              <span style={{
                color: 'var(--paper)',
                borderBottom: item === 'Contact' ? '1px solid var(--clay)' : '1px solid transparent',
              }}>{item}</span>
              {i < arr.length - 1 && <span style={{ color: 'rgba(245,240,232,0.45)' }}>/</span>}
            </React.Fragment>
          ))}
        </nav>
      </header>

      {/* terminal frame */}
      <section style={{ padding: '64px 96px' }}>
        <TerminalChrome />

        <div style={{ padding: '0 8px', fontSize: 16, lineHeight: 1.65 }}>
          {/* welcome */}
          <Line><span style={{ color: 'rgba(245,240,232,0.55)' }}>Last login: Wed 06 May 2026 09:14:22 on ttys001</span></Line>
          <Line>
            <Prompt /> bain --help
          </Line>

          {/* help output */}
          <pre style={{
            margin: '12px 0 32px', fontFamily: 'var(--font-mono-2)', fontSize: 15,
            color: 'rgba(245,240,232,0.9)', lineHeight: 1.7, whiteSpace: 'pre-wrap',
          }}>
{`USAGE
  bain [options] <message>

DESCRIPTION
  Friendly WordPress designer & developer. Talks to humans. Replies fast.

OPTIONS
  -e, --email      send to ${CONTACT.email}                       [recommended]
  -s, --schedule   open a 30-min slot at ${CONTACT.schedule}
  -g, --github     browse ${CONTACT.github}
  -r, --rss        subscribe to ${CONTACT.rss}
  -p, --place      coffee in Barcelona (${CONTACT.location})
  -h, --help       this output

ENVIRONMENT
  RESPONSE_TIME   ${CONTACT.responseTime}
  OFFICE_HOURS    ${CONTACT.hours}

EXAMPLES
  $ bain -e "Hi Mark, we run a small publisher and need a new theme..."
  $ bain --schedule
  $ bain --help`}
          </pre>

          {/* compose */}
          <Line><span style={{ color: 'rgba(245,240,232,0.55)' }}># the friendly path</span></Line>
          <Line><Prompt /> bain --email &lt;&lt;EOF</Line>
        </div>

        {/* the heredoc — really a form */}
        <div style={{
          margin: '16px 0 8px',
          background: 'rgba(245,240,232,0.04)',
          border: '1px solid rgba(245,240,232,0.18)',
          padding: 24,
        }}>
          <form onSubmit={(e) => e.preventDefault()} style={{ display: 'grid', gridTemplateColumns: '120px 1fr', gap: 18, alignItems: 'baseline' }}>
            <HeredocField label="To:"      defaultValue={CONTACT.email}   readOnly />
            <HeredocField label="From:"    placeholder="you@yours.com" />
            <HeredocField label="Subject:" placeholder="hello, new project" />
            <HeredocField label="--"       hr />
            <HeredocField label="Brief:"   textarea
              placeholder={`A line or two on what you're building, who it's for, and roughly when you need it.

The more you tell me up front, the less back-and-forth before we're useful to each other.`} />
          </form>

          <div style={{ marginTop: 20, display: 'flex', justifyContent: 'space-between', alignItems: 'center', gap: 16, flexWrap: 'wrap' }}>
            <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'rgba(245,240,232,0.55)' }}>
              <span style={{ color: 'var(--phosphor)' }}>●</span> 4 fields · plain text · no tracking
            </div>
            <div style={{ display: 'flex', gap: 12 }}>
              <button style={{
                background: 'transparent', color: 'var(--paper)',
                border: '1px solid rgba(245,240,232,0.35)', padding: '12px 18px',
                fontFamily: 'var(--font-mono)', fontSize: 13, cursor: 'pointer',
              }}>Cancel</button>
              <button style={{
                background: 'var(--clay)', color: 'var(--paper)',
                border: '1px solid var(--clay)', padding: '12px 20px',
                fontFamily: 'var(--font-mono)', fontSize: 13, fontWeight: 500, cursor: 'pointer',
              }}>EOF — send →</button>
            </div>
          </div>
        </div>

        {/* response prompt */}
        <div style={{ padding: '32px 8px 0', fontSize: 16, lineHeight: 1.65 }}>
          <Line><span style={{ color: 'rgba(245,240,232,0.55)' }}># once you hit send</span></Line>
          <Line><Prompt /> bain --status</Line>
          <pre style={{
            margin: '12px 0 0', fontFamily: 'var(--font-mono-2)', fontSize: 14,
            color: 'rgba(245,240,232,0.85)', lineHeight: 1.8, whiteSpace: 'pre-wrap',
          }}>
{`==> queued                    [ok]    your brief is in my inbox
==> read                       [t+2d]  i'll read it within two working days
==> reply                      [t+3d]  if it's a fit, i'll come back with questions
==> call                       [t+1w]  free 30 minutes, no pitch deck
==> proposal                   [t+2w]  one PDF: scope + timeline + price`}
          </pre>
          <Line style={{ marginTop: 32 }}>
            <Prompt cursor />
          </Line>
        </div>
      </section>

      {/* other paths strip */}
      <section style={{
        padding: '48px 96px',
        background: 'rgba(245,240,232,0.04)',
        borderTop: '1px solid rgba(245,240,232,0.18)',
        borderBottom: '1px solid rgba(245,240,232,0.18)',
      }}>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(4, 1fr)', gap: 16 }}>
          {[
            ['-s', 'Schedule',  CONTACT.schedule],
            ['-g', 'GitHub',    CONTACT.github],
            ['-r', 'RSS',       CONTACT.rss],
            ['-p', 'In person', CONTACT.location],
          ].map(([flag, label, addr]) => (
            <a key={flag} href="#" style={{ textDecoration: 'none', color: 'var(--paper)' }}>
              <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--clay)' }}>{flag}, --{label.toLowerCase().replace(/ /g, '')}</div>
              <div style={{ fontSize: 20, fontWeight: 700, marginTop: 6 }}>{label}</div>
              <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'rgba(245,240,232,0.55)', marginTop: 4, wordBreak: 'break-all' }}>{addr}</div>
            </a>
          ))}
        </div>
      </section>

      {/* inverted footer */}
      <footer style={{
        padding: '32px 96px',
        fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'rgba(245,240,232,0.65)',
        display: 'flex', justifyContent: 'space-between', alignItems: 'center', flexWrap: 'wrap', gap: 16,
      }}>
        <div>© 2026 Bain Design — Build with <span style={{ color: 'var(--clay)' }}>♥</span> · Barcelona</div>
        <div style={{ color: 'rgba(245,240,232,0.45)' }}>man(1) bain · last updated 2026-05-06</div>
      </footer>
    </div>
  );
};

// ---- terminal building blocks ----

function TerminalChrome() {
  return (
    <div style={{
      display: 'flex', alignItems: 'center', gap: 8, padding: '10px 16px',
      background: 'rgba(245,240,232,0.06)', borderBottom: '1px solid rgba(245,240,232,0.18)',
      fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'rgba(245,240,232,0.55)',
    }}>
      <span style={{ width: 12, height: 12, borderRadius: '50%', background: '#FF5F57' }} />
      <span style={{ width: 12, height: 12, borderRadius: '50%', background: '#FEBC2E' }} />
      <span style={{ width: 12, height: 12, borderRadius: '50%', background: '#28C840' }} />
      <span style={{ marginLeft: 14 }}>~/bain.design — zsh — 120×40</span>
    </div>
  );
}

function Prompt({ cursor }) {
  return (
    <span>
      <span style={{ color: 'var(--clay)' }}>~ </span>
      <span style={{ color: 'rgba(245,240,232,0.55)' }}>$ </span>
      {cursor && (
        <span style={{
          display: 'inline-block', width: '0.6ch', height: '1em',
          background: 'var(--phosphor)', verticalAlign: '-0.15em', marginLeft: 4,
          animation: 'ba-blink 1.06s steps(2) infinite',
        }} />
      )}
    </span>
  );
}

function Line({ children, style }) {
  return <div style={{ padding: '4px 8px', ...(style || {}) }}>{children}</div>;
}

function HeredocField({ label, defaultValue, placeholder, textarea, readOnly, hr }) {
  if (hr) {
    return (
      <>
        <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'rgba(245,240,232,0.45)' }}>{label}</div>
        <div style={{ height: 0, borderTop: '1px dashed rgba(245,240,232,0.18)' }} />
      </>
    );
  }
  const Cmp = textarea ? 'textarea' : 'input';
  return (
    <>
      <label style={{
        fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'rgba(245,240,232,0.55)',
        letterSpacing: '0.04em',
      }}>{label}</label>
      <Cmp
        defaultValue={defaultValue} placeholder={placeholder} readOnly={readOnly}
        rows={textarea ? 8 : undefined}
        style={{
          fontFamily: 'var(--font-mono)', fontSize: 15, color: 'var(--paper)',
          background: 'transparent',
          border: 0, borderBottom: '1px solid rgba(245,240,232,0.18)',
          padding: '8px 0', outline: 'none', resize: textarea ? 'vertical' : 'none',
          minHeight: textarea ? 180 : 'auto', width: '100%',
        }}
      />
    </>
  );
}

Object.assign(window, { ContactC });
