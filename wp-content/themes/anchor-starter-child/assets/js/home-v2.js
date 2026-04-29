/* === script block 0 === */
// Nav darken over dark sections
  const nav = document.getElementById('nav');
  const darkSections = () => [...document.querySelectorAll('.hero')];
  function updateNav() {
    const n = nav.getBoundingClientRect();
    const probeY = n.height * 0.6;
    const hit = darkSections().some(s => {
      const r = s.getBoundingClientRect();
      return r.top <= probeY && r.bottom >= probeY;
    });
    nav.classList.toggle('nav--dark', hit);
  }
  window.addEventListener('scroll', updateNav, { passive: true });
  window.addEventListener('resize', updateNav);
  updateNav();

  // Reveal on scroll
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

  // Build logo in nav — using static PNG variants

  // ——— Tweaks ———
  const TWEAK_DEFAULTS = /*EDITMODE-BEGIN*/{
    "palette": "navy",
    "density": "tight"
  }/*EDITMODE-END*/;

  let tweaksOn = false;
  let state = { ...TWEAK_DEFAULTS };
  const applyState = () => {
    document.body.dataset.palette = state.palette;
    document.body.dataset.density = state.density;
  };
  applyState();

  function renderTweaks() {
    const root = document.getElementById('tweaks-root');
    if (!tweaksOn) { root.innerHTML = ''; return; }
    root.innerHTML = `
      <div class="tw-panel" role="dialog" aria-label="Tweaks">
        <h6>Tweaks</h6>
        <div style="font-family: var(--mono); font-size: 10px; letter-spacing: 0.18em; text-transform: uppercase; color: rgba(4,5,65,0.5); margin-bottom: 6px;">Palette</div>
        <div class="tw-row">
          <button class="tw-btn ${state.palette==='navy'?'active':''}" data-set="palette" data-v="navy">Navy · Ivory</button>
          <button class="tw-btn ${state.palette==='warm'?'active':''}" data-set="palette" data-v="warm">Cognac · Cream</button>
          <button class="tw-btn ${state.palette==='noir'?'active':''}" data-set="palette" data-v="noir">Noir · Bone</button>
        </div>
        <div style="font-family: var(--mono); font-size: 10px; letter-spacing: 0.18em; text-transform: uppercase; color: rgba(4,5,65,0.5); margin-bottom: 6px;">Density</div>
        <div class="tw-row">
          <button class="tw-btn ${state.density==='tight'?'active':''}" data-set="density" data-v="tight">Tight</button>
          <button class="tw-btn ${state.density==='default'?'active':''}" data-set="density" data-v="default">Default</button>
          <button class="tw-btn ${state.density==='airy'?'active':''}" data-set="density" data-v="airy">Airy</button>
        </div>
      </div>
    `;
    root.querySelectorAll('.tw-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const k = btn.dataset.set, v = btn.dataset.v;
        state = { ...state, [k]: v };
        applyState();
        renderTweaks();
        try { window.parent.postMessage({ type: '__edit_mode_set_keys', edits: { [k]: v } }, '*'); } catch(e){}
      });
    });
  }

  window.addEventListener('message', (e) => {
    const d = e.data || {};
    if (d.type === '__activate_edit_mode')  { tweaksOn = true; renderTweaks(); }
    if (d.type === '__deactivate_edit_mode') { tweaksOn = false; renderTweaks(); }
  });
  try { window.parent.postMessage({ type: '__edit_mode_available' }, '*'); } catch(e){}

  // ——— Voices slider ———
  (function initVoices() {
    const voices = [
      { q: 'Smart Pro changed how I schedule. Procedures I used to staff for an hour now close in twenty minutes, and the <em>recoveries speak for themselves</em>.', n: 'Dr. Elena Marchetti, DDS', t: 'Studio Marchetti · Milan' },
      { q: 'The Nd:YAG pulse shape is unlike anything in my operatory. It is an instrument that <em>behaves the way you think</em> — which is the only compliment that matters.', n: 'Dr. Hiroshi Tanaka, DMD, PhD', t: 'Tokyo Advanced Periodontics' },
      { q: 'The SmartXide is the quietest surgical decision in my practice. Patients ask if we\'ve <em>already started</em> — we\'ve already finished.', n: 'Dr. Sofia Reyes, DDS, MS', t: 'Reyes Oral Surgery · Madrid' },
      { q: 'I\'ve placed every major laser in my thirty years. Deka is the one I put in my own mother\'s mouth.', n: 'Dr. Margaret Chen, DDS, FACD', t: 'Chen Dental Arts · San Francisco' },
    ];
    const track = document.getElementById('voices-track');
    const dotsEl = document.getElementById('voices-dots');
    const counterEl = document.getElementById('voices-counter');
    const prev = document.getElementById('voices-prev');
    const next = document.getElementById('voices-next');
    if (!track) return;

    track.innerHTML = voices.map((v, i) => `
      <div class="voice-slide${i===0?' active':''}" data-i="${i}">
        <div class="voice-no">— ${String(i+1).padStart(2,'0')}</div>
        <div>
          <p class="q">“${v.q}”</p>
          <div class="who">
            <div class="avatar"></div>
            <div class="meta">
              <div class="n">${v.n}</div>
              <div class="t">${v.t}</div>
            </div>
          </div>
        </div>
      </div>
    `).join('');

    dotsEl.innerHTML = voices.map((_, i) => `<button data-i="${i}" class="${i===0?'active':''}" aria-label="Slide ${i+1}"></button>`).join('');

    let idx = 0;
    let timer = null;
    function go(i) {
      idx = (i + voices.length) % voices.length;
      track.querySelectorAll('.voice-slide').forEach(el => el.classList.toggle('active', +el.dataset.i === idx));
      dotsEl.querySelectorAll('button').forEach(b => b.classList.toggle('active', +b.dataset.i === idx));
      counterEl.textContent = String(idx+1).padStart(2,'0') + ' / ' + String(voices.length).padStart(2,'0');
    }
    function start() { stop(); timer = setInterval(() => go(idx+1), 7000); }
    function stop() { if (timer) clearInterval(timer); timer = null; }

    prev.addEventListener('click', () => { go(idx-1); start(); });
    next.addEventListener('click', () => { go(idx+1); start(); });
    dotsEl.addEventListener('click', (e) => {
      const b = e.target.closest('button'); if (!b) return; go(+b.dataset.i); start();
    });
    // pause on hover
    const slider = document.getElementById('voices');
    slider.addEventListener('mouseenter', stop);
    slider.addEventListener('mouseleave', start);
    go(0); start();
  })();

