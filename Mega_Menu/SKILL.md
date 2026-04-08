# SKILL.md: Mega Menu Builder

Instructions for AI Agents to use and modify the Mega Menu Builder.

## Usage Recipe: Enabling 4-Column Mega Menu

1. **Goal**: Create a multi-column dropdown for the main site navigation.
2. **Action**: 
    - In the WordPress Admin (Appearance > Menus), select a top-level menu item.
    - Add the CSS class `has-mega-menu` to the "CSS Classes" field.
    - Ensure sub-items are nested underneath.
3. **Markup**:
    - The `Mega_Menu_Walker` will automatically wrap sub-items in a `.mega-menu-content` container.
    - Top-level sub-items will act as column headers.

## Guidelines for Modification
- **Changing Grid Layout**:
  1. Modify `assets/css/src/components/_mega-menu.css`.
  2. Change the `grid-template-columns` property for `.mega-menu-content`.
- **Adding Featured Images**:
  1. Modify the `Mega_Menu_Walker` to check for `_thumbnail_id` meta on the menu item.
  2. Output the featured image markup within the column.
- **Performance**:
  - Keep JS interaction handling minimal.
  - Rely on CSS `:hover` or the `aria-expanded` toggle provided by WP Rig core.
- **Responsiveness**:
  - The menu should automatically collapse to a standard mobile menu below the theme's defined breakpoint.
