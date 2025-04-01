document.addEventListener('DOMContentLoaded', () => {
    // Form validation
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');

    // Password validation for registration
    if (registerForm) {
        const password = document.getElementById('mot-de-passe');
        const confirmPassword = document.getElementById('confirm-mot-de-passe');

        registerForm.addEventListener('submit', (e) => {
            // Password match validation
            if (password.value !== confirmPassword.value) {
                e.preventDefault();
                showError(confirmPassword, 'Les mots de passe ne correspondent pas');
                return false;
            }

            // Password strength validation
            if (password.value.length < 8) {
                e.preventDefault();
                showError(password, 'Le mot de passe doit contenir au moins 8 caractères');
                return false;
            }
        });

        // Clear error on input
        password.addEventListener('input', () => {
            clearError(password);
        });

        confirmPassword.addEventListener('input', () => {
            clearError(confirmPassword);
            // Real-time validation
            if (password.value !== confirmPassword.value && confirmPassword.value !== '') {
                showError(confirmPassword, 'Les mots de passe ne correspondent pas', false);
            }
        });
    }

    // Login form validation
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            const identifiant = document.getElementById('identifiant');
            const motDePasse = document.getElementById('mot-de-passe');

            if (!validateEmail(identifiant.value)) {
                e.preventDefault();
                showError(identifiant, 'Veuillez entrer une adresse e-mail valide');
                return false;
            }

            if (motDePasse.value.length < 1) {
                e.preventDefault();
                showError(motDePasse, 'Veuillez entrer votre mot de passe');
                return false;
            }
        });
    }

    // Helper functions
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function showError(input, message, focus = true) {
        // Remove any existing error
        clearError(input);

        // Create error element
        const error = document.createElement('div');
        error.className = 'error-message';
        error.innerHTML = message;
        
        // Insert error after input
        input.parentNode.appendChild(error);
        
        // Highlight input
        input.classList.add('input-error');
        
        // Focus on input
        if (focus) {
            input.focus();
        }
    }

    function clearError(input) {
        // Remove error class from input
        input.classList.remove('input-error');
        
        // Remove error message if it exists
        const parent = input.parentNode;
        const error = parent.querySelector('.error-message');
        if (error) {
            parent.removeChild(error);
        }
    }
    
    // For displaying "J" in the avatar circle on the registration page
    const civiliteSelect = document.getElementById('civilite');
    if (civiliteSelect) {
        civiliteSelect.addEventListener('change', function() {
            // This functionality would be added if we had the avatar circle in the UI
            console.log('Civilité changed:', this.value);
        });
    }
});
