/* === script block 0 === */
// Reveal on scroll
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('in'); });
  }, { threshold: 0.12 });
  document.querySelectorAll('.reveal').forEach(el => io.observe(el));

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

