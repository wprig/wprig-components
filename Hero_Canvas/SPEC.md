# SPEC.md: Hero Canvas (Raw Canvas)

A high-impact visual background component for theme headers using Raw Canvas API.

## 1. Overview
A performance-optimized background canvas that renders a 2D particle system using the native Canvas API. It is designed to sit behind theme header content.

## 2. Architecture
- **PHP**: Renders a `<canvas id="wprig-hero-canvas">` element and enqueues the required scripts.
- **JavaScript**: Initializes a 2D canvas context and implements a responsive particle effect.
- **External Dependencies**: None (Ultra-lightweight).

## 3. Data Attributes (Configurable)
- `data-hero-opacity`: (Optional) The opacity of the canvas (default: 0.5).
- `data-hero-density`: (Optional) The density of particles (default: 500).
- `data-hero-color`: (Optional) Primary particle/gradient color (default: `#333333`).

## 4. PHP Implementation Details
- **Namespace**: `WP_Rig\WP_Rig\Hero_Canvas`
- **Class**: `Component` implements `Component_Interface` and `Asset_Provider`.
- **Initialization**: 
    - Provide a helper function `wprig_hero_canvas( $args )` to output the canvas element.
    - Inject the canvas into the theme header via `wp_head` or a template tag.

## 5. JavaScript / TypeScript Logic
- Listen for `DOMContentLoaded`.
- Detect the presence of `#wprig-hero-canvas`.
- Initialize `CanvasRenderingContext2D`.
- Implement a `window` resize listener to keep the canvas full-width/full-height.
- Implement a basic animation loop with `requestAnimationFrame`.

## 6. Performance
- Handle `resize` events with debouncing or simple updates.
- Use a low-resolution renderer or simple shaders to ensure 95+ Lighthouse score.
- Ensure the canvas is `pointer-events: none` to not interfere with user interaction.

## 7. Registry Mapping (`manifest.json`)
- **Slug**: `hero-canvas`
- **PHP Mapping**: `Hero_Canvas`: `inc/Hero_Canvas`
- **Asset Mapping**:
    - `js`: `assets/js/hero-canvas.ts`
