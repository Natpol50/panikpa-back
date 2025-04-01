document.addEventListener('DOMContentLoaded', () => {
    // Fetch and insert the sidebar HTML
    fetch('/component/sidebar.html')
        .then(response => response.text())
        .then(data => {
            const mainElement = document.querySelector('main');
            if (mainElement) {
                mainElement.insertAdjacentHTML('afterbegin', data);
                initializeSidebar();
            }
        })
        .catch(error => console.error('Error loading sidebar:', error));

    function initializeSidebar() {
        const toggleButton = document.getElementById('toggle-sidebar');
        const sidebar = document.querySelector('.sidebar');
        const footerdiv = document.querySelector('.site-footer');
        const mainContainer = document.querySelector('.app');
        const mainElement = document.querySelector('main');
        const toggleIcon = document.querySelector('.toggle-icon');
        const logoutButton = document.querySelector('.btn-deconnexion');
        const menuItems = document.querySelectorAll('.menu-item');

        // Restore the previous state of the sidebar
        const isSidebarClosed = localStorage.getItem('sidebarClosed') === 'true';
        updateSidebarState(isSidebarClosed);

        // Function to toggle the sidebar
        function toggleSidebar() {
            const isClosed = sidebar.classList.toggle('closed');
            updateSidebarState(isClosed);
            localStorage.setItem('sidebarClosed', isClosed);
            toggleButton.setAttribute('aria-expanded', !isClosed);
        }

        // Function to update the sidebar state
        function updateSidebarState(isClosed) {
            sidebar.classList.toggle('closed', isClosed);
            mainContainer?.classList.toggle('sidebar-open', !isClosed);
            footerdiv?.classList.toggle('sidebar-open', !isClosed);
            mainElement?.classList.toggle('no-overflow-if-small', !isClosed);
            toggleIcon.style.transform = isClosed ? 'rotate(135deg)' : 'rotate(-45deg)';
        }

        // Event Listeners
        toggleButton.addEventListener('click', toggleSidebar);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !sidebar.classList.contains('closed')) {
                toggleSidebar();
            }
        });

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth <= 768 && !sidebar.classList.contains('closed')) {
                    toggleSidebar();
                }
            }, 250);
        });

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 &&
                !sidebar.classList.contains('closed') &&
                !sidebar.contains(e.target) &&
                !toggleButton.contains(e.target)) {
                toggleSidebar();
            }
        });

        toggleButton.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleSidebar();
            }
        });

        if (logoutButton) {
            logoutButton.addEventListener('click', (e) => {
                e.preventDefault();
                console.log('Déconnexion...');
            });
        }

        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.stopPropagation();
            });
        });
    }
});