// Bain Design — About strip with checklist
// Quirks: portrait tilts on hover; checklist items get terminal tooltips.
const CHECKS = [
  { text: 'Dedicated and creative — every site is coded from scratch.',                                 tip: 'no Wix/Squarespace/Webflow' },
  { text: 'Proficient in wireframing, designing responsive layouts, and coding bespoke themes & plugins.', tip: 'full-stack, mostly' },
  { text: 'Two open-source plugins published on WordPress.org.',                                        tip: 'free as in beer' },
  { text: 'Committed to delivering technical solutions that align with clients\' business objectives.',  tip: 'translation: I read your brief' },
];

const About = () => {
  const [portraitHover, setPortraitHover] = React.useState(false);
  return (
    <section style={{ padding: '64px 32px', maxWidth: 1100, margin: '0 auto', borderTop: '1px solid var(--rule)' }}>
      <div style={{ display: 'grid', gridTemplateColumns: '1fr 1.4fr', gap: 48, alignItems: 'start' }}>
        <div>
          <div style={{
            fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)',
            textTransform: 'uppercase', letterSpacing: '0.04em', marginBottom: 12,
          }}>[ about ]</div>
          <h2 style={{
            fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 36,
            letterSpacing: '-0.02em', color: 'var(--ink)', margin: 0,
          }}>Mark Crawford Bain</h2>
          <div style={{
            fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'var(--graphite)', marginTop: 8,
          }}>[WordPress Designer &amp; Developer]</div>
          <Tip text="(would smile if I had a real photo)">
            <div onMouseEnter={() => setPortraitHover(true)} onMouseLeave={() => setPortraitHover(false)}
              style={{
                aspectRatio: '4/5', width: '100%',
                background: 'var(--paper-deep)', border: '1px solid var(--rule)',
                marginTop: 24, display: 'flex', alignItems: 'center', justifyContent: 'center',
                fontFamily: 'var(--font-mono-2)', fontSize: 11, color: 'var(--pencil)',
                transform: portraitHover ? 'rotate(-1deg) translateY(-3px)' : 'none',
                boxShadow: portraitHover ? '6px 6px 0 var(--clay)' : 'none',
                transition: 'transform 220ms, box-shadow 220ms',
                cursor: 'pointer',
              }}>[ portrait — b/w ]</div>
          </Tip>
        </div>

        <div>
          <p style={{
            fontFamily: 'var(--font-mono)', fontSize: 18, lineHeight: 1.55,
            color: 'var(--ink)', marginTop: 0,
          }}>14+ years building bespoke WordPress sites from inception to execution. Based near Barcelona, working with clients worldwide.</p>

          <ul className="bain-check" style={{ marginTop: 24, fontFamily: 'var(--font-mono)', fontSize: 14, lineHeight: 1.55, color: 'var(--graphite)' }}>
            {CHECKS.map((c, i) => (
              <li key={i}>
                {c.text}{' '}
                <Tip text={c.tip}>
                  <span style={{ color: 'var(--clay)', cursor: 'help' }}>?</span>
                </Tip>
              </li>
            ))}
          </ul>
        </div>
      </div>
    </section>
  );
};

window.About = About;
