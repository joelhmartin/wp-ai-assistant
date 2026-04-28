<?php
/**
 * Home (front page) — pure PHP.
 *
 * Edit HTML directly. Add sections, video backgrounds, shortcodes,
 * or any HTML element without constraint. Media keys resolve via
 * anchor_resolve_media(). Anchor Tools shortcodes via do_shortcode().
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Resolve product image URLs once.
$img_us20d      = anchor_resolve_media( 'product_us20d' );
$img_smartxide  = anchor_resolve_media( 'product_smartxide' );
$img_smartperio = anchor_resolve_media( 'product_smartperio' );

// Voices data for the JS testimonial slider.
$voices_raw = [
    [
        'q' => 'SmartXide changed how I schedule. Procedures I used to staff for an hour now close in twenty minutes, and the <em>recoveries speak for themselves</em>.',
        'n' => 'Dr. Elena Marchetti, DDS',
        't' => 'Studio Marchetti · Milan',
    ],
    [
        'q' => 'The Nd:YAG pulse shape is unlike anything in my operatory. It is an instrument that <em>behaves the way you think</em> — which is the only compliment that matters.',
        'n' => 'Dr. Hiroshi Tanaka, DMD, PhD',
        't' => 'Tokyo Advanced Periodontics',
    ],
    [
        'q' => 'The SmartXide is the quietest surgical decision in my practice. Patients ask if we\'ve <em>already started</em> — we\'ve already finished.',
        'n' => 'Dr. Sofia Reyes, DDS, MS',
        't' => 'Reyes Oral Surgery · Madrid',
    ],
    [
        'q' => 'I\'ve placed every major laser in my thirty years. DEKA is the one I put in my own mother\'s mouth.',
        'n' => 'Dr. Margaret Chen, DDS, FACD',
        't' => 'Chen Dental Arts · San Francisco',
    ],
];

$safe_voices = array_map( function( $v ) {
    return [
        'q' => wp_kses( $v['q'], [ 'em' => [] ] ),
        'n' => wp_strip_all_tags( $v['n'] ),
        't' => wp_strip_all_tags( $v['t'] ),
    ];
}, $voices_raw );
$voices_count = count( $safe_voices );
?>

<!-- 01 — Hero -->
<header class="hero" id="top" data-section-type="deka_hero">
    <div class="hero-grain"></div>
    <div class="hero-beam b1"></div>
    <div class="hero-beam b2"></div>

    <div class="container hero-inner">
        <div class="hero-meta">
            <div class="mono">Deka · Est. 1981 · Florence, Italy</div>
            <div class="mono">No. 01 / Homepage</div>
        </div>

        <div>
            <h1 class="display hero-headline" style="color: var(--deka-ivory);">
                <span class="line"><span>The standarg</span></span>
                <span class="line"><span>of <em>precision light</em></span></span>
                <span class="line"><span>in modern dentistry.</span></span>
            </h1>

            <div class="hero-foot">
                <p class="hero-sub">For more than four decades, DEKA has engineered the lasers that define the world's most demanding dental practices — instruments of clinical certainty, crafted in Florence.</p>

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

                <div>
                    <a class="hero-cta" href="#products">Explore the Instruments
                        <svg class="arrow" viewBox="0 0 24 12" fill="none" aria-hidden="true"><path d="M0 6h22m0 0l-6-5m6 5l-6 5" stroke="currentColor" stroke-width="1.2"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-scroll">
        <span>Scroll</span>
        <div class="tick"></div>
    </div>
</header>

<!-- 02 — Manifesto -->
<section class="manifesto" data-section-type="deka_manifesto">
    <div class="container">
        <div class="section-head">
            <div class="section-index">— 01</div>
            <div class="section-title">Manifesto</div>
            <div class="section-label">On light, on certainty</div>
        </div>

        <div class="manifesto-body">
            <p class="manifesto-quote reveal">
                We believe the highest form of care is the one the patient never feels arrive. A laser, held in a steady hand, becomes something closer to <em>intention</em> — a quieter procedure, a cleaner margin, a shorter recovery. This is the clinical language DEKA has spent a generation perfecting.
            </p>
        </div>

        <div class="manifesto-foot">
            <div class="manifesto-col reveal">
                <h4>Built in Florence</h4>
                <p>Every DEKA system is engineered, assembled, and calibrated by hand in our atelier outside Florence — the same workshop that has been shaping medical lasers since 1981.</p>
            </div>
            <div class="manifesto-col reveal">
                <h4>Evidence, not adjectives</h4>
                <p>More than 400 peer-reviewed papers inform our wavelengths, pulse shapes, and energy deliveries. We engineer to the paper, not the brochure.</p>
            </div>
            <div class="manifesto-col reveal">
                <h4>A partner to the practice</h4>
                <p>Our clinical team integrates with yours: training, protocols, tissue-specific libraries, and ongoing education — so the instrument pays itself forward from day one.</p>
            </div>
        </div>
    </div>
</section>

<!-- 03 — Capabilities -->
<section class="capabilities" id="technology" data-section-type="deka_capabilities">
    <div class="container">
        <div class="section-head">
            <div class="section-index">— 02</div>
            <div class="section-title">What DEKA Changes</div>
            <div class="section-label">Benefits · Innovation · Precision · Outcomes</div>
        </div>

        <div class="cap-head">
            <h2 class="display reveal">Four instruments of <em>clinical certainty</em>.</h2>
            <p class="reveal">Every DEKA platform is organised around the same quiet promise — that the right wavelength, delivered with the right discipline, changes what dentistry feels like. Here is how that promise shows up, chairside.</p>
        </div>

        <div class="cap-grid">
            <div class="cap-card reveal">
                <div>
                    <div class="cap-num">01</div>
                    <div class="cap-kicker">Benefit</div>
                </div>
                <div class="cap-body">
                    <h3>A calmer chair, a faster morning.</h3>
                    <p>Near-silent procedures. Less bleeding, fewer sutures, meaningfully shorter recoveries — patients leave comfortable, and they remember it.</p>
                </div>
            </div>
            <div class="cap-card reveal">
                <div>
                    <div class="cap-num">02</div>
                    <div class="cap-kicker">Innovation</div>
                </div>
                <div class="cap-body">
                    <h3>Pulse architectures, perfected.</h3>
                    <p>Proprietary Pulsed Solid State™ and QSP™ emissions give clinicians expressive control over energy — tissue-specific, not one-size.</p>
                </div>
            </div>
            <div class="cap-card reveal">
                <div>
                    <div class="cap-num">03</div>
                    <div class="cap-kicker">Precision</div>
                </div>
                <div class="cap-body">
                    <h3>A steadier hand, engineered in.</h3>
                    <p>Sub-micron delivery, active thermal management, and adaptive feedback — the instrument corrects before you notice the correction.</p>
                </div>
            </div>
            <div class="cap-card reveal">
                <div>
                    <div class="cap-num">04</div>
                    <div class="cap-kicker">Outcome</div>
                </div>
                <div class="cap-body">
                    <h3>Results your patients refer.</h3>
                    <p>Predictable margins, cleaner biopsy sites, documented healing curves — and a waiting room that fills itself, because the chair speaks for you.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 04 — Lineup -->
<section class="lineup" id="products" data-section-type="deka_lineup">
    <div class="container">
        <div class="section-head">
            <div class="section-index">— 03</div>
            <div class="section-title">The Collection</div>
            <div class="section-label">Three instruments, one standard</div>
        </div>

        <div class="lineup-grid">
            <a class="product" href="/shop/us-20d/">
                <div class="product-visual">
                    <div class="shape">
                        <div class="ring"></div>
                        <div class="ring-in"></div>
                    </div>
                    <?php if ( $img_us20d ) : ?>
                        <div class="pv-photo"><img src="<?php echo esc_url( $img_us20d ); ?>" alt="DEKA US-20D CO2 laser" loading="lazy"/></div>
                    <?php endif; ?>
                    <div class="tag">US-20D</div>
                    <div class="caption">
                        <span>CO₂ · 10,600 nm</span>
                        <span>Compact</span>
                    </div>
                </div>
                <h4><span class="sm">CO₂ · 10,600 nm</span>US-20D</h4>
                <p>The compact CO₂ instrument. An articulated arm, a mobile chassis, and the cleanest soft-tissue incision in the operatory — ready to move chair-to-chair.</p>
                <div class="product-meta">
                    <span>Soft Tissue · CO₂</span>
                    <span class="arrow">→</span>
                </div>
            </a>

            <a class="product" href="/shop/smartxide-ultraspeed2/">
                <div class="product-visual">
                    <div class="shape">
                        <div class="ring"></div>
                        <div class="ring-in"></div>
                    </div>
                    <?php if ( $img_smartxide ) : ?>
                        <div class="pv-photo"><img src="<?php echo esc_url( $img_smartxide ); ?>" alt="DEKA SmartXide Ultraspeed 2 CO2 laser" loading="lazy"/></div>
                    <?php endif; ?>
                    <div class="tag">SmartXide²</div>
                    <div class="caption">
                        <span>CO₂ · Pulse Shape Design</span>
                        <span>Flagship</span>
                    </div>
                </div>
                <h4><span class="sm">CO₂ · PSD™</span>SmartXide Ultraspeed 2</h4>
                <p>The surgical flagship. Proprietary Pulse Shape Design delivers energy the tissue doesn't feel arrive — and a healing curve your patients will describe for you.</p>
                <div class="product-meta">
                    <span>Surgical · CO₂</span>
                    <span class="arrow">→</span>
                </div>
            </a>

            <a class="product" href="/shop/smartperio/">
                <div class="product-visual">
                    <div class="shape">
                        <div class="ring"></div>
                        <div class="ring-in"></div>
                    </div>
                    <?php if ( $img_smartperio ) : ?>
                        <div class="pv-photo"><img src="<?php echo esc_url( $img_smartperio ); ?>" alt="DEKA SmartPerio Nd:YAG laser" loading="lazy"/></div>
                    <?php endif; ?>
                    <div class="tag">SmartPerio</div>
                    <div class="caption">
                        <span>Nd:YAG · 1064 nm</span>
                        <span>Periodontal</span>
                    </div>
                </div>
                <h4><span class="sm">Nd:YAG · 1064 nm</span>SmartPerio</h4>
                <p>The periodontal specialist. A pulsed Nd:YAG beam that reaches depth, sterilises pockets, and leaves the soft tissue above exactly as you found it.</p>
                <div class="product-meta">
                    <span>Perio · Endo</span>
                    <span class="arrow">→</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- 05 — Flagship (SmartPerio) -->
<section class="flagship" data-section-type="deka_flagship">
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
                <?php if ( $img_smartperio ) : ?>
                    <div class="fv-photo"><img src="<?php echo esc_url( $img_smartperio ); ?>" alt="DEKA SmartPerio Nd:YAG laser" loading="lazy"/></div>
                <?php endif; ?>
                <div class="fv-ticker">
                    <span>λ · 1064 nm</span>
                    <span>Made in Florence</span>
                </div>
            </div>

            <div class="flagship-content">
                <h3 class="display reveal">SmartPerio.<br>The <em>periodontal</em><br>standard.</h3>
                <p class="flagship-lede reveal">A pulsed Nd:YAG instrument built for the pocket, the furcation, and the quiet decisions that define a periodontal practice — sterilising depth without surrendering the soft tissue above.</p>

                <div class="flagship-specs reveal">
                    <div class="spec"><div class="k">Wavelength</div><div class="v">1064<sup>nm</sup></div></div>
                    <div class="spec"><div class="k">Peak power</div><div class="v">7<sup>W</sup></div></div>
                    <div class="spec"><div class="k">Pulse</div><div class="v">Free-running · Pulsed</div></div>
                    <div class="spec"><div class="k">Delivery</div><div class="v">Fiber · 300 µm</div></div>
                </div>

                <div class="flagship-ctas reveal">
                    <a class="btn-primary" href="#final">Schedule a Private Demo
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
                    </a>
                    <a class="btn-ghost" href="#">Download the Clinical Dossier</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 06 — Showcase: US-20D (light, visual left) -->
<section class="showcase" data-section-type="deka_showcase">
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
                <?php if ( $img_us20d ) : ?>
                    <div class="sc-photo"><img src="<?php echo esc_url( $img_us20d ); ?>" alt="DEKA US-20D CO2 dental laser" loading="lazy"/></div>
                <?php endif; ?>
                <div class="sc-ticker">
                    <span>λ · 10,600 nm</span>
                    <span>Articulated arm</span>
                </div>
            </div>

            <div class="sc-content">
                <div class="kicker reveal">— The compact instrument</div>
                <h3 class="display reveal">A <em>CO₂ workhorse</em>,<br>refined to the millimetre.</h3>
                <p class="sc-lede reveal">Compact enough to move between operatories, serious enough to carry the surgical day. The US-20D is the DEKA most dental practices meet first — and keep for life.</p>

                <div class="sc-points reveal">
                    <div class="p"><div class="k">Wavelength</div><div class="v">10,600<sup>nm</sup></div></div>
                    <div class="p"><div class="k">Max power</div><div class="v">20<sup>W</sup></div></div>
                    <div class="p"><div class="k">Delivery</div><div class="v">7-joint arm</div></div>
                    <div class="p"><div class="k">Modes</div><div class="v">CW · Pulsed · Super-Pulsed</div></div>
                </div>

                <div class="sc-ctas reveal">
                    <a class="btn-dark" href="#final">Request the US-20D Dossier
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
                    </a>
                    <a class="btn-light-ghost" href="#">See indications</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 07 — Showcase: SmartXide Ultraspeed 2 (dark, visual right) -->
<section class="showcase dark flip" data-section-type="deka_showcase">
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
                <p class="sc-lede reveal">The SmartXide Ultraspeed 2 is our proprietary PSD™ CO₂ platform. Energy shaped to the tissue, not the tissue shaped to the beam — with thermal confinement so disciplined the procedure ends before the patient notices it began.</p>

                <div class="sc-points reveal">
                    <div class="p"><div class="k">Wavelength</div><div class="v">10,600<sup>nm</sup></div></div>
                    <div class="p"><div class="k">Max power</div><div class="v">30<sup>W</sup></div></div>
                    <div class="p"><div class="k">Signature</div><div class="v">PSD™ · SmartPulse™</div></div>
                    <div class="p"><div class="k">Indications</div><div class="v">Surgical · Peri-implant</div></div>
                </div>

                <div class="sc-ctas reveal">
                    <a class="btn-primary" href="#final">Schedule a SX² Demo
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
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
                <?php if ( $img_smartxide ) : ?>
                    <div class="sc-photo"><img src="<?php echo esc_url( $img_smartxide ); ?>" alt="DEKA SmartXide Ultraspeed 2 CO2 dental laser" loading="lazy"/></div>
                <?php endif; ?>
                <div class="sc-ticker">
                    <span>λ · 10,600 nm · PSD™</span>
                    <span>Flagship</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 08 — Outcomes -->
<section class="outcomes" id="outcomes" data-section-type="deka_outcomes">
    <div class="container">
        <div class="section-head">
            <div class="section-index">— 06</div>
            <div class="section-title">Evidence</div>
            <div class="section-label">Measured, not marketed</div>
        </div>

        <div class="outcomes-wrap">
            <div class="outcomes-lead reveal">
                <h2 class="display">The quiet math of a <em>superior</em> procedure.</h2>
                <p>Every number below comes from peer-reviewed clinical literature published between 2016 and 2025. If a claim isn't documented, it isn't printed.</p>
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
                    <div class="lbl">Clinician reliability score across 1,200+ SmartXide cases</div>
                </div>
                <div class="metric">
                    <div class="num">+34<sup>%</sup></div>
                    <div class="lbl">Practice case acceptance when laser is offered first</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 09 — Voices -->
<section class="voices" id="clinicians" data-section-type="deka_voices">
    <div class="container">
        <div class="section-head">
            <div class="section-index">— 07</div>
            <div class="section-title">Clinicians</div>
            <div class="section-label">In their own words</div>
        </div>

        <div class="voices-slider reveal" id="voices">
            <div class="voices-track" id="voices-track"></div>

            <div class="voices-controls">
                <div class="voices-dots" id="voices-dots"></div>
                <div class="voices-counter" id="voices-counter">01 / <?php echo esc_html( str_pad( (string) max( 1, $voices_count ), 2, '0', STR_PAD_LEFT ) ); ?></div>
                <div class="voices-arrows">
                    <button id="voices-prev" aria-label="Previous">
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M13 5H1m0 0l4-4m-4 4l4 4" stroke="currentColor" stroke-width="1.2"/></svg>
                    </button>
                    <button id="voices-next" aria-label="Next">
                        <svg width="14" height="10" viewBox="0 0 14 10" fill="none"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>window.__DEKA_VOICES = <?php echo wp_json_encode( $safe_voices, JSON_HEX_TAG ); ?>;</script>
</section>

<!-- 10 — Trust -->
<section class="trust" data-section-type="deka_trust">
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

<!-- 11 — Final CTA -->
<section class="final" id="final" data-section-type="deka_final">
    <div class="container final-inner">
        <span class="eyebrow">— A private conversation</span>
        <h2 class="display">The instrument you've been waiting for<br>is waiting for <em>you</em>.</h2>
        <p>We don't run a showroom. We schedule a private demonstration in your operatory, with a clinical specialist who has placed hundreds of systems like yours. Quiet, unhurried, and entirely on your terms.</p>
        <div class="final-ctas">
            <a class="btn-primary" href="/contact/">Schedule a Private Demo
                <svg width="14" height="10" viewBox="0 0 14 10" fill="none" aria-hidden="true"><path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-width="1.2"/></svg>
            </a>
            <a class="btn-ghost" href="/contact/">Speak with a Clinical Advisor</a>
        </div>
    </div>
</section>
