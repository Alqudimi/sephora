// SEPHORA UAE — application JS
// Global helpers for cart, wishlist, and page interactions.

// Announce helper (toast)
window.sephoraToast = function (message, type = 'success') {
    let toast = document.getElementById('sephora-global-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'sephora-global-toast';
        toast.className = 'fixed top-24 right-4 z-[9999] bg-black text-white text-xs font-bold uppercase tracking-wider px-5 py-3 rounded shadow-2xl transition-all duration-300 opacity-0 translate-y-2';
        document.body.appendChild(toast);
    }
    toast.textContent = message;
    toast.classList.remove('opacity-0', 'translate-y-2');
    clearTimeout(toast._t);
    toast._t = setTimeout(() => toast.classList.add('opacity-0', 'translate-y-2'), 2600);
};

// Update every counter badge for a given selector (header bag/wishlist icons).
function updateCounterBadges(selector, count) {
    const value = Number(count) || 0;
    document.querySelectorAll(selector).forEach(function (badge) {
        badge.textContent = value;
        badge.classList.toggle('hidden', value === 0);
    });
}

// Mobile navigation drawer
(function () {
    const toggle = document.querySelector('[data-mobile-menu-toggle]');
    const menu = document.querySelector('[data-mobile-menu]');
    if (!toggle || !menu) return;

    const panel = menu.querySelector('[data-mobile-menu-panel]');
    const backdrop = menu.querySelector('[data-mobile-menu-backdrop]');
    const closeTargets = menu.querySelectorAll('[data-mobile-menu-close]');
    let isOpen = false;

    function setOpen(open) {
        isOpen = open;
        menu.classList.toggle('invisible', !open);
        menu.setAttribute('aria-hidden', open ? 'false' : 'true');
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        document.body.classList.toggle('overflow-hidden', open);

        if (panel) {
            panel.classList.toggle('-translate-x-full', !open);
            panel.classList.toggle('translate-x-0', open);
        }
        if (backdrop) backdrop.classList.toggle('opacity-0', !open);
    }

    function closeMenu() {
        if (!isOpen) return;
        const hadFocus = menu.contains(document.activeElement);
        setOpen(false);
        if (hadFocus) toggle.focus();
    }

    toggle.addEventListener('click', function () {
        setOpen(!isOpen);
    });

    closeTargets.forEach(function (el) {
        el.addEventListener('click', closeMenu);
    });

    // Close after choosing a destination.
    menu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', function () {
            setOpen(false);
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeMenu();
    });

    // Close when tapping outside the panel.
    document.addEventListener('click', function (event) {
        if (!isOpen) return;
        if (!menu.contains(event.target) && !toggle.contains(event.target)) closeMenu();
    });
})();

