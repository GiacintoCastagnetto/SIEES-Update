// https://www.github.com/laravel/vite-plugin/blob/0.x/UPGRADE.md#migrating-from-vite-to-laravel-mix
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
// import react from '@vitejs/plugin-react';
// import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [
    laravel({
      refresh: true,
      input: ["resources/css/app.css", "resources/js/app.js"]
    })
    // react(),
    // vue({
    //     template: {
    //         transformAssetUrls: {
    //             base: null,
    //             includeAbsolute: false,
    //         },
    //     },
    // }),
  ],
  // https://github.com/laravel/vite-plugin/blob/0.x/UPGRADE.md#update-aliases
  resolve: {
    alias: {
      "@": "/resources/js"
    }
  }
});
