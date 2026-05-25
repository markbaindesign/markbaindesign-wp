// Social banners — X, GitHub, Facebook, YouTube
// 3 variations per platform: A Terminal, B Blueprint, C Stats split.
// Each banner is the platform's exact upload size; the design canvas
// scales them for review and lets you export PNG/HTML per artboard.

// ---- shared bits ----
const BdMark = ({ size = 28 }) => (
  <div style={{
    width: size, height: size, background: 'var(--ink)', color: 'var(--paper)',
    display: 'inline-flex', alignItems: 'center', justifyContent: 'center',
    fontFamily: 'var(--font-mono)', fontWeight: 700, fontSize: size * 0.5,
    letterSpacing: '-0.04em', flexShrink: 0,
  }}>Bd</div>
);

const BannerFontStyles = () => (
  <style>{`
    @keyframes ba-blink { 50% { opacity: 0; } }
    .ba-cursor { display: inline-block; width: 0.55ch; height: 0.95em;
      vertical-align: -0.1em; background: var(--clay);
      animation: ba-blink 1.06s steps(2) infinite; margin-left: 4px; }
  `}</style>
);

// Scale recipe: every dimension scales off the banner's height so the same
// component renders consistently from a 315-tall Facebook cover to a
// 1440-tall YouTube banner. Pass `h` and we derive padding, type sizes,
// chrome heights from it.
const scale = (h, n) => Math.round(h * n);

// ---------- A · Terminal session ----------
// Dark, full-bleed mock terminal. $ prompt, blinking cursor, mac chrome.
// When `safe` is provided (YouTube), the entire terminal — chrome + content —
// is letterboxed inside the safe rect, and every dimension scales off the
// safe rect's height so the headline still fits. Bleed area stays solid ink.
const BannerTerminal = ({ w, h, safe }) => {
  const innerW = safe?.w ?? w;
  const innerH = safe?.h ?? h;
  const innerX = safe?.x ?? 0;
  const innerY = safe?.y ?? 0;
  const s = (n) => scale(innerH, n);
  const pad = s(0.10);
  const titleSize = s(0.14);
  const chromeH = s(0.07);
  return (
    <div style={{
      width: w, height: h, background: 'var(--ink)', color: 'var(--paper)',
      fontFamily: 'var(--font-mono)', position: 'relative', overflow: 'hidden',
      boxSizing: 'border-box',
    }}>
      <BannerFontStyles />
      <div style={{
        position: 'absolute', left: innerX, top: innerY, width: innerW, height: innerH,
        overflow: 'hidden', boxSizing: 'border-box',
      }}>
        {/* terminal chrome */}
        <div style={{
          position: 'absolute', top: 0, left: 0, right: 0, height: chromeH,
          background: 'rgba(245,240,232,0.08)', borderBottom: '1px solid rgba(245,240,232,0.12)',
          display: 'flex', alignItems: 'center', padding: `0 ${s(0.035)}px`, gap: s(0.015),
          fontFamily: 'var(--font-mono-2)', fontSize: s(0.028), color: 'rgba(245,240,232,0.55)',
        }}>
          <span style={{ width: s(0.02), height: s(0.02), borderRadius: '50%', background: '#FF5F57' }} />
          <span style={{ width: s(0.02), height: s(0.02), borderRadius: '50%', background: '#FEBC2E' }} />
          <span style={{ width: s(0.02), height: s(0.02), borderRadius: '50%', background: '#28C840' }} />
          <span style={{ marginLeft: s(0.035) }}>~/bain.design — zsh — {Math.round(innerW / 12)}×{Math.round(innerH / 24)}</span>
        </div>

        {/* content */}
        <div style={{
          position: 'absolute',
          left: pad, top: chromeH + pad * 0.4,
          right: pad, bottom: pad * 0.6,
          display: 'flex', flexDirection: 'column',
        }}>
          <div style={{ fontSize: s(0.035), color: 'rgba(245,240,232,0.55)', fontFamily: 'var(--font-mono-2)' }}>
            Last login: Wed May 06 09:14:22 on ttys001
          </div>
          <div style={{ marginTop: s(0.015), fontSize: s(0.045) }}>
            <span style={{ color: 'var(--clay)' }}>~ </span>
            <span style={{ color: 'rgba(245,240,232,0.65)' }}>$ </span>
            <span>cat about.txt</span>
          </div>

          <div style={{
            marginTop: s(0.06),
            fontSize: titleSize,
            fontWeight: 700, letterSpacing: '-0.03em', lineHeight: 1.08,
          }}>
            Friendly websites
            <br />for interesting <span style={{ color: 'var(--clay)' }}>people<span className="ba-cursor" /></span>
          </div>

          <div style={{ marginTop: 'auto', display: 'flex', alignItems: 'center', gap: s(0.025) }}>
            <BdMark size={s(0.08)} />
            <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: s(0.03), color: 'rgba(245,240,232,0.7)' }}>
              bain.design · Mark Bain
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

