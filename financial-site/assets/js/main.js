// assets/js/main.js - Main JavaScript for Unique Trust Investment 

// Hamburger menu toggle for mobile navigation
const hamburger = document.getElementById('hamburger-menu');
const navLinks = document.querySelector('.nav-links');

if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('open');
    });
} 