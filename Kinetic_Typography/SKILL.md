# SKILL.md: Kinetic Typography Engine

Instructions for AI Agents to use and modify the Kinetic Typography component.

## Usage Recipe: Wrapping Page Titles in Kinetic Reveal

1. **Goal**: Animate a Page Title so it reveals character by character when the page loads.
2. **Action**: 
    - Use the helper function `wprig_kinetic_text( get_the_title(), 'reveal' )` in the `content-page.php` or `content-single.php` template.
    - Ensure the CSS variable `--char-index` is properly applied to each `<span>` wrap.
3. **Attributes**:
   - `data-wprig-kinetic="reveal"`
   - `data-kinetic-duration="1000"` (Optional).
   - `data-kinetic-stagger="0.05"` (Optional).

## Guidelines for Modification
- **Adding New Animation Types**:
  1. Add a new keyframe or transition in `assets/css/src/components/_kinetic-type.css`.
  2. Map it to a new `data-wprig-kinetic` value (e.g., `glitch`).
  3. Ensure it uses the `--char-index` for staggered motion.
- **Performance**:
  - Keep JS splitting logic minimal. Use server-side splitting in PHP if possible for critical path text.
  - ALWAYS use `transform` and `opacity`.
- **Modularity**:
  - To swap the splitting library, register a new JS hook that overrides the default `wprigKineticSplit` function.
- **Reduced Motion**:
  - Ensure the `@media (prefers-reduced-motion: reduce)` block disables character-level staggering and animations.
