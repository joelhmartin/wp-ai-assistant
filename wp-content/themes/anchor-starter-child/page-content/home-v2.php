<?php
/**
 * Home v2 — pure PHP.
 *
 * Editorial homepage variant 2. CSS lives in assets/css/home-v2.css;
 * JS in assets/js/home-v2.js. Both are enqueued by functions.php when
 * this page is the queried slug.
 *
 * @package Anchor_Starter_Child
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- ====== NAV ====== -->
<!-- Hidden SVG defs: the real Deka wordmark, inlined -->
<!-- ====== HERO ====== -->
<header class="hero" id="top" data-section-type="hero">
  <div class="hero-grain"></div>
  <div class="hero-beam b1"></div>
  <div class="hero-beam b2"></div>

  <div class="container hero-inner">

    <div class="hero-meta">
      <div class="mono">Deka · Est. 1981 · Florence, Italy</div>
      <div class="mono">No. 01 / Homepage</div>
    </div>

    <div>
      <h1 class="display hero-headline" style="color: var(--ivory);">
        <span class="line"><span>The standard</span></span>
        <span class="line"><span>of <em>precision</em> light</span></span>
        <span class="line"><span>in modern dentistry.</span></span>
      </h1>

      <div class="hero-foot" style="margin-top: 28px;">
        <p class="hero-sub">
          For more than four decades, Deka has engineered the lasers that define the world's most demanding dental practices — instruments of clinical certainty, crafted in Florence.
        </p>

        <div class="hero-stats">
          <div class="hero-stat">
            <div class="num">44<sup>yrs</sup></div>
            <div class="cap">Italian engineering</div>
          </div>
          <div class="hero-stat">
            <div class="num">30k<sup>+</sup></div>
            <div class="cap">Systems placed worldwide</div>
          </div>
        </div>

        <div style="grid-column: 1 / -1; display: flex; justify-content: center; margin-top: 20px;">
          <a class="hero-cta" href="#products">
            Explore the Instruments
            <svg class="arrow" viewBox="0 0 24 12" fill="none" aria-hidden="true"><path d="M0 6h22m0 0l-6-5m6 5l-6 5" stroke="currentColor" stroke-width="1.2"></path></svg>
          </a>
        </div>
      </div>
    </div>
  </div>

</header>

<!-- ====== MANIFESTO ====== -->
<section class="manifesto" data-section-type="manifesto">
  <div class="container">
    <div class="section-head">
      <div class="section-index">— 01</div>
      <div class="section-title">The Deka Story</div>
      <div class="section-label">On light, on certainty</div>
    </div>

    <div class="manifesto-body">
      <p class="manifesto-quote reveal">
        We believe the highest form of care is the one the patient never feels arrive.
        A laser, held in a steady hand, becomes something closer to <em>intention</em> —
        a quieter procedure, a cleaner margin, a shorter recovery. This is the clinical
        language Deka has spent a generation perfecting.
      </p>
    </div>

    <div class="manifesto-foot">
      <div class="manifesto-col reveal">
        <h4>Built in Florence</h4>
        <p>Every Deka system is engineered, assembled and calibrated by hand in our atelier outside Florence — the same workshop that has been shaping medical lasers since 1981.</p>
      </div>
      <div class="manifesto-col reveal">
        <h4>Evidence, not adjectives</h4>
        <p>More than 400 peer-reviewed papers inform our wavelengths, pulse shapes and energy deliveries. We engineer to the paper, not the brochure.</p>
      </div>
      <div class="manifesto-col reveal">
        <h4>A partner to the practice</h4>
        <p>Our clinical team integrates with yours: training, protocols, tissue-specific libraries and ongoing education — so the instrument pays itself forward from day one.</p>
      </div>
    </div>
  </div>
</section>

<!-- ====== CAPABILITIES ====== -->
<section class="capabilities" id="technology" data-section-type="capabilities">
  <div class="container">
    <div class="section-head">
      <div class="section-index">— 02</div>
      <div class="section-title">What Deka Changes</div>
      <div class="section-label">Benefits · Innovation · Precision · Outcomes</div>
    </div>

    <div class="cap-head">
      <h2 class="display reveal">Four instruments of <em>clinical certainty</em>.</h2>
      <p class="reveal">Every Deka platform is organised around the same quiet promise — that the right wavelength, delivered with the right discipline, changes what dentistry feels like. Here is how that promise shows up, chairside.</p>
    </div>

    <div class="cap-grid">
      <div class="cap-card reveal">
        <div>
          <div class="cap-num">01</div>
          <div class="cap-kicker" style="margin-top: 24px;">Benefit</div>
        </div>
        <div class="cap-body">
          <h3>A calmer chair, a faster morning.</h3>
          <p>Near-silent procedures. Less bleeding, fewer sutures, meaningfully shorter recoveries — patients leave comfortable, and they remember it.</p>
        </div>
      </div>

      <div class="cap-card reveal">
        <div>
          <div class="cap-num">02</div>
          <div class="cap-kicker" style="margin-top: 24px;">Innovation</div>
        </div>
        <div class="cap-body">
          <h3>Pulse architectures, perfected.</h3>
          <p>Proprietary Pulsed Solid State™ and QSP™ emissions give clinicians expressive control over energy — tissue-specific, not one-size.</p>
        </div>
      </div>

      <div class="cap-card reveal">
        <div>
          <div class="cap-num">03</div>
          <div class="cap-kicker" style="margin-top: 24px;">Precision</div>
        </div>
        <div class="cap-body">
          <h3>A steadier hand, engineered in.</h3>
          <p>Sub-micron delivery, active thermal management and adaptive feedback — the instrument corrects before you notice the correction.</p>
        </div>
      </div>

      <div class="cap-card reveal">
        <div>
          <div class="cap-num">04</div>
          <div class="cap-kicker" style="margin-top: 24px;">Outcome</div>
        </div>
        <div class="cap-body">
          <h3>Results your patients refer.</h3>
          <p>Predictable margins, cleaner biopsy sites, documented healing curves — and a waiting room that fills itself, because the chair speaks for you.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====== LINEUP ====== -->
<section class="lineup" data-section-type="lineup">
  <div class="container">
    <div class="section-head">
      <div class="section-index">— 03</div>
      <div class="section-title">The Collection</div>
      <div class="section-label">Three instruments, one standard</div>
    </div>

    <div class="lineup-grid">

      <article class="product">
        <div class="product-visual">
          <div class="shape">
            <div class="ring"></div>
            <div class="ring-in"></div>
          </div>
          <div class="pv-photo"><img src="<?php echo esc_url( anchor_resolve_media( 'product_us20d' ) ); ?>" alt="DEKA US-20D CO2 laser"></div>
          <div class="tag">US-20D</div>
          <div class="caption"><span>CO₂ · 10,600 nm</span><span>Compact</span></div>
        </div>
        <h4><span class="sm">CO₂ · 10,600 nm</span>US-20D</h4>
        <p>The compact CO₂ instrument. An articulated arm, a mobile chassis, and the cleanest soft-tissue incision in the operatory — ready to move chair-to-chair.</p>
        <div class="product-meta">
          <span>Soft Tissue · CO₂</span>
          <span class="arrow">→</span>
        </div>
      </article>

      <article class="product">
        <div class="product-visual">
          <div class="shape">
            <div class="ring"></div>
            <div class="ring-in"></div>
          </div>
          <div class="pv-photo"><img src="<?php echo esc_url( anchor_resolve_media( 'product_smartxide' ) ); ?>" alt="DEKA SmartXide Ultraspeed 2 CO2 laser"></div>
          <div class="tag">SmartXide²</div>
          <div class="caption"><span>CO₂ · Pulse Shape Design</span><span>Flagship</span></div>
        </div>
        <h4><span class="sm">CO₂ · PSD™</span>SmartXide Ultraspeed 2</h4>
        <p>The surgical flagship. Proprietary Pulse Shape Design delivers energy the tissue doesn't feel arrive — and a healing curve your patients will describe for you.</p>
        <div class="product-meta">
          <span>Surgical · CO₂</span>
          <span class="arrow">→</span>
        </div>
      </article>

      <article class="product">
        <div class="product-visual">
          <div class="shape">
            <div class="ring"></div>
            <div class="ring-in"></div>
          </div>
          <div class="pv-photo"><img src="<?php echo esc_url( anchor_resolve_media( 'product_smartperio' ) ); ?>" alt="DEKA SmartPerio Nd:YAG laser"></div>
          <div class="tag">SmartPerio</div>
          <div class="caption"><span>Nd:YAG · 1064 nm</span><span>Periodontal</span></div>
        </div>
        <h4><span class="sm">Nd:YAG · 1064 nm</span>SmartPerio</h4>
        <p>The periodontal specialist. A pulsed Nd:YAG beam that reaches depth, sterilises pockets, and leaves the soft tissue above exactly as you found it.</p>
        <div class="product-meta">
          <span>Perio · Endo</span>
          <span class="arrow">→</span>
        </div>
      </article>

    </div>
  </div>
</section>

<!-- ====== FLAGSHIP ====== -->
<section class="flagship" id="products" data-section-type="flagship">
  <div class="container">
    <div class="section-head">
      <div class="section-index">— 04</div>
      <div class="section-title">SmartPerio</div>
      <div class="section-label">Pulsed Nd:YAG · Periodontal specialist</div>
    </div>

    <div class="flagship-wrap">
      <div class="flagship-visual reveal">
        <div class="fv-label">DEKA · SMARTPERIO Nd:YAG</div>
        <div class="fv-crop">
          <div class="ring"></div>
          <div class="ring ring2"></div>
          <div class="ring ring3"></div>
          <div class="dot"></div>
          <div class="caption">DEKA · Florence</div>
        </div>
        <div class="fv-photo"><img src="<?php echo esc_url( anchor_resolve_media( 'product_smartperio' ) ); ?>" alt="DEKA SmartPerio Nd:YAG laser"></div>
        <div class="fv-ticker">
          <span>λ · 1064 nm</span>
          <span>Made in Florence</span>
        </div>
      </div>

      <div class="flagship-content">
        <h3 class="display reveal">SmartPerio.<br>The <em>periodontal</em><br>standard.</h3>
        <p class="flagship-lede reveal">
          A pulsed Nd:YAG instrument built for the pocket, the furcation, and the quiet decisions that define a periodontal practice — sterilising depth without surrendering the soft tissue above.
        </p>

        <div class="flagship-specs reveal">
          <div class="spec"><div class="k">Wavelength</div><div class="v">1064<sup>nm</sup></div></div>
          <div class="spec"><div class="k">Peak power</div><div class="v">7<sup>W</sup></div></div>
          <div class="spec"><div class="k">Pulse</div><div class="v">Free-running · Pulsed</div></div>
          <div class="spec"><div class="k">Delivery</div><div class="v">Fiber · 300 µm</div></div>
        </div>

        <div class="flagship-ctas reveal">
          <a class="btn-primary" href="#final">
            Schedule a Private Demo
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"></path></svg>
          </a>
          <a class="btn-ghost" href="#">Download the Clinical Dossier</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====== SHOWCASE: US-20D ====== -->
<section class="showcase" data-section-type="showcase">
  <div class="container">
    <div class="section-head">
      <div class="section-index">— 05.01</div>
      <div class="section-title">US-20D CO₂</div>
      <div class="section-label">The compact surgical standard</div>
    </div>

    <div class="sc-wrap">
      <div class="sc-visual reveal">
        <div class="sc-label">DEKA · US-20D</div>
        <div class="sc-frame">
          <div class="ring"></div>
          <div class="ring ring2"></div>
          <div class="ring ring3"></div>
          <div class="dot"></div>
        </div>
        <div class="sc-photo"><img src="<?php echo esc_url( anchor_resolve_media( 'product_us20d' ) ); ?>" alt="DEKA US-20D CO2 dental laser"></div>
        <div class="sc-ticker"><span>λ · 10,600 nm</span><span>Articulated arm</span></div>
      </div>

      <div class="sc-content">
        <div class="kicker reveal">— The compact instrument</div>
        <h3 class="display reveal">A <em>CO₂ workhorse</em>,<br>refined to the millimetre.</h3>
        <p class="sc-lede reveal">
          Compact enough to move between operatories, serious enough to carry the surgical day. The US-20D is the Deka most dental practices meet first — and keep for life.
        </p>
        <div class="sc-points reveal">
          <div class="p"><div class="k">Wavelength</div><div class="v">10,600<sup>nm</sup></div></div>
          <div class="p"><div class="k">Max power</div><div class="v">20<sup>W</sup></div></div>
          <div class="p"><div class="k">Delivery</div><div class="v">7-joint arm</div></div>
          <div class="p"><div class="k">Modes</div><div class="v">CW · Pulsed · Super-Pulsed</div></div>
        </div>
        <div class="sc-ctas reveal">
          <a class="btn-dark" href="#final">Request the US-20D Dossier
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"></path></svg>
          </a>
          <a class="btn-light-ghost" href="#">See indications</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====== SHOWCASE: SmartXide Ultraspeed 2 ====== -->
<section class="showcase dark flip" data-section-type="showcase">
  <div class="container">
    <div class="section-head">
      <div class="section-index">— 05.02</div>
      <div class="section-title">SmartXide Ultraspeed 2</div>
      <div class="section-label">Pulse Shape Design CO₂</div>
    </div>

    <div class="sc-wrap">
      <div class="sc-content">
        <div class="kicker reveal">— The surgical flagship</div>
        <h3 class="display reveal">Pulse Shape Design.<br>A CO₂ <em>you can't feel</em><br>arrive.</h3>
        <p class="sc-lede reveal">
          The SmartXide Ultraspeed 2 is our proprietary PSD™ CO₂ platform. Energy shaped to the tissue, not the tissue shaped to the beam — with thermal confinement so disciplined the procedure ends before the patient notices it began.
        </p>
        <div class="sc-points reveal">
          <div class="p"><div class="k">Wavelength</div><div class="v">10,600<sup>nm</sup></div></div>
          <div class="p"><div class="k">Max power</div><div class="v">30<sup>W</sup></div></div>
          <div class="p"><div class="k">Signature</div><div class="v">PSD™ · SmartPulse™</div></div>
          <div class="p"><div class="k">Indications</div><div class="v">Surgical · Peri-implant</div></div>
        </div>
        <div class="sc-ctas reveal">
          <a class="btn-primary" href="#final">Schedule a SX² Demo
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"></path></svg>
          </a>
          <a class="btn-ghost" href="#">Download the PSD™ whitepaper</a>
        </div>
      </div>

      <div class="sc-visual reveal">
        <div class="sc-label">DEKA · SMARTXIDE²</div>
        <div class="sc-frame">
          <div class="ring"></div>
          <div class="ring ring2"></div>
          <div class="ring ring3"></div>
          <div class="dot"></div>
        </div>
        <div class="sc-photo"><img src="<?php echo esc_url( anchor_resolve_media( 'product_smartxide' ) ); ?>" alt="DEKA SmartXide Ultraspeed 2 CO2 dental laser"></div>
        <div class="sc-ticker"><span>λ · 10,600 nm · PSD™</span><span>Flagship</span></div>
      </div>
    </div>
  </div>
</section>

<!-- ====== OUTCOMES ====== -->
<section class="outcomes" id="outcomes" data-section-type="outcomes">
  <div class="container">
    <div class="section-head">
      <div class="section-index">— 06</div>
      <div class="section-title">Evidence</div>
      <div class="section-label">Measured, not marketed</div>
    </div>

    <div class="outcomes-wrap">
      <div class="outcomes-lead reveal">
        <h2 class="display">The quiet math of a <em>superior</em> procedure.</h2>
        <p>
          Every number below comes from peer-reviewed clinical literature published between 2016 and 2025. If a claim isn't documented, it isn't printed.
        </p>
      </div>

      <div class="metrics reveal">
        <div class="metric">
          <div class="num">–62<sup>%</sup></div>
          <div class="lbl">Reduction in post-operative discomfort vs. conventional modality</div>
        </div>
        <div class="metric">
          <div class="num">2.4<sup>×</sup></div>
          <div class="lbl">Faster soft-tissue healing observed at 14 days</div>
        </div>
        <div class="metric">
          <div class="num">0.98</div>
          <div class="lbl">Clinician reliability score across 1,200+ Smart Pro cases</div>
        </div>
        <div class="metric">
          <div class="num">+34<sup>%</sup></div>
          <div class="lbl">Practice case acceptance when laser is offered first</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====== VOICES ====== -->
<section class="voices" id="clinicians" data-section-type="voices">
  <div class="container">
    <div class="section-head">
      <div class="section-index">— 07</div>
      <div class="section-title">Clinicians</div>
      <div class="section-label">In their own words</div>
    </div>

    <div class="voices-slider reveal" id="voices">
      <div class="voices-track" id="voices-track">
        <!-- slides injected by JS -->
      </div>
      <div class="voices-controls">
        <div class="voices-dots" id="voices-dots"></div>
        <div class="voices-counter" id="voices-counter">01 / 04</div>
        <div class="voices-arrows">
          <button id="voices-prev" aria-label="Previous">
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M13 5H1m0 0l4-4m-4 4l4 4" stroke="currentColor" stroke-width="1.2"></path></svg>
          </button>
          <button id="voices-next" aria-label="Next">
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"></path></svg>
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ====== TRUST ====== -->
<section class="trust" data-section-type="trust">
  <div class="container trust-wrap">
    <div class="trust-label">Trusted by teaching institutions and top-quartile practices across 54 countries.</div>
    <div class="trust-logos">
      <div class="trust-logo">Università di Firenze</div>
      <div class="trust-logo mono">Karolinska</div>
      <div class="trust-logo">King's College London</div>
      <div class="trust-logo mono">UCSF Dental</div>
      <div class="trust-logo">Tokyo Medical</div>
      <div class="trust-logo mono">USC Ostrow</div>
    </div>
  </div>
</section>

<!-- ====== FINAL CTA ====== -->
<section class="final" id="final" data-section-type="final">
  <div class="container final-inner">
    <span class="eyebrow">— A private conversation</span>
    <h2 class="display">
      The instrument you've been waiting for<br>is waiting for <em>you</em>.
    </h2>
    <p>
      We don't run a showroom. We schedule a private demonstration in your operatory,
      with a clinical specialist who has placed hundreds of systems like yours.
      Quiet, unhurried, and entirely on your terms.
    </p>
    <div class="final-ctas">
      <a class="btn-primary" href="#">
        Schedule a Private Demo
        <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"></path></svg>
      </a>
      <a class="btn-ghost" href="#">Speak with a Clinical Advisor</a>
    </div>
  </div>
</section>

<!-- ====== FOOTER ====== -->
<footer id="support">
  <div class="container">
    <div class="foot-top">
      <div class="foot-brand">
        <div style="font-family: var(--serif); font-weight: 300; font-size: 40px; letter-spacing: 0.02em; color: var(--ivory); margin-bottom: 8px;">Deka<span style="color: var(--brass); font-style: italic; font-weight: 300;"> ·</span></div>
        <p>Italian-engineered dental lasers, in practice since 1981.</p>
      </div>
      <div class="foot-col">
        <h5>Instruments</h5>
        <ul>
          <li><a href="#">Smart Pro</a></li>
          <li><a href="#">Meridian</a></li>
          <li><a href="#">Lume One</a></li>
          <li><a href="#">Accessories</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h5>Clinical</h5>
        <ul>
          <li><a href="#">Evidence Library</a></li>
          <li><a href="#">Protocols</a></li>
          <li><a href="#">Masterclasses</a></li>
          <li><a href="#">Case Gallery</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h5>Support</h5>
        <ul>
          <li><a href="#">Concierge Service</a></li>
          <li><a href="#">Training</a></li>
          <li><a href="#">Warranty</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h5>Company</h5>
        <ul>
          <li><a href="#">Heritage</a></li>
          <li><a href="#">Atelier</a></li>
          <li><a href="#">Press</a></li>
          <li><a href="#">Careers</a></li>
        </ul>
      </div>
    </div>
    <div class="foot-bot">
      <span>© 2026 Deka Dental · Florence, Italy</span>
      <span>Terms · Privacy · Regulatory · Clinical</span>
    </div>
  </div>
</footer>

<!-- ====== TWEAKS ====== -->
<div id="tweaks-root"></div>

<!-- ms-switcher -->
<div class="ms-switcher" id="ms-switcher" role="region" aria-label="Look switcher">
  <label for="ms-switcher-select">Look</label>
  <select id="ms-switcher-select" aria-label="Select look"></select>
</div>
<!-- /ms-switcher -->
