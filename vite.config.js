import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    build: {
        minify: 'esbuild', // Tối ưu hóa file JS/CSS
        sourcemap: false, // Tắt sourcemap để giảm dung lượng
    },
});
