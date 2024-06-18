// Import necessary dependencies
import './bootstrap';
import Alpine from 'alpinejs';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    function createStars() {
        const starsOverlay = document.querySelector('.stars-overlay');
        if (starsOverlay) {
            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                star.style.top = `${Math.random() * 100}%`;
                star.style.left = `${Math.random() * 100}%`;
                star.style.animationDuration = `${Math.random() * 3 + 1}s`;
                starsOverlay.appendChild(star);
            }
        }
    }
    createStars();

    function showForm(formId) {
        document.querySelectorAll('.form-container').forEach((form) => {
            form.classList.remove('active');
        });
        document.getElementById(formId).classList.add('active');
    }
    window.showForm = showForm;
});
