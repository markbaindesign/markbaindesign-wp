// Bain Design — Site header
// Sticky bar with the Bd mark, primary nav, slash separators.
// Quirks: Bd mark cycles glyphs on click; nav links carry terminal tooltips.

const NAV_TIPS = {
  'Home':       'pwd → /',
  'About':      'whoami',
  'Services':   'ls services/',
  'Work':       'cat portfolio.md',
  'Nice Words': 'grep -i kind reviews/*',
  'Contact':    'open mailto:hello',
};
const MARKS = ['Bd', 'B|', 'B_', 'B/', 'Bd'];

const Header = () => {
  const [markIdx, setMarkIdx] = React.useState(0);
  const [marked, setMarked] = React.useState(false);
  const cycle = () => {
    setMarkIdx(i => (i + 1) % MARKS.length);
    setMarked(true);
    setTimeout(() => setMarked(false), 220);
    window.bdToast?.('hello, you found it');
  };
  return (
    <header style={{
      position: 'sticky', top: 0, zIndex: 10,
      background: 'var(--paper)', borderBottom: '1px solid var(--rule)',
      display: 'flex', alignItems: 'center', justifyContent: 'space-between',
      padding: '14px 32px',
    }}>
      <a href="#" onClick={(e) => { e.preventDefault(); cycle(); }}
         style={{ display: 'flex', alignItems: 'center', gap: 12, textDecoration: 'none', cursor: 'pointer' }}>
        <Tip text="click me">
          <div style={{
            width: 36, height: 36, background: 'var(--ink)', color: 'var(--paper)',
            display: 'flex', alignItems: 'center', justifyContent: 'center',
            fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 18, letterSpacing: '-0.04em',
            transform: marked ? 'rotate(-8deg) scale(1.1)' : 'none',
            transition: 'transform 220ms cubic-bezier(.2,.9,.3,1.4)',
          }}>{MARKS[markIdx]}</div>
        </Tip>
        <span style={{
          fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 14,
          color: 'var(--ink)', letterSpacing: '-0.01em',
        }}>BAIN DESIGN</span>
      </a>
      <nav style={{ display: 'flex', alignItems: 'center', gap: 14, fontFamily: 'var(--font-mono)', fontSize: 13 }}>
        {Object.keys(NAV_TIPS).map((item, i, arr) => (
          <React.Fragment key={item}>
            <Tip text={NAV_TIPS[item]}>
              <a href="#" style={{ color: 'var(--ink)', textDecoration: 'none', borderBottom: '1px solid transparent' }}
                 onMouseEnter={e => e.currentTarget.style.borderBottomColor = 'var(--ink)'}
                 onMouseLeave={e => e.currentTarget.style.borderBottomColor = 'transparent'}>{item}</a>
            </Tip>
            {i < arr.length - 1 && <span style={{ color: 'var(--pencil)' }}>/</span>}
          </React.Fragment>
        ))}
      </nav>
    </header>
  );
};

window.Header = Header;
