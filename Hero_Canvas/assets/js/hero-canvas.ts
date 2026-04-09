/**
 * Hero Canvas (Raw Canvas / Ultra-lightweight)
 *
 * Performance-optimized background particles without external dependencies.
 */

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('wprig-hero-canvas') as HTMLCanvasElement;
    if (!canvas) return;

    // Check for reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const opacity = parseFloat(canvas.getAttribute('data-hero-opacity') || '0.5');
    const density = Math.min(parseInt(canvas.getAttribute('data-hero-density') || '100'), 500);
    const color = canvas.getAttribute('data-hero-color') || '#333333';

    let width: number, height: number;
    let particles: { x: number, y: number, vx: number, vy: number, size: number }[] = [];

    const init = () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
        particles = [];
        for (let i = 0; i < density; i++) {
            particles.push({
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5,
                size: Math.random() * 2
            });
        }
    };

    const animate = () => {
        if (!ctx) return;
        ctx.clearRect(0, 0, width, height);
        ctx.fillStyle = color;
        
        for (let i = 0; i < particles.length; i++) {
            const p = particles[i];
            p.x += p.vx;
            p.y += p.vy;

            if (p.x < 0) p.x = width;
            if (p.x > width) p.x = 0;
            if (p.y < 0) p.y = height;
            if (p.y > height) p.y = 0;

            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();
        }
        requestAnimationFrame(animate);
    };

    window.addEventListener('resize', init);
    init();
    animate();
});
