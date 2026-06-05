// Shared bits for the single-project-page variants.
// Project data, header/footer, image placeholders.

const PROJECT = {
  num: '03',
  title: 'Khyentse Foundation',
  tagline: 'A bilingual grant-management platform for a global Buddhist non-profit.',
  client: 'Khyentse Foundation',
  year: 2024,
  duration: '5 months',
  role: 'Design & development',
  stack: ['WordPress', 'PHP 8.2', 'ACF Pro', 'Custom plugin (kf-grants)', 'Algolia search'],
  url: 'khyentsefoundation.org',
  tags: ['Bespoke theme', 'Multilingual', 'Plugin authoring', 'Grant CMS'],
  brief:
    'KF run a global grant programme funding Buddhist scholarship, translation and practice. The legacy site was a tangle of off-the-shelf plugins, a slow editorial flow, and no clear story for prospective grantees. They asked for a from-scratch rebuild — bilingual (English / Traditional Chinese), simple for their non-technical editors, and easy for board members to track grant cycles.',
  approach:
    'I built a bespoke theme on top of a stripped-down WordPress, wrote a single-purpose plugin (kf-grants) to model grant cycles, applications and decisions as first-class post types, and wired the front end to Algolia so the public-facing project archive stays fast as it grows past four figures. Editorial flow is one CPT per concern, no shortcodes, no page builder.',
  outcome:
    'Editors now spin up a new grant cycle in two clicks. Public archive searches under 50 ms across both languages. Page weight is down 78% vs. the legacy site. Most importantly: the board can read the same dashboard the editors use, which is what they actually wanted.',
  wins: [
    'Bespoke theme — no parent, no page builder, no jQuery.',
    'Custom plugin shipped as a versioned dependency, not a thousand-line functions.php.',
    'Lighthouse 99 / 100 / 100 / 100 across both locales.',
    'Editorial training in a single 45-minute call.',
  ],
  testimonial: {
    quote: 'Mark turned eight years of grant-cycle institutional memory into a CMS our least technical board members can navigate. The plugin still gets a feature request a quarter and nothing else.',
    author: 'Cangioli Che',
    role:   'Executive Director · Khyentse Foundation',
  },
  related: [
    { year: '2024', title: 'Mhairi McFarlane',     tag: 'Author site' },
    { year: '2023', title: 'Plain Sitemap',         tag: 'Open-source plugin' },
  ],
};

// Mock screenshot placeholder — a typographic stand-in until real imagery arrives.
const ScreenPlaceholder = ({ w, h, label, tone = 'paper' }) => {
  const bg = tone === 'paper' ? 'var(--paper-deep)' : 'var(--ink)';
  const fg = tone === 'paper' ? 'var(--pencil)' : 'rgba(245,240,232,0.55)';
  return (
    <div style={{
      width: w, height: h, background: bg, color: fg, position: 'relative',
      fontFamily: 'var(--font-mono-2)', fontSize: 12, letterSpacing: '0.04em',
      textTransform: 'uppercase', display: 'flex', alignItems: 'center',
      justifyContent: 'center', border: '1px solid var(--rule)', boxSizing: 'border-box',
    }}>
      <span style={{ position: 'absolute', top: 8, left: 10 }}>┌</span>
      <span style={{ position: 'absolute', top: 8, right: 10 }}>┐</span>
      <span style={{ position: 'absolute', bottom: 8, left: 10 }}>└</span>
      <span style={{ position: 'absolute', bottom: 8, right: 10 }}>┘</span>
      [ {label} ]
    </div>
  );
};

// Sticky-style site header, mocked at canvas resolution (no JS interactivity
// needed for a static screen — just a faithful chrome layer).
const SiteHeaderMock = ({ active = 'Work' }) => (
  <header style={{
    background: 'var(--paper)', borderBottom: '1px solid var(--rule)',
    display: 'flex', alignItems: 'center', justifyContent: 'space-between',
    padding: '14px 48px', fontFamily: 'var(--font-mono)',
  }}>
    <div style={{ display: 'flex', alignItems: 'center', gap: 12 }}>
      <div style={{
        width: 36, height: 36, background: 'var(--ink)', color: 'var(--paper)',
        display: 'flex', alignItems: 'center', justifyContent: 'center',
        fontWeight: 700, fontSize: 18, letterSpacing: '-0.04em',
      }}>Bd</div>
      <span style={{ fontWeight: 700, fontSize: 14, color: 'var(--ink)', letterSpacing: '-0.01em' }}>BAIN DESIGN</span>
    </div>
    <nav style={{ display: 'flex', alignItems: 'center', gap: 14, fontSize: 13 }}>
      {['Home', 'About', 'Services', 'Work', 'Nice Words', 'Contact'].map((item, i, arr) => (
        <React.Fragment key={item}>
          <span style={{
            color: 'var(--ink)',
            borderBottom: item === active ? '1px solid var(--ink)' : '1px solid transparent',
          }}>{item}</span>
          {i < arr.length - 1 && <span style={{ color: 'var(--pencil)' }}>/</span>}
        </React.Fragment>
      ))}
    </nav>
  </header>
);

const SiteFooterMock = () => (
  <footer style={{
    background: 'var(--ink)', color: 'var(--paper)', padding: '64px 48px',
    fontFamily: 'var(--font-mono)', borderTop: '1px solid var(--rule)',
  }}>
    <div style={{ display: 'grid', gridTemplateColumns: '1.4fr 1fr 1fr', gap: 48, alignItems: 'start' }}>
      <div>
        <div style={{ fontSize: 28, fontWeight: 700, letterSpacing: '-0.02em' }}>
          Friendly websites for interesting people<span style={{ color: 'var(--clay)' }}>.</span>
        </div>
        <div style={{ marginTop: 24, fontFamily: 'var(--font-mono-2)', fontSize: 13, color: 'rgba(245,240,232,0.55)' }}>
          [ Build with <span style={{ color: 'var(--clay)' }}>♥</span> · Barcelona · est. 2012 ]
        </div>
      </div>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, lineHeight: 1.9, color: 'rgba(245,240,232,0.85)' }}>
        <div style={{ color: 'rgba(245,240,232,0.45)', textTransform: 'uppercase', letterSpacing: '0.06em', marginBottom: 8 }}>Pages</div>
        <div>Home / About / Services</div>
        <div>Work / Nice Words / Contact</div>
      </div>
      <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: 13, lineHeight: 1.9, color: 'rgba(245,240,232,0.85)' }}>
        <div style={{ color: 'rgba(245,240,232,0.45)', textTransform: 'uppercase', letterSpacing: '0.06em', marginBottom: 8 }}>Contact</div>
        <div>mark@bain.design</div>
        <div>github.com/markcbain</div>
      </div>
    </div>
  </footer>
);

Object.assign(window, { PROJECT, ScreenPlaceholder, SiteHeaderMock, SiteFooterMock });
