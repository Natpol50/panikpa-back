document.addEventListener('DOMContentLoaded', () => {
    // Charger et insérer la navbar
    loadNavbar();

    async function loadNavbar() {

        try {
            // Récupérer le contenu HTML de la navbar
            const response = await fetch('/Component/navbar.html');
            const navbarHTML = await response.text();
            // Insérer la navbar dans le header
            const headerElement = document.querySelector('header');
            if (headerElement) {
                headerElement.innerHTML = navbarHTML;
                
                // Initialiser les gestionnaires d'événements après l'insertion
                initializeNavbar();
                
                // Marquer la page active
                highlightActivePage();
            }
        } catch (error) {
            console.error('Erreur lors du chargement de la navbar:', error);
        }
    }

    function initializeNavbar() {
        // Récupérer les éléments après qu'ils soient insérés dans le DOM
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
            if (e.key === 'Escape' && navRight.classList.contains('active')) {
                toggleMenu();
            }
        });
    }

    function highlightActivePage() {
        // Obtenir le chemin actuel
        const currentPath = window.location.pathname;
        
        // Identifiant de la page actuelle basé sur le chemin
        let currentPage = '';
        
        if (currentPath === '/' || currentPath.includes('index')) {
            currentPage = 'accueil';
        } else if (currentPath.includes('entreprises')) {
            currentPage = 'entreprises';
        } else if (currentPath.includes('offres') || currentPath.includes('stages') || currentPath.includes('alternances')) {
            currentPage = 'offres';
        } else if (currentPath.includes('wishlist')) {
            currentPage = 'wishlist';
        } else if (currentPath.includes('form') || currentPath.includes('postuler')) {
            currentPage = 'postuler';
        } else {
            currentPage = 'autres';
        }
        
        
        // Ajouter la classe 'selected' à l'élément de navigation correspondant
        if (currentPage) {
            const navLink = document.querySelector(`.nav-links[data-page="${currentPage}"] a`);
            if (navLink) {
                navLink.classList.add('selected');
            }
        }
    }
});