// ---------- B · Blueprint ----------
// When `safe` is provided, everything (grid bg, type, corner ticks) is
// scoped to the safe rect and sized off its height. Bleed area is solid
// paper without a grid so the crop is obvious during review.
const BannerBlueprint = ({ w, h, safe }) => {
  const innerW = safe?.w ?? w;
  const innerH = safe?.h ?? h;
  const innerX = safe?.x ?? 0;
  const innerY = safe?.y ?? 0;
  const s = (n) => scale(innerH, n);
  const pad = s(0.12);
  const titleSize = s(0.17);
  const gridStep = s(0.10);
  return (
    <div style={{
      width: w, height: h, background: 'var(--paper)', color: 'var(--ink)',
      fontFamily: 'var(--font-mono)', position: 'relative', overflow: 'hidden',
      boxSizing: 'border-box',
    }}>
      <BannerFontStyles />
      <div style={{
        position: 'absolute', left: innerX, top: innerY, width: innerW, height: innerH,
        overflow: 'hidden', boxSizing: 'border-box',
        backgroundImage: `linear-gradient(transparent ${gridStep - 1}px, rgba(28,26,23,0.06) ${gridStep}px),
                          linear-gradient(90deg, transparent ${gridStep - 1}px, rgba(28,26,23,0.06) ${gridStep}px)`,
        backgroundSize: `${gridStep}px ${gridStep}px`,
      }}>
        <div style={{
          position: 'absolute',
          left: pad, top: pad, right: pad, bottom: pad,
          display: 'flex', flexDirection: 'column', justifyContent: 'center',
        }}>
          <div style={{ display: 'flex', alignItems: 'baseline', gap: s(0.035), fontFamily: 'var(--font-mono-2)', fontSize: s(0.032), color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.06em' }}>
            <span>~/bain.design/</span><span style={{ color: 'var(--clay)' }}>v.2026</span>
          </div>

          <div style={{ marginTop: s(0.04), fontSize: titleSize, fontWeight: 700, letterSpacing: '-0.03em', lineHeight: 1.05, color: 'var(--ink)' }}>
            <span style={{ color: 'var(--pencil)' }}>[</span> Friendly <span style={{ color: 'var(--pencil)' }}>]</span> websites
            <br />for <span style={{
              color: 'var(--clay-deep)', background: 'rgba(201, 100, 66, 0.12)', padding: '0 0.18ch',
            }}>interesting</span> people.
          </div>

          <div style={{ marginTop: s(0.06), display: 'flex', alignItems: 'center', gap: s(0.025) }}>
            <BdMark size={s(0.08)} />
            <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: s(0.03), color: 'var(--graphite)' }}>
              bain.design · Mark Bain
            </div>
          </div>
        </div>

        {/* corner ticks — anchored to the safe rect */}
        <div style={{ position: 'absolute', top: s(0.06), right: s(0.06), fontFamily: 'var(--font-mono-2)', fontSize: s(0.035), color: 'var(--clay)' }}>┐</div>
        <div style={{ position: 'absolute', bottom: s(0.06), left: s(0.06), fontFamily: 'var(--font-mono-2)', fontSize: s(0.035), color: 'var(--clay)' }}>└</div>
      </div>
    </div>
  );
};

