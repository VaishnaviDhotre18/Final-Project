document.addEventListener('DOMContentLoaded', function() {
    const sliderContainer = document.querySelector('.slider-container');
    const slides = document.querySelectorAll('.slide');
    const prevButton = document.querySelector('.prev-slide');
    const nextButton = document.querySelector('.next-slide');
    let currentIndex = 0;

    function updateSlider() {
        sliderContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
        slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === currentIndex);
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        updateSlider();
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        updateSlider();
    }

    if (nextButton && prevButton) {
        nextButton.addEventListener('click', nextSlide);
        prevButton.addEventListener('click', prevSlide);

        // Optional: Auto slide every 5 seconds
        setInterval(nextSlide, 5000);
    }

    updateSlider(); // Initialize on load
});

document.addEventListener('DOMContentLoaded', function() {
    // ... (previous slider code) ...

    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    const cartFeedback = document.createElement('div');
    cartFeedback.classList.add('cart-feedback');
    document.body.appendChild(cartFeedback);

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            cartFeedback.textContent = `Item ${productId} added to cart!`;
            cartFeedback.classList.add('show');
            setTimeout(() => {
                cartFeedback.classList.remove('show');
            }, 2000); // Hide after 2 seconds
            // In a real application, you would also send an AJAX request here
            // to update the server-side cart.
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // This is a highly simplified and inaccurate estimation
    const approximateBytesPerPageLoad = document.documentElement.outerHTML.length + document.styleSheets.length * 50000 + document.scripts.length * 20000; // Very rough guess
    const kwhPerGB = 0.00065; // Average estimate for data transfer
    const carbonIntensityGramsPerKwh = 475; // Global average (very rough)

    const gbPerPageLoad = approximateBytesPerPageLoad / (1024 * 1024 * 1024);
    const kwhPerPageLoad = gbPerPageLoad * kwhPerGB;
    const gramsCo2ePerPageLoad = kwhPerPageLoad * carbonIntensityGramsPerKwh;

    const carbonFootprintElement = document.getElementById('carbonFootprint');
    if (carbonFootprintElement) {
        carbonFootprintElement.textContent = `Estimated data transfer: ${(gbPerPageLoad * 1000).toFixed(2)} MB. Approximate potential carbon: ${gramsCo2ePerPageLoad.toFixed(4)} g CO2e (very rough estimate).`;
    }
});