export default function initNavbar() {
    // Desktop Sticky Navbar
    const stickyWrapper = document.getElementById("sticky-wrapper");
    const bottomBar = document.getElementById("bottom-bar");
    const stickyFlags = document.getElementById("sticky-flags");

    if (stickyWrapper && bottomBar) {
        // Initial offset calculation
        let stickyOffset = stickyWrapper.offsetTop;

        const handleScroll = () => {
            if (window.scrollY > stickyOffset) {
                bottomBar.classList.add("is-sticky");
                if (stickyFlags) stickyFlags.classList.remove("hidden");
            } else {
                bottomBar.classList.remove("is-sticky");
                if (stickyFlags) stickyFlags.classList.add("hidden");
            }
        };

        window.addEventListener("scroll", handleScroll, { passive: true });

        // Update offset on resize
        window.addEventListener("resize", () => {
            stickyOffset = stickyWrapper.offsetTop;
        });
    }

    // Mobile Menu Functionality
    const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
    const mobileMenuClose = document.getElementById("mobile-menu-close");
    const mobileMenuPanel = document.getElementById("mobile-menu-panel");
    const mobileMenuOverlay = document.getElementById("mobile-menu-overlay");
    const mobileMenuIcon = document.getElementById("mobile-menu-icon");
    const mobileCloseIcon = document.getElementById("mobile-close-icon");
    const accordionToggles = document.querySelectorAll(
        ".mobile-accordion-toggle",
    );

    if (mobileMenuToggle && mobileMenuPanel) {
        // Toggle Mobile Menu
        const toggleMobileMenu = () => {
            const isOpen = mobileMenuPanel.classList.contains("translate-x-0");

            if (isOpen) {
                mobileMenuPanel.classList.remove("translate-x-0");
                mobileMenuPanel.classList.add("-translate-x-full");
                mobileMenuOverlay.classList.add("hidden");
                mobileMenuIcon.classList.remove("hidden");
                mobileCloseIcon.classList.add("hidden");
                document.body.style.overflow = "auto";
            } else {
                mobileMenuPanel.classList.remove("-translate-x-full");
                mobileMenuPanel.classList.add("translate-x-0");
                mobileMenuOverlay.classList.remove("hidden");
                mobileMenuIcon.classList.add("hidden");
                mobileCloseIcon.classList.remove("hidden");
                document.body.style.overflow = "hidden";
            }
        };

        // Toggle Accordion
        const toggleAccordion = (button) => {
            const content = button.nextElementSibling;
            const icon = button.querySelector(".accordion-icon");

            if (content.classList.contains("hidden")) {
                content.classList.remove("hidden");
                icon.style.transform = "rotate(180deg)";
            } else {
                content.classList.add("hidden");
                icon.style.transform = "rotate(0deg)";
            }
        };

        // Event Listeners
        mobileMenuToggle.addEventListener("click", toggleMobileMenu);
        if (mobileMenuClose)
            mobileMenuClose.addEventListener("click", toggleMobileMenu);
        if (mobileMenuOverlay)
            mobileMenuOverlay.addEventListener("click", toggleMobileMenu);

        // Accordion Event Listeners
        accordionToggles.forEach((toggle) => {
            toggle.addEventListener("click", () => toggleAccordion(toggle));
        });

        // Close menu when clicking on links
        const mobileLinks = mobileMenuPanel.querySelectorAll("a");
        mobileLinks.forEach((link) => {
            link.addEventListener("click", toggleMobileMenu);
        });

        // Close menu on escape key
        document.addEventListener("keydown", (e) => {
            if (
                e.key === "Escape" &&
                !mobileMenuPanel.classList.contains("-translate-x-full")
            ) {
                toggleMobileMenu();
            }
        });

        // Handle window resize
        window.addEventListener("resize", () => {
            if (window.innerWidth >= 640) {
                // sm breakpoint
                if (!mobileMenuPanel.classList.contains("-translate-x-full")) {
                    toggleMobileMenu();
                }
            }
        });
    }
}
