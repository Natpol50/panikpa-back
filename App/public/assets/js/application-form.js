// Show loading animation and handle form submission
document.getElementById('application-form').addEventListener('submit', async function (event) {
    event.preventDefault();

    // Show loading animation
    const loadingAnimation = document.getElementById('loading-animation');
    loadingAnimation.style.display = 'flex';

    const formData = new FormData(this);

    try {
        const response = await fetch('submit_application.php', {
            method: 'POST',
            body: formData
        });

        const rawResponse = await response.text();
        console.log('Raw Response:', rawResponse);

        const result = JSON.parse(rawResponse);

        const popup = document.getElementById('popup');
        const popupMessage = document.getElementById('popup-message');

        if (result.success) {
            popup.className = 'popup success'; // Add success class
            popupMessage.textContent = result.message;
        } else {
            popup.className = 'popup error'; // Add error class
            popupMessage.textContent = result.message;
        }

        popup.style.display = 'block';
        setTimeout(closePopup, 5000);
    } catch (error) {
        console.error('Error:', error);
        const popup = document.getElementById('popup');
        const popupMessage = document.getElementById('popup-message');
        popup.className = 'popup error'; // Add error class
        popupMessage.textContent = 'Une erreur s\'est produite. Veuillez réessayer.';
        popup.style.display = 'block';
    } finally {
        // Hide loading animation
        loadingAnimation.style.display = 'none';
    }
});

// Update file info when a file is selected
document.getElementById('file-upload').addEventListener('change', function () {
    const fileInput = this;
    const fileName = document.getElementById('file-name');
    const fileSize = document.getElementById('file-size');

    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        fileName.textContent = file.name;
        fileSize.textContent = (file.size / (1024 * 1024)).toFixed(2);
    } else {
        fileName.textContent = 'Aucun fichier choisi';
        fileSize.textContent = '0';
    }
});

// Close popup
function closePopup() {
    const popup = document.getElementById('popup');
    popup.style.display = 'none';
}