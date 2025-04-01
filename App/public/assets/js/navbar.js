document.addEventListener('DOMContentLoaded', () => {
    // Since the navbar is already rendered by Twig, we can initialize it directly
    initializeNavbar();

    function initializeNavbar() {
        // Get navbar elements
        const menuToggle = document.querySelector('.menu-toggle');
        const navRight = document.querySelector('.nav-right');
        const navLinks = document.querySelectorAll('.nav-right .nav-links a');

        // Function to toggle menu state
        function toggleMenu() {
            const isExpanded = menuToggle.classList.toggle('active');
            navRight.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded', isExpanded);
        }

        // Event listener for menu toggle button
        menuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            toggleMenu();
        });

        // Close menu when clicking on links
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                menuToggle.classList.remove('active');
                navRight.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', false);
                document.body.style.overflow = '';
            });
        });

        // Handle window resize
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

        // Keyboard navigation
        menuToggle.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleMenu();
            }
        });

        // Close menu with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && navRight.classList.contains('active')) {
                toggleMenu();
            }
        });
    }
});