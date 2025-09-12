/**
 * Performance optimizations for the website
 * This script handles preloading of common assets and other performance enhancements
 */
document.addEventListener('DOMContentLoaded', function() {
    // Preload common placeholder images
    preloadImage('../../assets/img/placeholders/maps.png');
    preloadImage('../../assets/img/placeholders/monsters.png');
    preloadImage('../../assets/img/placeholders/npcs.png');
    preloadImage('../../assets/img/placeholders/items.png');
    
    // Add intersection observer for lazy-loaded images
    setupLazyLoadObserver();
});

/**
 * Preload an image to ensure it's in browser cache
 * @param {string} src - The image source URL
 */
function preloadImage(src) {
    const img = new Image();
    img.src = src;
}

/**
 * Setup intersection observer for better lazy loading
 */
function setupLazyLoadObserver() {
    // Check if IntersectionObserver is supported
    if ('IntersectionObserver' in window) {
        const lazyImageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const lazyImage = entry.target;
                    if (lazyImage.dataset.src) {
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.removeAttribute('data-src');
                    }
                    observer.unobserve(lazyImage);
                }
            });
        });

        // Find all images with data-src attribute
        document.querySelectorAll('img[data-src]').forEach(img => {
            lazyImageObserver.observe(img);
        });
    }
}
