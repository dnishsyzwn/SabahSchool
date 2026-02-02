import "./bootstrap";
import initCarousel from "./carousel";
import { initArticlesCarousel } from "./articles-carousel";
import initTextAnimations from "./text-animations";
import initAboutGallery from "./about-gallery";

import initNavbar from "./navbar";
import initStuDatePickers from "./datepicker";

import.meta.glob(["../images/**"]);

document.addEventListener("DOMContentLoaded", () => {
    initNavbar();
    initStuDatePickers();
    initCarousel();
    initArticlesCarousel();
    initTextAnimations();
    initAboutGallery();
});
