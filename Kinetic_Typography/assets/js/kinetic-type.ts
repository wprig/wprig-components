/**
 * Kinetic Typography Engine
 *
 * Performance-optimized text animations.
 */

document.addEventListener('DOMContentLoaded', () => {
    const kineticElements = document.querySelectorAll('.wprig-kinetic-text');
    
    // Intersection Observer to trigger animations when in view
    const observerOptions = {
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-animating');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    kineticElements.forEach(el => {
        // If not already split by PHP, we could split here.
        // For the registry, we assume PHP does the splitting for SEO/Performance.
        observer.observe(el);
    });
});

/**
 * Hook for swapping splitting libraries.
 */
(window as any).wprigKineticSplit = (element: HTMLElement) => {
    // Default splitting logic if needed for dynamic content
    const text = element.textContent || '';
    element.innerHTML = '';
    text.split('').forEach((char, index) => {
        const span = document.createElement('span');
        span.className = 'char';
        span.style.setProperty('--char-index', index.toString());
        span.textContent = char;
        element.appendChild(span);
    });
};
