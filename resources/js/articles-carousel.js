export function initArticlesCarousel() {
    const slider = document.getElementById("articles-slider");
    const prevBtn = document.getElementById("article-prev");
    const nextBtn = document.getElementById("article-next");
    const indicatorsContainer = document.getElementById("articles-indicators");

    if (!slider || !prevBtn || !nextBtn || !indicatorsContainer) return;

    const slides = Array.from(slider.querySelectorAll(".article-slide"));
    const totalOriginalItems = slides.length;
    let itemsPerPage = getItemsPerPage();
    let totalPages = Math.ceil(totalOriginalItems / itemsPerPage);
    let currentPage = 0;
    let isTransitioning = false;

    function getItemsPerPage() {
        if (window.innerWidth >= 1024) return 3;
        if (window.innerWidth >= 768) return 2;
        return 1;
    }

    function setupClones() {
        slider.querySelectorAll(".clone").forEach((c) => c.remove());
        const firstClones = slides.slice(0, itemsPerPage).map((s) => {
            const clone = s.cloneNode(true);
            clone.classList.add("clone");
            return clone;
        });
        const lastClones = slides.slice(-itemsPerPage).map((s) => {
            const clone = s.cloneNode(true);
            clone.classList.add("clone");
            return clone;
        });
        [...lastClones].reverse().forEach((clone) => slider.prepend(clone));
        firstClones.forEach((clone) => slider.append(clone));
    }

    function createIndicators() {
        indicatorsContainer.innerHTML = "";
        totalPages = Math.ceil(totalOriginalItems / itemsPerPage);
        for (let i = 0; i < totalPages; i++) {
            const btn = document.createElement("button");
            btn.className = `h-1.5 rounded-full transition-all duration-300 ${
                i === currentPage
                    ? "w-10 bg-green"
                    : "w-3 bg-gray-200 hover:bg-green/40"
            }`;
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
        const isDesktop = window.innerWidth >= 1024;
        const peek = isDesktop ? 150 : 0;

        if (withTransition) {
            isTransitioning = true;
            slider.style.transition =
                "transform 0.7s cubic-bezier(0.4, 0, 0.2, 1)";
        } else {
            slider.style.transition = "none";
        }

        const virtualIndex = itemsPerPage + currentPage * itemsPerPage;
        const moveDistance =
            (virtualIndex * (containerWidth + gap)) / itemsPerPage;

        slider.style.transform = `translateX(${-moveDistance + peek}px)`;

        // Update indicators
        const indicators = indicatorsContainer.querySelectorAll("button");
        indicators.forEach((indicator, index) => {
            let activePage = currentPage;
            if (currentPage >= totalPages) activePage = 0;
            if (currentPage < 0) activePage = totalPages - 1;

            const isCurrent = index === activePage;
            indicator.className = `h-1.5 rounded-full transition-all duration-300 ${
                isCurrent
                    ? "w-10 bg-green"
                    : "w-3 bg-gray-200 hover:bg-green/40"
            }`;
        });
    }

    slider.addEventListener("transitionend", (e) => {
        // IMPORTANT: Only handle transitions on the slider itself
        if (e.target !== slider) return;

        isTransitioning = false;

        if (currentPage >= totalPages) {
            currentPage = 0;
            updateCarousel(false);
        } else if (currentPage < 0) {
            currentPage = totalPages - 1;
            updateCarousel(false);
        }
    });

    nextBtn.addEventListener("click", () => {
        if (isTransitioning) return;
        currentPage++;
        updateCarousel(true);
    });

    prevBtn.addEventListener("click", () => {
        if (isTransitioning) return;
        currentPage--;
        updateCarousel(true);
    });

    let resizeTimer;
    window.addEventListener("resize", () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            const oldItemsPerPage = itemsPerPage;
            const newItemsPerPage = getItemsPerPage();

            if (oldItemsPerPage !== newItemsPerPage) {
                // Determine which item was roughly at the start
                const firstVisibleItem = currentPage * oldItemsPerPage;

                itemsPerPage = newItemsPerPage;
                totalPages = Math.ceil(totalOriginalItems / itemsPerPage);

                // Set new currentPage and clamp it
                currentPage = Math.floor(firstVisibleItem / itemsPerPage);
                if (currentPage >= totalPages) currentPage = totalPages - 1;
                if (currentPage < 0) currentPage = 0;

                setupClones();
                createIndicators();
                updateCarousel(false);
            } else {
                // Even if itemsPerPage didn't change, width did.
                updateCarousel(false);
            }
        }, 200);
    });

    setupClones();
    createIndicators();
    updateCarousel(false);
}
