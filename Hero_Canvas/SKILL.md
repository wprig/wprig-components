# SKILL.md: Hero Canvas (Three.js / WebGL)

Instructions for AI Agents to use and modify the Hero Canvas component.

## Usage Recipe: Placing the Canvas Behind Theme Header Text

1. **Goal**: Add a dynamic, performance-first background to the main site header.
2. **Action**: 
    - Use the helper function `wprig_hero_canvas( [ 'opacity' => 0.5, 'density' => 200 ] )` in the `header.php` template.
    - Ensure the parent container of the header text has `position: relative; z-index: 2;`.
    - The canvas itself will have `position: absolute; top: 0; left: 0; z-index: 1;`.
3. **Attributes**:
   - `data-hero-opacity="0.3"` (Low opacity for subtle effect).
   - `data-hero-density="150"` (Fewer particles for better performance).
   - `data-hero-color="#ff0000"` (Specific theme primary color).

## Guidelines for Modification
- **Changing Animation Type**:
  1. Modify the `hero-canvas.ts` file.
  2. Implement a new `THREE.Mesh` or `THREE.Points` object.
  3. Ensure you are using `THREE.BufferGeometry` for large point counts to keep performance high.
- **Performance**:
  - NEVER run expensive calculations in the `animate()` loop if not necessary.
  - ALWAYS use `pointer-events: none` on the canvas to allow clicking through to links.
- **Reduced Motion**:
  - Use `window.matchMedia('(prefers-reduced-motion: reduce)').matches` to disable the `requestAnimationFrame` loop if the user prefers reduced motion.
