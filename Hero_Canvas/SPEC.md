# SPEC.md: Hero Canvas (Three.js / WebGL)

A high-impact visual background component for theme headers using Three.js.

## 1. Overview
A performance-optimized background canvas that renders a 3D scene (particles or moving gradients) using WebGL. It is designed to sit behind theme header content.

## 2. Architecture
- **PHP**: Renders a `<canvas id="wprig-hero-canvas">` element and enqueues the required scripts/styles.
- **JavaScript**: Initializes a Three.js scene, camera, and renderer. Implements a responsive background effect.
- **Three.js**: Loaded via CDN (`https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js` or similar).

## 3. Data Attributes (Configurable)
- `data-hero-opacity`: (Optional) The opacity of the canvas (default: 0.5).
- `data-hero-density`: (Optional) The density of particles (default: 500).
- `data-hero-color`: (Optional) Primary particle/gradient color (default: `#333333`).

## 4. PHP Implementation Details
- **Namespace**: `WP_Rig\WP_Rig\Hero_Canvas`
- **Class**: `Component` implements `Component_Interface` and `Asset_Provider`.
- **Initialization**: 
    - Enqueue Three.js from a CDN.
    - Provide a helper function `wprig_hero_canvas( $args )` to output the canvas element.
    - Inject the canvas into the theme header via `wp_head` or a template tag.

## 5. JavaScript / TypeScript Logic
- Listen for `DOMContentLoaded`.
- Detect the presence of `#wprig-hero-canvas`.
- Initialize `THREE.Scene`, `THREE.PerspectiveCamera`, and `THREE.WebGLRenderer`.
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
    - `js`: `assets/js/src/hero-canvas.ts`
