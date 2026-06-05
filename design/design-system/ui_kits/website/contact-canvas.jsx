// Root canvas — three contact-page directions side-by-side.

const W = 1440;

const App = () => (
  <DesignCanvas title="Contact page" subtitle="Three design directions">
    <DCSection id="variants" title="Contact page · variants">
      <DCArtboard id="a" label="A · Editorial letter + form"   width={W} height={2700}><ContactA /></DCArtboard>
      <DCArtboard id="b" label="B · Channels grid + FAQ"       width={W} height={3450}><ContactB /></DCArtboard>
      <DCArtboard id="c" label="C · Terminal CLI composer"     width={W} height={2100}><ContactC /></DCArtboard>
    </DCSection>
  </DesignCanvas>
);

ReactDOM.createRoot(document.getElementById('root')).render(<App />);
