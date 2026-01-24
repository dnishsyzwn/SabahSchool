import "./bootstrap";
import initCarousel from "./carousel";
import { initArticlesCarousel } from "./articles-carousel";
import initTextAnimations from "./text-animations";
import initAboutGallery from "./about-gallery";

import initNavbar from "./navbar";

import.meta.glob(["../images/**"]);

document.addEventListener("DOMContentLoaded", () => {
    initNavbar();
    initCarousel();
    initArticlesCarousel();
    initTextAnimations();
    initAboutGallery();
});
