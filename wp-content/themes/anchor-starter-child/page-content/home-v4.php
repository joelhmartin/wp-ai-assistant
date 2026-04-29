<?php
/**
 * Home v4 — pure PHP.
 *
 * Editorial homepage variant 4 (different section structure: stat-band,
 * split, services, reviews, blog, etc.). CSS lives in assets/css/home-v4.css;
 * JS in assets/js/home-v4.js. Both are enqueued by functions.php when this
 * page is the queried slug.
 *
 * @package Anchor_Starter_Child
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<!-- ============ NAV ============ -->
<!-- ============ HERO ============ -->
<section class="hero" data-section-type="hero">
  <div class="container">
    <div class="hero-grid">
      <div>
        <span class="hero-eyebrow"><span class="dot"></span>Italian-engineered since 1981</span>
        <h1 class="hero-title">
          Bringing <em>precision light</em> to modern dentistry.
        </h1>
        <p class="hero-sub">
          For more than four decades, Deka has built the lasers that define the world's most demanding dental practices — instruments of clinical certainty, hand-assembled in Florence.
        </p>

        <div class="hero-bar">
          <div class="hero-bar-cell">
            <div class="icn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 12h6l2-3 2 6 2-3h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </div>
            <div>
              <div class="lbl">Application</div>
              <div class="val">Soft &amp; hard tissue</div>
            </div>
          </div>
          <div class="hero-bar-cell">
            <div class="icn">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 3v18M3 12h18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"></path></svg>
            </div>
            <div>
              <div class="lbl">Wavelength</div>
              <div class="val">Er:YAG · Diode</div>
            </div>
          </div>
          <button class="hero-bar-cta">
            Find your laser
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
          </button>
        </div>
      </div>

      <div class="hero-visual">
        <img src="<?php echo esc_url( anchor_resolve_media( 'product_smartxide' ) ); ?>" alt="Deka SmartXide Ultra Speed">

        <div class="hero-chip tl">
          <div class="icn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"></path></svg>
          </div>
          <div>
            <div class="label">CE / FDA</div>
            <div class="value">All systems certified</div>
          </div>
        </div>

        <div class="hero-chip tr">
          <div class="stars">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
          </div>
          <div>
            <div class="review-num">4.9 / 5</div>
            <div class="review-meta">From 2,840 clinicians</div>
          </div>
        </div>

        <div class="hero-chip br">
          <div class="icn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"></circle><path d="M12 7v5l3 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"></path></svg>
          </div>
          <div>
            <div class="label">Install lead time</div>
            <div class="value">14 business days</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ STAT BAND ============ -->
<section class="stat-band" data-section-type="stat-band">
  <div class="container">
    <div class="stat-band-grid">
      <div class="stat-item">
        <div class="icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M12 22s-7-5-7-12a7 7 0 1114 0c0 7-7 12-7 12z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"></path><circle cx="12" cy="10" r="2.5" stroke="currentColor" stroke-width="1.6"></circle></svg>
        </div>
        <div>
          <div class="val">Florence, Italy</div>
          <div class="lbl">Designed, built and calibrated by hand</div>
        </div>
      </div>
      <div class="stat-item">
        <div class="icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M3 12l3-9 3 6 3-3 3 9 3-6 3 3" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"></path></svg>
        </div>
        <div>
          <div class="val">400+ studies</div>
          <div class="lbl">Peer-reviewed clinical evidence</div>
        </div>
      </div>
      <div class="stat-item">
        <div class="icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.6"></circle><path d="M3 12h18M12 3a14 14 0 010 18M12 3a14 14 0 000 18" stroke="currentColor" stroke-width="1.6"></path></svg>
        </div>
        <div>
          <div class="val">62 countries</div>
          <div class="lbl">30,000+ systems placed worldwide</div>
        </div>
      </div>
      <div class="stat-item">
        <div class="icn">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M4 7h16M4 12h16M4 17h10" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"></path></svg>
        </div>
        <div>
          <div class="val">44 years</div>
          <div class="lbl">Of Italian laser engineering</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SPLIT 1 ============ -->
<section class="split" data-section-type="split">
  <div class="container">
    <div class="split-grid">
      <div class="split-visual">
        <span class="badge">SmartXide² · CO₂</span>
        <img src="<?php echo esc_url( anchor_resolve_media( 'product_smartxide' ) ); ?>" alt="Deka SmartXide² Ultra Speed">
      </div>
      <div class="split-copy">
        <span class="kicker">The flagship platform</span>
        <h2>The dental laser <em>clinicians trust</em> at every wavelength.</h2>
        <p>
          A single instrument, calibrated to four delivery modes, lets you move from gingivectomy to perio surgery to caries removal without changing rooms — or hands.
        </p>
        <div class="split-features">
          <div class="split-feature">
            <span class="check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M4 12l5 5 11-11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            <span>PSD® Pulse Shape Design</span>
          </div>
          <div class="split-feature">
            <span class="check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M4 12l5 5 11-11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            <span>10.6 µm Er:YAG and 980 nm diode</span>
          </div>
          <div class="split-feature">
            <span class="check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M4 12l5 5 11-11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            <span>Tissue-specific protocol library</span>
          </div>
          <div class="split-feature">
            <span class="check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M4 12l5 5 11-11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            <span>Closed-loop power calibration</span>
          </div>
        </div>
        <a href="#" class="split-cta">
          Explore the SmartXide²
          <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ============ FORM SECTION ============ -->
<section class="form-section" data-section-type="form-section">
  <div class="container">
    <div class="form-grid">
      <div class="form-copy">
        <h2>Specify a system <em>for your practice</em>.</h2>
        <p>Tell us how you work and we'll build a configuration around your protocols, room layout and wavelengths — usually back to you within one business day.</p>
        <div class="form-bullets">
          <div class="form-bullet">
            <span class="check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M4 12l5 5 11-11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            Free 60-minute clinical demo
          </div>
          <div class="form-bullet">
            <span class="check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M4 12l5 5 11-11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            White-glove install &amp; calibration
          </div>
          <div class="form-bullet">
            <span class="check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M4 12l5 5 11-11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            Three years parts &amp; tube warranty
          </div>
          <div class="form-bullet">
            <span class="check"><svg width="11" height="11" viewBox="0 0 24 24" fill="none"><path d="M4 12l5 5 11-11" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>
            Continuing education credits
          </div>
        </div>
      </div>
      <form class="form-card" onsubmit="event.preventDefault();">
        <h3>Request a demo</h3>
        <p class="sub">A clinical specialist will reach out within one business day.</p>
        <div class="form-row">
          <div class="form-field">
            <label>First name</label>
            <input type="text" placeholder="Marco">
          </div>
          <div class="form-field">
            <label>Last name</label>
            <input type="text" placeholder="Rossi">
          </div>
        </div>
        <div class="form-row">
          <div class="form-field">
            <label>Practice email</label>
            <input type="email" placeholder="m.rossi@studiodental.it">
          </div>
          <div class="form-field">
            <label>Phone</label>
            <input type="tel" placeholder="+39 …">
          </div>
        </div>
        <div class="form-row full">
          <div class="form-field">
            <label>Application of interest</label>
            <select>
              <option>Soft-tissue surgery</option>
              <option>Endodontics</option>
              <option>Periodontics</option>
              <option>Implantology</option>
              <option>Pediatric dentistry</option>
            </select>
          </div>
        </div>
        <button class="form-submit" type="submit">
          Request demo
          <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
        </button>
      </form>
    </div>
  </div>
</section>

<!-- ============ DARK BAND ============ -->
<section class="dark-band" data-section-type="dark-band">
  <div class="container">
    <div class="dark-band-grid">
      <div>
        <span class="kicker">Why Deka</span>
        <h2>Built to be the most <em>uncompromising</em> instrument in your operatory.</h2>
        <p>
          Every Deka is hand-assembled and calibrated in our Florence atelier — the same workshop where we've been shaping medical lasers since 1981. We engineer to the paper, not the brochure.
        </p>
        <div class="dark-stats">
          <div class="dark-stat">
            <div class="num">44<em>yrs</em></div>
            <div class="lbl">Italian engineering</div>
          </div>
          <div class="dark-stat">
            <div class="num">30k<em>+</em></div>
            <div class="lbl">Systems placed</div>
          </div>
          <div class="dark-stat">
            <div class="num">62</div>
            <div class="lbl">Countries served</div>
          </div>
        </div>
      </div>

      <div class="dark-collage" aria-hidden="true">
        <div class="tile t1"><img src="<?php echo esc_url( anchor_resolve_media( 'product_smartxide' ) ); ?>" alt=""></div>
        <div class="tile t2"><img src="<?php echo esc_url( anchor_resolve_media( 'product_us20d' ) ); ?>" alt=""></div>
        <div class="tile t3"><img src="<?php echo esc_url( anchor_resolve_media( 'product_smartperio' ) ); ?>" alt=""></div>
        <div class="tile t4">
          <span class="quote-mark">"</span>
          <span class="qtext">A Deka in the room is a quieter chair. The patient feels it before I do.</span>
          <span class="qauthor">Dr. Elena Marchetti · Milan</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ SERVICES / PRODUCTS ============ -->
<section class="services" data-section-type="services">
  <div class="container">
    <div class="section-head">
      <span class="kicker">The instrument library</span>
      <h2>Six platforms. <em>One philosophy.</em></h2>
      <p>From compact diode units to flagship CO₂ surgical lasers, every Deka is built to the same Florence standard — and shares the same protocol library and clinical support.</p>
    </div>

    <div class="svc-grid">

      <article class="svc">
        <div class="svc-img">
          <span class="tag">CO₂ · Surgical</span>
          <img class="placeholder-laser" src="<?php echo esc_url( anchor_resolve_media( 'product_smartxide' ) ); ?>" alt="">
        </div>
        <div class="svc-body">
          <h3>SmartXide² Ultra Speed</h3>
          <p>The flagship surgical platform — Er:YAG and CO₂ delivery on a single calibrated chassis. Designed for high-volume operatories.</p>
          <div class="svc-foot">
            <span class="meta">From €54,900</span>
            <span class="arrow">
              <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
            </span>
          </div>
        </div>
      </article>

      <article class="svc">
        <div class="svc-img">
          <span class="tag">Er:YAG · Soft + Hard</span>
          <img class="placeholder-laser" src="<?php echo esc_url( anchor_resolve_media( 'product_us20d' ) ); ?>" alt="">
        </div>
        <div class="svc-body">
          <h3>Smart US20D</h3>
          <p>A compact Er:YAG unit for soft and hard tissue. Articulated arm, dental-specific handpieces, refined closed-loop calibration.</p>
          <div class="svc-foot">
            <span class="meta">From €38,400</span>
            <span class="arrow">
              <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
            </span>
          </div>
        </div>
      </article>

      <article class="svc">
        <div class="svc-img">
          <span class="tag">Diode · Periodontal</span>
          <img class="placeholder-laser" src="<?php echo esc_url( anchor_resolve_media( 'product_smartperio' ) ); ?>" alt="">
        </div>
        <div class="svc-body">
          <h3>SmartPerio</h3>
          <p>Dedicated periodontal diode laser with tissue-specific protocols, ideal for chairside therapy and decontamination.</p>
          <div class="svc-foot">
            <span class="meta">From €19,800</span>
            <span class="arrow">
              <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
            </span>
          </div>
        </div>
      </article>

      <article class="svc">
        <div class="svc-img">
          <span class="tag">Endodontics</span>
          <img class="placeholder-laser" src="<?php echo esc_url( anchor_resolve_media( 'product_us20d' ) ); ?>" alt="">
        </div>
        <div class="svc-body">
          <h3>SmartFile Endo</h3>
          <p>A dedicated endodontic platform with calibrated tip libraries for retreatment, irrigation activation and apical sealing.</p>
          <div class="svc-foot">
            <span class="meta">From €22,600</span>
            <span class="arrow">
              <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
            </span>
          </div>
        </div>
      </article>

      <article class="svc">
        <div class="svc-img">
          <span class="tag">Implant care</span>
          <img class="placeholder-laser" src="<?php echo esc_url( anchor_resolve_media( 'product_smartperio' ) ); ?>" alt="">
        </div>
        <div class="svc-body">
          <h3>Implant Pro Diode</h3>
          <p>Designed for peri-implantitis decontamination and soft-tissue management around healing abutments.</p>
          <div class="svc-foot">
            <span class="meta">From €17,200</span>
            <span class="arrow">
              <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
            </span>
          </div>
        </div>
      </article>

      <article class="svc">
        <div class="svc-img">
          <span class="tag">Pediatric</span>
          <img class="placeholder-laser" src="<?php echo esc_url( anchor_resolve_media( 'product_smartxide' ) ); ?>" alt="">
        </div>
        <div class="svc-body">
          <h3>SmartKid Er:YAG</h3>
          <p>Anesthesia-free protocols for pediatric caries removal and frenectomy, with quieter handpiece acoustics by design.</p>
          <div class="svc-foot">
            <span class="meta">From €31,800</span>
            <span class="arrow">
              <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
            </span>
          </div>
        </div>
      </article>

    </div>
  </div>
</section>

<!-- ============ REVIEWS ============ -->
<section class="reviews" data-section-type="reviews">
  <div class="container">
    <div class="section-head">
      <span class="kicker">From clinicians</span>
      <h2>The <em>honest review</em> from your peers.</h2>
    </div>

    <div class="reviews-grid">
      <div class="review-card">
        <div class="stars">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
        </div>
        <p class="quote">
          The <em>SmartXide²</em> changed how my hygienists think about a perio appointment. The patient feels less, the tissue heals faster, and the chair turns over before lunch.
        </p>
        <div class="author">
          <div class="avatar">EM</div>
          <div>
            <div class="name">Dr. Elena Marchetti</div>
            <div class="role">Studio Marchetti · Milan</div>
          </div>
        </div>
      </div>

      <div class="review-list">
        <div class="review-mini">
          <div class="avatar">JP</div>
          <div class="body">
            <div class="quote">The SmartPerio was paid for in nine months. We've stopped sending soft-tissue cases out entirely.</div>
            <div class="who">Dr. James Park · London</div>
          </div>
          <div class="stars">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
          </div>
        </div>
        <div class="review-mini">
          <div class="avatar">AT</div>
          <div class="body">
            <div class="quote">Calibration arrived dead-on. The clinical training is the best I've seen from any manufacturer in twenty years.</div>
            <div class="who">Dr. Astrid Thorsen · Oslo</div>
          </div>
          <div class="stars">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 7h7l-5.5 4 2 7L12 16l-6.5 4 2-7L2 9h7z"></path></svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ DEDICATED CTA ============ -->
<section class="dedicated" data-section-type="dedicated">
  <div class="container">
    <div class="dedicated-card">
      <div>
        <span class="kicker">Dedicated clinical service</span>
        <h2>The instrument is half the <em>partnership</em>.</h2>
        <p>Every Deka system ships with a clinical specialist on-call: protocol setup, room calibration, staff training and continuing education — for as long as the laser is in your operatory.</p>
        <div class="dedicated-actions">
          <a class="btn-pri" href="#">
            Talk to a specialist
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
          </a>
          <a class="btn-ghost" href="#">Visit Florence</a>
        </div>
      </div>
      <div class="dedicated-visual">
        <img src="<?php echo esc_url( anchor_resolve_media( 'product_us20d' ) ); ?>" alt="Deka Smart US20D">
      </div>
    </div>
  </div>
</section>

<!-- ============ BLOG ============ -->
<section class="blog" data-section-type="blog">
  <div class="container">
    <div class="section-head">
      <span class="kicker">From the journal</span>
      <h2>Notes on light, <em>protocol &amp; practice</em>.</h2>
    </div>

    <div class="blog-grid">
      <article class="post">
        <div class="post-img">
          <span class="date">Apr · 2026</span>
          <svg class="ph-illu" width="120" height="120" viewBox="0 0 120 120" fill="none">
            <circle cx="60" cy="60" r="36" stroke="#2b529f" stroke-width="2"></circle>
            <circle cx="60" cy="60" r="20" stroke="#2b529f" stroke-width="2"></circle>
            <circle cx="60" cy="60" r="6" fill="#2b529f"></circle>
          </svg>
        </div>
        <div class="post-body">
          <div class="meta">Clinical · 6 min read</div>
          <h3>Why pulse shape matters more than peak power.</h3>
          <p>A deep dive into PSD® and how energy delivery — not raw wattage — defines tissue response in soft-tissue surgery.</p>
          <a href="#" class="read">Read essay
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
          </a>
        </div>
      </article>

      <article class="post">
        <div class="post-img">
          <span class="date">Mar · 2026</span>
          <svg class="ph-illu" width="120" height="120" viewBox="0 0 120 120" fill="none">
            <path d="M20 80 L40 50 L60 70 L80 30 L100 60" stroke="#2b529f" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"></path>
            <circle cx="40" cy="50" r="3" fill="#2b529f"></circle>
            <circle cx="80" cy="30" r="3" fill="#2b529f"></circle>
          </svg>
        </div>
        <div class="post-body">
          <div class="meta">Practice · 4 min read</div>
          <h3>Costing a laser the way the patient costs a chair.</h3>
          <p>The honest unit economics of a Deka in a four-op practice — with a worked example from a partner studio in Bologna.</p>
          <a href="#" class="read">Read essay
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
          </a>
        </div>
      </article>

      <article class="post">
        <div class="post-img">
          <span class="date">Feb · 2026</span>
          <svg class="ph-illu" width="120" height="120" viewBox="0 0 120 120" fill="none">
            <rect x="20" y="30" width="80" height="60" rx="6" stroke="#2b529f" stroke-width="2"></rect>
            <path d="M30 50h60M30 60h40M30 70h50" stroke="#2b529f" stroke-width="2" stroke-linecap="round"></path>
          </svg>
        </div>
        <div class="post-body">
          <div class="meta">Education · 8 min read</div>
          <h3>The Florence Method: a year inside the Deka clinical academy.</h3>
          <p>Inside the residency program where dentists from 22 countries learn protocol-first laser dentistry — by the people who built the lasers.</p>
          <a href="#" class="read">Read essay
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
          </a>
        </div>
      </article>
    </div>
  </div>
</section>

<!-- ============ FINAL CTA ============ -->
<section class="final" data-section-type="final">
  <div class="container">
    <div class="final-card">
      <div>
        <h2>Become the next <em>Deka practice</em>.</h2>
        <p>Schedule a clinical demo or visit our atelier in Florence. Either way, you'll meet the lasers — and the people who hand-build them — before you make a decision.</p>
        <div class="actions">
          <a class="btn-pri" href="#">
            Request a demo
            <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.5"></path></svg>
          </a>
          <a class="btn-ghost" href="#">Download the catalogue</a>
        </div>
      </div>
      <div class="final-visual">
        <img src="<?php echo esc_url( anchor_resolve_media( 'product_smartxide' ) ); ?>" alt="Deka SmartXide² Ultra Speed">
      </div>
    </div>
  </div>
</section>

<!-- ============ FOOTER ============ -->
<footer>
  <div class="container">
    <div class="foot-grid">
      <div class="foot-brand">
        <div class="logo">
          <img src="<?php echo esc_url( anchor_resolve_media( 'deka_logo_white' ) ); ?>" alt="Deka Dental Lasers" style="height:38px;width:auto;display:block;">
        </div>
        <p>Italian-engineered dental lasers, in practice since 1981. Designed, built and calibrated by hand outside Florence.</p>
      </div>
      <div class="foot-col">
        <h4>Products</h4>
        <ul>
          <li><a href="#">SmartXide²</a></li>
          <li><a href="#">Smart US20D</a></li>
          <li><a href="#">SmartPerio</a></li>
          <li><a href="#">SmartFile Endo</a></li>
          <li><a href="#">Implant Pro</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h4>Clinical</h4>
        <ul>
          <li><a href="#">Protocol library</a></li>
          <li><a href="#">Continuing education</a></li>
          <li><a href="#">Florence Method</a></li>
          <li><a href="#">Studies &amp; papers</a></li>
        </ul>
      </div>
      <div class="foot-col">
        <h4>Company</h4>
        <ul>
          <li><a href="#">About Deka</a></li>
          <li><a href="#">Atelier visits</a></li>
          <li><a href="#">Distributors</a></li>
          <li><a href="#">Press</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
    <div class="foot-bottom">
      <span>© 2026 Deka M.E.L.A. Srl · Florence, Italy</span>
      <span>Privacy · Terms · Cookies</span>
    </div>
  </div>
</footer>

<!-- ms-switcher -->
<div class="ms-switcher" id="ms-switcher" role="region" aria-label="Look switcher">
  <label for="ms-switcher-select">Look</label>
  <select id="ms-switcher-select" aria-label="Select look"></select>
</div>
<!-- /ms-switcher -->
