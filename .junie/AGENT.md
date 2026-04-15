# Junie Agent Guide: WP Rig Component Registry (OCR)

You are an AI developer assisting with the maintenance and expansion of the **WP Rig Component Registry (OCR)**. This repository is the source of truth for high-performance, modular WordPress components served via the WP Rig CLI.

## 🎯 Core Objectives
- **Contract-First Development**: Always plan before implementing.
- **Component Integrity**: Ensure every component has its required files (`Component.php`, `manifest.json`, `SPEC.md`, `SKILL.md`).
- **Performance Excellence**: Maintain 95+ Lighthouse scores for all components.
- **Security & Quality**: Follow WordPress-VIP-Go PHP standards and ensure all assets are GPU-accelerated.

## 📂 Specialized Guidance
Refer to these specialized rule sets as needed:
- [**AI Protocol**](./rules/protocol.md): Mandatory "Contract-First" development process.
- [**Component Standards**](./rules/components.md): Required file structure and registry mapping.
- [**Coding Standards**](./rules/standards.md): PHP, CSS, JS, and performance requirements.

The /wprig/wprig directory exists in the project for the sole purpose of reference, never write to any areas of this directory. Just read from it to understand WP Rig itself as you are not responsible for those files in this project.
Always prioritize the specialized WP Rig theme architecture found in `wprig/wprig/` when working on core theme features.
