/* Elegant theme: small, dependency-free behaviours. */
(function () {
    'use strict';

    var header = document.querySelector('.site-header');

    /* ---- Mobile menu ---- */
    var toggle = document.querySelector('[data-nav-toggle]');
    if (toggle && header) {
        var setOpen = function (open) {
            header.classList.toggle('nav-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        };
        toggle.addEventListener('click', function () {
            setOpen(!header.classList.contains('nav-open'));
        });
        // Close the menu after choosing a link, or pressing Escape.
        header.querySelectorAll('.nav a').forEach(function (a) {
            a.addEventListener('click', function () { setOpen(false); });
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') { setOpen(false); }
        });
    }

    /* ---- Portals dropdown: close on outside click ---- */
    var portals = document.querySelector('.portals');
    if (portals) {
        document.addEventListener('click', function (e) {
            if (!portals.contains(e.target)) { portals.removeAttribute('open'); }
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') { portals.removeAttribute('open'); }
        });
    }

    /* ---- Gallery lightbox ---- */
    var dialog = document.querySelector('[data-lightbox-dialog]');
    if (dialog && typeof dialog.showModal === 'function') {
        var img = dialog.querySelector('[data-lightbox-img]');
        var cap = dialog.querySelector('[data-lightbox-caption]');
        document.querySelectorAll('[data-lightbox]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                img.src = btn.getAttribute('data-lightbox');
                img.alt = btn.getAttribute('data-caption') || '';
                cap.textContent = btn.getAttribute('data-caption') || '';
                dialog.showModal();
            });
        });
        // Click on the dark backdrop closes it.
        dialog.addEventListener('click', function (e) {
            if (e.target === dialog) { dialog.close(); }
        });
    } else {
        // Very old browsers: open the photo in a new tab instead.
        document.querySelectorAll('[data-lightbox]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                window.open(btn.getAttribute('data-lightbox'), '_blank', 'noopener');
            });
        });
    }

    /* ---- Contact form: block double submits, focus the result message ---- */
    var form = document.querySelector('[data-contact-form]');
    if (form) {
        form.addEventListener('submit', function () {
            var btn = form.querySelector('[data-submit]');
            if (btn && form.checkValidity()) {
                btn.disabled = true;
                btn.textContent = 'Sending...';
            }
        });
    }
    var notice = document.querySelector('[data-focus-me]');
    if (notice) {
        notice.scrollIntoView({ block: 'center' });
        notice.focus({ preventScroll: true });
    }
})();
