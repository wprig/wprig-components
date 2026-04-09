# SPEC.md: Animate on Scroll (AOS)

Ultra-lightweight Intersection Observer implementation to replace heavy AOS plugins.

## 1. Overview
A performance-first animation-on-scroll system that uses the native `IntersectionObserver` API instead of legacy scroll listeners.

## 2. Architecture
- **PHP**: Injects `data-wprig-aos` attributes into core Gutenberg blocks via the `render_block` filter.
- **JavaScript**: A single `IntersectionObserver` instance to observe all elements with `data-wprig-aos`. It sets `data-aos-state="visible"` when an element enters the viewport.
- **CSS**: Uses GPU-accelerated transitions (`transform` and `opacity`) to perform the animations.

## 3. Data Attributes
- `data-wprig-aos`: The animation type. Supported: `fade-up`, `fade-down`, `fade-in`, `zoom-in`.
- `data-wprig-aos-delay`: (Optional) Delay in milliseconds.
- `data-wprig-aos-duration`: (Optional) Duration in milliseconds.
- `data-aos-state`: Set by JS to `visible` when the animation should trigger.

## 4. PHP Implementation Details
- **Namespace**: `WP_Rig\WP_Rig\Animate_on_Scroll`
- **Class**: `Component` implements `Component_Interface`
- **Target Blocks**: `core/group`, `core/image`, `core/heading`, `core/media-text` (Hardcoded for now).
- **Filter**: `render_block` at priority 10.

## 5. CSS/Performance
- All animations must use `translate3d` and `opacity`.
- Respect `prefers-reduced-motion` by disabling transitions and setting opacity to 1.
- Target Lighthouse Score: 95+.

## 6. JavaScript Logic
- Listen for `DOMContentLoaded`.
- Initialize `IntersectionObserver` with a 0.1 threshold.
- `unobserve` element after it becomes visible to ensure it only animates once.

## 7. Registry Mapping (`manifest.json`)
- **Slug**: `animate-on-scroll`
- **PHP Mapping**: `Animate_on_Scroll`: `inc/Animate_on_Scroll` (When extracted into the theme).
- **Asset Mapping**:
    - `js`: `assets/js/animation.ts`
    - `css`: `assets/css/animation.css`