// ---------- C · Stats split ----------
const BannerStats = ({ w, h, safe }) => {
  const pad = scale(h, 0.10);
  const titleSize = scale(h, 0.14);
  const lines = [
    ['14+',  'years coding bespoke'],
    ['100s', 'sites shipped'],
    ['2',    'plugins on .org'],
    ['0',    'page builders used'],
  ];
  // safe area handling: when a safe rect is provided (YouTube), letterbox
  // the split entirely inside it instead of spanning the full width.
  if (safe) {
    return (
      <div style={{
        width: w, height: h, background: 'var(--ink)', position: 'relative',
        fontFamily: 'var(--font-mono)', overflow: 'hidden',
      }}>
        <BannerFontStyles />
        <div style={{
          position: 'absolute', left: safe.x, top: safe.y, width: safe.w, height: safe.h,
          display: 'grid', gridTemplateColumns: '1.4fr 1fr', background: 'var(--paper)',
        }}>
          <StatsLeft h={safe.h} titleSize={scale(safe.h, 0.16)} pad={scale(safe.h, 0.10)} />
          <StatsRight h={safe.h} pad={scale(safe.h, 0.08)} lines={lines} />
        </div>
      </div>
    );
  }
  return (
    <div style={{
      width: w, height: h, fontFamily: 'var(--font-mono)', position: 'relative', overflow: 'hidden',
      display: 'grid', gridTemplateColumns: '1.4fr 1fr', background: 'var(--paper)',
    }}>
      <BannerFontStyles />
      <StatsLeft h={h} titleSize={titleSize} pad={pad} />
      <StatsRight h={h} pad={scale(h, 0.08)} lines={lines} />
    </div>
  );
};

const StatsLeft = ({ h, titleSize, pad }) => (
  <div style={{ padding: `${pad}px ${pad}px`, display: 'flex', flexDirection: 'column', justifyContent: 'space-between' }}>
    <div style={{ fontFamily: 'var(--font-mono-2)', fontSize: scale(h, 0.028), color: 'var(--pencil)', textTransform: 'uppercase', letterSpacing: '0.08em' }}>
      [ Bain Design — est. 2012 ]
    </div>
    <div style={{ fontSize: titleSize, fontWeight: 700, lineHeight: 1.05, letterSpacing: '-0.03em', color: 'var(--ink)' }}>
      Friendly websites for interesting people<span style={{ color: 'var(--clay)' }}>.</span>
    </div>
    <div style={{ display: 'flex', alignItems: 'center', gap: scale(h, 0.025) }}>
      <BdMark size={scale(h, 0.07)} />
      <span style={{ fontFamily: 'var(--font-mono-2)', fontSize: scale(h, 0.028), color: 'var(--graphite)' }}>
        Mark Bain · bain.design
      </span>
    </div>
  </div>
);

const StatsRight = ({ h, pad, lines }) => (
  <div style={{
    background: 'var(--ink)', color: 'var(--paper)', padding: `${pad}px ${pad}px`,
    display: 'flex', flexDirection: 'column', justifyContent: 'center', gap: scale(h, 0.025),
    fontFamily: 'var(--font-mono-2)', fontSize: scale(h, 0.032),
  }}>
    {lines.map(([n, l]) => (
      <div key={l} style={{ display: 'flex', alignItems: 'baseline', gap: scale(h, 0.035) }}>
        <span style={{ color: 'var(--clay)', fontWeight: 700, fontSize: scale(h, 0.055), minWidth: scale(h, 0.15) }}>✔ {n}</span>
        <span style={{ color: 'rgba(245,240,232,0.85)' }}>{l}</span>
      </div>
    ))}
  </div>
);

// ---------- Safe-area overlay ----------
// Faint dashed outline showing the cross-device safe zone. Hidden by
// default (use the Safe-area toggle in the canvas).
const SafeOverlay = ({ x, y, w, h, label }) => (
  <div data-safe-overlay style={{
    position: 'absolute', left: x, top: y, width: w, height: h,
    border: '2px dashed rgba(201, 100, 66, 0.55)', pointerEvents: 'none',
    display: 'none',
  }}>
    <div style={{
      position: 'absolute', top: -28, left: 0,
      fontFamily: 'var(--font-mono-2)', fontSize: 14, color: 'var(--clay)',
    }}>{label}</div>
  </div>
);

