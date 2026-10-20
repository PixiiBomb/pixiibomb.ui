(() => {
    const maxParticles = 20;
    const minSize = 6;
    const maxSize = 20;
    const minSpeed = 0.03;
    const maxSpeed = 0.12;

    const binaryColumnSpacing = 34;
    const binaryMinDigits = 8;
    const binaryMaxDigits = 24;
    const binaryMinDuration = 8;
    const binaryMaxDuration = 20;
    const binaryMinFontSize = 10;
    const binaryMaxFontSize = 18;

    const CSS_SELECTORS = {

    }

    const queryParticles = document.querySelectorAll('.particle');
    const queryRain = document.querySelectorAll('.rain');

    const particles = [];

    queryParticles.forEach((layer) => {
        const baseOpacity = layer.classList.contains('foreground')
            ? 0.45
            : 0.18;

        createParticles(getRandomInt(2, maxParticles), layer, baseOpacity);
    });

    queryRain.forEach((layer) => {
        createBinaryRain(layer);
        observeBinaryRain(layer);
    });

    if (particles.length > 0) {
        requestAnimationFrame(animateParticles);
    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function getRandomFloat(min, max) {
        return Math.random() * (max - min) + min;
    }

    function getRandomDirection() {
        return Math.random() < 0.5 ? -1 : 1;
    }

    function getRandomBinaryDigit() {
        return Math.random() < 0.5 ? '0' : '1';
    }

    function getRandomDigitOpacity() {
        const opacityType = Math.random();

        if (opacityType < 0.05) {
            return 0;
        }

        if (opacityType > 0.95) {
            return 1;
        }

        return getRandomFloat(0.15, 0.85);
    }

    function getRandomBinaryColorClass() {
        const color = getRandomInt(0, 2);

        if (color === 1) {
            return 'secondary';
        }

        if (color === 2) {
            return 'accent';
        }

        return '';
    }

    function createBinaryRain(container) {
        const bounds = container.getBoundingClientRect();
        const columnCount = Math.ceil(bounds.width / binaryColumnSpacing);

        container.replaceChildren();

        for (let i = 0; i < columnCount; i++) {
            const column = document.createElement('div');
            const colorClass = getRandomBinaryColorClass();
            const digitCount = getRandomInt(binaryMinDigits, binaryMaxDigits);
            const fontSize = getRandomInt(binaryMinFontSize, binaryMaxFontSize);
            const duration = getRandomFloat(binaryMinDuration, binaryMaxDuration );
            const delay = getRandomFloat(-binaryMaxDuration, 0);
            const horizontalOffset = getRandomFloat(-binaryColumnSpacing * 0.25, binaryColumnSpacing * 0.25);

            column.classList.add('binary-column');

            if (colorClass) {
                column.classList.add(colorClass);
            }

            column.style.left = `${i * binaryColumnSpacing + horizontalOffset}px`;
            column.style.setProperty('--binary-font-size', `${fontSize}px`);
            column.style.setProperty('--binary-duration', `${duration}s`);
            column.style.setProperty('--binary-delay', `${delay}s`);

            for (let j = 0; j < digitCount; j++) {
                const digit = document.createElement('span');

                digit.classList.add('binary-digit');
                digit.textContent = getRandomBinaryDigit();
                digit.style.opacity = getRandomDigitOpacity();

                column.appendChild(digit);
            }

            container.appendChild(column);
        }
    }

    function observeBinaryRain(container) {
        let previousWidth = container.clientWidth;
        let resizeTimeout;

        const observer = new ResizeObserver((entries) => {
            const width = entries[0].contentRect.width;

            if (Math.abs(width - previousWidth) < binaryColumnSpacing) {
                return;
            }

            previousWidth = width;

            window.clearTimeout(resizeTimeout);

            resizeTimeout = window.setTimeout(() => {
                createBinaryRain(container);
            }, 150);
        });

        observer.observe(container);
    }

    function createParticles(count, container, baseOpacity) {
        const bounds = container.getBoundingClientRect();

        for (let i = 0; i < count; i++) {
            const color = getRandomInt(0, 1);
            const size = getRandomInt(minSize, maxSize);
            const x = getRandomFloat(
                0,
                Math.max(0, bounds.width - size)
            );

            const y = getRandomFloat(
                0,
                Math.max(0, bounds.height - size)
            );

            const particle = document.createElement('div');

            particle.classList.add('particle-item');

            if (color === 1) {
                particle.classList.add('alternate');
            }

            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.opacity = getRandomFloat(
                baseOpacity,
                Math.min(1, baseOpacity + 0.35)
            );

            container.appendChild(particle);

            particles.push({
                element: particle,
                container,
                x,
                y,
                size,
                vx:
                    getRandomFloat(minSpeed, maxSpeed) *
                    getRandomDirection(),
                vy:
                    getRandomFloat(minSpeed, maxSpeed) *
                    getRandomDirection()
            });
        }
    }

    function animateParticles() {
        particles.forEach((particle) => {
            const bounds = particle.container.getBoundingClientRect();

            particle.x += particle.vx;
            particle.y += particle.vy;

            if (particle.x <= 0 || particle.x + particle.size >= bounds.width) {
                particle.vx *= -1;
                particle.x = Math.max(
                    0,
                    Math.min(
                        particle.x,
                        bounds.width - particle.size
                    )
                );
            }

            if (particle.y <= 0 || particle.y + particle.size >= bounds.height) {
                particle.vy *= -1;
                particle.y = Math.max(
                    0,
                    Math.min(
                        particle.y,
                        bounds.height - particle.size
                    )
                );
            }

            particle.element.style.transform = `translate3d(${particle.x}px, ${particle.y}px, 0)`;
        });

        requestAnimationFrame(animateParticles);
    }
})();
