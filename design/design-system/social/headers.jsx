// LinkedIn Header — 3 variations for Bain Design
// Canvas size: 1584 × 396 (LinkedIn personal banner)
// Each artboard is built at full size; the canvas scales them for review.

const W = 1584, H = 396;

// ---- shared bits ----
const BdMark = ({ size = 28 }) => (
  <div style={{
    width: size, height: size, background: 'var(--ink)', color: 'var(--paper)',
    display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
    fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: size * 0.5,
    letterSpacing: '-0.04em',
  }}>Bd</div>
);

const FontStyles = () => (
  <style>{`
    @keyframes bd-blink { 50% { opacity: 0; } }
    .bd-cursor { display: inline-block; width: 0.55ch; height: 0.95em;
      vertical-align: -0.1em; background: var(--clay);
      animation: bd-blink 1.06s steps(2) infinite; margin-left: 4px; }
  `}</style>
);

// ---- Variant A — Terminal session ----
// Full-bleed mock terminal with a real $ prompt, ASCII frame, blinking cursor.
const HeaderA = () => (
  <div style={{
    width: W, height: H, background: 'var(--ink)', color: 'var(--paper)',
    fontFamily: 'var(--font-mono)', position: 'relative', overflow: 'hidden',
    padding: '40px 56px', boxSizing: 'border-box',
  }}>
    <FontStyles />
    {/* terminal chrome top bar */}
    <div style={{
      position: 'absolute', top: 0, left: 0, right: 0, height: 28,
      background: 'rgba(245,240,232,0.08)', borderBottom: '1px solid rgba(245,240,232,0.12)',
      display: 'flex', alignItems: 'center', padding: '0 14px', gap: 6,
      fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'rgba(245,240,232,0.55)',
    }}>
      <span style={{ width: 8, height: 8, borderRadius: '50%', background: '#FF5F57' }} />
      <span style={{ width: 8, height: 8, borderRadius: '50%', background: '#FEBC2E' }} />
      <span style={{ width: 8, height: 8, borderRadius: '50%', background: '#28C840' }} />
      <span style={{ marginLeft: 14 }}>~/bain.design — zsh — 132×24</span>
    </div>

    <div style={{ marginTop: 28, fontSize: 14, color: 'rgba(245,240,232,0.55)', fontFamily: 'var(--font-mono-2)' }}>
      Last login: Wed May 06 09:14:22 on ttys001
    </div>
    <div style={{ marginTop: 6, fontSize: 18 }}>
      <span style={{ color: 'var(--clay)' }}>~ </span>
      <span style={{ color: 'rgba(245,240,232,0.65)' }}>$ </span>
      <span>cat about.txt</span>
    </div>

    <div style={{ marginTop: 22, fontSize: 56, fontWeight: 700, letterSpacing: '-0.03em', lineHeight: 1.1 }}>
      Friendly websites
      <br />for interesting <span style={{ color: 'var(--clay)' }}>people<span className="bd-cursor" /></span>
    </div>

    <div style={{ position: 'absolute', right: 32, bottom: 28, display: 'flex', alignItems: 'center', gap: 12 }}>
      <BdMark size={32} />
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'rgba(245,240,232,0.7)' }}>
        bain.design · Mark Bain
      </div>
    </div>
  </div>
);

