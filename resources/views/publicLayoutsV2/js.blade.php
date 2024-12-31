<script>
const productSlider = document.querySelector('.product-slider');

let isDragging = false;
let startX, scrollLeft;

// Mouse Down Event
productSlider.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.pageX - productSlider.offsetLeft;
    scrollLeft = productSlider.scrollLeft;
    productSlider.classList.add('active');
});

// Mouse Leave or Up Event
productSlider.addEventListener('mouseleave', () => {
    isDragging = false;
    productSlider.classList.remove('active');
});

productSlider.addEventListener('mouseup', () => {
    isDragging = false;
    productSlider.classList.remove('active');
});

// Mouse Move Event
productSlider.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - productSlider.offsetLeft;
    const walk = (x - startX) * 2; // Speed factor
    productSlider.scrollLeft = scrollLeft - walk;
});

// Touch Events for Mobile
productSlider.addEventListener('touchstart', (e) => {
    isDragging = true;
    startX = e.touches[0].pageX - productSlider.offsetLeft;
    scrollLeft = productSlider.scrollLeft;
});

productSlider.addEventListener('touchend', () => {
    isDragging = false;
});

productSlider.addEventListener('touchmove', (e) => {
    if (!isDragging) return;
    const x = e.touches[0].pageX - productSlider.offsetLeft;
    const walk = (x - startX) * 2; // Speed factor
    productSlider.scrollLeft = scrollLeft - walk;
});

const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

// Toggle visibility of nav links
menuToggle.addEventListener('click', () => {
    if (navLinks.classList.contains('visible')) {
        navLinks.classList.remove('visible');
    } else {
        navLinks.classList.add('visible');
    }
});

// Ensure menu is hidden by default on page load
window.addEventListener('DOMContentLoaded', () => {
    navLinks.classList.remove('visible');
});
$(window).on('load', function () {
    // Ensure the preloader hides after the page has loaded
    $('.loader').fadeOut(); // Fade out the loader animation
    $('.loader-mask').delay(200).fadeOut('slow'); // Fade out the background mask
});

// Fallback in case the load event is delayed
setTimeout(function () {
    $('.loader, .loader-mask').fadeOut();
    console.log('Fallback: Preloader hidden after timeout');
}, 5000);

</script>

