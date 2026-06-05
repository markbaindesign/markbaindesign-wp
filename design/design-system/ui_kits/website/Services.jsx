// Bain Design — Services list. ASCII-panel feel.
// Quirk: hover a row → ASCII corner brackets appear, "open ticket →" stamp, num scales up.
const services = [
  { num: '01', name: 'Themes',  desc: 'Bespoke WordPress themes, coded from scratch. No page builders, no bloat.', stamp: 'no bloat ✦' },
  { num: '02', name: 'Plugins', desc: 'Custom functionality, two open-source plugins on .org, hundreds of bespoke installs.', stamp: 'two on .org ✦' },
  { num: '03', name: 'Design',  desc: 'Wireframing through to UI — mood-boarding, prototyping, full handoff.', stamp: 'pixels & all ✦' },
];

const ServiceRow = ({ s, i }) => {
  const [hover, setHover] = React.useState(false);
  return (
    <div onMouseEnter={() => setHover(true)} onMouseLeave={() => setHover(false)}
      style={{
        position: 'relative',
        display: 'grid', gridTemplateColumns: '80px 200px 1fr auto',
        gap: 24, padding: '22px 24px', alignItems: 'baseline',
        borderTop: i === 0 ? 'none' : '1px solid var(--rule-soft)',
        cursor: 'pointer',
        background: hover ? 'rgba(201, 100, 66, 0.04)' : 'transparent',
        transition: 'background 160ms ease',
    }}>
      {/* ASCII corner brackets */}
      <span aria-hidden="true" style={{
        position: 'absolute', top: 8, left: 8, fontFamily: 'var(--font-mono-2)',
        fontSize: 11, color: 'var(--clay)',
        opacity: hover ? 1 : 0, transition: 'opacity 160ms',
      }}>┌</span>
      <span aria-hidden="true" style={{
        position: 'absolute', bottom: 8, right: 8, fontFamily: 'var(--font-mono-2)',
        fontSize: 11, color: 'var(--clay)',
        opacity: hover ? 1 : 0, transition: 'opacity 160ms',
      }}>┘</span>

      <div style={{
        fontFamily: 'var(--font-mono)', fontSize: 32, fontWeight: 700,
        color: 'var(--clay)', letterSpacing: '-0.04em',
        transform: hover ? 'translateY(-2px) scale(1.06)' : 'none',
        transition: 'transform 220ms cubic-bezier(.2,.9,.3,1.4)',
      }}>{s.num}</div>

      <div style={{
        fontFamily: 'var(--font-mono)', fontSize: 22, fontWeight: 700,
        color: 'var(--ink)', letterSpacing: '-0.02em',
        position: 'relative',
      }}>
        {s.name}
        <span aria-hidden="true" style={{
          position: 'absolute', left: '100%', top: 4, marginLeft: 10,
          fontFamily: 'var(--font-mono-2)', fontSize: 10, fontWeight: 600,
          color: 'var(--paper)', background: 'var(--clay)',
          padding: '2px 6px', whiteSpace: 'nowrap',
          transform: hover ? 'rotate(-4deg) translateY(0)' : 'rotate(-4deg) translateY(-6px)',
          opacity: hover ? 1 : 0,
          transition: 'opacity 200ms, transform 220ms cubic-bezier(.2,.9,.3,1.4)',
          pointerEvents: 'none',
        }}>{s.stamp}</span>
      </div>

      <div style={{
        fontFamily: 'var(--font-mono)', fontSize: 14, lineHeight: 1.55,
        color: 'var(--graphite)',
      }}>{s.desc}</div>

      <a href="#" style={{
        fontFamily: 'var(--font-mono-2)', fontSize: 12,
        color: hover ? 'var(--clay)' : 'var(--ink)',
        transition: 'color 160ms',
      }}>{hover ? 'open ticket →' : 'read more →'}</a>
    </div>
  );
};

const Services = () => (
  <section style={{ padding: '64px 32px', maxWidth: 1100, margin: '0 auto', borderTop: '1px solid var(--rule)' }}>
    <h2 style={{
      fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 36,
      letterSpacing: '-0.02em', color: 'var(--ink)', margin: '0 0 32px',
    }}>
      <span style={{ color: 'var(--pencil)', fontWeight: 400, marginRight: 12 }}>01 /</span>
      Services
    </h2>

    <div style={{
      border: '1px solid var(--rule)', background: 'var(--paper-pure)',
    }}>
      {services.map((s, i) => <ServiceRow key={s.num} s={s} i={i} />)}
    </div>
  </section>
);

window.Services = Services;