// ---- Variant B — Cream blueprint ----
// Light, editorial. Big mono headline, file-tree path, ASCII brackets.
const HeaderB = () => (
  <div style={{
    width: W, height: H, background: 'var(--paper)', color: 'var(--ink)',
    fontFamily: 'var(--font-mono)', position: 'relative', overflow: 'hidden',
    padding: '48px 64px', boxSizing: 'border-box',
    backgroundImage: 'linear-gradient(transparent 39px, rgba(28,26,23,0.06) 40px), linear-gradient(90deg, transparent 39px, rgba(28,26,23,0.06) 40px)',
    backgroundSize: '40px 40px',
  }}>
    <FontStyles />
    <div style={{ display: 'flex', alignItems: 'baseline', gap: 14, fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.06em' }}>
      <span>~/bain.design/</span><span style={{ color: 'var(--clay)' }}>v.2026</span>
    </div>

    <div style={{ marginTop: 18, fontSize: 64, fontWeight: 700, letterSpacing: '-0.03em', lineHeight: 1.05, color: 'var(--ink)' }}>
      <span style={{ color: 'var(--pencil)' }}>[</span> Friendly <span style={{ color: 'var(--pencil)' }}>]</span> websites
      <br />for <span style={{
        color: 'var(--clay-deep)', background: 'rgba(201, 100, 66, 0.12)', padding: '0 6px',
      }}>interesting</span> people.
    </div>

    {/* corner ticks */}
    <div style={{ position: 'absolute', top: 24, right: 24, fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--clay)' }}>┐</div>
    <div style={{ position: 'absolute', bottom: 24, left: 24, fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--clay)' }}>└</div>

    <div style={{ position: 'absolute', right: 32, bottom: 28, display: 'flex', alignItems: 'center', gap: 12 }}>
      <BdMark size={32} />
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--graphite)' }}>
        bain.design · Mark Bain
      </div>
    </div>
  </div>
);

// ---- Variant C — Stats card ----
// Cream split with a "specs" panel — 14yr, 2 plugins on .org, etc.
const HeaderC = () => (
  <div style={{
    width: W, height: H, fontFamily: 'var(--font-mono)', position: 'relative', overflow: 'hidden',
    display: 'grid', gridTemplateColumns: '1.4fr 1fr', background: 'var(--paper)',
  }}>
    <FontStyles />
    <div style={{ padding: '52px 48px', display: 'flex', flexDirection: 'column', justifyContent: 'space-between' }}>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em' }}>
        [ Bain Design — est. 2012 ]
      </div>
      <div style={{ fontSize: 56, fontWeight: 700, lineHeight: 1.05, letterSpacing: '-0.03em', color: 'var(--ink)' }}>
        Friendly websites for interesting people<span style={{ color: 'var(--clay)' }}>.</span>
      </div>
      <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
        <BdMark size={28} />
        <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--graphite)' }}>
          Mark Bain · bain.design
        </span>
      </div>
    </div>
    <div style={{
      background: 'var(--ink)', color: 'var(--paper)', padding: '40px 36px',
      display: 'flex', flexDirection: 'column', justifyContent: 'center', gap: 10,
      fontFamily: 'var(--font-mono-2)', fontSize: 14,
    }}>
      {[
        ['14+', 'years coding bespoke'],
        ['100s', 'sites shipped'],
        ['2',   'plugins on .org'],
        ['0',   'page builders used'],
      ].map(([n, l]) => (
        <div key={l} style={{ display: 'flex', alignItems: 'baseline', gap: 14 }}>
          <span style={{ color: 'var(--clay)', fontWeight: 700, fontSize: 22, minWidth: 60 }}>✔ {n}</span>
          <span style={{ color: 'rgba(245,240,232,0.85)' }}>{l}</span>
        </div>
      ))}
    </div>
  </div>
);

window.HeaderA = HeaderA;
window.HeaderB = HeaderB;
window.HeaderC = HeaderC;

if (!window.__solo) {
  const App = () => (
    <DesignCanvas title="LinkedIn Header — Bain Design" subtitle="1584 × 396">
      <DCSection id="variants" title="Three directions">
        <DCArtboard id="a" label="A · Terminal"      width={W} height={H}><HeaderA /></DCArtboard>
        <DCArtboard id="b" label="B · Blueprint"     width={W} height={H}><HeaderB /></DCArtboard>
        <DCArtboard id="c" label="C · Stats split"   width={W} height={H}><HeaderC /></DCArtboard>
      </DCSection>
    </DesignCanvas>
  );
  ReactDOM.createRoot(document.getElementById('root')).render(<App />);
}
