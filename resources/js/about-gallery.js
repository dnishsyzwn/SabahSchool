/**
 * Interactive Gallery logic for the About section.
 */
export default function initAboutGallery() {
    const gallery = document.getElementById("stu-gallery");
    if (!gallery) return;

    const items = gallery.querySelectorAll(".gallery-item");

    function activateGalleryItem(element) {
        // Prevent repeated triggers for the same element
        if (element.classList.contains("flex-[4]")) return;

        items.forEach((item) => {
            item.classList.remove("flex-[4]", "shadow-xl");
            item.classList.add("flex-1", "shadow-lg");
            item.classList.remove("active");
        });

        element.classList.remove("flex-1", "shadow-lg");
        element.classList.add("flex-[4]", "shadow-xl");
        element.classList.add("active");
    }

    items.forEach((item) => {
        // Support both hover and click
        item.addEventListener("mouseenter", () => activateGalleryItem(item));
        item.addEventListener("click", () => activateGalleryItem(item));
    });
}
