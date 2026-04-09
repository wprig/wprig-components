# WP Rig Component Registry

This is the main registry index for WP Rig components. WP Rig can use this file to discover and fetch components.

## Components Index

| Slug | Title | Version | Directory | Description |
| :--- | :--- | :--- | :--- | :--- |
| `animation` | **Animate on Scroll (AOS)** | 1.1.0 | `Animate_on_Scroll` | Ultra-lightweight Intersection Observer implementation. |
| `hero-canvas` | **Hero Canvas (Three.js / WebGL)** | 1.1.0 | `Hero_Canvas` | A high-impact visual background component using Three.js. |
| `kinetic-typography` | **Kinetic Typography Engine** | 1.1.0 | `Kinetic_Typography` | High-performance text animations for editorial themes. |
| `mega-menu` | **Mega Menu Builder** | 1.1.0 | `Mega_Menu` | CSS Grid-based expansion for WP Rig core navigation. |

---

## Technical Metadata

The following JSON block provides machine-readable information about the registry.

```json
{
  "registry_name": "WP Rig OCR (Open Component Registry)",
  "version": "1.1.0",
  "base_url": "https://github.com/wprig/wprig-components",
  "components": [
    {
      "slug": "animation",
      "title": "Animate on Scroll (AOS)",
      "version": "1.1.0",
      "path": "Animate_on_Scroll",
      "manifest": "Animate_on_Scroll/manifest.json"
    },
    {
      "slug": "hero-canvas",
      "title": "Hero Canvas (Three.js / WebGL)",
      "version": "1.1.0",
      "path": "Hero_Canvas",
      "manifest": "Hero_Canvas/manifest.json"
    },
    {
      "slug": "kinetic-typography",
      "title": "Kinetic Typography Engine",
      "version": "1.1.0",
      "path": "Kinetic_Typography",
      "manifest": "Kinetic_Typography/manifest.json"
    },
    {
      "slug": "mega-menu",
      "title": "Mega Menu Builder",
      "version": "1.1.0",
      "path": "Mega_Menu",
      "manifest": "Mega_Menu/manifest.json"
    }
  ]
}
```

## How to use
To add a component to your WP Rig theme, use the CLI:

```bash
npm run rig:add [slug]
```

Example:
```bash
npm run rig:add animation
```
