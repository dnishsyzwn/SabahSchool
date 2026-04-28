export function initArticlesCarousel() {
    const slider = document.getElementById("articles-slider");
    const prevBtn = document.getElementById("article-prev");
    const nextBtn = document.getElementById("article-next");
    const indicatorsContainer = document.getElementById("articles-indicators");

    if (!slider || !prevBtn || !nextBtn || !indicatorsContainer) return;

    const allSlides = Array.from(slider.querySelectorAll(".article-slide"));
    let slides = [];
    let itemsPerPage = getItemsPerPage();
    let totalOriginalItems = 0;
    let totalPages = 0;
    let currentPage = 0;
    let isTransitioning = false;

    function getItemsPerPage() {
        if (window.innerWidth >= 768) return 3; // Desktop and Tab
        return 1; // Mobile
    }

    function updateSlidesList() {
        slides = allSlides.filter(s => window.getComputedStyle(s).display !== 'none');
        totalOriginalItems = slides.length;
        itemsPerPage = getItemsPerPage();
        totalPages = Math.ceil(totalOriginalItems / itemsPerPage);
    }

    function createIndicators() {
        indicatorsContainer.innerHTML = "";
        for (let i = 0; i < totalPages; i++) {
            const btn = document.createElement("button");
            btn.className = `h-1.5 rounded-full transition-all duration-300 ${i === currentPage ? "w-10 bg-green" : "w-3 bg-gray-200 hover:bg-green/40"}`;
            btn.dataset.page = i;
            btn.addEventListener("click", () => {
                if (isTransitioning) return;
                currentPage = i;
                updateCarousel(true);
            });
            indicatorsContainer.appendChild(btn);
        }
    }

    function updateCarousel(withTransition = true) {
        const containerWidth = slider.parentElement.offsetWidth;
        const gap = 32;

        if (withTransition) {
            isTransitioning = true;
            slider.style.transition = "transform 0.7s cubic-bezier(0.4, 0, 0.2, 1)";
        } else {
            slider.style.transition = "none";
        }

        const moveDistance = currentPage * (containerWidth + gap);
        slider.style.transform = `translateX(${-moveDistance}px)`;

        // Update indicators
        const indicators = indicatorsContainer.querySelectorAll("button");
        indicators.forEach((indicator, index) => {
            const isCurrent = index === currentPage;
            indicator.className = `h-1.5 rounded-full transition-all duration-300 ${isCurrent ? "w-10 bg-green" : "w-3 bg-gray-200 hover:bg-green/40"}`;
        });

        // Update buttons
        prevBtn.disabled = currentPage === 0;
        nextBtn.disabled = currentPage >= totalPages - 1;
        prevBtn.style.opacity = prevBtn.disabled ? "0.2" : "1";
        nextBtn.style.opacity = nextBtn.disabled ? "0.2" : "1";
    }

    slider.addEventListener("transitionend", () => {
        isTransitioning = false;
    });

    nextBtn.addEventListener("click", () => {
        if (isTransitioning || currentPage >= totalPages - 1) return;
        currentPage++;
        updateCarousel(true);
    });

    prevBtn.addEventListener("click", () => {
        if (isTransitioning || currentPage <= 0) return;
        currentPage--;
        updateCarousel(true);
    });

    let resizeTimer;
    window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            updateSlidesList();
            if (currentPage >= totalPages) currentPage = totalPages - 1;
            if (currentPage < 0) currentPage = 0;
            createIndicators();
            updateCarousel(false);
        }, 200);
    });

    updateSlidesList();
    createIndicators();
    updateCarousel(false);
}
