import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [
                "resources/views/**",
                "routes/**",
                "app/Http/Controllers/**",
            ],
        }),
        tailwindcss(),
    ],
    server: {
        host: "localhost",
        hmr: {
            host: "localhost",
        },
        watch: {
            usePolling: true,
            ignored: [
                "**/storage/**",
                "**/public/**",
                "**/vendor/**",
                "**/.git/**",
            ],
        },
    },
});
