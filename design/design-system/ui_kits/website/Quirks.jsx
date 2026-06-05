// Bain Design — Quirks
// Hover tooltips, easter eggs, surprises. Self-contained: exports
// helper components + hooks to window. Other files opt in.

// ---------- Tooltip ----------
// Terminal-style tooltip that follows the cursor. Place a parent with
// position: relative and use <Tip text="..."> as the wrapper to attach
// a tooltip to its children. Fades in after 120ms, jitter rotation.

const Tip = ({ text, children, side = 'top', sticky = false }) => {
  const [show, setShow] = React.useState(false);
  const [pos, setPos] = React.useState({ x: 0, y: 0 });
  const [rot, setRot] = React.useState(0);
  const ref = React.useRef(null);

  const onEnter = (e) => {
    setRot((Math.random() - 0.5) * 3); // slight tilt
    setShow(true);
    onMove(e);
  };
  const onMove = (e) => {
    if (!ref.current) return;
    const r = ref.current.getBoundingClientRect();
    setPos({ x: e.clientX - r.left, y: e.clientY - r.top });
  };
  const onLeave = () => setShow(false);

  return (
    <span ref={ref} style={{ position: 'relative', display: 'inline-block' }}
      onMouseEnter={onEnter} onMouseMove={onMove} onMouseLeave={onLeave}>
      {children}
      {show && (
        <span aria-hidden="true" style={{
          position: 'absolute',
          left: pos.x + 14, top: pos.y - 36,
          transform: `rotate(${rot}deg)`,
          background: 'var(--ink)', color: 'var(--paper)',
          fontFamily: 'var(--font-mono-2)', fontSize: 11, lineHeight: 1.3,
          padding: '6px 8px',
          whiteSpace: 'nowrap',
          pointerEvents: 'none',
          zIndex: 50,
          boxShadow: '2px 2px 0 var(--clay)',
        }}>
          <span style={{ color: 'var(--clay)' }}>$ </span>{text}
        </span>
      )}
    </span>
  );
};

// ---------- Toast ----------
// Singleton toast queue posted via window.bdToast(msg).
const ToastHost = () => {
  const [toasts, setToasts] = React.useState([]);
  React.useEffect(() => {
    window.bdToast = (msg) => {
      const id = Math.random();
      setToasts(t => [...t, { id, msg }]);
      setTimeout(() => setToasts(t => t.filter(x => x.id !== id)), 2400);
    };
  }, []);
  return (
    <div style={{
      position: 'fixed', bottom: 24, right: 24, zIndex: 1000,
      display: 'flex', flexDirection: 'column', gap: 8,
      pointerEvents: 'none',
    }}>
      {toasts.map(t => (
        <div key={t.id} style={{
          background: 'var(--ink)', color: 'var(--paper)',
          fontFamily: 'var(--font-mono)', fontSize: 13, fontWeight: 600,
          padding: '10px 14px',
          boxShadow: '4px 4px 0 var(--clay)',
          animation: 'bd-toast-in 280ms cubic-bezier(.2,.9,.3,1.2)',
        }}>
          <span style={{ color: 'var(--clay)', marginRight: 6 }}>›</span>{t.msg}
        </div>
      ))}
      <style>{`
        @keyframes bd-toast-in {
          from { transform: translateY(20px); opacity: 0; }
          to   { transform: translateY(0);    opacity: 1; }
        }
      `}</style>
    </div>
  );
};

// ---------- Konami / type-to-trigger ----------
// Type any of the trigger words anywhere on the page → fire a surprise.
const TYPE_TRIGGERS = {
  'hello':   () => window.bdToast?.('hi back ✋'),
  'hi':      () => window.bdToast?.('oh hey'),
  'mark':    () => window.bdToast?.('that\'s me'),
  'coffee':  () => window.bdToast?.('☕ refilled'),
  'wow':     () => window.bdToast?.('thanks, I try'),
  'why':     () => window.bdToast?.('why not?'),
  'rosebud': () => document.body.classList.toggle('bd-invert'),
};

const useTypeTriggers = () => {
  React.useEffect(() => {
    let buf = '';
    const onKey = (e) => {
      // ignore typing in inputs
      const t = e.target;
      if (t && (t.tagName === 'INPUT' || t.tagName === 'TEXTAREA' || t.isContentEditable)) return;
      if (e.key.length === 1) {
        buf = (buf + e.key.toLowerCase()).slice(-24);
        for (const [trigger, fn] of Object.entries(TYPE_TRIGGERS)) {
          if (buf.endsWith(trigger)) { fn(); buf = ''; return; }
        }
      }
    };
    window.addEventListener('keydown', onKey);
    return () => window.removeEventListener('keydown', onKey);
  }, []);
};

// ---------- Cursor breadcrumb dot ----------
// Tiny clay dot that fades in your wake. Subtle.
const CursorTrail = () => {
  React.useEffect(() => {
    const dots = [];
    const max = 8;
    let last = { x: 0, y: 0, t: 0 };
    const onMove = (e) => {
      const now = performance.now();
      // throttle by distance + time
      const dx = e.clientX - last.x, dy = e.clientY - last.y;
      if (dx*dx + dy*dy < 1400 || now - last.t < 60) return;
      last = { x: e.clientX, y: e.clientY, t: now };
      const dot = document.createElement('div');
      dot.style.cssText = `
        position: fixed; left: ${e.clientX-3}px; top: ${e.clientY-3}px;
        width: 6px; height: 6px; background: var(--clay);
        pointer-events: none; z-index: 999;
        opacity: 0.7;
        transition: opacity 600ms ease, transform 600ms ease;
      `;
      document.body.appendChild(dot);
      dots.push(dot);
      requestAnimationFrame(() => {
        dot.style.opacity = '0';
        dot.style.transform = 'scale(0.3)';
      });
      setTimeout(() => dot.remove(), 700);
      while (dots.length > max) dots.shift().remove();
    };
    window.addEventListener('mousemove', onMove);
    return () => window.removeEventListener('mousemove', onMove);
  }, []);
  return null;
};

// ---------- Console banner ----------
const useConsoleBanner = () => {
  React.useEffect(() => {
    const css = 'font-family: monospace; color: #C96442; font-weight: bold;';
    console.log('%c\n  ┌─────────────┐\n  │  Bd hello!  │\n  └─────────────┘\n  type "rosebud" :)\n', css);
  }, []);
};

// ---------- Quirks host ----------
// Drop <Quirks /> at the root to install all global behaviors.
const Quirks = () => {
  useTypeTriggers();
  useConsoleBanner();
  return (
    <React.Fragment>
      <ToastHost />
      <CursorTrail />
      <style>{`
        body.bd-invert { filter: invert(1) hue-rotate(180deg); transition: filter 400ms; }
      `}</style>
    </React.Fragment>
  );
};

window.Tip = Tip;
window.Quirks = Quirks;
