import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css", 
                "resources/js/app.js",
                "resources/css/pages/keahlian.css",
                "resources/js/pages/keahlian.js",
            ],
            refresh: [
                "resources/views/**",
                "routes/**",
                "app/Http/Controllers/**",
            ],
        }),
        tailwindcss(),
    ],
});

