import "./bootstrap";
import initCarousel from "./carousel";
import { initArticlesCarousel } from "./articles-carousel";
import initTextAnimations from "./text-animations";
import initAboutGallery from "./about-gallery";

document.addEventListener("DOMContentLoaded", () => {
    initCarousel();
    initArticlesCarousel();
    initTextAnimations();
    initAboutGallery();
});
