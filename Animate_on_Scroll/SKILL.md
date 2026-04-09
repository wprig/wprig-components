# SKILL.md: Animate on Scroll (AOS)

Instructions for AI Agents to use and modify the Animate on Scroll component.

## Usage Recipe: Configuring Global AOS Settings

1. **Goal**: Change the default animation to `zoom-in` and set a faster duration.
2. **Action**: Use the `wprig_aos_config` filter in a theme or plugin.
3. **Example**:
   ```php
   add_filter( 'wprig_aos_config', function( $config ) {
       $config['animation_type'] = 'zoom-in';
       $config['animation_duration'] = '400ms';
       return $config;
   } );
   ```

## Supported Animations
- `fade-in`: Simple opacity transition.
- `fade-up`: Fade in while sliding up 20px.
- `zoom-in`: Fade in while scaling from 0.95 to 1.

## Guidelines for Modification
- **Adding New Animations**:
  1. Add the CSS definition in `assets/css/animation.css` using `[data-wprig-aos="new-type"]`.
  2. Ensure the initial state is set via the selector (e.g., `opacity: 0; transform: translateY(20px);`).
  3. Ensure the active state is set via `[data-aos-state="visible"]`.
- **Configurability**:
  - Always prefer using the `Component` class properties and the `wprig_aos_config` filter for global changes.
  - Per-element overrides can still be applied using `data-wprig-aos-delay` and `data-wprig-aos-duration` (value in ms).
- **Performance**:
  - NEVER use `margin-top` or `top/left/right/bottom` for animations.
  - ALWAYS use `transform` and `opacity`.
- **Reduced Motion**:
  - Ensure the `@media (prefers-reduced-motion: reduce)` block is updated if new animations are added.
