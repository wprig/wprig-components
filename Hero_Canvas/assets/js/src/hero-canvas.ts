/**
 * Hero Canvas (Three.js / WebGL)
 *
 * Performance-optimized background animations.
 */

declare const THREE: any;

document.addEventListener('DOMContentLoaded', () => {
    const canvas = document.getElementById('wprig-hero-canvas') as HTMLCanvasElement;
    if (!canvas) return;

    // Check for reduced motion
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    const opacity = parseFloat(canvas.getAttribute('data-hero-opacity') || '0.5');
    const density = parseInt(canvas.getAttribute('data-hero-density') || '500');
    const color = canvas.getAttribute('data-hero-color') || '#333333';

    // Set canvas style
    canvas.style.opacity = opacity.toString();

    // Initialize Three.js
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });

    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    // Create Particles
    const particlesGeometry = new THREE.BufferGeometry();
    const posArray = new Float32Array(density * 3);

    for (let i = 0; i < density * 3; i++) {
        posArray[i] = (Math.random() - 0.5) * 10;
    }

    particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

    const particlesMaterial = new THREE.PointsMaterial({
        size: 0.005,
        color: color
    });

    const particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
    scene.add(particlesMesh);

    camera.position.z = 2;

    // Handle Resize
    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });

    // Animation Loop
    const animate = () => {
        requestAnimationFrame(animate);

        particlesMesh.rotation.y += 0.001;
        particlesMesh.rotation.x += 0.0005;

        renderer.render(scene, camera);
    };

    animate();
});
