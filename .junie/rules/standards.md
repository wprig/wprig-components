# WP Rig Coding Standards

Maintain the following standards to ensure high performance and maintainable code.

## 💾 PHP
- **Namespace**: `WP_Rig\WP_Rig\[Feature]` (or context-specific namespace).
- **Standards**: Must pass `phpcs` using WordPress-VIP-Go rules.
- **Interfaces**: Features should implement `Component_Interface`.

## 🎨 CSS
- **Source**: Edit files in `assets/css/src/`.
- **Build**: Processed via Lightning CSS.
- **Performance**:
  - Always use `transform` and `opacity` for animations.
  - Animations must be GPU-accelerated.
  - Implement `prefers-reduced-motion`.
  - Prefer the `cookie-critical` strategy for above-the-fold assets.

## ⚡ JavaScript / TypeScript
- **Source**: Edit files in `assets/js/src/`.
- **Build**: Processed via esbuild.
- **Standards**: No scroll listeners unless absolutely necessary; use `IntersectionObserver` for scroll-based logic.

## 🏎️ Performance Goals
- **Lighthouse**: 95+ score.
- **FCP**: Minimize First Contentful Paint.
- **TTFB**: Ensure dynamic registration logic doesn't impact server response times.
