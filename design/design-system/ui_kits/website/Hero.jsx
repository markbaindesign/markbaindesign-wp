// Bain Design — Hero
// Single terminal caret traces the WHOLE headline, including the static
// connector text. Cycling slots get random typos, false-starts, and a
// random number of re-edits per visit.

const ADJ  = ['Friendly', 'Stunning', 'Quirky', 'Fun', 'Honest', 'Bespoke', 'Tasteful'];
const QUAL = ['interesting', 'creative', 'artistic', 'curious', 'thoughtful', 'ambitious'];
const NOUN = ['people', 'artists', 'writers', 'entrepreneurs', 'start-ups', 'businesses', 'firms', 'founders'];

const longest = (a) => a.reduce((x, y) => (y.length > x.length ? y : x), '');
const ADJ_MAX = longest(ADJ), QUAL_MAX = longest(QUAL), NOUN_MAX = longest(NOUN);

const rand = (n) => Math.floor(Math.random() * n);
const pick = (arr) => arr[rand(arr.length)];
const NEIGHBORS = {
  a:'sq', b:'vn', c:'xv', d:'sf', e:'wr', f:'dg', g:'fh', h:'gj', i:'uo', j:'hk',
  k:'jl', l:'k', m:'n', n:'mb', o:'ip', p:'o', q:'wa', r:'et', s:'ad', t:'ry',
  u:'yi', v:'cb', w:'qe', x:'zc', y:'tu', z:'x',
};
function typoChar(c) {
  const lo = c.toLowerCase();
  const ns = NEIGHBORS[lo];
  if (!ns) return c;
  const t = pick(ns.split(''));
  return c === lo ? t : t.toUpperCase();
}

function planEdit(current, allWords, currentIdx) {
  const steps = [];
  for (let i = 0; i < current.length; i++) steps.push({ kind: 'del' });

  if (Math.random() < 0.30) {
    const otherIdx = (currentIdx + 1 + rand(allWords.length - 1)) % allWords.length;
    const other = allWords[otherIdx];
    const prefixLen = 1 + rand(Math.min(other.length - 1, 4));
    for (let i = 0; i < prefixLen; i++) steps.push({ kind: 'type', ch: other[i] });
    steps.push({ kind: 'pause', ms: 220 });
    for (let i = 0; i < prefixLen; i++) steps.push({ kind: 'del' });
  }

  let nextIdx = currentIdx;
  if (allWords.length > 1) while (nextIdx === currentIdx) nextIdx = rand(allWords.length);
  const target = allWords[nextIdx];

  const willTypo = Math.random() < 0.45 && target.length >= 4;
  const typoAt = willTypo ? 1 + rand(target.length - 2) : -1;
  for (let i = 0; i < target.length; i++) {
    if (i === typoAt) {
      steps.push({ kind: 'type', ch: typoChar(target[i]) });
      steps.push({ kind: 'pause', ms: 200 });
      steps.push({ kind: 'del' });
      steps.push({ kind: 'type', ch: target[i] });
    } else {
      steps.push({ kind: 'type', ch: target[i] });
    }
  }
  return { steps, nextIdx };
}

const slotChrome = {
  display: 'inline-grid', fontWeight: 700,
  color: 'var(--clay-deep)', background: 'transparent',
  padding: '0 2px',
  whiteSpace: 'pre', position: 'relative',
};
const wordHighlight = {
  position: 'absolute', inset: 0,
  background: 'rgba(201, 100, 66, 0.12)', pointerEvents: 'none',
};
const Slot = React.forwardRef(({ children, reserve }, ref) => (
  <span style={slotChrome}>
    {reserve && <span style={{ gridArea: '1/1', visibility: 'hidden' }} aria-hidden="true">{reserve}</span>}
    <span style={{ gridArea: '1/1', position: 'relative', display: 'inline-block' }}>
      <span style={wordHighlight} aria-hidden="true" />
      <span ref={ref} style={{ position: 'relative' }}>{children}</span>
    </span>
  </span>
));

