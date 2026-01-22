import "./bootstrap";
import initCarousel from "./carousel";
import { initArticlesCarousel } from "./articles-carousel";

document.addEventListener("DOMContentLoaded", () => {
    initCarousel();
    initArticlesCarousel();
});
