document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.querySelector('.menu-toggle');
    const navRight = document.querySelector('.nav-right');
    const navLinks = document.querySelectorAll('.nav-right .nav-links a');

    // Fonction pour gérer l'état du menu
    function toggleMenu() {
        const isExpanded = menuToggle.classList.toggle('active');
        navRight.classList.toggle('active');
        menuToggle.setAttribute('aria-expanded', isExpanded);
    }

    // Gestionnaire d'événements pour le bouton
    menuToggle.addEventListener('click', (e) => {
        e.preventDefault();
        toggleMenu();
    });

    // Fermeture du menu lors du clic sur un lien
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            menuToggle.classList.remove('active');
            navRight.classList.remove('active');
            menuToggle.setAttribute('aria-expanded', false);
            document.body.style.overflow = '';
        });
    });

    // Gestion du redimensionnement de la fenêtre
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (window.innerWidth > 768) {
                menuToggle.classList.remove('active');
                navRight.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', false);
                document.body.style.overflow = '';
            }
        }, 250);
    });

    // Gestion de la navigation au clavier
    menuToggle.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            toggleMenu();
        }
    });

    // Fermeture du menu avec la touche Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !navRight.contains(e.target)) {
            toggleMenu();
        }
    });
});