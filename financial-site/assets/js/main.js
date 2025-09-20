
// Hamburger menu toggle for mobile navigation
const hamburger = document.getElementById('hamburger-menu');
const navLinks = document.querySelector('.nav-links');

if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('open');
    });
} 



// Scroll to Top Button

let btnScroll = document.getElementById("btn-scroll");
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    btnScroll.style.display = "block";
  } else {
    btnScroll.style.display = "none";
  }
}

function scrollToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}