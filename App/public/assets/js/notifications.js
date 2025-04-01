/**
 * Notification management for PANIKPA
 * 
 * This script manages notification display, auto-dismiss, and manual dismissal.
 */
document.addEventListener('DOMContentLoaded', () => {
    // Set up all notifications for auto-dismiss
    const notifications = document.querySelectorAll('.notification');
    
    if (notifications.length > 0) {
        // Set up each notification with auto-dismiss
        notifications.forEach((notification, index) => {
            // Set a staggered timeout for each notification
            const delay = 5000 + (index * 500); // 5 seconds base + staggered delay
            
            // Store the timeout ID on the element for potential cancellation
            notification.autoDismissTimeout = setTimeout(() => {
                closeNotification(notification);
            }, delay);
            
            // Pause the auto-dismiss when hovering
            notification.addEventListener('mouseenter', () => {
                // Stop the progress bar animation
                const progressBar = notification.querySelector('::after');
                if (progressBar) {
                    progressBar.style.animationPlayState = 'paused';
                }
                
                // Clear the timeout
                if (notification.autoDismissTimeout) {
                    clearTimeout(notification.autoDismissTimeout);
                }
            });
            
            // Resume the auto-dismiss when mouse leaves
            notification.addEventListener('mouseleave', () => {
                // Resume the progress bar animation
                const progressBar = notification.querySelector('::after');
                if (progressBar) {
                    progressBar.style.animationPlayState = 'running';
                }
                
                // Set a new timeout
                notification.autoDismissTimeout = setTimeout(() => {
                    closeNotification(notification);
                }, 5000); // Reset to 5 seconds
            });
        });
    }
});

/**
 * Close a notification with animation
 * @param {HTMLElement} notification - The notification element to close
 */
function closeNotification(notification) {
    // Clear any existing timeout
    if (notification.autoDismissTimeout) {
        clearTimeout(notification.autoDismissTimeout);
    }
    
    // Add the exit animation
    notification.style.animation = 'slideOut 0.3s ease-out forwards';
    
    // Remove the element after animation completes
    setTimeout(() => {
        notification.remove();
        
        // Check if there are no more notifications in this container
        const container = notification.closest('.notifications-container');
        if (container && container.childElementCount === 0) {
            container.remove();
        }
    }, 300); // Match the animation duration
}

/**
 * Programmatically add a new notification
 * @param {string} message - The notification message
 * @param {string} type - The notification type ('success' or 'error')
 */
function addNotification(message, type = 'success') {
    // Create container if it doesn't exist
    let container = document.querySelector(`.${type}-container`);
    if (!container) {
        container = document.createElement('div');
        container.className = `notifications-container ${type}-container`;
        
        // Find the appropriate place to insert it (after breadcrumb if exists, otherwise at the top of .container)
        const breadcrumb = document.querySelector('.breadcrumb');
        const targetContainer = document.querySelector('.container');
        
        if (breadcrumb) {
            breadcrumb.insertAdjacentElement('afterend', container);
        } else if (targetContainer) {
            targetContainer.prepend(container);
        }
    }
    
    // Create notification element
    const notificationId = Date.now();
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.dataset.notificationId = notificationId;
    notification.innerHTML = `
        <div class="notification-content">${message}</div>
        <button class="notification-close" aria-label="Close notification" 
                onclick="closeNotification(this.parentElement)">×</button>
    `;
    
    // Add to container
    container.appendChild(notification);
    
    // Set up auto-dismiss
    notification.autoDismissTimeout = setTimeout(() => {
        closeNotification(notification);
    }, 5000);
    
    // Return the created notification for potential further manipulation
    return notification;
}