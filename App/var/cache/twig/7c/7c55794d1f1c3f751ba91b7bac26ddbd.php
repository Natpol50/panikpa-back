<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* wishlist/index.html.twig */
class __TwigTemplate_e2251b8d83ae38a39a32e9bf8c8b0728 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'content' => [$this, 'block_content'],
            'javascripts' => [$this, 'block_javascripts'],
            'stylesheets' => [$this, 'block_stylesheets'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html.twig", "wishlist/index.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Ma Wishlist - ";
        yield from $this->yieldParentBlock("title", $context, $blocks);
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_content(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span>Ma Wishlist</span>
    </nav>

    <section class=\"wishlist-section\">
        <header class=\"wishlist-header\">
            <h1>Mes offres favorites</h1>
        </header>

        <!-- Empty state for wishlist -->
        <div id=\"wishlist-empty\" class=\"empty-container\" style=\"display: none;\">
            <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" fill=\"currentColor\"/>
            </svg>
            <h3>Votre wishlist est vide</h3>
            <p>Ajoutez des offres à votre wishlist en cliquant sur l'étoile à côté de chaque offre.</p>
            <a href=\"/offres/stages\" class=\"btn-primary\">Découvrir des offres</a>
        </div>

        <!-- Loading state -->
        <div id=\"loading-container\" class=\"loading-container\">
            <div class=\"spinner\"></div>
            <p>Chargement de vos offres favorites...</p>
        </div>

        <!-- Error state -->
        <div id=\"error-container\" class=\"error-container\" style=\"display: none;\">
            <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                <path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z\" fill=\"currentColor\"/>
            </svg>
            <h3>Erreur lors du chargement</h3>
            <p id=\"error-message\">Impossible de charger vos offres favorites.</p>
            <button class=\"global-btn\" style=\"max-width: 300px;\" onclick=\"fetchWishlist()\">Réessayer</button>
        </div>

        <!-- Wishlist container -->
        <div id=\"wishlist-container\" class=\"offres-container\" style=\"display: none;\"></div>

        <!-- Pagination -->
        <div id=\"pagination\" class=\"pagination\" style=\"display: none;\">
            <button id=\"prev-page\" class=\"pagination-button\">Précédent</button>
            <span id=\"page-info\">Page 1 sur 1</span>
            <button id=\"next-page\" class=\"pagination-button\">Suivant</button>
        </div>
    </section>
</div>
";
        yield from [];
    }

    // line 56
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 57
        yield "    ";
        yield from $this->yieldParentBlock("javascripts", $context, $blocks);
        yield "
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // State variables
            let currentPage = 1;
            let totalPages = 1;
            const itemsPerPage = 5;
            
            // DOM elements
            const wishlistContainer = document.getElementById('wishlist-container');
            const emptyContainer = document.getElementById('wishlist-empty');
            const loadingContainer = document.getElementById('loading-container');
            const errorContainer = document.getElementById('error-container');
            const errorMessage = document.getElementById('error-message');
            const pagination = document.getElementById('pagination');
            const prevPageButton = document.getElementById('prev-page');
            const nextPageButton = document.getElementById('next-page');
            const pageInfo = document.getElementById('page-info');
            
            // Initial fetch
            fetchWishlist();
            
            // Fetch wishlist data from API
            async function fetchWishlist(page = 1) {
                // Show loading state
                loadingContainer.style.display = 'flex';
                wishlistContainer.style.display = 'none';
                emptyContainer.style.display = 'none';
                errorContainer.style.display = 'none';
                pagination.style.display = 'none';
                
                try {
                    // Fetch data from API
                    const response = await fetch(`/API/wishlist?page=\${page}&limit=\${itemsPerPage}`);
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: \${response.status}`);
                    }
                    
                    const data = await response.json();
                    
                    // Hide loading state
                    loadingContainer.style.display = 'none';
                    
                    // Update state
                    currentPage = data.currentPage;
                    totalPages = data.totalPages;
                    
                    // Process response
                    if (data.success) {
                        if (data.offers && data.offers.length > 0) {
                            // Display offers and pagination
                            displayOffers(data.offers);
                            updatePagination(data.totalPages, data.currentPage);
                            wishlistContainer.style.display = 'grid';
                            pagination.style.display = 'flex';
                        } else {
                            // Show empty state
                            emptyContainer.style.display = 'flex';
                        }
                    } else {
                        // Show error state
                        errorMessage.textContent = data.error || 'Une erreur s\\'est produite lors du chargement de votre wishlist.';
                        errorContainer.style.display = 'block';
                    }
                } catch (error) {
                    // Handle fetch errors
                    console.error('Error fetching wishlist:', error);
                    loadingContainer.style.display = 'none';
                    errorMessage.textContent = error.message || 'Une erreur s\\'est produite lors du chargement de votre wishlist.';
                    errorContainer.style.display = 'block';
                }
            }
            
            // Display offers in the container
            function displayOffers(offers) {
                // Clear existing offers
                wishlistContainer.innerHTML = '';
                
                // Animation delay for staggered appearance
                let delay = 0;
                
                // Create and append offer cards
                offers.forEach((offer, index) => {
                    const offerCard = document.createElement('div');
                    offerCard.className = `offre-card \${offer.highlighted ? 'highlighted' : ''}`;
                    offerCard.dataset.id = offer.id;
                    offerCard.style.animationDelay = `\${delay}s`;
                    delay += 0.1; // Stagger animation
                    
                    // Generate HTML for tags
                    const tagsHTML = offer.tags && Array.isArray(offer.tags) 
                        ? offer.tags.map(tag => 
                            `<span class=\"\${tag.optional ? 'tag_optional' : 'tag'}\">\${tag.name}</span>`
                        ).join('') 
                        : '';
                    
                    // Wishlist star button HTML
                    const wishlistStarHTML = `
                        <button class=\"wishlist-star active\" 
                                data-id=\"\${offer.id}\" 
                                aria-label=\"Retirer de la wishlist\"
                                title=\"Retirer de la wishlist\">
                            <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" />
                            </svg>
                        </button>
                    `;
                    
                    // Set the inner HTML of the offer card
                    offerCard.innerHTML = `
                        <div class=\"card-header\">
                            <h3>\${offer.title || 'Titre non disponible'}</h3>
                            \${wishlistStarHTML}
                        </div>
                        <p class=\"reference\">\${offer.company || ''} | \${offer.location || ''} | Réf. \${offer.reference || offer.id}</p>
                        <div class=\"tags\">
                            <span class=\"tag\">\${offer.duration || ''}</span>
                            <span class=\"tag\">\${offer.level || ''}</span>
                            \${tagsHTML}
                        </div>
                        <p>Commence le : \${offer.startDate || ''}</p>
                        <p class=\"\${offer.remuneration === 0 ? 'remuneration_negative' : 'remuneration'}\">
                            \${offer.remuneration === 0 ? 'Non Rémunéré' : 'Rémunéré'}
                        </p>
                        \${offer.highlighted ? '<p class=\"tag_star\">Candidat star !</p>' : ''}
                        <p class=\"wishlist-badge\">Dans votre wishlist</p>
                        \${offer.applied ? '<p class=\"postu-badge\">Déjà postulé</p>' : ''}
                    `;
                    
                    // Add click event listener for the wishlist star
                    offerCard.querySelector('.wishlist-star').addEventListener('click', async (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const offerId = e.currentTarget.dataset.id;
                        
                        try {
                            // Send request to remove from wishlist
                            const response = await fetch(`/API/wishlist/toggle/\${offerId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            
                            const data = await response.json();
                            
                            if (data.success && !data.wishlisted) {
                                // If successfully removed, animate card removal
                                offerCard.style.opacity = '0';
                                offerCard.style.transform = 'translateX(50px)';
                                
                                setTimeout(() => {
                                    offerCard.remove();
                                    
                                    // Check if there are any offers left
                                    if (wishlistContainer.children.length === 0) {
                                        // Reload current page or show empty state if it was the last item
                                        if (currentPage > 1) {
                                            fetchWishlist(currentPage - 1);
                                        } else {
                                            wishlistContainer.style.display = 'none';
                                            pagination.style.display = 'none';
                                            emptyContainer.style.display = 'flex';
                                        }
                                    }
                                }, 500);
                                
                                // Show success notification
                                if (typeof addNotification === 'function') {
                                    addNotification(data.message, 'success');
                                }
                            }
                        } catch (error) {
                            console.error('Error toggling wishlist:', error);
                            if (typeof addNotification === 'function') {
                                addNotification('Une erreur s\\'est produite lors de la mise à jour de votre wishlist.', 'error');
                            }
                        }
                    });
                    
                    // Add click event for card (except wishlist star) to navigate to offer details
                    offerCard.addEventListener('click', (e) => {
                        // Don't navigate if clicking on the wishlist star or apply button
                        if (!e.target.closest('.wishlist-star') && !e.target.closest('.apply-button')) {
                            window.location.href = `/offres/\${offer.reference}`;
                        }
                    });
                    
                    // Append the card to the container
                    wishlistContainer.appendChild(offerCard);
                });
            }
            
            // Update pagination controls
            function updatePagination(totalPages, currentPage) {
                pageInfo.textContent = `Page \${currentPage} sur \${totalPages}`;
                
                // Update button states
                prevPageButton.disabled = currentPage <= 1;
                nextPageButton.disabled = currentPage >= totalPages;
            }
            
            // Event listeners for pagination
            prevPageButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    fetchWishlist(currentPage - 1);
                }
            });
            
            nextPageButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    fetchWishlist(currentPage + 1);
                }
            });
            
            // Make fetchWishlist available globally for retry button
            window.fetchWishlist = fetchWishlist;
        });
    </script>
";
        yield from [];
    }

    // line 281
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 282
        yield "    ";
        yield from $this->yieldParentBlock("stylesheets", $context, $blocks);
        yield "
    <style>
        /* Wishlist section styles */
        .wishlist-section {
            margin-bottom: 2rem;
        }
        
        .wishlist-header {
            margin-bottom: 1.5rem;
        }
        
        .wishlist-header h1 {
            color: var(--primary-color);
            font-size: 2rem;
            margin: 0;
        }
        
        /* Empty state */
        .empty-container {
            text-align: center;
            padding: 3rem 0;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .empty-container svg {
            color: var(--realsecondary-color);
            opacity: 0.5;
            margin-bottom: 1rem;
        }
        
        .empty-container h3 {
            margin-bottom: 0.5rem;
            color: var(--onyx);
        }
        
        .empty-container p {
            color: var(--real-grey);
            margin-bottom: 1.5rem;
            max-width: 400px;
        }
        
        .btn-primary {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: filter 0.3s ease;
        }
        
        .btn-primary:hover {
            filter: brightness(0.9);
        }
        
        /* Loading state */
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 0;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
        }
        
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Error state */
        .error-container {
            text-align: center;
            padding: 3rem 0;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .error-container svg {
            color: var(--tertiary-color);
            opacity: 0.5;
            margin-bottom: 1rem;
        }
        
        /* Offer card animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .offre-card {
            animation: fadeIn 0.3s ease-out forwards;
            opacity: 0;
            transition: opacity 0.5s, transform 0.5s;
            cursor: pointer;
        }
        
        /* Apply button */
        .apply-button {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 1rem;
            transition: filter 0.3s ease;
        }
        
        .apply-button:hover {
            filter: brightness(0.9);
        }
        
        /* For users who prefer reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .spinner {
                animation: none;
            }
            
            .offre-card {
                animation: none;
                opacity: 1;
            }
        }

                .offres-container {
            background-color: var(--background-nav);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px var(--shadow-color);
        }
    </style>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "wishlist/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  369 => 282,  362 => 281,  133 => 57,  126 => 56,  73 => 6,  66 => 5,  54 => 3,  43 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Ma Wishlist - {{ parent() }}{% endblock %}

{% block content %}
<div class=\"container\">
    <nav class=\"breadcrumb\">
        <span><a href=\"/\">Accueil</a></span>
        <span>Ma Wishlist</span>
    </nav>

    <section class=\"wishlist-section\">
        <header class=\"wishlist-header\">
            <h1>Mes offres favorites</h1>
        </header>

        <!-- Empty state for wishlist -->
        <div id=\"wishlist-empty\" class=\"empty-container\" style=\"display: none;\">
            <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" fill=\"currentColor\"/>
            </svg>
            <h3>Votre wishlist est vide</h3>
            <p>Ajoutez des offres à votre wishlist en cliquant sur l'étoile à côté de chaque offre.</p>
            <a href=\"/offres/stages\" class=\"btn-primary\">Découvrir des offres</a>
        </div>

        <!-- Loading state -->
        <div id=\"loading-container\" class=\"loading-container\">
            <div class=\"spinner\"></div>
            <p>Chargement de vos offres favorites...</p>
        </div>

        <!-- Error state -->
        <div id=\"error-container\" class=\"error-container\" style=\"display: none;\">
            <svg viewBox=\"0 0 24 24\" width=\"48\" height=\"48\">
                <path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z\" fill=\"currentColor\"/>
            </svg>
            <h3>Erreur lors du chargement</h3>
            <p id=\"error-message\">Impossible de charger vos offres favorites.</p>
            <button class=\"global-btn\" style=\"max-width: 300px;\" onclick=\"fetchWishlist()\">Réessayer</button>
        </div>

        <!-- Wishlist container -->
        <div id=\"wishlist-container\" class=\"offres-container\" style=\"display: none;\"></div>

        <!-- Pagination -->
        <div id=\"pagination\" class=\"pagination\" style=\"display: none;\">
            <button id=\"prev-page\" class=\"pagination-button\">Précédent</button>
            <span id=\"page-info\">Page 1 sur 1</span>
            <button id=\"next-page\" class=\"pagination-button\">Suivant</button>
        </div>
    </section>
</div>
{% endblock %}

{% block javascripts %}
    {{ parent() }}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // State variables
            let currentPage = 1;
            let totalPages = 1;
            const itemsPerPage = 5;
            
            // DOM elements
            const wishlistContainer = document.getElementById('wishlist-container');
            const emptyContainer = document.getElementById('wishlist-empty');
            const loadingContainer = document.getElementById('loading-container');
            const errorContainer = document.getElementById('error-container');
            const errorMessage = document.getElementById('error-message');
            const pagination = document.getElementById('pagination');
            const prevPageButton = document.getElementById('prev-page');
            const nextPageButton = document.getElementById('next-page');
            const pageInfo = document.getElementById('page-info');
            
            // Initial fetch
            fetchWishlist();
            
            // Fetch wishlist data from API
            async function fetchWishlist(page = 1) {
                // Show loading state
                loadingContainer.style.display = 'flex';
                wishlistContainer.style.display = 'none';
                emptyContainer.style.display = 'none';
                errorContainer.style.display = 'none';
                pagination.style.display = 'none';
                
                try {
                    // Fetch data from API
                    const response = await fetch(`/API/wishlist?page=\${page}&limit=\${itemsPerPage}`);
                    
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: \${response.status}`);
                    }
                    
                    const data = await response.json();
                    
                    // Hide loading state
                    loadingContainer.style.display = 'none';
                    
                    // Update state
                    currentPage = data.currentPage;
                    totalPages = data.totalPages;
                    
                    // Process response
                    if (data.success) {
                        if (data.offers && data.offers.length > 0) {
                            // Display offers and pagination
                            displayOffers(data.offers);
                            updatePagination(data.totalPages, data.currentPage);
                            wishlistContainer.style.display = 'grid';
                            pagination.style.display = 'flex';
                        } else {
                            // Show empty state
                            emptyContainer.style.display = 'flex';
                        }
                    } else {
                        // Show error state
                        errorMessage.textContent = data.error || 'Une erreur s\\'est produite lors du chargement de votre wishlist.';
                        errorContainer.style.display = 'block';
                    }
                } catch (error) {
                    // Handle fetch errors
                    console.error('Error fetching wishlist:', error);
                    loadingContainer.style.display = 'none';
                    errorMessage.textContent = error.message || 'Une erreur s\\'est produite lors du chargement de votre wishlist.';
                    errorContainer.style.display = 'block';
                }
            }
            
            // Display offers in the container
            function displayOffers(offers) {
                // Clear existing offers
                wishlistContainer.innerHTML = '';
                
                // Animation delay for staggered appearance
                let delay = 0;
                
                // Create and append offer cards
                offers.forEach((offer, index) => {
                    const offerCard = document.createElement('div');
                    offerCard.className = `offre-card \${offer.highlighted ? 'highlighted' : ''}`;
                    offerCard.dataset.id = offer.id;
                    offerCard.style.animationDelay = `\${delay}s`;
                    delay += 0.1; // Stagger animation
                    
                    // Generate HTML for tags
                    const tagsHTML = offer.tags && Array.isArray(offer.tags) 
                        ? offer.tags.map(tag => 
                            `<span class=\"\${tag.optional ? 'tag_optional' : 'tag'}\">\${tag.name}</span>`
                        ).join('') 
                        : '';
                    
                    // Wishlist star button HTML
                    const wishlistStarHTML = `
                        <button class=\"wishlist-star active\" 
                                data-id=\"\${offer.id}\" 
                                aria-label=\"Retirer de la wishlist\"
                                title=\"Retirer de la wishlist\">
                            <svg viewBox=\"0 0 24 24\" width=\"24\" height=\"24\">
                                <path d=\"M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z\" />
                            </svg>
                        </button>
                    `;
                    
                    // Set the inner HTML of the offer card
                    offerCard.innerHTML = `
                        <div class=\"card-header\">
                            <h3>\${offer.title || 'Titre non disponible'}</h3>
                            \${wishlistStarHTML}
                        </div>
                        <p class=\"reference\">\${offer.company || ''} | \${offer.location || ''} | Réf. \${offer.reference || offer.id}</p>
                        <div class=\"tags\">
                            <span class=\"tag\">\${offer.duration || ''}</span>
                            <span class=\"tag\">\${offer.level || ''}</span>
                            \${tagsHTML}
                        </div>
                        <p>Commence le : \${offer.startDate || ''}</p>
                        <p class=\"\${offer.remuneration === 0 ? 'remuneration_negative' : 'remuneration'}\">
                            \${offer.remuneration === 0 ? 'Non Rémunéré' : 'Rémunéré'}
                        </p>
                        \${offer.highlighted ? '<p class=\"tag_star\">Candidat star !</p>' : ''}
                        <p class=\"wishlist-badge\">Dans votre wishlist</p>
                        \${offer.applied ? '<p class=\"postu-badge\">Déjà postulé</p>' : ''}
                    `;
                    
                    // Add click event listener for the wishlist star
                    offerCard.querySelector('.wishlist-star').addEventListener('click', async (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const offerId = e.currentTarget.dataset.id;
                        
                        try {
                            // Send request to remove from wishlist
                            const response = await fetch(`/API/wishlist/toggle/\${offerId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            });
                            
                            const data = await response.json();
                            
                            if (data.success && !data.wishlisted) {
                                // If successfully removed, animate card removal
                                offerCard.style.opacity = '0';
                                offerCard.style.transform = 'translateX(50px)';
                                
                                setTimeout(() => {
                                    offerCard.remove();
                                    
                                    // Check if there are any offers left
                                    if (wishlistContainer.children.length === 0) {
                                        // Reload current page or show empty state if it was the last item
                                        if (currentPage > 1) {
                                            fetchWishlist(currentPage - 1);
                                        } else {
                                            wishlistContainer.style.display = 'none';
                                            pagination.style.display = 'none';
                                            emptyContainer.style.display = 'flex';
                                        }
                                    }
                                }, 500);
                                
                                // Show success notification
                                if (typeof addNotification === 'function') {
                                    addNotification(data.message, 'success');
                                }
                            }
                        } catch (error) {
                            console.error('Error toggling wishlist:', error);
                            if (typeof addNotification === 'function') {
                                addNotification('Une erreur s\\'est produite lors de la mise à jour de votre wishlist.', 'error');
                            }
                        }
                    });
                    
                    // Add click event for card (except wishlist star) to navigate to offer details
                    offerCard.addEventListener('click', (e) => {
                        // Don't navigate if clicking on the wishlist star or apply button
                        if (!e.target.closest('.wishlist-star') && !e.target.closest('.apply-button')) {
                            window.location.href = `/offres/\${offer.reference}`;
                        }
                    });
                    
                    // Append the card to the container
                    wishlistContainer.appendChild(offerCard);
                });
            }
            
            // Update pagination controls
            function updatePagination(totalPages, currentPage) {
                pageInfo.textContent = `Page \${currentPage} sur \${totalPages}`;
                
                // Update button states
                prevPageButton.disabled = currentPage <= 1;
                nextPageButton.disabled = currentPage >= totalPages;
            }
            
            // Event listeners for pagination
            prevPageButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    fetchWishlist(currentPage - 1);
                }
            });
            
            nextPageButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    fetchWishlist(currentPage + 1);
                }
            });
            
            // Make fetchWishlist available globally for retry button
            window.fetchWishlist = fetchWishlist;
        });
    </script>
{% endblock %}

{% block stylesheets %}
    {{ parent() }}
    <style>
        /* Wishlist section styles */
        .wishlist-section {
            margin-bottom: 2rem;
        }
        
        .wishlist-header {
            margin-bottom: 1.5rem;
        }
        
        .wishlist-header h1 {
            color: var(--primary-color);
            font-size: 2rem;
            margin: 0;
        }
        
        /* Empty state */
        .empty-container {
            text-align: center;
            padding: 3rem 0;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .empty-container svg {
            color: var(--realsecondary-color);
            opacity: 0.5;
            margin-bottom: 1rem;
        }
        
        .empty-container h3 {
            margin-bottom: 0.5rem;
            color: var(--onyx);
        }
        
        .empty-container p {
            color: var(--real-grey);
            margin-bottom: 1.5rem;
            max-width: 400px;
        }
        
        .btn-primary {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: filter 0.3s ease;
        }
        
        .btn-primary:hover {
            filter: brightness(0.9);
        }
        
        /* Loading state */
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 0;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
        }
        
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Error state */
        .error-container {
            text-align: center;
            padding: 3rem 0;
            background-color: var(--background-nav);
            border-radius: 8px;
            box-shadow: 0 2px 4px var(--shadow-color);
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .error-container svg {
            color: var(--tertiary-color);
            opacity: 0.5;
            margin-bottom: 1rem;
        }
        
        /* Offer card animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .offre-card {
            animation: fadeIn 0.3s ease-out forwards;
            opacity: 0;
            transition: opacity 0.5s, transform 0.5s;
            cursor: pointer;
        }
        
        /* Apply button */
        .apply-button {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 1rem;
            transition: filter 0.3s ease;
        }
        
        .apply-button:hover {
            filter: brightness(0.9);
        }
        
        /* For users who prefer reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .spinner {
                animation: none;
            }
            
            .offre-card {
                animation: none;
                opacity: 1;
            }
        }

                .offres-container {
            background-color: var(--background-nav);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px var(--shadow-color);
        }
    </style>
{% endblock %}", "wishlist/index.html.twig", "C:\\Users\\Asha\\Documents\\GitHub\\Panikpa\\App\\templates\\wishlist\\index.html.twig");
    }
}
