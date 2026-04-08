# SPEC.md: Mega Menu Builder

CSS Grid-based expansion for WP Rig’s core navigation to support multi-column dropdowns.

## 1. Overview
A modern, accessible mega menu system that leverages CSS Grid for responsive 4-column layouts. It integrates with WordPress's standard menu system via a custom `Walker_Nav_Menu`.

## 2. Architecture
- **PHP**: Implements a custom `Mega_Menu_Walker` class that extends `Walker_Nav_Menu`. It detects the `has-mega-menu` CSS class on top-level menu items.
- **CSS**: Uses CSS Grid to structure the dropdown. Fully responsive with mobile fallback.
- **JavaScript**: (Optional) Minimal interaction handling for accessibility if needed (WP Rig Core often handles this).

## 3. Data Attributes & Classes
- `.has-mega-menu`: Added to the top-level menu item in the WordPress menu editor to trigger the mega menu layout.
- `.mega-menu-content`: The container for the mega menu dropdown.
- `.mega-menu-column`: Individual columns within the grid.

## 4. PHP Implementation Details
- **Namespace**: `WP_Rig\WP_Rig\Mega_Menu`
- **Class**: `Component` implements `Component_Interface` and `Asset_Provider`.
- **Walker**: `Mega_Menu_Walker` (self-contained in `Component.php` for now).
- **Hooks**: Filters `wp_nav_menu_args` to use the custom walker if the theme location supports it.

## 5. CSS/Performance
- Use CSS Grid for the layout: `display: grid; grid-template-columns: repeat(4, 1fr);`.
- Lightning CSS optimized.
- No heavy JS dependencies for layout.
- GPU-accelerated dropdown animations.

## 6. Registry Mapping (`manifest.json`)
- **Slug**: `mega-menu`
- **PHP Mapping**: `Mega_Menu`: `inc/Mega_Menu`
- **Asset Mapping**:
    - `css`: `assets/css/src/components/_mega-menu.css`
