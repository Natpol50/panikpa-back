/**
 * Wishlist functionality for PANIKPA
 * Manages the wishlist star button interactions and server communication
 */
function initWishlistButtons() {
    const wishlistButtons = document.querySelectorAll('.wishlist-star');
    
    wishlistButtons.forEach(button => {
        button.addEventListener('click', handleWishlistClick);
    });
}

/**
 * Handle click on wishlist star
 * @param {Event} e - Click event
 */
async function handleWishlistClick(e) {
    e.preventDefault();
    e.stopPropagation();
    
    const button = e.currentTarget;
    const offerId = button.dataset.id;
    
    // Prevent multiple clicks
    if (button.classList.contains('loading')) {
        return;
    }
    
    // Visual feedback
    button.classList.add('loading');
    button.classList.add('clicked');
    
    // Delay removing the clicked class for animation
    setTimeout(() => {
        button.classList.remove('clicked');
    }, 400);
    
    try {
        // Send request to server
        const response = await fetch('wishlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `offer_id=${offerId}`
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update UI based on new wishlist state
            updateWishlistUI(button, data.wishlisted);
            
            // Find and update the wishlist badge
            const offerCard = button.closest('.offre-card');
            updateWishlistBadge(offerCard, data.wishlisted);
        } else {
            console.error('Error updating wishlist:', data.message);
        }
    } catch (error) {
        console.error('Error communicating with server:', error);
    } finally {
        // Remove loading state
        button.classList.remove('loading');
    }
}

/**
 * Update the UI state of the wishlist button
 * @param {HTMLElement} button - The wishlist star button
 * @param {boolean} isWishlisted - New wishlist state
 */
function updateWishlistUI(button, isWishlisted) {
    if (isWishlisted) {
        button.classList.add('active');
        button.setAttribute('aria-label', 'Retirer de la wishlist');
        button.setAttribute('title', 'Retirer de la wishlist');
    } else {
        button.classList.remove('active');
        button.setAttribute('aria-label', 'Ajouter à la wishlist');
        button.setAttribute('title', 'Ajouter à la wishlist');
    }
}

/**
 * Update or create the wishlist badge in the offer card
 * @param {HTMLElement} offerCard - The offer card element
 * @param {boolean} isWishlisted - New wishlist state
 */
function updateWishlistBadge(offerCard, isWishlisted) {
    let wishlistBadge = offerCard.querySelector('.wishlist-badge');
    
    if (isWishlisted) {
        if (!wishlistBadge) {
            wishlistBadge = document.createElement('p');
            wishlistBadge.className = 'wishlist-badge';
            wishlistBadge.textContent = 'Dans votre wishlist';
            offerCard.appendChild(wishlistBadge);
        }
    } else {
        if (wishlistBadge) {
            offerCard.removeChild(wishlistBadge);
        }
    }
}