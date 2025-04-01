// Function to load the footer
async function loadFooter() {
    try {
        // Load footer HTML
        const response = await fetch('Component/footer.html');
        const footerHTML = await response.text();

        // Insert footer into the page
        const footerContainer = document.createElement('div');
        footerContainer.innerHTML = footerHTML;
        document.body.appendChild(footerContainer);

        // Load footer CSS
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'assets/components/footer.css';
        document.head.appendChild(link);
    } catch (error) {
        console.error('Erreur lors du chargement du footer:', error);
    }
}

// Load the footer when the page is ready
document.addEventListener('DOMContentLoaded', loadFooter);