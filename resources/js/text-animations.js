/**
 * Split text into individual characters and animate them with a blur effect.
 */
export default function initTextAnimations() {
    const animatedElements = document.querySelectorAll(
        '[data-animate="split-text"]',
    );

    animatedElements.forEach((element) => {
        const text = element.textContent.trim();
        element.textContent = "";
        element.classList.add("reveal-text");

        // Split by characters
        const chars = text.split("");
        chars.forEach((char, index) => {
            const span = document.createElement("span");
            span.textContent = char;
            span.classList.add("split-char");
            // Add a slight stagger for each character
            span.style.animationDelay = `${index * 10}ms`;
            element.appendChild(span);
        });
    });

    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.2,
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-revealed");
                // Optional: stop observing after animation triggers
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    animatedElements.forEach((element) => {
        observer.observe(element);
    });
}
