import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

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
                "resources/js/statisticChart.js",
                "resources/js/monthlyIuranCountChart.js",
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '$': 'jQuery'
        },
    },
    build: {
        rollupOptions: {
            preserveEntrySignatures: 'strict',
        }
    }
});