const Hero = () => {
  const slotsDef = React.useRef([{ words: ADJ }, { words: QUAL }, { words: NOUN }]).current;
  const [text, setText] = React.useState(slotsDef.map(s => s.words[0]));
  const idxRef = React.useRef([0, 0, 0]);
  const [active, setActive] = React.useState(0);
  // 'hold' (admire), 'editing' (mid-plan), 'transit' (caret moves to next slot)
  const [phase, setPhase] = React.useState('hold');
  const [tick, setTick] = React.useState(0); // bump to advance editing safely
  const planRef = React.useRef(null);

  // Driver
  React.useEffect(() => {
    let t;
    if (phase === 'hold') {
      t = setTimeout(() => {
        const r = Math.random();
        const reEdits = r < 0.65 ? 1 : r < 0.92 ? 2 : 3;
        planRef.current = { reEdits, doneEdits: 0, steps: [], ptr: 0, lastIdx: idxRef.current[active], finalIdx: idxRef.current[active] };
        setPhase('editing');
        setTick(x => x + 1);
      }, 900 + rand(600));
    } else if (phase === 'editing') {
      const plan = planRef.current;
      // Need a new sub-plan?
      if (plan.ptr >= plan.steps.length) {
        if (plan.doneEdits >= plan.reEdits) {
          // done with all edits — admire briefly, then transit
          idxRef.current = idxRef.current.map((v, i) => i === active ? plan.finalIdx : v);
          t = setTimeout(() => setPhase('transit'), 600 + rand(500));
          return () => clearTimeout(t);
        }
        const cur = text[active];
        const { steps, nextIdx } = planEdit(cur, slotsDef[active].words, plan.lastIdx);
        plan.steps = steps; plan.ptr = 0;
        plan.lastIdx = nextIdx; plan.finalIdx = nextIdx;
        plan.doneEdits++;
      }
      const step = plan.steps[plan.ptr];
      const dur = step.kind === 'pause' ? step.ms
                : step.kind === 'del'   ? 32 + rand(28)
                : 50 + rand(85);
      t = setTimeout(() => {
        if (step.kind === 'type') setText(p => p.map((v, i) => i === active ? v + step.ch : v));
        else if (step.kind === 'del') setText(p => p.map((v, i) => i === active ? v.slice(0, -1) : v));
        plan.ptr++;
        setTick(x => x + 1); // safe re-trigger
      }, dur);
    } else if (phase === 'transit') {
      // handled by transit effect below — nothing to do here.
    }
    return () => clearTimeout(t);
  }, [phase, tick, active, slotsDef]); // text intentionally excluded — we read latest via setter

  // --- caret measurement ---
  const headlineRef = React.useRef(null);
  const slotRefs = [React.useRef(null), React.useRef(null), React.useRef(null)];
  const [caret, setCaret] = React.useState({ left: 0, top: 0, height: 0, opacity: 0, animate: false });
  // override caret position during line-by-line transit
  const [transitOverride, setTransitOverride] = React.useState(null);

  const measureSlot = React.useCallback((slotIdx, animate) => {
    const el = slotRefs[slotIdx].current;
    const host = headlineRef.current;
    if (!el || !host) return;
    const hostRect = host.getBoundingClientRect();
    let left, top, height;
    if (el.firstChild && el.firstChild.nodeType === 3 && el.firstChild.length > 0) {
      const range = document.createRange();
      range.setStart(el.firstChild, el.firstChild.length - 1);
      range.setEnd(el.firstChild, el.firstChild.length);
      const rects = range.getClientRects();
      const r = rects[rects.length - 1];
      if (!r) return;
      left = r.right - hostRect.left;
      top = r.top - hostRect.top;
      height = r.height;
    } else {
      const r = el.getBoundingClientRect();
      left = r.left - hostRect.left; top = r.top - hostRect.top;
      height = r.height || parseFloat(getComputedStyle(el).fontSize) * 1.1;
    }
    setCaret({ left, top, height, opacity: 1, animate });
  }, []);

  React.useLayoutEffect(() => {
    if (phase !== 'transit') {
      measureSlot(active, false);
    }
  }, [text, active, phase, tick, measureSlot]);

  // Transit: snap caret line by line from current slot end -> next slot start.
  // Caret only moves vertically (stays at fixed x within each step's line),
  // pausing at each line.
  React.useEffect(() => {
    if (phase !== 'transit') { setTransitOverride(null); return; }
    const fromEl = slotRefs[active].current;
    const nextIdx = (active + 1) % slotsDef.length;
    const toEl = slotRefs[nextIdx].current;
    const host = headlineRef.current;
    if (!fromEl || !toEl || !host) return;

    const hostRect = host.getBoundingClientRect();
    const lineH = parseFloat(getComputedStyle(host).lineHeight) || 1.25 * parseFloat(getComputedStyle(host).fontSize);

    // current caret position (end of current slot's text)
    const fromRect = (() => {
      if (fromEl.firstChild && fromEl.firstChild.nodeType === 3 && fromEl.firstChild.length > 0) {
        const range = document.createRange();
        range.setStart(fromEl.firstChild, fromEl.firstChild.length - 1);
        range.setEnd(fromEl.firstChild, fromEl.firstChild.length);
        const rs = range.getClientRects();
        const r = rs[rs.length - 1];
        return r ? { left: r.right - hostRect.left, top: r.top - hostRect.top, height: r.height } : null;
      }
      const r = fromEl.getBoundingClientRect();
      return { left: r.left - hostRect.left, top: r.top - hostRect.top, height: r.height };
    })();

    // target: start of next slot's first char
    const toRect = (() => {
      if (toEl.firstChild && toEl.firstChild.nodeType === 3 && toEl.firstChild.length > 0) {
        const range = document.createRange();
        range.setStart(toEl.firstChild, 0);
        range.setEnd(toEl.firstChild, 1);
        const rs = range.getClientRects();
        const r = rs[0];
        return r ? { left: r.left - hostRect.left, top: r.top - hostRect.top, height: r.height } : null;
      }
      const r = toEl.getBoundingClientRect();
      return { left: r.left - hostRect.left, top: r.top - hostRect.top, height: r.height };
    })();

    if (!fromRect || !toRect) return;

    // build vertical step path: same line -> next line(s) -> destination
    const steps = [];
    const fromLine = Math.round(fromRect.top / lineH);
    const toLine   = Math.round(toRect.top / lineH);

    if (fromLine === toLine) {
      // same line — no vertical hop, just go straight to destination after a pause
      steps.push({ left: toRect.left, top: toRect.top, height: toRect.height });
    } else {
      // step down (or up) one line at a time, keeping x at the START of the
      // headline (left edge) — caret only moves directly up/down.
      const step = fromLine < toLine ? 1 : -1;
      for (let line = fromLine + step; line !== toLine; line += step) {
        steps.push({ left: 0, top: line * lineH, height: fromRect.height });
      }
      // final position: start of destination slot
      steps.push({ left: toRect.left, top: toRect.top, height: toRect.height });
    }

    let cancelled = false;
    let i = 0;
    const PAUSE = 280; // ms per line

    const advance = () => {
      if (cancelled) return;
      if (i >= steps.length) {
        setActive(nextIdx);
        setPhase('hold');
        return;
      }
      setTransitOverride({ ...steps[i], opacity: 1 });
      i++;
      setTimeout(advance, PAUSE);
    };
    // initial pause before first hop
    setTimeout(advance, PAUSE);

    return () => { cancelled = true; };
  }, [phase, active, slotsDef.length]);

  React.useEffect(() => {
    const onResize = () => measureSlot(active, false);
    window.addEventListener('resize', onResize);
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(() => measureSlot(active, false));
    return () => window.removeEventListener('resize', onResize);
  }, [measureSlot, active]);

  return (
    <section style={{ padding: '96px 32px 64px', maxWidth: 1100, margin: '0 auto' }}>
      <h1 ref={headlineRef} style={{
        position: 'relative',
        fontFamily: 'var(--font-mono)', fontWeight: 700,
        fontSize: 'clamp(40px, 6vw, 72px)', lineHeight: 1.25,
        letterSpacing: '-0.03em', color: 'var(--ink)', margin: 0, maxWidth: '16ch',
      }}>
        <Slot ref={slotRefs[0]} reserve={ADJ_MAX}>{text[0]}</Slot>
        {' '}
        <span style={{
          fontWeight: 700, color: 'var(--clay-deep)',
          background: 'rgba(201, 100, 66, 0.12)',
          padding: '0 2px',
          whiteSpace: 'pre',
        }}>websites for</span>
        {' '}
        <Slot ref={slotRefs[1]} reserve={QUAL_MAX}>{text[1]}</Slot>
        {'\u00a0'}
        <Slot ref={slotRefs[2]} reserve={NOUN_MAX}>{text[2]}</Slot>

        {(() => {
          const c = transitOverride || caret;
          return (
            <span aria-hidden="true" style={{
              position: 'absolute', left: 0, top: 0,
              width: '0.55ch', height: c.height || '1em',
              background: 'var(--clay)',
              transform: `translate(${c.left}px, ${c.top}px)`,
              opacity: c.opacity ?? 1,
              transition: 'none', // snap — no diagonal animation
              animation: phase === 'hold' ? 'bain-caret-blink 1.06s steps(2) infinite' : 'none',
              pointerEvents: 'none', zIndex: 2,
            }} />
          );
        })()}
      </h1>

      <p style={{
        fontFamily: 'var(--font-mono)', fontSize: 18, lineHeight: 1.55,
        color: 'var(--graphite)', marginTop: 32, maxWidth: '52ch',
      }}>
        I design &amp; build <strong style={{ color: 'var(--ink)' }}>bespoke websites</strong> for
        <strong style={{ color: 'var(--ink)' }}> individuals</strong>,
        <strong style={{ color: 'var(--ink)' }}> small businesses</strong> &amp;
        <strong style={{ color: 'var(--ink)' }}> start-ups</strong>.
      </p>

      <div style={{ display: 'flex', gap: 14, marginTop: 36, flexWrap: 'wrap' }}>
        <button style={{
          background: 'var(--ink)', color: 'var(--paper)', border: '1px solid var(--ink)',
          padding: '14px 22px', fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 14,
          cursor: 'pointer',
        }}>Arrange a chat now</button>
        <button style={{
          background: 'transparent', color: 'var(--ink)', border: '1px solid var(--ink)',
          padding: '14px 22px', fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: 14,
          cursor: 'pointer',
        }}>Check out my work →</button>
      </div>

      <style>{`
        @keyframes bain-caret-blink {
          0%, 50% { opacity: 1; }
          50.01%, 100% { opacity: 0; }
        }
      `}</style>
    </section>
  );
};

window.Hero = Hero;
