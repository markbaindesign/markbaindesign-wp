// Root: lay every banner / sig / avatar onto a single design canvas,
// grouped into sections matching the asks.

const App = () => (
  <DesignCanvas title="Bain Design — Identity assets" subtitle="Banners, email sigs, avatars">

    <DCSection id="x"     title="X / Twitter — 1500×500"      subtitle="3 directions">
      <DCArtboard id="xa" label="A · Terminal"   width={X_W} height={X_H}><XTerminal  /></DCArtboard>
      <DCArtboard id="xb" label="B · Blueprint"  width={X_W} height={X_H}><XBlueprint /></DCArtboard>
      <DCArtboard id="xc" label="C · Stats"      width={X_W} height={X_H}><XStats     /></DCArtboard>
    </DCSection>

    <DCSection id="gh"    title="GitHub profile README — 1280×640" subtitle="2:1, full-bleed">
      <DCArtboard id="gha" label="A · Terminal"  width={GH_W} height={GH_H}><GHTerminal  /></DCArtboard>
      <DCArtboard id="ghb" label="B · Blueprint" width={GH_W} height={GH_H}><GHBlueprint /></DCArtboard>
      <DCArtboard id="ghc" label="C · Stats"     width={GH_W} height={GH_H}><GHStats     /></DCArtboard>
    </DCSection>

    <DCSection id="fb"    title="Facebook cover — 851×315"     subtitle="Tight format; expect mobile crop">
      <DCArtboard id="fba" label="A · Terminal"  width={FB_W} height={FB_H}><FBTerminal  /></DCArtboard>
      <DCArtboard id="fbb" label="B · Blueprint" width={FB_W} height={FB_H}><FBBlueprint /></DCArtboard>
      <DCArtboard id="fbc" label="C · Stats"     width={FB_W} height={FB_H}><FBStats     /></DCArtboard>
    </DCSection>

    <DCSection id="yt"    title="YouTube channel art — 2560×1440" subtitle="Safe zone (1546×423) outlined in clay — keep important content inside it">
      <DCArtboard id="yta" label="A · Terminal"  width={YT_W} height={YT_H}><YTTerminal  /></DCArtboard>
      <DCArtboard id="ytb" label="B · Blueprint" width={YT_W} height={YT_H}><YTBlueprint /></DCArtboard>
      <DCArtboard id="ytc" label="C · Stats"     width={YT_W} height={YT_H}><YTStats     /></DCArtboard>
    </DCSection>

    <DCSection id="sigs"  title="Email signatures"             subtitle="All three forms side-by-side — Copy button on each pulls the raw source">
      <DCArtboard id="sa" label="A · HTML table (universal)"     width={SIG_W} height={SIG_H}><SigA /></DCArtboard>
      <DCArtboard id="sb" label="B · HTML + inline SVG Bd"       width={SIG_W} height={SIG_H}><SigB /></DCArtboard>
      <DCArtboard id="sc" label="C · Plain text (Usenet-style)"  width={SIG_W} height={SIG_H}><SigC /></DCArtboard>
    </DCSection>

    <DCSection id="av"    title="ASCII portrait avatars — 1024×1024" subtitle="Type IS the image. Export each as PNG via the artboard menu.">
      <DCArtboard id="ava" label="A · Block Bd"      width={AV_W} height={AV_H}><AvatarBlockBd  /></DCArtboard>
      <DCArtboard id="avb" label="B · Terminal"      width={AV_W} height={AV_H}><AvatarTerminal /></DCArtboard>
      <DCArtboard id="avc" label="C · Density"       width={AV_W} height={AV_H}><AvatarDensity  /></DCArtboard>
    </DCSection>

  </DesignCanvas>
);

ReactDOM.createRoot(document.getElementById('root')).render(<App />);
