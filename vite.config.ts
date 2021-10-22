import { defineConfig } from "laravel-vite";
import { createVuePlugin as vue2 } from "vite-plugin-vue2";
import dynamicImportVariables from "@rollup/plugin-dynamic-import-vars";

export default defineConfig({
    build: {
        rollupOptions: {
            plugins: [dynamicImportVariables()],
        },
    },
}).withPlugin(vue2());
