# Specification: TGM Plugin Activation (TGMPA)

A standardized way for WP Rig theme developers to curate a list of required or recommended plugins for their theme.

## 1. Goal
Provide a performance-first, modular integration of the [TGM Plugin Activation](http://tgmpluginactivation.com/) library into the WP Rig Component Registry. This allows theme developers to guide users toward installing necessary plugins without manual boilerplate.

## 2. Architecture

### PHP Logic
- **Namespace**: `WP_Rig\WP_Rig\TGM_Plugin_Activation`
- **Class**: `Component` (implements `Component_Interface`)
- **Library**: `inc/class-tgm-plugin-activation.php`

### Hook Integration
- `tgmpa_register`: Used to register plugins with the TGMPA library.
- `wprig_tgm_plugins`: A filter allowing developers to define the list of plugins.

## 3. Data Attributes & Hooks
This component does not use front-end data attributes as it is an admin-side utility.

### Filters
- `wprig_tgm_plugins`:
  - **Description**: Returns an array of plugin definitions.
  - **Parameters**: `array $plugins`
  - **Expected Return**: `array`

## 4. PHP/JS/CSS Mapping
This component is PHP-only.

- **PHP**: `Component.php`
- **JS**: None
- **CSS**: None

## 5. Performance Goals
- **Lighthouse Score**: 95+ (No front-end impact).
- **Admin Impact**: Minimal, library only loads when needed in the admin dashboard.

## 6. Security
- TGMPA follows WordPress security best practices for plugin installation and activation.
- All plugin definitions are filtered through `wprig_tgm_plugins`.
- VIP-Go standards compliance.
