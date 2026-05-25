// ASCII portraits — square avatars (1024×1024) built from text glyphs.
// Three variations, each rendered as a fixed-width monospace grid so the
// "image" IS the type. Designed to look like terminal screenshots that
// happen to also be avatars.
//
//  A · Big block Bd        — the Bd mark built from # glyphs, framed in
//                            box-drawing characters. Reads as a brand mark
//                            from any distance.
//  B · Terminal window     — a mock $ shell that ends with `whoami` and
//                            an ASCII face/glyph response. Reads as type
//                            up close, glyph at thumbnail size.
//  C · Density portrait    — ramp-shaded character art forming a square
//                            silhouette. The painterly one.

const AV_W = 1024, AV_H = 1024;

// ---- shared base ----
function AvatarBase({ background = 'var(--ink)', foreground = 'var(--paper)', children, fontSize = 24, lineHeight = 1.0, fontWeight = 500, fontFamily = "var(--font-mono)" }) {
  return (
    <div style={{
      width: AV_W, height: AV_H, background, color: foreground,
      fontFamily, fontWeight, fontSize, lineHeight,
      display: 'flex', alignItems: 'center', justifyContent: 'center',
      whiteSpace: 'pre', overflow: 'hidden', boxSizing: 'border-box',
      letterSpacing: 0,
    }}>
      {children}
    </div>
  );
}

// =====================================================================
// A · Big block "Bd"
// =====================================================================
// Hand-pixelled 12×7 character bitmap for the letters B and d, then
// rendered as a textile of █/░ glyphs framed by box-drawing chars.
// .  = empty
// #  = ink-on-paper fill (we render with the █ glyph)
const BD_BITMAP = [
//  B B B B B B B   d d d d d d d
  '. # # # # # . . . . . # # # # # .',
  '. # . . . . # . . . . # . . . # .',
  '. # . . . . # . . . . # . . . # .',
  '. # # # # # . . . . . # . . . # .',
  '. # . . . . # . . . . # . . . # .',
  '. # . . . . # . . . . # . . . # .',
  '. # # # # # . . . . . # # # # # .',
];

function buildBdGrid() {
  // Frame the bitmap with a 2-cell padding + a single-line box border.
  const rows = BD_BITMAP.map((r) => r.split(' '));
  const innerW = rows[0].length;          // 17
  const padX = 3, padY = 3;
  const W = innerW + padX * 2 + 2;        // +2 for left/right border
  const H = rows.length + padY * 2 + 2;   // +2 for top/bottom border

  const grid = Array.from({ length: H }, () => Array(W).fill(' '));
  // box border
  for (let x = 1; x < W - 1; x++) { grid[0][x] = '─'; grid[H - 1][x] = '─'; }
  for (let y = 1; y < H - 1; y++) { grid[y][0] = '│'; grid[y][W - 1] = '│'; }
  grid[0][0] = '┌'; grid[0][W - 1] = '┐';
  grid[H - 1][0] = '└'; grid[H - 1][W - 1] = '┘';
  // bitmap
  rows.forEach((row, ry) => {
    row.forEach((cell, rx) => {
      grid[1 + padY + ry][1 + padX + rx] = cell === '#' ? '█' : ' ';
    });
  });
  return grid.map((r) => r.join('')).join('\n');
}

const AvatarBlockBd = () => {
  const grid = buildBdGrid();
  // tuned so the framed Bd fills ~78% of the 1024px canvas height.
  return (
    <AvatarBase fontSize={64} lineHeight={1.0} fontWeight={700}>
      <div style={{ position: 'relative' }}>
        <div>{grid}</div>
        <div style={{
          position: 'absolute', left: 0, right: 0, bottom: -56,
          fontFamily: 'var(--font-mono-2)', fontSize: 22, color: 'var(--clay)',
          textAlign: 'center', letterSpacing: '0.12em', fontWeight: 400,
        }}>BAIN.DESIGN</div>
      </div>
    </AvatarBase>
  );
};

