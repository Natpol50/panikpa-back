// Fonction pour charger le contenu HTML
async function loadCookieComponents() {
    try {
        // Charger les cookies modaux
        const response = await fetch('Component/cookies.html');
        const htmlContent = await response.text();
        
        const cookieContainer = document.createElement('div');
        cookieContainer.id = 'cookie-components';
        cookieContainer.innerHTML = htmlContent;
        
        document.querySelector('main').appendChild(cookieContainer);
        
        // Initialiser les gestionnaires d'événements après l'insertion
        initializeCookieHandlers();
        
        // Vérifier les cookies après l'insertion du HTML
        if (!getCookie('cookieConsent')) {
            showCookieBanner();
        }
    } catch (error) {
        console.error('Erreur lors du chargement des composants de cookies:', error);
    }
}

// Initialisation des gestionnaires d'événements
function initializeCookieHandlers() {
    // Gestionnaire pour la modal
    const cookieSettings = document.getElementById('cookieSettings');
    if (cookieSettings) {
        cookieSettings.addEventListener('click', (e) => {
            if (e.target.id === 'cookieSettings') {
                closeCookieSettings();
            }
        });
    }

    // Gestionnaire pour la touche Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeCookieSettings();
        }
    });
}

// Fonctions de gestion des cookies
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function showCookieBanner() {
    const banner = document.getElementById('cookieBanner');
    if (banner) banner.classList.add('visible');
}

function hideCookieBanner() {
    const banner = document.getElementById('cookieBanner');
    if (banner) banner.classList.remove('visible');
}

// Gestionnaires d'événements pour les boutons
function acceptAllCookies() {
    setCookie('cookieConsent', 'all', 365);
    setCookie('analyticsCookies', 'true', 365);
    setCookie('marketingCookies', 'true', 365);
    hideCookieBanner();
}

function rejectNonEssentialCookies() {
    setCookie('cookieConsent', 'essential', 365);
    setCookie('analyticsCookies', 'false', 365);
    setCookie('marketingCookies', 'false', 365);
    hideCookieBanner();
}

function openCookieSettings() {
    const modal = document.getElementById('cookieSettings');
    if (!modal) return;
    
    modal.style.display = 'flex';
    
    // Charger les préférences actuelles
    const analyticsCookies = getCookie('analyticsCookies') === 'true';
    const marketingCookies = getCookie('marketingCookies') === 'true';
    
    const analyticsCookiesEl = document.getElementById('analyticsCookies');
    const marketingCookiesEl = document.getElementById('marketingCookies');
    
    if (analyticsCookiesEl) analyticsCookiesEl.checked = analyticsCookies;
    if (marketingCookiesEl) marketingCookiesEl.checked = marketingCookies;
}

function closeCookieSettings() {
    const modal = document.getElementById('cookieSettings');
    if (modal) modal.style.display = 'none';
}

function saveCookiePreferences() {
    const analyticsCookies = document.getElementById('analyticsCookies')?.checked || false;
    const marketingCookies = document.getElementById('marketingCookies')?.checked || false;
    
    setCookie('cookieConsent', 'custom', 365);
    setCookie('analyticsCookies', analyticsCookies.toString(), 365);
    setCookie('marketingCookies', marketingCookies.toString(), 365);
    
    closeCookieSettings();
    hideCookieBanner();
}

// Charger les composants au chargement de la page
document.addEventListener('DOMContentLoaded', loadCookieComponents);