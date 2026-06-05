// Bain Design — Project grid (Latest projects)
// Quirks: cards tilt slightly toward the cursor on hover; ASCII frame appears.
const projects = [
  { id: 1, year: '2025', tag: 'branding',   title: 'Buddhist Curriculum Framework', desc: 'A bespoke WordPress site for an educational non-profit, with custom post types and a multilingual curriculum browser.' },
  { id: 2, year: '2024', tag: 'responsive', title: 'Mhairi McFarlane',               desc: 'Author site rebuilt from scratch. Custom theme, performant, no plugin bloat.' },
  { id: 3, year: '2024', tag: 'responsive', title: 'Khyentse Foundation',            desc: 'Multi-language WordPress with bespoke plugins for grant management.' },
];

const ProjectCard = ({ p }) => {
  const ref = React.useRef(null);
  const [tilt, setTilt] = React.useState({ rx: 0, ry: 0 });
  const [hover, setHover] = React.useState(false);

  const onMove = (e) => {
    const r = ref.current.getBoundingClientRect();
    const cx = (e.clientX - r.left) / r.width - 0.5;
    const cy = (e.clientY - r.top) / r.height - 0.5;
    setTilt({ rx: -cy * 6, ry: cx * 6 });
  };
  const onLeave = () => { setHover(false); setTilt({ rx: 0, ry: 0 }); };

  return (
    <article ref={ref}
      onMouseEnter={() => setHover(true)}
      onMouseMove={onMove}
      onMouseLeave={onLeave}
      style={{
        position: 'relative',
        background: 'var(--paper-pure)', border: '1px solid var(--rule)',
        padding: 16, display: 'flex', flexDirection: 'column', gap: 8,
        cursor: 'pointer',
        transform: `perspective(800px) rotateX(${tilt.rx}deg) rotateY(${tilt.ry}deg) translateZ(0)`,
        transition: 'transform 200ms ease, box-shadow 200ms ease',
        boxShadow: hover ? '6px 6px 0 var(--clay)' : '0 0 0 transparent',
      }}>
      {/* corner ticks */}
      {['┌','┐','└','┘'].map((g, i) => (
        <span key={i} aria-hidden="true" style={{
          position: 'absolute',
          top:    i < 2 ? -8 : 'auto',
          bottom: i >= 2 ? -8 : 'auto',
          left:   i % 2 === 0 ? -8 : 'auto',
          right:  i % 2 === 1 ? -8 : 'auto',
          fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--clay)',
          opacity: hover ? 1 : 0, transition: 'opacity 180ms',
          pointerEvents: 'none',
        }}>{g}</span>
      ))}

      <div style={{
        aspectRatio: '4/3', background: 'var(--paper-deep)',
        borderBottom: '1px solid var(--rule-soft)', margin: '-16px -16px 4px',
        display: 'flex', alignItems: 'center', justifyContent: 'center',
        fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)',
      }}>[ project preview ]</div>
      <div style={{
        fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)',
        textTransform: 'uppercase', letterSpacing: '0.04em',
      }}>[{p.year} / {p.tag}]</div>
      <h3 style={{
        fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 18,
        letterSpacing: '-0.01em', color: 'var(--ink)', margin: 0,
      }}>{p.title}</h3>
      <p style={{
        fontFamily: 'var(--font-mono)', fontSize: 13, lineHeight: 1.55,
        color: 'var(--graphite)', margin: 0,
      }}>{p.desc}</p>
      <a href="#" style={{
        marginTop: 6, fontFamily: 'var(--font-mono-2)', fontSize: 12,
        color: hover ? 'var(--clay)' : 'var(--ink)',
      }}>view project →</a>
    </article>
  );
};

const Projects = () => (
  <section style={{ padding: '64px 32px', maxWidth: 1100, margin: '0 auto', borderTop: '1px solid var(--rule)' }}>
    <div style={{ display: 'flex', alignItems: 'baseline', justifyContent: 'space-between', marginBottom: 32 }}>
      <h2 style={{
        fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 36,
        letterSpacing: '-0.02em', color: 'var(--ink)', margin: 0,
      }}>
        <span style={{ color: 'var(--pencil)', fontWeight: 400, marginRight: 12 }}>02 /</span>
        Latest projects
      </h2>
      <Tip text="all 47 of them"><a href="#" style={{ fontFamily: 'var(--font-mono)', fontSize: 13 }}>See all →</a></Tip>
    </div>

    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(3, 1fr)', gap: 18 }}>
      {projects.map(p => <ProjectCard key={p.id} p={p} />)}
    </div>
  </section>
);

window.Projects = Projects;
