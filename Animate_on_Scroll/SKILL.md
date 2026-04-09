# SKILL.md: Animate on Scroll (AOS)

Instructions for AI Agents to use and modify the Animate on Scroll component.

## Usage Recipe: Applying Fade-Up to a Media & Text Block

1. **Goal**: Animate a Media & Text block so it fades up when it enters the viewport.
2. **Action**: Use the `render_block` filter logic or manually add attributes in the block editor.
3. **Attributes**:
   - `data-wprig-aos="fade-up"`
   - `data-wprig-aos-delay="200"`
   - `data-wprig-aos-duration="600"`

## Guidelines for Modification
- **Adding New Animations**:
  1. Add the CSS definition in `assets/css/animation.css` using `[data-wprig-aos="new-type"]`.
  2. Ensure the initial state is set via the selector (e.g., `opacity: 0; transform: translateY(20px);`).
  3. Ensure the active state is set via `[data-aos-state="visible"]`.
- **Performance**:
  - NEVER use `margin-top` or `top/left/right/bottom` for animations.
  - ALWAYS use `transform` and `opacity`.
- **Reduced Motion**:
  - Ensure the `@media (prefers-reduced-motion: reduce)` block is updated if new animations are added.
