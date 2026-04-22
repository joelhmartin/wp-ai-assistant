/* ==========================================================================
   Deka Homepage — bespoke JS.
     - Darken nav when it overlaps a dark section
     - Reveal elements on scroll
     - Voices (testimonial) slider
   ========================================================================== */
(function () {
    'use strict';

    // ------- Nav darken -----------------------------------------------------
    var nav = document.getElementById('deka-nav');

    function darkSections() {
        return Array.prototype.slice.call(
            document.querySelectorAll('.hero, .flagship, .showcase.dark, .outcomes, .final')
        );
    }

    function fallbackUpdateNav() {
        if (!nav) return;
        var rect = nav.getBoundingClientRect();
        var probeY = rect.height * 0.6;
        var hit = darkSections().some(function (section) {
            var sectionRect = section.getBoundingClientRect();
            return sectionRect.top <= probeY && sectionRect.bottom >= probeY;
        });
        nav.classList.toggle('nav--dark', hit);
    }

    function initNavObserver() {
        if (!nav) return;

        if (!('IntersectionObserver' in window)) {
            window.addEventListener('scroll', fallbackUpdateNav, { passive: true });
            window.addEventListener('resize', fallbackUpdateNav, { passive: true });
            fallbackUpdateNav();
            return;
        }

        var observer = null;
        var activeSections = new Set();
        var resizeTicking = false;

        function syncNavState() {
            nav.classList.toggle('nav--dark', activeSections.size > 0);
        }

        function buildObserver() {
            var sections = darkSections();

            if (observer) observer.disconnect();
            activeSections.clear();

            if (!sections.length) {
                nav.classList.remove('nav--dark');
                return;
            }

            // Observe a narrow band at the nav line instead of recalculating
            // section bounds on every scroll event.
            var probeY = Math.max(Math.round(nav.offsetHeight * 0.6), 1);
            var bandHeight = 2;
            var bottomInset = Math.max(window.innerHeight - probeY - bandHeight, 0);

            observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        activeSections.add(entry.target);
                    } else {
                        activeSections.delete(entry.target);
                    }
                });
                syncNavState();
            }, {
                rootMargin: '-' + probeY + 'px 0px -' + bottomInset + 'px 0px',
                threshold: 0
            });

            sections.forEach(function (section) {
                observer.observe(section);
            });
        }

        function onResize() {
            if (resizeTicking) return;
            resizeTicking = true;
            requestAnimationFrame(function () {
                buildObserver();
                resizeTicking = false;
            });
        }

        window.addEventListener('resize', onResize, { passive: true });
        buildObserver();
    }

    initNavObserver();

    // ------- Reveal on scroll -----------------------------------------------
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add('in');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.deka-home .reveal').forEach(function (el) { io.observe(el); });
    } else {
        document.querySelectorAll('.deka-home .reveal').forEach(function (el) { el.classList.add('in'); });
    }

    // ------- Voices slider --------------------------------------------------
    var track    = document.getElementById('voices-track');
    var dotsEl   = document.getElementById('voices-dots');
    var counter  = document.getElementById('voices-counter');
    var prevBtn  = document.getElementById('voices-prev');
    var nextBtn  = document.getElementById('voices-next');
    var slider   = document.getElementById('voices');
    if (!track || !slider || !window.__DEKA_VOICES) return;

    var voices = window.__DEKA_VOICES;

    track.innerHTML = voices.map(function (v, i) {
        return [
            '<div class="voice-slide' + (i === 0 ? ' active' : '') + '" data-i="' + i + '">',
                '<div class="voice-no">— ', String(i + 1).padStart(2, '0'), '</div>',
                '<div>',
                    '<p class="q">“', v.q, '”</p>',
                    '<div class="who">',
                        '<div class="avatar"></div>',
                        '<div class="meta">',
                            '<div class="n">', v.n, '</div>',
                            '<div class="t">', v.t, '</div>',
                        '</div>',
                    '</div>',
                '</div>',
            '</div>'
        ].join('');
    }).join('');

    if (dotsEl) {
        dotsEl.innerHTML = voices.map(function (_, i) {
            return '<button data-i="' + i + '" class="' + (i === 0 ? 'active' : '') + '" aria-label="Slide ' + (i + 1) + '"></button>';
        }).join('');
    }

    var idx = 0;
    var timer = null;

    function go(i) {
        idx = (i + voices.length) % voices.length;
        track.querySelectorAll('.voice-slide').forEach(function (el) {
            el.classList.toggle('active', +el.dataset.i === idx);
        });
        if (dotsEl) {
            dotsEl.querySelectorAll('button').forEach(function (b) {
                b.classList.toggle('active', +b.dataset.i === idx);
            });
        }
        if (counter) {
            counter.textContent = String(idx + 1).padStart(2, '0') + ' / ' + String(voices.length).padStart(2, '0');
        }
    }

    function start() { stop(); timer = setInterval(function () { go(idx + 1); }, 7000); }
    function stop()  { if (timer) clearInterval(timer); timer = null; }

    if (prevBtn) prevBtn.addEventListener('click', function () { go(idx - 1); start(); });
    if (nextBtn) nextBtn.addEventListener('click', function () { go(idx + 1); start(); });
    if (dotsEl) {
        dotsEl.addEventListener('click', function (e) {
            var b = e.target.closest('button');
            if (!b) return;
            go(+b.dataset.i);
            start();
        });
    }

    slider.addEventListener('mouseenter', stop);
    slider.addEventListener('mouseleave', start);

    go(0);
    start();
})();
