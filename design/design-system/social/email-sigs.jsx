// Email signatures — three forms side-by-side.
//
//  A · HTML table-based (no images)   — paste into Gmail/Apple Mail/Outlook
//  B · HTML with inline SVG Bd mark   — more visual, slightly riskier
//  C · Plain text monospace block     — most on-brand; Usenet-style
//
// Each artboard renders the signature exactly as it will appear in a
// mail client, plus a small "Copy" affordance and a code panel below
// showing the raw source to paste.

const SIG_W = 720, SIG_H = 480;

// ---- shared identity ----
const ID = {
  name:   'Mark Crawford Bain',
  role:   'WordPress Designer & Developer',
  email:  'mark@bain.design',
  web:    'https://bain.design',
  github: 'github.com/markcbain',
};

// ---- copy button ----
function CopyBtn({ text }) {
  const [done, setDone] = React.useState(false);
  return (
    <button
      onClick={() => { navigator.clipboard?.writeText(text); setDone(true); setTimeout(() => setDone(false), 1400); }}
      style={{
        appearance: 'none', border: '1px solid var(--ink)', background: done ? 'var(--ink)' : 'transparent',
        color: done ? 'var(--paper)' : 'var(--ink)', fontFamily: 'var(--font-mono-2)', fontSize: 12,
        padding: '6px 10px', cursor: 'pointer', letterSpacing: '0.02em',
      }}
    >{done ? '✔ Copied' : 'Copy source'}</button>
  );
}

// ---- inline code panel ----
function CodePanel({ children, lang }) {
  return (
    <pre style={{
      margin: 0, padding: 12, background: 'var(--paper-deep)',
      border: '1px solid var(--rule)', borderTop: 'none',
      fontFamily: 'var(--font-mono-2)', fontSize: 11, lineHeight: 1.45,
      color: 'var(--ink)', overflow: 'auto', maxHeight: 200, whiteSpace: 'pre',
      flexShrink: 0,
    }}><code>{children}</code></pre>
  );
}

// ---- A · HTML table-based (no images, max compatibility) ----
// Table layout because Outlook + several webmail clients strip CSS that
// touches flex/grid. Inline styles only — external stylesheets are gone
// the moment the user pastes this into Gmail's signature editor.
const SIG_A_HTML = `<table cellpadding="0" cellspacing="0" border="0" style="font-family: 'JetBrains Mono', ui-monospace, Menlo, monospace; font-size: 13px; line-height: 1.55; color: #141413;">
  <tr>
    <td style="padding-right: 16px; border-right: 1px solid #1F1F1D; vertical-align: top; padding-top: 2px;">
      <div style="font-family: 'JetBrains Mono', ui-monospace, monospace; font-weight: 700; font-size: 18px; color: #141413; letter-spacing: -0.02em; padding: 4px 8px; background: #141413; color: #E8DFCC; display: inline-block;">Bd</div>
    </td>
    <td style="padding-left: 16px; vertical-align: top;">
      <div style="font-weight: 700; color: #141413;">${ID.name}</div>
      <div style="color: #3D3D3A; font-size: 12px;">[${ID.role}]</div>
      <div style="margin-top: 8px; color: #3D3D3A; font-size: 12px;">
        <a href="mailto:${ID.email}" style="color: #1A4FE3; text-decoration: underline;">${ID.email}</a>
        &nbsp;/&nbsp;
        <a href="${ID.web}" style="color: #1A4FE3; text-decoration: underline;">${ID.web.replace(/^https?:\/\//, '')}</a>
      </div>
      <div style="margin-top: 4px; color: #8C8A85; font-size: 11px;">Build with <span style="color: #C96442;">&hearts;</span> &nbsp;·&nbsp; Barcelona</div>
    </td>
  </tr>
</table>`;

