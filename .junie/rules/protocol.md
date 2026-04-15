# Mandatory AI Protocol: Contract-First Development

WP Rig uses a highly opinionated, "Contract-First" development process. You **MUST** follow these steps before modifying implementation code:

## 1. Discovery & Clarification
- You are **FORBIDDEN** from writing implementation code until a `SPEC.md` exists and you have achieved a 95%+ implementation confidence score.
- Ask **3-10 clarifying questions** about the architecture, aesthetics, and requirements for any non-trivial change.

## 2. The Specification Phase
- Author a `SPEC.md` for every new feature or significant modification.
- Document the planned architecture, data attributes, and PHP/JS/CSS mapping.
- Get the `SPEC.md` **APPROVED** by the user before proceeding to implementation.

## 3. Tool-First Scaffolding
- **Theme Feature?** Use `npm run create-rig-component`.
- **Gutenberg Block?** Use `npm run block:new`.
- **DO NOT** manually create files in `inc/` or hardcode UI in templates without a clear justification in your `SPEC.md`.

## 4. Pre-Flight Validation
- Before submitting your work, run `npm run ai:check` to ensure compliance with WP Rig standards.
- Ensure all PHP passes WordPress-VIP-Go standards.
- Ensure all CSS is GPU-accelerated and Lighthouse-optimized.
