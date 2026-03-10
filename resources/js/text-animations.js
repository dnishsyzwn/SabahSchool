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

        // Split by words to prevent wrapping mid-word
        const words = text.split(" ");
        let globalIndex = 0;
        
        words.forEach((word) => {
            const wordSpan = document.createElement("span");
            wordSpan.style.display = "inline-block";
            // Allow wrapping between words naturally, but not inside words
            
            const chars = word.split("");
            chars.forEach((char) => {
                const span = document.createElement("span");
                span.textContent = char;
                span.classList.add("split-char");
                span.style.animationDelay = `${globalIndex * 10}ms`;
                wordSpan.appendChild(span);
                globalIndex++;
            });
            
            element.appendChild(wordSpan);
            // Add a space after each word
            element.appendChild(document.createTextNode(" "));
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
