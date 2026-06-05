// Shared bits for contact-page variants:
//   - Site header/footer mocks (reuse the project-page versions)
//   - Identity constants
//   - Tiny helpers used by all three layouts

const CONTACT = {
  email:   'hello@bain.design',
  location: 'Barcelona, ES — UTC+1',
  hours:   'Mon–Thu, 09:00–18:00',
  github:  'github.com/markcbain',
  rss:     'bain.design/feed',
  schedule: 'cal.com/markcbain/30min',
  responseTime: 'within two working days, usually one',
};

// CTA button — same as inc/bain-design-system.php's bain_button render.
function CtaBtn({ children, variant = 'primary', href = '#', external = false }) {
  const base = {
    display: 'inline-flex', alignItems: 'center', gap: 8,
    fontFamily: 'var(--font-mono)', fontWeight: 500, fontSize: 14, lineHeight: 1,
    padding: '14px 22px',
    border: '1px solid var(--ink)', textDecoration: 'none',
    cursor: 'pointer', transition: 'all 200ms ease',
  };
  const styles = variant === 'primary'
    ? { ...base, background: 'var(--ink)', color: 'var(--paper)' }
    : { ...base, background: 'transparent', color: 'var(--ink)' };
  return (
    <a href={href} style={styles}
       {...(external ? { target: '_blank', rel: 'noopener noreferrer' } : {})}>
      {children}{external && ' ↗'}
    </a>
  );
}

// Bracket meta line.
function Bracket({ children, color = 'var(--pencil)', size = 13 }) {
  return (
    <div style={{
      fontFamily: 'var(--font-mono-2)', fontSize: size, color,
      textTransform: 'uppercase', letterSpacing: '0.08em',
    }}>[ {children} ]</div>
  );
}

// Numbered section head, inline variant (no rail).
function InlineHead({ num, label }) {
  return (
    <header style={{ display: 'flex', alignItems: 'baseline', gap: 16 }}>
      <span style={{
        fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)',
        textTransform: 'uppercase', letterSpacing: '0.08em',
      }}>{num} /</span>
      <h3 style={{
        fontSize: 32, fontWeight: 700, margin: 0,
        letterSpacing: '-0.02em', fontFamily: 'var(--font-mono)',
      }}>{label}</h3>
    </header>
  );
}

Object.assign(window, { CONTACT, CtaBtn, Bracket, InlineHead });
