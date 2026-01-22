export default function initCarousel() {
    const carousel = document.getElementById("hero-carousel");
    if (!carousel) return;

    const items = carousel.querySelectorAll(".carousel-item");
    const indicators = carousel.querySelectorAll(".indicator");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    let currentIndex = 0;
    let interval;

    function showSlide(index) {
        if (index === currentIndex) return;

        items[currentIndex].classList.remove(
            "opacity-100",
            "pointer-events-auto",
        );
        items[currentIndex].classList.add("opacity-0", "pointer-events-none");

        currentIndex = index;

        items[currentIndex].classList.remove(
            "opacity-0",
            "pointer-events-none",
        );
        items[currentIndex].classList.add("opacity-100", "pointer-events-auto");

        // Update Indicators
        indicators.forEach((indicator, i) => {
            if (i === currentIndex) {
                indicator.classList.add("w-8", "sm:w-12", "bg-white");
                indicator.classList.remove("w-3", "sm:w-4", "bg-white/50");
            } else {
                indicator.classList.remove("w-8", "sm:w-12", "bg-white");
                indicator.classList.add("w-3", "sm:w-4", "bg-white/50");
            }
        });
    }

    function nextSlide() {
        const nextIndex = (currentIndex + 1) % items.length;
        showSlide(nextIndex);
    }

    function prevSlide() {
        const prevIndex = (currentIndex - 1 + items.length) % items.length;
        showSlide(prevIndex);
    }

    function startAutoplay() {
        if (interval) return; // Prevent double intervals
        interval = setInterval(() => {
            nextSlide();
        }, 4000);
    }

    function stopAutoplay() {
        if (interval) {
            clearInterval(interval);
            interval = null;
        }
    }

    function resetAutoplay() {
        stopAutoplay();
        startAutoplay();
    }

    // Event Listeners
    if (nextBtn) {
        nextBtn.addEventListener("click", () => {
            nextSlide();
            resetAutoplay();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener("click", () => {
            prevSlide();
            resetAutoplay();
        });
    }

    indicators.forEach((indicator, index) => {
        indicator.addEventListener("click", () => {
            showSlide(index);
            resetAutoplay();
        });
    });

    // Pause on hover
    carousel.addEventListener("mouseenter", stopAutoplay);
    carousel.addEventListener("mouseleave", startAutoplay);

    startAutoplay();
}
