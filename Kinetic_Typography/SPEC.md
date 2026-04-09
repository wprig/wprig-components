# SPEC.md: Kinetic Typography Engine

High-performance text animations (splitting, skewing, fluid transitions) for editorial themes.

## 1. Overview
A performance-first kinetic typography system that splits text into individual characters or words and applies animations. Designed to be modular and lightweight.

## 2. Architecture
- **PHP**: Provides a helper function `wprig_kinetic_text( $text, $style )` that outputs text with necessary data attributes and initial markup.
- **JavaScript**: A lightweight utility to split text into `<span>` tags (if not already handled by PHP or for dynamic content). Applies animation hooks.
- **CSS**: Uses Lightning CSS `@keyframes` and `transition` for the actual motion, keeping JS execution to a minimum.

## 3. Data Attributes
- `data-wprig-kinetic`: The animation type. Supported: `reveal`, `float`, `glitch`, `skew`.
- `data-kinetic-duration`: (Optional) Animation duration in milliseconds.
- `data-kinetic-stagger`: (Optional) Stagger delay between characters.

## 4. PHP Implementation Details
- **Namespace**: `WP_Rig\WP_Rig\Kinetic_Typography`
- **Class**: `Component` implements `Component_Interface` and `Asset_Provider`.
- **Helper Function**: `wprig_kinetic_text( string $text, string $type = 'reveal', array $args = [] )`
- **Logic**: Wrap characters in `<span>` tags with CSS variable `--char-index` for easy staggering in CSS.

## 5. CSS/Performance
- Use CSS variables for staggering: `animation-delay: calc(var(--char-index) * 0.05s)`.
- GPU-accelerated: use `transform` and `opacity`.
- Respect `prefers-reduced-motion`.

## 6. JavaScript Logic
- Listen for `DOMContentLoaded`.
- Enhance server-side rendered kinetic text if needed (e.g. for viewport-based triggering).
- Provide a modular "splitting" system that can be extended with other libraries.

## 7. Registry Mapping (`manifest.json`)
- **Slug**: `kinetic-typography`
- **PHP Mapping**: `Kinetic_Typography`: `inc/Kinetic_Typography`
- **Asset Mapping**:
    - `js`: `assets/js/kinetic-type.ts`
    - `css`: `assets/css/kinetic-type.css`
