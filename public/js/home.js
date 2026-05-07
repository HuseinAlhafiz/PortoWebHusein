// ========== NAVBAR SCROLL ==========
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 60);
});

// ========== ACTIVE NAV LINK ==========
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-links a');
window.addEventListener('scroll', () => {
    const y = window.scrollY + 200;
    sections.forEach(s => {
        if (y >= s.offsetTop && y < s.offsetTop + s.offsetHeight) {
            navLinks.forEach(l => {
                l.classList.toggle('active', l.dataset.section === s.id);
            });
        }
    });
});

// ========== MOBILE TOGGLE ==========
const navToggle = document.getElementById('navToggle');
const navLinksEl = document.getElementById('navLinks');
navToggle.addEventListener('click', () => navLinksEl.classList.toggle('active'));
navLinksEl.querySelectorAll('a').forEach(a => a.addEventListener('click', () => navLinksEl.classList.remove('active')));

// ========== TYPED TEXT ==========
const typedTexts = ['Business Analyst', 'UI/UX Designer', 'Technical Writer', 'System Analyst', 'Quality Assurance'];
let ti = 0, ci = 0, deleting = false;
const typedEl = document.getElementById('typedText');

function typeWriter() {
    const current = typedTexts[ti];
    if (!deleting) {
        typedEl.textContent = current.substring(0, ci + 1);
        ci++;
        if (ci === current.length) { deleting = true; setTimeout(typeWriter, 2000); return; }
    } else {
        typedEl.textContent = current.substring(0, ci - 1);
        ci--;
        if (ci === 0) { deleting = false; ti = (ti + 1) % typedTexts.length; }
    }
    setTimeout(typeWriter, deleting ? 40 : 80);
}
typeWriter();

// ========== SCROLL REVEAL ==========
const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));



// ========== SKILL BARS ==========
const barObs = new IntersectionObserver((entries) => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.classList.add('visible');
            barObs.unobserve(e.target);
        }
    });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal-bar').forEach(b => barObs.observe(b));

// ========== PORTFOLIO TABS ==========
document.querySelectorAll('.pf-tab').forEach(tab => {
    tab.addEventListener('click', () => {
        document.querySelectorAll('.pf-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        document.querySelectorAll('.pf-tab-content').forEach(c => c.classList.remove('active'));
        document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
    });
});

// ========== PORTFOLIO SUB-FILTER ==========
document.querySelectorAll('.pf-pill').forEach(pill => {
    pill.addEventListener('click', () => {
        document.querySelectorAll('.pf-pill').forEach(p => p.classList.remove('active'));
        pill.classList.add('active');
        const filter = pill.dataset.subfilter;
        document.querySelectorAll('#tab-projects .pf-card').forEach(card => {
            card.style.display = (filter === 'all' || card.dataset.subcategory === filter) ? '' : 'none';
        });
    });
});