// ---------- Platform wrappers ----------
// Each wrapper sets the platform's pixel size and (where it matters) a
// safe-area rect. Variants A/B/C receive both.

// X / Twitter — 1500×500. Avatar overlay sits at ~120px from left,
// bottom-aligned. Mobile crop is roughly the centre 1500×500 so no
// special safe rect needed beyond "keep the bottom-left clear of dense
// content."
const X_W = 1500, X_H = 500;
const XSafe = { x: 280, y: 40, w: 1180, h: 420 }; // clear of avatar overlap

// GitHub profile README banner — 1280×640 (2:1). Used full-bleed on
// profile READMEs. No platform crop.
const GH_W = 1280, GH_H = 640;

// Facebook cover — 851×315 on desktop, but Facebook upscales to ~820×312
// at display. We render at native 851×315.
const FB_W = 851, FB_H = 315;

// YouTube channel art — 2560×1440 upload. The platform crops aggressively:
// safe area is the centre 1546×423 ("TV-safe"), which is what we design
// inside. Outside is bleed.
const YT_W = 2560, YT_H = 1440;
const YTSafe = { x: (YT_W - 1546) / 2, y: (YT_H - 423) / 2, w: 1546, h: 423 };

// X / Twitter
const XTerminal = () => (
  <div style={{ position: 'relative' }}>
    <BannerTerminal w={X_W} h={X_H} safe={XSafe} />
    <SafeOverlay x={XSafe.x} y={XSafe.y} w={XSafe.w} h={XSafe.h} label="Safe area · clear of avatar" />
  </div>
);
const XBlueprint = () => (
  <div style={{ position: 'relative' }}>
    <BannerBlueprint w={X_W} h={X_H} safe={XSafe} />
    <SafeOverlay x={XSafe.x} y={XSafe.y} w={XSafe.w} h={XSafe.h} label="Safe area · clear of avatar" />
  </div>
);
const XStats = () => <BannerStats w={X_W} h={X_H} />;

// GitHub
const GHTerminal  = () => <BannerTerminal  w={GH_W} h={GH_H} />;
const GHBlueprint = () => <BannerBlueprint w={GH_W} h={GH_H} />;
const GHStats     = () => <BannerStats     w={GH_W} h={GH_H} />;

// Facebook
const FBTerminal  = () => <BannerTerminal  w={FB_W} h={FB_H} />;
const FBBlueprint = () => <BannerBlueprint w={FB_W} h={FB_H} />;
const FBStats     = () => <BannerStats     w={FB_W} h={FB_H} />;

// YouTube
const YTTerminal = () => (
  <div style={{ position: 'relative' }}>
    <BannerTerminal w={YT_W} h={YT_H} safe={YTSafe} />
    <SafeOverlay x={YTSafe.x} y={YTSafe.y} w={YTSafe.w} h={YTSafe.h} label="TV-safe · 1546×423" />
  </div>
);
const YTBlueprint = () => (
  <div style={{ position: 'relative' }}>
    <BannerBlueprint w={YT_W} h={YT_H} safe={YTSafe} />
    <SafeOverlay x={YTSafe.x} y={YTSafe.y} w={YTSafe.w} h={YTSafe.h} label="TV-safe · 1546×423" />
  </div>
);
const YTStats = () => (
  <div style={{ position: 'relative' }}>
    <BannerStats w={YT_W} h={YT_H} safe={YTSafe} />
    <SafeOverlay x={YTSafe.x} y={YTSafe.y} w={YTSafe.w} h={YTSafe.h} label="TV-safe · 1546×423" />
  </div>
);

Object.assign(window, {
  X_W, X_H, GH_W, GH_H, FB_W, FB_H, YT_W, YT_H,
  XTerminal, XBlueprint, XStats,
  GHTerminal, GHBlueprint, GHStats,
  FBTerminal, FBBlueprint, FBStats,
  YTTerminal, YTBlueprint, YTStats,
});