/* === script block 1 === */
(function () {
  function init() {
    var nav = document.querySelector('nav.nav');
    if (!nav || nav.dataset.msPatched === '1') return;
    nav.dataset.msPatched = '1';

    var navRow = nav.querySelector('.nav-row');

    // --- Super header (phone + shop + message) ------------------------------
    var phoneSVG = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>';
    var cartSVG = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.7 13.5a2 2 0 0 0 2 1.5h9.7a2 2 0 0 0 2-1.6L23 6H6"/></svg>';
    var chatSVG = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/></svg>';

    var sh = document.createElement('div');
    sh.className = 'ms-superheader';
    sh.innerHTML =
      '<a class="ms-sh-item" href="tel:+390558826807" aria-label="Call Deka">' + phoneSVG + '<span>+39 055 882 6807</span></a>' +
      '<a class="ms-sh-item" href="#shop" aria-label="Shop">' + cartSVG + '<span>Shop</span></a>' +
      '<a class="ms-sh-item" href="#contact" aria-label="Message">' + chatSVG + '<span>Message</span></a>';
    nav.insertBefore(sh, nav.firstChild);

    if (!navRow) return;

    // --- Hamburger button ----------------------------------------------------
    var burger = document.createElement('button');
    burger.type = 'button';
    burger.className = 'ms-burger';
    burger.setAttribute('aria-label', 'Open menu');
    burger.setAttribute('aria-expanded', 'false');
    burger.innerHTML = '<span></span><span></span><span></span>';
    navRow.appendChild(burger);

    // --- Drawer --------------------------------------------------------------
    var drawer = document.createElement('div');
    drawer.className = 'ms-drawer';
    drawer.setAttribute('aria-hidden', 'true');

    // Pull links from existing nav
    var linkEls = navRow.querySelectorAll('.nav-links .nav-link');
    var rightLinkEls = navRow.querySelectorAll('.nav-right .nav-link');
    var ctaEl = navRow.querySelector('.nav-right .nav-cta');

    var linksHTML = '';
    linkEls.forEach(function (a) {
      linksHTML +=
        '<a class="ms-drawer-link" href="' + (a.getAttribute('href') || '#') + '">' +
        (a.textContent || '').trim().replace(/\s+/g, ' ') +
        '</a>';
    });
    rightLinkEls.forEach(function (a) {
      linksHTML +=
        '<a class="ms-drawer-link" href="' + (a.getAttribute('href') || '#') + '">' +
        (a.textContent || '').trim().replace(/\s+/g, ' ') +
        '</a>';
    });
    if (ctaEl) {
      linksHTML +=
        '<a class="ms-drawer-link ms-drawer-cta" href="' + (ctaEl.getAttribute('href') || '#') + '">' +
        (ctaEl.textContent || '').trim().replace(/\s+/g, ' ') +
        '</a>';
    }

    drawer.innerHTML =
      '<button class="ms-drawer-close" type="button" aria-label="Close menu">&times;</button>' +
      '<div class="ms-drawer-inner">' + linksHTML + '</div>';
    document.body.appendChild(drawer);

    function openDrawer() {
      drawer.classList.add('open');
      drawer.setAttribute('aria-hidden', 'false');
      burger.setAttribute('aria-expanded', 'true');
      document.body.classList.add('ms-drawer-open');
    }
    function closeDrawer() {
      drawer.classList.remove('open');
      drawer.setAttribute('aria-hidden', 'true');
      burger.setAttribute('aria-expanded', 'false');
      document.body.classList.remove('ms-drawer-open');
    }

    burger.addEventListener('click', function () {
      if (drawer.classList.contains('open')) closeDrawer(); else openDrawer();
    });
    drawer.querySelector('.ms-drawer-close').addEventListener('click', closeDrawer);
    drawer.addEventListener('click', function (e) {
      if (e.target === drawer) closeDrawer();
    });
    drawer.querySelectorAll('.ms-drawer-link').forEach(function (a) {
      a.addEventListener('click', closeDrawer);
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && drawer.classList.contains('open')) closeDrawer();
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})();

