# WP Rig Component Registry

This repository acts as the source of truth for the WP Rig Component Registry (OCR). The WP Rig Component Registry plugin on `wprig.io` communicates with this repository via the GitHub API to serve components to the WP Rig CLI.

## Directory Structure

The repository follows a simple directory-per-component structure. Each component must be located in its own top-level folder:

```text
/wprig-components
  ├── [ComponentName]/
  │   ├── Component.php
  │   ├── manifest.json
  │   ├── SPEC.md
  │   └── SKILL.md
```

### Required Files for Components:
- `Component.php`: The main component logic.
- `manifest.json`: Metadata for the component (version, author, dependencies, etc.).
- `SPEC.md`: Component specification.
- `SKILL.md`: Component skill definition.

## Integration

The `WP Rig Component Registry` plugin requires a GitHub Personal Access Token (PAT) with `public_repo` (or `repo`) scope to perform operations.

### Configuration on wprig.io:
1. Navigate to **WP Rig Registry > Settings**.
2. Enter the **Repository Owner**, **Repository Name** (`wprig-components`), and the **Personal Access Token**.
3. Use **Test Connection** to verify.

## Implementation Guides

Detailed implementation guides for starter components are available in the `docs/` folder:
- [Hero-Canvas (Three.js / WebGL)](docs/guide-hero-canvas.md)
- [Mega-Menu Builder (Source-First)](docs/guide-mega-menu.md)
- [Kinetic Typography Engine](docs/guide-kinetic-typography.md)
- [Native Animate on Scroll (AOS)](docs/guide-animate-on-scroll.md)

## Contributing

To submit new components or update existing ones, use the `rig:submit` command from the WP Rig CLI. Each submission should follow the standard WP Rig component structure.
