'use strict';

/* ── Navbar : scroll shadow ── */
(function () {
    var header = document.getElementById('site-header');
    if (!header) return;
    window.addEventListener('scroll', function () {
        header.classList.toggle('scrolled', window.scrollY > 10);
    }, { passive: true });
})();

/* ── Navbar : burger mobile ── */
(function () {
    var burger = document.getElementById('nav-burger');
    var links  = document.getElementById('nav-links');
    if (!burger || !links) return;

    burger.addEventListener('click', function () {
        var open = links.style.display === 'flex';
        links.style.display = open ? '' : 'flex';
        links.style.flexDirection = 'column';
        links.style.position = 'absolute';
        links.style.top = '62px';
        links.style.left = '0';
        links.style.right = '0';
        links.style.background = '#fff';
        links.style.borderBottom = '1px solid #E2E8F0';
        links.style.padding = '0.75rem 1rem';
        links.style.gap = '0.125rem';
        links.style.zIndex = '200';
        if (open) links.removeAttribute('style');
    });
})();

/* ── Accordéon (page détail) ── */
(function () {
    var items = document.querySelectorAll('.accordion-item');
    if (!items.length) return;

    items.forEach(function (item) {
        var trigger = item.querySelector('.accordion-trigger');
        var panel   = item.querySelector('.accordion-panel');
        var icon    = item.querySelector('.accordion-icon');
        if (!trigger || !panel) return;

        // État initial
        if (item.classList.contains('open')) {
            panel.style.display = 'block';
            if (icon) icon.style.transform = 'rotate(180deg)';
        }

        trigger.addEventListener('click', function () {
            var isOpen = item.classList.contains('open');

            // Fermer tous
            items.forEach(function (i) {
                i.classList.remove('open');
                var p = i.querySelector('.accordion-panel');
                var ic = i.querySelector('.accordion-icon');
                if (p) p.style.display = 'none';
                if (ic) ic.style.transform = '';
            });

            // Ouvrir celui cliqué si il était fermé
            if (!isOpen) {
                item.classList.add('open');
                panel.style.display = 'block';
                if (icon) icon.style.transform = 'rotate(180deg)';
            }
        });
    });
})();

/* ── Tabs cours ── */
(function () {
    var tabs   = document.querySelectorAll('.cours-tab');
    var panels = document.querySelectorAll('.cours-tab-panel');
    if (!tabs.length) return;

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            var target = tab.getAttribute('data-tab');
            tabs.forEach(function (t) { t.classList.remove('active'); });
            panels.forEach(function (p) { p.classList.remove('active'); });
            tab.classList.add('active');
            var panel = document.getElementById('tab-' + target);
            if (panel) panel.classList.add('active');
        });
    });
})();

/* ── Sidebar cours : toggle mobile ── */
(function () {
    var sidebar = document.getElementById('elearning-sidebar');
    var menuBtn = document.getElementById('topbar-menu-btn');
    var closeBtn = document.getElementById('esb-close');
    if (!sidebar) return;

    if (menuBtn) {
        menuBtn.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });
    }
    if (closeBtn) {
        closeBtn.addEventListener('click', function () {
            sidebar.classList.remove('open');
        });
    }
})();

/* ── Chapitres sidebar cours ── */
function toggleChapter(index) {
    var lessons = document.getElementById('lessons-' + index);
    var arrow   = document.getElementById('arrow-' + index);
    if (!lessons) return;

    var isOpen = lessons.style.display !== 'none' && lessons.style.display !== '';
    lessons.style.display = isOpen ? 'none' : 'flex';
    lessons.style.flexDirection = isOpen ? '' : 'column';
    if (arrow) arrow.classList.toggle('rotated', !isOpen);
}

/* ── Quiz ── */
function submitQuiz() {
    var form   = document.getElementById('quiz-form');
    var result = document.getElementById('quiz-result');
    if (!form || !result) return;

    var q1 = form.querySelector('input[name="q1"]:checked');
    var q2 = form.querySelector('input[name="q2"]:checked');
    var q3 = form.querySelector('input[name="q3"]:checked');

    if (!q1 || !q2 || !q3) {
        result.className = 'error';
        result.textContent = 'Veuillez répondre à toutes les questions.';
        return;
    }

    var correct = (q1.value === 'a') && (q2.value === 'b') && (q3.value === 'a');
    if (correct) {
        result.className = 'success';
        result.textContent = 'Excellent ! Toutes les réponses sont correctes. Module validé.';
    } else {
        result.className = 'error';
        result.textContent = 'Certaines réponses sont incorrectes. Revoyez le contenu du module et réessayez.';
    }
}

/* ── Validation formulaire inscription ── */
(function () {
    var form = document.getElementById('form-inscription');
    if (!form) return;

    function isEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }

    function setError(id, msg) {
        var f = document.getElementById(id);
        var m = document.getElementById('msg-' + id);
        if (f) f.style.borderColor = '#DC2626';
        if (m) m.textContent = msg;
    }

    function clearError(id) {
        var f = document.getElementById(id);
        var m = document.getElementById('msg-' + id);
        if (f) f.style.borderColor = '';
        if (m) m.textContent = '';
    }

    ['nom', 'prenom', 'email'].forEach(function (id) {
        var el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('input', function () { clearError(id); });
        el.addEventListener('blur', function () {
            if (id === 'email' && !isEmail(el.value)) setError('email', 'Email invalide.');
            else if (id !== 'email' && el.value.trim().length < 2) setError(id, 'Champ obligatoire.');
        });
    });

    form.addEventListener('submit', function (e) {
        var ok = true;
        var nom    = document.getElementById('nom');
        var prenom = document.getElementById('prenom');
        var email  = document.getElementById('email');
        var sel    = document.getElementById('formation_id');

        if (nom && nom.value.trim().length < 2)       { setError('nom', 'Nom obligatoire.');       ok = false; }
        if (prenom && prenom.value.trim().length < 2)  { setError('prenom', 'Prénom obligatoire.'); ok = false; }
        if (email && !isEmail(email.value))            { setError('email', 'Email invalide.');      ok = false; }
        if (sel && sel.value === '')                   { setError('formation', 'Choisissez une formation.'); ok = false; }
        if (!ok) e.preventDefault();
    });
})();

/* ── Formatage carte bancaire ── */
(function () {
    var num = document.getElementById('num_carte');
    var exp = document.getElementById('expiration');
    if (num) {
        num.addEventListener('input', function () {
            var d = num.value.replace(/\D/g, '').slice(0, 16);
            num.value = d.replace(/(.{4})/g, '$1 ').trim();
        });
    }
    if (exp) {
        exp.addEventListener('input', function () {
            var d = exp.value.replace(/\D/g, '').slice(0, 4);
            exp.value = d.length >= 3 ? d.slice(0, 2) + '/' + d.slice(2) : d;
        });
    }
})();
