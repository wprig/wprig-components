/**
 * Animate on Scroll (AOS)
 *
 * Uses Intersection Observer to trigger animations.
 */

document.addEventListener('DOMContentLoaded', () => {
    const observerOptions: IntersectionObserverInit = {
        root: null, // use the viewport
        rootMargin: '0px',
        threshold: 0.1 // trigger when 10% of the element is visible
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target as HTMLElement;
                
                // Add the visible state
                element.setAttribute('data-aos-state', 'visible');
                
                // Once it's visible, we can stop observing it
                observer.unobserve(element);
            }
        });
    }, observerOptions);

    // Target all elements with the data-wprig-aos attribute
    const aosElements = document.querySelectorAll('[data-wprig-aos]');
    aosElements.forEach(el => observer.observe(el));
});
