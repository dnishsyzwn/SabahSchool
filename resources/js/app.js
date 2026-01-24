import "./bootstrap";
import initCarousel from "./carousel";
import { initArticlesCarousel } from "./articles-carousel";
import initTextAnimations from "./text-animations";
import initAboutGallery from "./about-gallery";

import.meta.glob(["../images/**"]);

document.addEventListener("DOMContentLoaded", () => {
    initCarousel();
    initArticlesCarousel();
    initTextAnimations();
    initAboutGallery();
});
