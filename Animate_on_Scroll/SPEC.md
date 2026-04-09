# SPEC.md: Animate on Scroll (AOS) - Updated

Ultra-lightweight Intersection Observer implementation to replace heavy AOS plugins. Optimized for performance and configurability.

## 1. Overview
A performance-first animation-on-scroll system that uses the native `IntersectionObserver` API. This version adds PHP-side configurability for animation type, duration, and target blocks.

## 2. Architecture
- **PHP**:
    - Defines class properties for `animation_type`, `animation_duration`, and `target_blocks`.
    - Implements a filter hook `wprig_aos_config` to allow overriding these properties.
    - Uses `wp_localize_script` to pass these configuration values to the JavaScript.
    - Injects `data-wprig-aos` attributes into the configured core Gutenberg blocks via the `render_block` filter.
- **JavaScript**:
    - Receives configuration from PHP via the `wprigAosSettings` object.
    - Dynamically injects global CSS variables into `:root` (e.g., `--wprig-aos-default-duration`).
    - Uses a single `IntersectionObserver` instance to observe all elements with `data-wprig-aos`.
    - Sets `data-aos-state="visible"` when an element enters the viewport.
- **CSS**:
    - Uses GPU-accelerated transitions (`transform` and `opacity`) to perform the animations.
    - Utilizes CSS variables for duration, allowing for easy global configuration.
    - Implements a refined set of 3 elegant animations with smooth cubic-bezier easing.

## 3. Configuration & Data Attributes
### PHP Configurable Properties (via Class Properties and `wprig_aos_config` filter):
- `animation_type`: `fade-in`, `fade-up`, `zoom-in`. Default: `fade-up`.
- `animation_duration`: Default: `600ms`.
- `target_blocks`: Default: `['core/group', 'core/image', 'core/heading', 'core/media-text']`.

### Data Attributes (on elements):
- `data-wprig-aos`: The animation type.
- `data-aos-state`: Set by JS to `visible` when the animation should trigger.

### CSS Variables (on `:root`):
- `--wprig-aos-duration`: Global duration, set by JS from PHP configuration.

## 4. Animation Styles (Elegant & Subtle)
1. **fade-in**:
    - Initial: `opacity: 0;`
    - Final: `opacity: 1;`
2. **fade-up** (Fade + Slide Up):
    - Initial: `opacity: 0; transform: translate3d(0, 20px, 0);`
    - Final: `opacity: 1; transform: translate3d(0, 0, 0);`
3. **zoom-in** (Fade + Subtle Scale):
    - Initial: `opacity: 0; transform: scale3d(0.95, 0.95, 1);`
    - Final: `opacity: 1; transform: scale3d(1, 1, 1);`

**Easing**: `cubic-bezier(0.165, 0.84, 0.44, 1)` (Quart Out).

## 5. Performance Goals
- **Lighthouse**: 95+ score.
- **Accessibility**: Respect `prefers-reduced-motion` by disabling transitions.
- **Footprint**: Minimal JS/CSS (~1KB gzipped).
- **Observer**: Elements are `unobserve`d after they become visible to ensure they only animate once.

## 6. Registry Mapping (`manifest.json`)
- **Slug**: `animate-on-scroll`
- **PHP Mapping**: `Animate_on_Scroll`: `inc/Animate_on_Scroll`
- **Asset Mapping**:
    - `js`: `assets/js/animation.ts`
    - `css`: `assets/css/animation.css`
