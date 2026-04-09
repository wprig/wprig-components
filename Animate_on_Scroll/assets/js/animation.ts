/**
 * Animate on Scroll (AOS)
 *
 * Uses Intersection Observer to trigger animations.
 * Integrated with PHP settings via wp_localize_script.
 */

interface WPRigAosSettings {
    duration: string;
}

declare const wprigAosSettings: WPRigAosSettings;

document.addEventListener('DOMContentLoaded', () => {
    // 1. Inject global settings from PHP into :root if available
    if (typeof wprigAosSettings !== 'undefined' && wprigAosSettings.duration) {
        document.documentElement.style.setProperty('--wprig-aos-duration', wprigAosSettings.duration);
    }

    const aosElements = document.querySelectorAll<HTMLElement>('[data-wprig-aos]');

    if (!aosElements.length) {
        return;
    }

    // Fallback for browsers without IntersectionObserver
    if (!('IntersectionObserver' in window)) {
        aosElements.forEach(el => el.setAttribute('data-aos-state', 'visible'));
        return;
    }

    const observerOptions: IntersectionObserverInit = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target as HTMLElement;
                
                // Handle dynamic delay/duration via CSS variables if overridden per-element
                const delay = element.getAttribute('data-wprig-aos-delay');
                const duration = element.getAttribute('data-wprig-aos-duration');
                
                if (delay) {
                    element.style.setProperty('--wprig-aos-delay', `${delay}ms`);
                }
                if (duration) {
                    element.style.setProperty('--wprig-aos-duration', `${duration}ms`);
                }

                // Add the visible state to trigger the CSS transition
                element.setAttribute('data-aos-state', 'visible');
                
                // Remove will-change after animation to save memory
                element.addEventListener('transitionend', () => {
                    element.style.willChange = 'auto';
                }, { once: true });

                // Once it's visible, we can stop observing it
                observer.unobserve(element);
            }
        });
    }, observerOptions);

    aosElements.forEach(el => observer.observe(el));
});