// =====================================================================
// B · Terminal window — `whoami` response is an ASCII face
// =====================================================================
const AvatarTerminal = () => (
  <AvatarBase background="var(--ink)" foreground="var(--paper)" fontSize={26} lineHeight={1.45}>
    <div style={{ width: 880, height: 880, border: '4px solid var(--paper)', position: 'relative', padding: '64px 56px 56px', boxSizing: 'border-box' }}>
      {/* chrome */}
      <div style={{ position: 'absolute', top: 0, left: 0, right: 0, height: 44, borderBottom: '1px solid var(--paper)', display: 'flex', alignItems: 'center', padding: '0 18px', gap: 10 }}>
        <span style={{ width: 12, height: 12, borderRadius: '50%', background: '#FF5F57' }} />
        <span style={{ width: 12, height: 12, borderRadius: '50%', background: '#FEBC2E' }} />
        <span style={{ width: 12, height: 12, borderRadius: '50%', background: '#28C840' }} />
        <span style={{ marginLeft: 16, fontSize: 16, fontFamily: 'var(--font-mono-2)', color: 'rgba(245,240,232,0.55)' }}>~ — zsh — 24×16</span>
      </div>

      <div>
        <span style={{ color: 'var(--clay)' }}>~ </span>
        <span style={{ color: 'rgba(245,240,232,0.65)' }}>$ </span>
        whoami
      </div>
      <div style={{ marginTop: 6, color: 'rgba(245,240,232,0.85)', fontFamily: 'var(--font-mono-2)', fontSize: 22 }}>
{`  ┌─────────┐
  │ ┌─┐ ┌─┐ │
  │ └─┘ └─┘ │
  │   ─┬─   │
  │  \\___/  │
  └─────────┘`}
      </div>
      <div style={{ marginTop: 28 }}>
        mark — <span style={{ color: 'var(--clay)' }}>WordPress dev</span>
      </div>
      <div style={{ marginTop: 4, color: 'rgba(245,240,232,0.65)' }}>
        Barcelona / est. 2012
      </div>

      <div style={{ marginTop: 28 }}>
        <span style={{ color: 'var(--clay)' }}>~ </span>
        <span style={{ color: 'rgba(245,240,232,0.65)' }}>$ </span>
        <span style={{ display: 'inline-block', width: '0.6ch', height: '1em', background: 'var(--phosphor)', verticalAlign: '-0.15em', marginLeft: 4, animation: 'ba-blink 1.06s steps(2) infinite' }} />
      </div>

      <div style={{ position: 'absolute', bottom: 18, right: 24, fontSize: 16, color: 'rgba(245,240,232,0.55)', fontFamily: 'var(--font-mono-2)' }}>
        bain.design
      </div>
    </div>
  </AvatarBase>
);

// =====================================================================
// C · Density portrait — ramp-shaded square silhouette
// =====================================================================
// Each character in the grid is one of:
//   ' '  '.'  ':'  '-'  '+'  '='  '*'  '#'  '@'  '█'
// from lightest to darkest. We hand-paint a 28×28 grid that reads as a
// stylized portrait at avatar sizes — chunky head, terminal-prompt mouth,
// shoulders forming the base.
const PORTRAIT = [
  '............................',
  '............................',
  '..........=*####*=..........',
  '........+##########+........',
  '.......*############*.......',
  '......*##############*......',
  '.....*##::########::##*.....',
  '.....*##::########::##*.....',
  '.....*##############*.......',
  '......*############*........',
  '.......*####@@####*.........',
  '........*##::::##*..........',
  '.........*######*...........',
  '..........+####+............',
  '..........=####=............',
  '.........*######*...........',
  '........*########*..........',
  '.......*##########*.........',
  '......*############*........',
  '.....*##############*.......',
  '....*################*......',
  '...*##################*.....',
  '..*####################*....',
  '.*######################*...',
  '*########################*..',
  '##########################*.',
  '############################',
  '############################',
];

const RAMP = { '.': ' ', ':': '·', '-': '-', '+': '+', '=': '=', '*': '*', '#': '#', '@': '@' };

const AvatarDensity = () => {
  // Translate the painted grid through the ramp; render with var(--paper)
  // base + a clay tint for the strongest cells (@ and #) so the portrait
  // gets a warm highlight without leaving the brand palette.
  return (
    <AvatarBase background="var(--paper)" foreground="var(--ink)" fontSize={32} lineHeight={0.95} fontWeight={700} fontFamily="var(--font-mono-2)">
      <div style={{ position: 'relative' }}>
        <div style={{ color: 'var(--ink)' }}>
          {PORTRAIT.map((row) => row.split('').map((c) => RAMP[c] ?? c).join('')).join('\n')}
        </div>
        {/* small clay overlay on the eyes column — drawn as a second pass
            so it sits on top without disturbing the monospace metric */}
        <div style={{
          position: 'absolute', inset: 0, pointerEvents: 'none',
          color: 'var(--clay)', mixBlendMode: 'normal', opacity: 0.85,
        }}>
          {PORTRAIT.map((row, y) => row.split('').map((c, x) => {
            // highlight only the two "eye" rows (y 6,7) where columns hold ::
            if ((y === 6 || y === 7) && (x === 9 || x === 10 || x === 17 || x === 18)) return '·';
            return ' ';
          }).join('')).join('\n')}
        </div>
        <div style={{
          position: 'absolute', bottom: -44, left: 0, right: 0,
          fontFamily: 'var(--font-mono-2)', fontSize: 22, color: 'var(--graphite)',
          textAlign: 'center', letterSpacing: '0.18em', fontWeight: 400,
        }}>[ MARK / Bd ]</div>
      </div>
    </AvatarBase>
  );
};

Object.assign(window, { AV_W, AV_H, AvatarBlockBd, AvatarTerminal, AvatarDensity });
