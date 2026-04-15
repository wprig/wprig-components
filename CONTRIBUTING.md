# Contributing to the WP Rig Component Registry (OCR)

The **WP Rig Component Registry (OCR)** is an open source repository for high-performance, modular WordPress components. We welcome contributions from the community to expand the ecosystem of components available to WP Rig users.

If you have found a problem or want to suggest an improvement or new feature, please file an issue.

## Workflow

### Submitting via WP Rig CLI (Recommended)

To submit new components or update existing ones, the recommended method is using the WP Rig CLI from within your local WP Rig installation.

```bash
npm run rig:submit
```

Each submission must follow the standard WP Rig component structure (see [Component Standards](#component-standards-ocr) below).

### Manual Contributions

If you want to contribute code to the registry itself or manually add a component:

1. **Set up a local development environment** with a WordPress site running on your computer.
2. **Fork the WP Rig Component Registry repository.**
3. **Clone the forked repository** to your computer.
4. **Create a new branch** for your changes.
5. **Make code changes** as necessary.
6. **Update `REGISTRY.md`** if you are adding a new component or updating a version. Ensure both the table and the JSON metadata are updated.
7. **Commit changes** within the new branch.
8. **Push the new branch** to your forked repository.
9. **Submit a Pull Request** explaining your changes and referencing any related issues.

## Guidelines for Pull Requests

- Keep pull requests as concise as possible. If you're addressing a bug, only submit the fixes for that bug.
- Submit unrelated cleanup, e.g. fixing spaces, tabs, or any violations caught by PHPCS, as its own pull request.

## Branch Naming Convention

Name your branches with prefixes and descriptions: `[type]/[change]`. Examples:
- `add/` = add a new component or feature
- `update/` = update an existing component or feature
- `fix/` = bug fix
- `try/` = experimental feature, "tentatively add"

## Component Standards (OCR)

Components in the **WP Rig Component Registry (OCR)** must follow a strict file and metadata structure to be valid.

### Required File Structure

Each component must live in its own directory at the root:

```text
[ComponentName]/
  ├── Component.php     # Main logic implementing Component_Interface
  ├── manifest.json     # Component metadata and file mappings
  ├── SPEC.md           # Component specification
  └── SKILL.md          # Component-specific AI skill definition
```

### `manifest.json` Mapping

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

## Mandatory AI Protocol: Contract-First Development

If you are using an AI coding agent to contribute to the registry, you **MUST** follow our opinionated standards:

1. **Read `.junie/AGENT.md`**: This is the entry point for all AI-specific guidance for this repository.
2. **Contract-First Development**: You are **FORBIDDEN** from writing implementation code until a `SPEC.md` exists and you have achieved a 95%+ implementation confidence score. Ask 3-10 clarifying questions about requirements.
3. **The Specification Phase**: Author a `SPEC.md` for every new feature or significant modification. Document the planned architecture, data attributes, and PHP/JS/CSS mapping. Get the `SPEC.md` **APPROVED** by the user before proceeding to implementation.
4. **Tool-First Scaffolding**: Use `npm run create-rig-component` or `npm run block:new` to scaffold features. Do not manually create files in `inc/` or hardcode UI in templates without a clear justification in your `SPEC.md`.
5. **Pre-Flight Validation**: Before submitting, ensure all PHP passes WordPress-VIP-Go standards and all CSS is GPU-accelerated and Lighthouse-optimized.

## Coding Standards

### 💾 PHP
- **Namespace**: `WP_Rig\WP_Rig\[Feature]` (or context-specific namespace).
- **Standards**: Must pass `phpcs` using WordPress-VIP-Go rules.
- **Interfaces**: Features should implement `Component_Interface`.

### 🎨 CSS
- **Source**: Edit files in `assets/css/src/`.
- **Build**: Processed via Lightning CSS.
- **Performance**:
  - Always use `transform` and `opacity` for animations.
  - Animations must be GPU-accelerated.
  - Implement `prefers-reduced-motion`.
  - Prefer the `cookie-critical` strategy for above-the-fold assets.

### ⚡ JavaScript / TypeScript
- **Source**: Edit files in `assets/js/src/`.
- **Build**: Processed via esbuild.
- **Standards**: No scroll listeners unless absolutely necessary; use `IntersectionObserver` for scroll-based logic.

### 🏎️ Performance Goals
- **Lighthouse**: 95+ score.
- **FCP**: Minimize First Contentful Paint.
- **TTFB**: Ensure dynamic registration logic doesn't impact server response times.