// Generic carousel: [data-carousel] with slides, arrows, dots and autoplay.
document.querySelectorAll('[data-carousel]').forEach(function (carousel) {
    const slides = Array.from(carousel.querySelectorAll('[data-carousel-slide]'));
    if (slides.length < 2) return;

    const dots = Array.from(carousel.querySelectorAll('[data-carousel-dot]'));
    const prevButton = carousel.querySelector('[data-carousel-prev]');
    const nextButton = carousel.querySelector('[data-carousel-next]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
    const autoplayDelay = Math.max(2000, parseInt(carousel.dataset.autoplay || '5000', 10));

    let activeIndex = Math.max(0, slides.findIndex(function (slide) {
        return slide.classList.contains('is-active');
    }));
    let autoplayTimer = null;
    let resumeTimer = null;
    let touchStartX = null;
    let touchStartY = null;

    function render() {
        slides.forEach(function (slide, index) {
            const active = index === activeIndex;
            slide.classList.toggle('is-active', active);
            slide.classList.toggle('opacity-100', active);
            slide.classList.toggle('opacity-0', !active);
            slide.classList.toggle('pointer-events-none', !active);
            slide.inert = !active;
            slide.setAttribute('aria-hidden', active ? 'false' : 'true');
        });

        dots.forEach(function (dot, index) {
            const active = index === activeIndex;
            dot.classList.toggle('bg-white', active);
            dot.classList.toggle('bg-white/40', !active);
            dot.setAttribute('aria-selected', active ? 'true' : 'false');
        });
    }

    function goTo(index) {
        activeIndex = (index + slides.length) % slides.length;
        render();
    }

    function stopAutoplay() {
        if (autoplayTimer !== null) window.clearInterval(autoplayTimer);
        autoplayTimer = null;
    }

    function startAutoplay() {
        stopAutoplay();
        if (reduceMotion.matches) return;
        autoplayTimer = window.setInterval(function () {
            goTo(activeIndex + 1);
        }, autoplayDelay);
    }

    function pauseAutoplay() {
        stopAutoplay();
        window.clearTimeout(resumeTimer);
    }

    function resumeAutoplay(delay) {
        pauseAutoplay();
        resumeTimer = window.setTimeout(startAutoplay, delay || 0);
    }

    prevButton?.addEventListener('click', function () {
        goTo(activeIndex - 1);
        resumeAutoplay();
    });

    nextButton?.addEventListener('click', function () {
        goTo(activeIndex + 1);
        resumeAutoplay();
    });

    dots.forEach(function (dot, index) {
        dot.addEventListener('click', function () {
            goTo(index);
            resumeAutoplay();
        });
    });

    carousel.addEventListener('mouseenter', pauseAutoplay);
    carousel.addEventListener('mouseleave', function () {
        resumeAutoplay();
    });

    carousel.addEventListener('focusin', pauseAutoplay);
    carousel.addEventListener('focusout', function (event) {
        if (!carousel.contains(event.relatedTarget)) resumeAutoplay();
    });

    carousel.addEventListener('touchstart', function (event) {
        pauseAutoplay();
        touchStartX = event.touches[0].clientX;
        touchStartY = event.touches[0].clientY;
    }, { passive: true });

    carousel.addEventListener('touchend', function (event) {
        if (touchStartX === null) return;
        const deltaX = event.changedTouches[0].clientX - touchStartX;
        const deltaY = event.changedTouches[0].clientY - (touchStartY ?? event.changedTouches[0].clientY);
        touchStartX = null;
        touchStartY = null;

        // Horizontal swipes change slides; vertical scrolling is left alone.
        if (Math.abs(deltaX) > 40 && Math.abs(deltaX) > Math.abs(deltaY)) {
            goTo(activeIndex + (deltaX < 0 ? 1 : -1));
        }
        resumeAutoplay(3000);
    }, { passive: true });

    carousel.addEventListener('touchcancel', function () {
        touchStartX = null;
        touchStartY = null;
        resumeAutoplay(3000);
    }, { passive: true });

    if (typeof reduceMotion.addEventListener === 'function') {
        reduceMotion.addEventListener('change', function () {
            if (reduceMotion.matches) stopAutoplay();
            else startAutoplay();
        });
    }

    render();
    startAutoplay();
});

// Add to bag (global handler for any [data-add-to-bag] button)
document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-add-to-bag]');
    if (!btn) return;
    e.preventDefault();
    const qtyInput = document.querySelector('[data-qty-input]');
    const shadeInput = document.querySelector('input[name="shade"]:checked');
    const data = {
        product_id: btn.dataset.addToBag,
        quantity: qtyInput ? parseInt(qtyInput.value || '1', 10) : 1,
        shade: shadeInput ? shadeInput.value : null,
    };
    btn.disabled = true;
    const original = btn.textContent;
    btn.textContent = 'Adding...';

    fetch(btn.dataset.url || '/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            window.sephoraToast('Added to your bag');
            updateCounterBadges('[data-bag-count]', res.count);
            if (btn.dataset.redirect) window.location.href = btn.dataset.redirect;
        } else {
            window.sephoraToast(res.message || 'Could not add to bag', 'error');
        }
    })
    .catch(() => window.sephoraToast('Network error', 'error'))
    .finally(() => { btn.disabled = false; btn.textContent = original; });
});

// Wishlist toggle (global handler)
document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-wishlist-toggle]');
    if (!btn) return;
    e.preventDefault();
    fetch('/wishlist/toggle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
        body: JSON.stringify({ product_id: btn.dataset.wishlistToggle }),
    })
    .then(r => r.json())
    .then(res => {
        if (res.success) {
            window.sephoraToast(res.added ? 'Saved to wishlist' : 'Removed from wishlist');
            updateCounterBadges('[data-wishlist-count]', res.count);
            const icon = btn.querySelector('.material-symbols-outlined, svg');
            if (icon) {
                if (res.added) { icon.textContent = icon.tagName === 'svg' ? icon.textContent : 'favorite'; icon.classList.add('fill-icon', 'text-secondary'); }
                else { icon.textContent = icon.tagName === 'svg' ? icon.textContent : 'favorite_border'; icon.classList.remove('fill-icon', 'text-secondary'); }
            }
        }
    })
    .catch(() => window.sephoraToast('Network error', 'error'));
});

