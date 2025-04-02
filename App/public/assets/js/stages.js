/**
 * Stages.js - JavaScript for the offers/stages.html.twig template
 * 
 * This script handles loading, displaying, and searching offer listings.
 * It uses the API endpoint to fetch offers with pagination and implements
 * client-side search functionality.
 */

document.addEventListener('DOMContentLoaded', async () => {
    // DOM elements
    const offersContainer = document.getElementById('offers-container');
    const loadingElement = document.getElementById('offers-loading');
    const errorElement = document.getElementById('offers-error');
    const errorMessage = document.getElementById('error-message');
    const emptyElement = document.getElementById('offers-empty');
    const paginationElement = document.getElementById('pagination');
    const prevPageButton = document.getElementById('prev-page');
    const nextPageButton = document.getElementById('next-page');
    const pageInfo = document.getElementById('page-info');
    const searchInput = document.getElementById('search-input');
    const searchButton = document.getElementById('search-button');
    
    // State variables
    let currentPage = 1;
    let totalPages = 1;
    let currentQuery = '';
    const itemsPerPage = 5;
    
    
    /**
     * Fetch offers from the API
     * @param {number} page - Page number
     * @param {string} query - Search query
     */
    async function fetchOffers(page = 1, query = '') {
        try {
            // Show loading state
            loadingElement.style.display = 'flex';
            offersContainer.style.display = 'none';
            errorElement.style.display = 'none';
            emptyElement.style.display = 'none';
            paginationElement.style.display = 'none';
            
            // Build API URL with parameters
            const url = `/API/GetOffers?page=${page}&limit=${itemsPerPage}&type=${offerType}&query=${encodeURIComponent(query)}`;
            
            console.log("Fetching offers from:", url);
            
            // Fetch data from API
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log("API response:", data);
            
            // Update state
            currentPage = data.currentPage;
            totalPages = data.totalPages;
            
            // Hide loading state
            loadingElement.style.display = 'none';
            
            // Process the response
            if (data.success) {
                if (data.offers && data.offers.length > 0) {
                    displayOffers(data.offers);
                    updatePagination(data.totalPages, data.currentPage);
                    offersContainer.style.display = 'grid';
                    paginationElement.style.display = 'flex';
                } else {
                    // No offers found
                    emptyElement.style.display = 'block';
                }
            } else {
                // API returned an error
                errorMessage.textContent = data.error || 'Une erreur s\'est produite lors du chargement des offres.';
                errorElement.style.display = 'block';
            }
        } catch (error) {
            // Handle fetch errors
            console.error('Error fetching offers:', error);
            errorMessage.textContent = error.message || 'Une erreur s\'est produite lors du chargement des offres.';
            loadingElement.style.display = 'none';
            errorElement.style.display = 'block';
        }
    }
    
    /**
     * Display offers in the container
     * @param {Array} offers - Array of offer objects
     */
    function displayOffers(offers) {
        // Clear existing offers
        offersContainer.innerHTML = '';
        
        // Animation delay for staggered appearance
        let delay = 0;
        
        // Create and append offer cards
        offers.forEach((offer, index) => {
            // Handle potential missing data
            const offerId = offer.id || offer.id_offer || index;
            const highlight = offer.highlighted || false;
            const wishlist = offer.wishlisted || false;
            const applied = offer.applied || false;
            
            const offerCard = document.createElement('div');
            offerCard.className = `offre-card ${highlight ? 'highlighted' : ''}`;
            offerCard.dataset.id = offerId;
            offerCard.style.animationDelay = `${delay}s`;
            delay += 0.1; // Stagger animation
            
            // Generate HTML for tags - defensive programming
            const tagsHTML = offer.tags && Array.isArray(offer.tags) 
                ? offer.tags.map(tag => 
                    `<span class="${tag.optional ? 'tag_optional' : 'tag'}">${tag.name}</span>`
                ).join('')
                : '';
            
            // Wishlist star button HTML
            const wishlistStarHTML = `
                <button class="wishlist-star ${wishlist ? 'active' : ''}" 
                        data-id="${offerId}" 
                        aria-label="${wishlist ? 'Retirer de la wishlist' : 'Ajouter à la wishlist'}"
                        title="${wishlist ? 'Retirer de la wishlist' : 'Ajouter à la wishlist'}">
                    <svg viewBox="0 0 24 24" width="24" height="24">
                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" />
                    </svg>
                </button>
            `;
            
            // Set the inner HTML of the offer card
            offerCard.innerHTML = `
                <div class="card-header">
                    <h3>${offer.title || offer.offer_title || 'Titre non disponible'}</h3>
                    ${wishlistStarHTML}
                </div>
                <p class="reference">${offer.company || ''} | ${offer.location || ''} | Réf. ${offer.reference || offerId}</p>
                <div class="tags">
                    <span class="tag">${offer.duration || offer.offer_duration || ''}</span>
                    <span class="tag">${offer.level || offer.offer_level || ''}</span>
                    ${tagsHTML}
                </div>
                <p>Commence le : ${offer.startDate || offer.offer_start || ''}</p>
                <p class="${(offer.remuneration === 0 || offer.offer_remuneration === 0) ? 'remuneration_negative' : 'remuneration'}">
                    ${(offer.remuneration === 0 || offer.offer_remuneration === 0) ? 'Non Rémunéré' : 'Rémunéré'}
                </p>
                ${highlight ? '<p class="tag_star">Candidat star !</p>' : ''}
                ${wishlist ? '<p class="wishlist-badge">Dans votre wishlist</p>' : ''}
                ${applied ? '<p class="wishlist-badge">Déjà postulé</p>' : ''}
            `;
            
            // Add click handler to navigate to offer details
            offerCard.addEventListener('click', (e) => {
                // Don't navigate if clicking on the wishlist star
                if (!e.target.closest('.wishlist-star')) {
                    window.location.href = `/offres/${offer.reference}`;
                }
            });
            
            // Append the card to the container
            offersContainer.appendChild(offerCard);
        });
        
        // Initialize wishlist functionality
        initWishlistButtons();
    }
    
    /**
     * Initialize wishlist star buttons
     */
    function initWishlistButtons() {
        const wishlistButtons = document.querySelectorAll('.wishlist-star');
        
        wishlistButtons.forEach(button => {
            // Remove existing listeners by cloning and replacing
            const newButton = button.cloneNode(true);
            button.parentNode.replaceChild(newButton, button);
            
            // Add new click event listener
                            newButton.addEventListener('click', async (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                const offerId = newButton.dataset.id;
                
                // Prevent multiple clicks
                if (newButton.classList.contains('loading')) {
                    return;
                }
                
                // Add visual feedback
                newButton.classList.add('loading');
                newButton.classList.add('clicked');
                
                try {
                    console.log("Toggling wishlist for offer ID:", offerId);
                    
                    // Send request to toggle wishlist status
                    const response = await fetch(`/API/wishlist/toggle/${offerId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });
                    
                    console.log("Wishlist toggle response status:", response.status);
                    const data = await response.json();
                    console.log("Wishlist toggle response data:", data);
                    
                    if (data.success) {
                        // Update button appearance
                        newButton.classList.toggle('active', data.wishlisted);
                        newButton.setAttribute('aria-label', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');
                        newButton.setAttribute('title', data.wishlisted ? 'Retirer de la wishlist' : 'Ajouter à la wishlist');
                        
                        // Update wishlist badge
                        const offerCard = newButton.closest('.offre-card');
                        let wishlistBadge = offerCard.querySelector('.wishlist-badge');
                        
                        if (data.wishlisted) {
                            if (!wishlistBadge) {
                                wishlistBadge = document.createElement('p');
                                wishlistBadge.className = 'wishlist-badge';
                                wishlistBadge.textContent = 'Dans votre wishlist';
                                offerCard.appendChild(wishlistBadge);
                            }
                        } else if (wishlistBadge) {
                            wishlistBadge.remove();
                        }
                    } else {
                        // Handle error (e.g., not authenticated)
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    }
                } catch (error) {
                    console.error('Error toggling wishlist:', error);
                } finally {
                    // Clean up animation classes
                    newButton.classList.remove('loading');
                    setTimeout(() => {
                        newButton.classList.remove('clicked');
                    }, 400);
                }
            });
        });
    }
    
    /**
     * Update pagination controls
     * @param {number} totalPages - Total number of pages
     * @param {number} currentPage - Current page number
     */
    function updatePagination(totalPages, currentPage) {
        pageInfo.textContent = `Page ${currentPage} sur ${totalPages}`;
        
        // Update button states
        prevPageButton.disabled = currentPage <= 1;
        nextPageButton.disabled = currentPage >= totalPages;
    }
    
    // Event listeners for pagination buttons
    prevPageButton.addEventListener('click', () => {
        if (currentPage > 1) {
            fetchOffers(currentPage - 1, currentQuery);
        }
    });
    
    nextPageButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            fetchOffers(currentPage + 1, currentQuery);
        }
    });
    
    // Search functionality
    searchButton.addEventListener('click', () => {
        const query = searchInput.value.trim();
        currentQuery = query;
        fetchOffers(1, query);
    });
    
    // Search on Enter key press
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            const query = searchInput.value.trim();
            currentQuery = query;
            fetchOffers(1, query);
        }
    });
    
    // Add offerType as data attribute to body for easy access
    document.body.dataset.offerType = offerType;
    
    // Initial fetch
    fetchOffers();
});