// Shared bits for the Nice Words (testimonials) pages.
// Data + tiny helpers. Header/footer/screen placeholders are reused
// from single-project-shared.jsx.

const TESTIMONIALS = [
  {
    id: 'khyentse',
    num: '01',
    author: 'Cangioli Che',
    role: 'Executive Director',
    org:  'Khyentse Foundation',
    location: 'Berkeley, CA',
    year: 2024,
    project: 'Khyentse Foundation',
    projectSlug: 'khyentse-foundation',
    scope: ['Bespoke theme', 'Custom plugin', 'Bilingual CMS'],
    short: 'Mark turned eight years of grant-cycle institutional memory into a CMS our least technical board members can navigate.',
    full:
      "We came to Mark with eight years of accumulated grant-cycle institutional memory, mostly held in a spreadsheet, a shared inbox, and Cangioli's head. We needed a bilingual site, a way for board members to read what editors were writing, and a public archive that didn't fall over when the press picked up a particular grant. He turned all of that into a CMS our least technical board members can navigate, shipped a versioned plugin instead of a thousand-line functions.php, and trained the team in a single 45-minute call. The plugin still gets a feature request a quarter and nothing else.",
    tone: 'long',
    pinned: true,
  },
  {
    id: 'mhairi',
    num: '02',
    author: 'Mhairi McFarlane',
    role: 'Novelist',
    org:  'mhairimcfarlane.com',
    location: 'Nottingham, UK',
    year: 2024,
    project: 'Mhairi McFarlane — author site',
    projectSlug: 'mhairi-mcfarlane',
    scope: ['Bespoke theme', 'Editorial CMS', 'Newsletter'],
    short: "I told Mark I wanted a website that didn't look like every other author website. He sent back something that looks like a paperback.",
    full:
      "I told Mark I wanted a website that didn't look like every other author website — no parallax, no autoplaying book trailer, no carousel of jacket quotes. He sent back something that looks like a paperback you'd actually want to pick up. He also patiently rebuilt the back end so my publicist can add a tour date without phoning me, which was, in retrospect, the actual deliverable.",
    tone: 'medium',
    pinned: true,
  },
  {
    id: 'plain-sitemap',
    num: '03',
    author: 'Anika Beauchamp',
    role: 'Maintainer',
    org:  'Plain Sitemap (community)',
    location: 'Open source',
    year: 2023,
    project: 'Plain Sitemap',
    projectSlug: 'plain-sitemap',
    scope: ['Open-source plugin', 'Maintenance'],
    short: "Twelve lines of config. No admin UI. No tracking. It's the only WordPress plugin I've ever installed that I forget exists.",
    full:
      "Twelve lines of config in a PHP file. No admin UI. No newsletter modal. No tracking pixel. It's the only WordPress plugin I've ever installed that I forget exists, which is, you'll agree, the highest possible compliment.",
    tone: 'short',
    pinned: false,
  },
  {
    id: 'cobblestone',
    num: '04',
    author: 'Júlia Vidal',
    role: 'Founder',
    org:  'Cobblestone Coffee',
    location: 'Gràcia, Barcelona',
    year: 2023,
    project: 'Cobblestone Coffee',
    projectSlug: 'cobblestone',
    scope: ['Brand site', 'E-commerce', 'Local SEO'],
    short: 'I asked for a website. Mark built me a quiet little machine that sells beans while I sleep.',
    full:
      "I asked for a website. Mark built me a quiet little machine that sells beans to the people who want them and stays out of the way of the people who just want to know whether we're open on Sundays. He also got the address-finder working with the Catalan postal codes that two other developers had told me were impossible. We are open on Sundays.",
    tone: 'medium',
    pinned: false,
  },
  {
    id: 'reed-letters',
    num: '05',
    author: 'Dr. Henrietta Reed',
    role: 'Editor',
    org:  'The Reed Letters',
    location: 'Edinburgh, UK',
    year: 2022,
    project: 'The Reed Letters',
    projectSlug: 'reed-letters',
    scope: ['Bespoke theme', 'Newsletter', 'Long-form'],
    short: 'He has the rare gift of reading what you mean rather than what you said in the brief.',
    full:
      "He has the rare gift of reading what you mean rather than what you said in the brief. Twice he came back with a question that made me realise I'd been pointing at the wrong problem. The site is the better for it, and so is the editorial calendar he quietly rebuilt while he was in there.",
    tone: 'medium',
    pinned: false,
  },
  {
    id: 'allotment',
    num: '06',
    author: 'Tomás Field',
    role: 'Co-founder',
    org:  'The Allotment Co.',
    location: 'Bristol, UK',
    year: 2022,
    project: 'The Allotment Co.',
    projectSlug: 'allotment',
    scope: ['Brand site', 'Membership'],
    short: 'No drama, no surprise invoices, no calls that should have been an email.',
    full:
      "No drama. No surprise invoices. No calls that should have been an email. He missed one deadline by a single day, sent a one-line message explaining why, and then beat the next three. I've worked with twelve agencies and I have never written a sentence like that before.",
    tone: 'short',
    pinned: false,
  },
  {
    id: 'noon',
    num: '07',
    author: 'Eliana Park',
    role: 'Head of Product',
    org:  'Noon Health',
    location: 'Remote · NYC',
    year: 2021,
    project: 'Noon Health (marketing)',
    projectSlug: 'noon-health',
    scope: ['Marketing site', 'WP + Next.js'],
    short: "We hired Mark to build a brochure site. He noticed our staging environment was held together with hope and built us one of those too.",
    full:
      "We hired Mark for a six-week brochure site engagement. By week three he had noticed our staging environment was held together with hope and the kind word of a single DevOps consultant, and built us a proper one — for free, on his lunch break, because it was apparently bothering him. The brochure site is great. The staging environment is a small life-changing gift.",
    tone: 'medium',
    pinned: true,
  },
  {
    id: 'tasca',
    num: '08',
    author: 'Marc Puig',
    role: 'Owner',
    org:  "Tasca d'en Marc",
    location: 'Poble-sec, Barcelona',
    year: 2021,
    project: "Tasca d'en Marc",
    projectSlug: 'tasca',
    scope: ['One-pager', 'Bookings'],
    short: "Una web honesta, sense ensarronades. Funciona millor que la majoria de coses al meu restaurant.",
    full:
      "Una web honesta, sense ensarronades. La gent troba el telèfon a la primera, el menú s'actualitza en trenta segons, i ningú m'ha trucat per dir que no la sap fer servir. Funciona millor que la majoria de coses al meu restaurant.",
    tone: 'short',
    pinned: false,
  },
  {
    id: 'archive-trust',
    num: '09',
    author: 'Yusuf Aldridge',
    role: 'Trustee',
    org:  'The Westwall Archive Trust',
    location: 'Sheffield, UK',
    year: 2020,
    project: 'Westwall Archive',
    projectSlug: 'westwall',
    scope: ['Bespoke theme', 'Long-form', 'A11y'],
    short: 'A team of unpaid trustees can now publish a 9,000-word essay without phoning a single one of us.',
    full:
      "We are a small charity run by people who can do many things, none of which is WordPress. A team of unpaid trustees can now publish a 9,000-word essay, with images and footnotes, without phoning a single one of us. The site passes WCAG AA, which mattered to one trustee, and looks like it was made on a typewriter, which mattered to another.",
    tone: 'medium',
    pinned: false,
  },
  {
    id: 'studio-half',
    num: '10',
    author: 'Imo Hartley',
    role: 'Director',
    org:  'Studio Half',
    location: 'Margate, UK',
    year: 2020,
    project: 'Studio Half',
    projectSlug: 'studio-half',
    scope: ['Portfolio', 'Headless WP'],
    short: 'He pushed back on three of my worst ideas. I am very grateful for two of those.',
    full:
      "He pushed back on three of my worst ideas — politely, in a thoughtful email, with sketches. I am very grateful for two of those. The third I am still litigating, but the site shipped on time anyway.",
    tone: 'short',
    pinned: false,
  },
  {
    id: 'common-lot',
    num: '11',
    author: 'Sara Akhtar',
    role: 'Programme Lead',
    org:  'Common Lot',
    location: 'Manchester, UK',
    year: 2019,
    project: 'Common Lot',
    projectSlug: 'common-lot',
    scope: ['Bespoke theme', 'Volunteer CMS'],
    short: 'Five years on, the site is faster than the day it launched and we still know how to use it.',
    full:
      "Five years on, the site is faster than the day it launched, we have replaced two laptops and one programme manager, and we still know how to use it. We have referred Mark to six people. All six have come back to thank us.",
    tone: 'short',
    pinned: false,
  },
  {
    id: 'oldcastle',
    num: '12',
    author: 'Roisin Ó hAodha',
    role: 'Director',
    org:  'Oldcastle Press',
    location: 'Galway, IE',
    year: 2018,
    project: 'Oldcastle Press',
    projectSlug: 'oldcastle',
    scope: ['Brand site', 'Catalogue'],
    short: 'A small press website that reads like one of our books rather than like an estate agent.',
    full:
      "A small press website that reads, finally, like one of our books rather than like an estate agent. Catalogue importer included, which has saved us roughly a working week per release for the last six years.",
    tone: 'short',
    pinned: false,
  },
];

