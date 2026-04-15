# WP Rig Component Standards (OCR)

Components in the **WP Rig Component Registry (OCR)** must follow a strict file and metadata structure to be valid.

## Required File Structure
Each component must live in its own directory at the root (or under `wprig/wprig/inc/` or `wprig/wprig/optional/` depending on context).

```text
[ComponentName]/
  ├── Component.php     # Main logic implementing Component_Interface
  ├── manifest.json     # Component metadata and file mappings
  ├── SPEC.md           # Component specification
  └── SKILL.md          # Component-specific AI skill definition
```

## `manifest.json` Mapping
Ensure `manifest.json` correctly maps PHP classes and assets:

```json
{
  "slug": "component-slug",
  "version": "1.0.0",
  "title": "Human Title",
  "description": "Short, informative description.",
  "php_class_mapping": {
    "Namespace": "inc/Namespace"
  },
  "asset_mapping": {
    "js": { "src": "assets/js/src/file.ts" },
    "css": { "src": "assets/css/src/file.css" }
  },
  "ai_context": {
    "spec": "SPEC.md",
    "skill": "SKILL.md"
  }
}
```

## Registry Requirements
- **Auto-Registration**: Components must be structured for the dynamic directory scanner in `inc/Theme.php`.
- **Performance**: Rendered output must contribute to a 95+ Lighthouse score.
- **Security**: All PHP must pass WordPress-VIP-Go standards.
