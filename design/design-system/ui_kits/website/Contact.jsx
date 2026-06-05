// Bain Design — Contact / footer
// Quirks: email click copies to clipboard + toast; footer heart beats on hover;
// "Build with" cycles synonyms on click.
const Contact = () => {
  const [copied, setCopied] = React.useState(false);
  const onEmailClick = (e) => {
    // Don't suppress mailto on cmd-click; only the toast is the bonus.
    navigator.clipboard?.writeText('hello@bain.design').then(() => {
      setCopied(true);
      window.bdToast?.('email copied — also opens your client');
      setTimeout(() => setCopied(false), 1600);
    });
  };
  return (
    <section style={{ padding: '64px 32px', maxWidth: 1100, margin: '0 auto', borderTop: '1px solid var(--rule)' }}>
      <h2 style={{
        fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 36,
        letterSpacing: '-0.02em', color: 'var(--ink)', margin: '0 0 16px',
      }}>
        <span style={{ color: 'var(--pencil)', fontWeight: 400, marginRight: 12 }}>03 /</span>
        Get in touch
      </h2>
      <p style={{
        fontFamily: 'var(--font-mono)', fontSize: 18, lineHeight: 1.55,
        color: 'var(--graphite)', maxWidth: '54ch',
      }}>
        If you're keen to find out more, there are lots of ways to get in touch — but why not start with an email?
      </p>
      <Tip text="click to copy + open">
        <a href="mailto:hello@bain.design" onClick={onEmailClick} style={{
          display: 'inline-block', marginTop: 16, fontFamily: 'var(--font-mono)',
          fontSize: 22, fontWeight: 700,
          textDecorationStyle: 'wavy', textDecorationColor: 'var(--clay)',
        }}>{copied ? '✓ copied — also opening' : 'hello@bain.design →'}</a>
      </Tip>
    </section>
  );
};

const VERBS = ['Build', 'Built', 'Brewed', 'Bashed', 'Baked'];

const Footer = () => {
  const [verbIdx, setVerbIdx] = React.useState(0);
  const [beating, setBeating] = React.useState(false);
  return (
    <footer style={{
      borderTop: '1px solid var(--rule)', padding: '32px',
      display: 'flex', justifyContent: 'space-between', alignItems: 'center',
      fontFamily: 'var(--font-mono-2)', fontSize: 12, color: 'var(--graphite)',
      flexWrap: 'wrap', gap: 16,
    }}>
      <div>
        © 2026 Bain Design —{' '}
        <span onClick={() => setVerbIdx(i => (i + 1) % VERBS.length)}
          style={{ cursor: 'pointer', borderBottom: '1px dashed var(--graphite)' }}>{VERBS[verbIdx]} with</span>{' '}
        <span
          onMouseEnter={() => setBeating(true)} onMouseLeave={() => setBeating(false)}
          style={{
            color: 'var(--clay)', display: 'inline-block',
            animation: beating ? 'bd-heart 600ms ease-in-out infinite' : 'none',
          }}>♥</span>
      </div>
      <nav style={{ display: 'flex', gap: 14 }}>
        {['WordPress', 'GitHub', 'Twitter', 'RSS'].map((item, i, arr) => (
          <React.Fragment key={item}>
            <a href="#">{item}</a>
            {i < arr.length - 1 && <span style={{ color: 'var(--pencil)' }}>/</span>}
          </React.Fragment>
        ))}
      </nav>
      <style>{`
        @keyframes bd-heart {
          0%, 100% { transform: scale(1); }
          25%      { transform: scale(1.35); }
          50%      { transform: scale(1); }
          75%      { transform: scale(1.2); }
        }
      `}</style>
    </footer>
  );
};

window.Contact = Contact;
window.Footer = Footer;
