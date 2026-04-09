/**
 * Mega Menu Accessibility Script
 *
 * Ultra-lightweight script to handle ARIA states and keyboard navigation for the mega menu.
 */

document.addEventListener('DOMContentLoaded', () => {
    const megaMenuItems = document.querySelectorAll('.main-navigation li.has-mega-menu');

    megaMenuItems.forEach(item => {
        const link = item.querySelector('a');
        const content = item.querySelector('.mega-menu-content');

        if (!link || !content) return;

        // Set initial ARIA states
        link.setAttribute('aria-haspopup', 'true');
        link.setAttribute('aria-expanded', 'false');

        const toggleExpanded = (isExpanded: boolean) => {
            link.setAttribute('aria-expanded', isExpanded.toString());
        };

        // Update ARIA on hover
        item.addEventListener('mouseenter', () => toggleExpanded(true));
        item.addEventListener('mouseleave', () => toggleExpanded(false));

        // Update ARIA on focus-within
        item.addEventListener('focusin', () => toggleExpanded(true));
        item.addEventListener('focusout', (e: FocusEvent) => {
            if (!item.contains(e.relatedTarget as Node)) {
                toggleExpanded(false);
            }
        });

        // Close on Escape key
        item.addEventListener('keydown', (e: KeyboardEvent) => {
            if (e.key === 'Escape') {
                toggleExpanded(false);
                link.focus();
            }
        });
    });
});