// Newsletter subscribe (global)
document.addEventListener('submit', function (e) {
    const form = e.target.closest('[data-newsletter-form]');
    if (!form) return;
    e.preventDefault();
    const email = form.querySelector('input[type="email"]').value;
    fetch('/newsletter/subscribe', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ email }),
    })
    .then(r => r.json())
    .then(res => window.sephoraToast(res.message || 'Subscribed'))
    .catch(() => window.sephoraToast('Network error', 'error'));
    form.querySelector('input[type="email"]').value = '';
});

// Quantity steppers [data-qty-minus] / [data-qty-plus]
document.addEventListener('click', function (e) {
    const minus = e.target.closest('[data-qty-minus]');
    const plus = e.target.closest('[data-qty-plus]');
    if (!minus && !plus) return;
    const input = (minus || plus).parentElement.querySelector('input[data-qty-input]');
    if (!input) return;
    let v = parseInt(input.value || '1', 10);
    v = minus ? Math.max(1, v - 1) : v + 1;
    input.value = v;
    input.dispatchEvent(new Event('change', { bubbles: true }));
});

// Cart quantity change → server update
document.addEventListener('change', function (e) {
    const input = e.target.closest('input[data-qty-input][data-cart-item]');
    if (!input) return;
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ item_id: input.dataset.cartItem, quantity: parseInt(input.value || '1', 10) }),
    })
    .then(r => r.json())
    .then(res => { if (res.success && res.reload) window.location.reload(); })
    .catch(() => {});
});

// Remove from cart
document.addEventListener('click', function (e) {
    const btn = e.target.closest('[data-cart-remove]');
    if (!btn) return;
    e.preventDefault();
    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ item_id: btn.dataset.cartRemove }),
    })
    .then(r => r.json())
    .then(res => { if (res.success) window.location.reload(); })
    .catch(() => {});
});

// Generic accordion toggle used by several design pages
window.toggleAccordion = function (el) {
    const content = el.nextElementSibling;
    const icon = el.querySelector('.material-symbols-outlined');
    const isOpen = !content.classList.contains('hidden');
    if (isOpen) {
        content.classList.add('hidden');
        if (icon) icon.classList.remove('rotate-180');
    } else {
        content.classList.remove('hidden');
        if (icon) icon.classList.add('rotate-180');
    }
};

// Promo code apply (checkout)
document.addEventListener('click', function (e) {
    const btn = e.target.closest('#promo-apply-btn');
    if (!btn) return;
    e.preventDefault();
    const input = document.getElementById('promo-code-input');
    const feedback = document.getElementById('promo-feedback');
    if (!input || !input.value.trim()) return;

    const form = document.getElementById('checkout-form');
    const delivery = form ? form.querySelector('input[name="delivery_method"]:checked') : null;
    const payment = form ? form.querySelector('input[name="payment_method"]:checked') : null;

    btn.disabled = true;
    fetch('/checkout/coupon', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            code: input.value.trim(),
            delivery_method: delivery ? delivery.value : 'standard',
            payment_method: payment ? payment.value : null,
        }),
    })
    .then(r => r.json())
    .then(res => {
        if (!feedback) return;
        feedback.classList.remove('hidden');
        feedback.textContent = res.message || '';
        feedback.classList.toggle('text-secondary', !!res.success);
        feedback.classList.toggle('text-outline', !res.success);
        if (res.success) window.applyCheckoutTotals(res);
    })
    .catch(() => window.sephoraToast('Network error', 'error'))
    .finally(() => { btn.disabled = false; });
});

// Single source of truth for checkout money rows. The checkout view listens
// for the "checkout:totals" event to keep labels/points in sync.
window.applyCheckoutTotals = function (res) {
    const formatted = res.formatted || {};
    const set = (id, value) => {
        const el = document.getElementById(id);
        if (el && typeof value !== 'undefined' && value !== null) el.textContent = value;
    };

    set('summary-subtotal', formatted.subtotal);
    set('summary-shipping', formatted.shipping);
    set('summary-tax', formatted.tax);
    set('checkout-total', formatted.total);

    const row = document.getElementById('discount-row');
    if (row) {
        if (Number(res.discount) > 0) {
            row.classList.remove('hidden');
            set('summary-discount', '-' + (formatted.discount || ''));
        } else {
            row.classList.add('hidden');
        }
    }

    const points = document.getElementById('summary-points');
    if (points && typeof res.total !== 'undefined') {
        points.textContent = '+' + Math.floor(Number(res.total)) + ' Beauty Pass points';
    }

    document.dispatchEvent(new CustomEvent('checkout:totals', { detail: res }));
};