const SigA = () => (
  <div style={{
    width: SIG_W, height: SIG_H, background: 'var(--paper)', color: 'var(--ink)',
    fontFamily: 'var(--font-mono)', display: 'flex', flexDirection: 'column',
    boxSizing: 'border-box',
  }}>
    {/* mock email-client preview */}
    <div style={{ padding: '24px 24px 0', flex: 1, display: 'flex', flexDirection: 'column' }}>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em', marginBottom: 12 }}>
        [ A · HTML table — universal ]
      </div>
      <div style={{
        background: 'var(--paper-pure)', border: '1px solid var(--rule)', padding: 20, flex: 1,
        display: 'flex', flexDirection: 'column', gap: 16,
      }}>
        <div style={{ fontFamily: '-apple-system, system-ui, sans-serif', fontSize: 13, color: 'var(--graphite)', lineHeight: 1.55 }}>
          Hi there —<br />Thanks for the brief, I'll get you a proposal by Friday.<br /><br />
          Best,<br />Mark
        </div>
        <div style={{ borderTop: '1px solid var(--rule-soft)', paddingTop: 12 }}
             dangerouslySetInnerHTML={{ __html: SIG_A_HTML }} />
      </div>
    </div>
    <div style={{ padding: '8px 24px 12px', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
      <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)' }}>
        Paste into Gmail/Apple Mail signature editor →
      </span>
      <CopyBtn text={SIG_A_HTML} />
    </div>
  </div>
);

// ---- B · HTML with inline SVG Bd mark (vector, scales cleanly) ----
const SIG_B_BD = `<svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" viewBox="0 0 44 44"><rect width="44" height="44" fill="#141413"/><text x="22" y="29" font-family="'JetBrains Mono', monospace" font-weight="700" font-size="20" fill="#E8DFCC" text-anchor="middle" letter-spacing="-1">Bd</text></svg>`;
const SIG_B_HTML = `<table cellpadding="0" cellspacing="0" border="0" style="font-family: 'JetBrains Mono', ui-monospace, Menlo, monospace; font-size: 13px; line-height: 1.55;">
  <tr>
    <td style="padding-right: 16px; vertical-align: top;">
      <img src="data:image/svg+xml;base64,${typeof btoa !== 'undefined' ? btoa(SIG_B_BD) : ''}" alt="Bd" width="44" height="44" style="display: block;" />
    </td>
    <td style="padding-left: 16px; border-left: 1px solid #1F1F1D; vertical-align: top;">
      <div style="font-weight: 700; color: #141413; font-size: 15px;">${ID.name}<span style="color: #C96442;">.</span></div>
      <div style="color: #3D3D3A; font-size: 12px; font-family: 'IBM Plex Mono', monospace;">[${ID.role}]</div>
      <div style="margin-top: 10px; font-size: 12px;">
        <span style="color: #8C8A85;">e&nbsp;</span><a href="mailto:${ID.email}" style="color: #1A4FE3;">${ID.email}</a><br/>
        <span style="color: #8C8A85;">w&nbsp;</span><a href="${ID.web}" style="color: #1A4FE3;">${ID.web.replace(/^https?:\/\//, '')}</a><br/>
        <span style="color: #8C8A85;">g&nbsp;</span><a href="https://${ID.github}" style="color: #1A4FE3;">${ID.github}</a>
      </div>
      <div style="margin-top: 10px; color: #8C8A85; font-size: 11px;">────  Build with <span style="color: #C96442;">&hearts;</span></div>
    </td>
  </tr>
</table>`;

const SigB = () => (
  <div style={{
    width: SIG_W, height: SIG_H, background: 'var(--paper)', color: 'var(--ink)',
    fontFamily: 'var(--font-mono)', display: 'flex', flexDirection: 'column',
    boxSizing: 'border-box',
  }}>
    <div style={{ padding: '24px 24px 0', flex: 1, display: 'flex', flexDirection: 'column' }}>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em', marginBottom: 12 }}>
        [ B · HTML + inline SVG mark — more visual ]
      </div>
      <div style={{
        background: 'var(--paper-pure)', border: '1px solid var(--rule)', padding: 20, flex: 1,
        display: 'flex', flexDirection: 'column', gap: 16,
      }}>
        <div style={{ fontFamily: '-apple-system, system-ui, sans-serif', fontSize: 13, color: 'var(--graphite)', lineHeight: 1.55 }}>
          Hi there —<br />Quick reply on the staging URL — I'll have the build deployed by EOD.<br /><br />
          Cheers,<br />Mark
        </div>
        <div style={{ borderTop: '1px solid var(--rule-soft)', paddingTop: 12 }}
             dangerouslySetInnerHTML={{ __html: SIG_B_HTML }} />
      </div>
    </div>
    <div style={{ padding: '8px 24px 12px', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
      <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)' }}>
        SVG inlined as base64 — no host needed
      </span>
      <CopyBtn text={SIG_B_HTML} />
    </div>
  </div>
);

// ---- C · Plain text monospace block ----
const SIG_C_TEXT = `--
  ┌─────────────────────────────────────────┐
  │  ${ID.name}                       │
  │  [${ID.role}]    │
  └─────────────────────────────────────────┘
    e  ${ID.email}
    w  ${ID.web}
    g  ${ID.github}

    Build with ♥  ·  Barcelona, ES`;

const SigC = () => (
  <div style={{
    width: SIG_W, height: SIG_H, background: 'var(--paper)', color: 'var(--ink)',
    fontFamily: 'var(--font-mono)', display: 'flex', flexDirection: 'column',
    boxSizing: 'border-box',
  }}>
    <div style={{ padding: '24px 24px 0', flex: 1, display: 'flex', flexDirection: 'column' }}>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em', marginBottom: 12 }}>
        [ C · Plain text — Usenet-style, most on-brand ]
      </div>
      <div style={{
        background: 'var(--paper-pure)', border: '1px solid var(--rule)', padding: 20, flex: 1,
        display: 'flex', flexDirection: 'column', gap: 16,
      }}>
        <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--graphite)', lineHeight: 1.55, whiteSpace: 'pre-wrap' }}>
{`> Subject: Re: portfolio site
> From: ${ID.email}
> Date: Wed, 06 May 2026 09:14:22 +0100

Hi —

Sounds good. I'll spin up a Local site this afternoon and
push a first pass to staging tomorrow.

— Mark`}
        </div>
        <pre style={{
          margin: 0, padding: 0, fontFamily: 'var(--font-mono-2)', fontSize: 11,
          color: 'var(--ink)', lineHeight: 1.4, borderTop: '1px solid var(--rule-soft)',
          paddingTop: 12, whiteSpace: 'pre',
        }}>{SIG_C_TEXT.replace('♥', '\u2665')}</pre>
      </div>
    </div>
    <div style={{ padding: '8px 24px 12px', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
      <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)' }}>
        Works in literally every mail client
      </span>
      <CopyBtn text={SIG_C_TEXT} />
    </div>
  </div>
);

Object.assign(window, { SIG_W, SIG_H, SigA, SigB, SigC });
