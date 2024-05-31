import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import { viteStaticCopy } from "vite-plugin-static-copy";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/fonts.css",
                "resources/css/image-zoom.css",
                "resources/js/app.js",
                "resources/js/image-zoom.js",
                "resources/js/loading.js",
                "resources/js/utils/request.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
});