// Available filter chips (terminal-flavoured)
const TESTIMONIAL_FILTERS = {
  service: ['Bespoke theme', 'Custom plugin', 'E-commerce', 'Membership', 'Newsletter', 'A11y'],
  year:    ['2024', '2023', '2022', '2021', '2020', 'earlier'],
  size:    ['Solo / freelancer', 'Small business', 'Non-profit', 'Start-up'],
};

// Counters strip
const NICE_NUMBERS = [
  { n: '47',  label: 'Projects shipped',  sub: 'since 2012' },
  { n: '24',  label: 'Nice words logged', sub: 'this page' },
  { n: '14',  label: 'Repeat clients',    sub: '60% retention' },
  { n: '6',   label: 'Referrals returned',sub: 'thanks Common Lot' },
];

// ───────────────────────────────────────────────────────
// Helpers
// ───────────────────────────────────────────────────────

// Inline name → initials avatar tile. Square, monospaced, ink-on-paper.
const InitialsAvatar = ({ name, size = 56, tone = 'ink' }) => {
  const initials = name.split(/\s+/).map(p => p[0]).filter(Boolean).slice(0, 2).join('').toUpperCase();
  const bg = tone === 'ink' ? 'var(--ink)' : 'var(--paper-deep)';
  const fg = tone === 'ink' ? 'var(--paper)' : 'var(--ink)';
  return (
    <div style={{
      width: size, height: size, background: bg, color: fg,
      display: 'flex', alignItems: 'center', justifyContent: 'center',
      fontFamily: 'var(--font-mono)', fontWeight: 700,
      fontSize: Math.round(size * 0.36), letterSpacing: '-0.02em',
      border: tone === 'ink' ? 'none' : '1px solid var(--rule)',
      flexShrink: 0,
    }}>{initials}</div>
  );
};

// Compact bracketed metadata line, used in headers and meta rows.
const BracketMeta = ({ children, color = 'var(--pencil)' }) => (
  <div style={{
    fontFamily: 'var(--font-mono-2)', fontSize: 13, color,
    textTransform: 'uppercase', letterSpacing: '0.08em',
    whiteSpace: 'nowrap',
  }}>[ {children} ]</div>
);

// Filter chip — pressable, terminal-flavoured.
const FilterChip = ({ children, active = false, onClick }) => (
  <button type="button" onClick={onClick} style={{
    fontFamily: 'var(--font-mono-2)', fontSize: 13,
    padding: '6px 12px',
    border: '1px solid var(--rule)',
    background: active ? 'var(--ink)' : 'var(--paper-pure)',
    color: active ? 'var(--paper)' : 'var(--ink)',
    cursor: 'pointer', letterSpacing: '0.02em',
    whiteSpace: 'nowrap',
  }}>
    {active && <span style={{ marginRight: 6 }}>✔</span>}{children}
  </button>
);

Object.assign(window, {
  TESTIMONIALS, TESTIMONIAL_FILTERS, NICE_NUMBERS,
  InitialsAvatar, BracketMeta, FilterChip,
});
