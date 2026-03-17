/* ── Wakalah mobile accordion ── */
function wmToggle(header) {
    const body = header.nextElementSibling;
    const isOpen = body.classList.contains('open');
    header.classList.toggle('open', !isOpen);
    body.classList.toggle('open', !isOpen);
}

/* ── Global body-level tooltip (bypasses overflow:hidden) ── */
document.addEventListener('DOMContentLoaded', () => {
    const tip = document.createElement('div');
    tip.id = 'g-tooltip';
    document.body.appendChild(tip);

    let hideTimer;
    document.querySelectorAll('[data-tip]').forEach(el => {
        el.style.cursor = 'default';
        el.addEventListener('mouseenter', e => {
            clearTimeout(hideTimer);
            tip.textContent = el.dataset.tip;
            const r = el.getBoundingClientRect();
            tip.style.left = (r.left + r.width / 2) + 'px';
            tip.style.top  = (r.top - 10) + 'px';
            tip.style.transform = 'translate(-50%, -100%)';
            tip.classList.add('show');
        });
        el.addEventListener('mouseleave', () => {
            hideTimer = setTimeout(() => tip.classList.remove('show'), 120);
        });
    });

    /* ── Animate total amount on scroll into view ── */
    const totalEl = document.querySelector('.total-bar-amt');
    if (totalEl && 'IntersectionObserver' in window) {
        const ob = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                totalEl.style.animation = 'none';
                void totalEl.offsetWidth;
                totalEl.style.animation = 'countUp .6s ease both';
                ob.disconnect();
            }
        }, { threshold: 0.5 });
        ob.observe(totalEl);
    }
});

/* ── Ripple effect on row click ── */
function addRipple(e) {
    const row = e.currentTarget;
    const circle = document.createElement('span');
    circle.classList.add('ripple');
    row.appendChild(circle);
    const rect = row.getBoundingClientRect();
    circle.style.left = (e.clientX - rect.left) + 'px';
    circle.style.top  = (e.clientY - rect.top)  + 'px';
    setTimeout(() => circle.remove(), 600);
}
