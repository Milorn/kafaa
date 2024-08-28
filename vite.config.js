import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // Css
                'resources/css/app.css', 
                'resources/css/forms.css',

                // Js
                'resources/js/pro.js',

                // React
                'resources/js/register.jsx'],
            refresh: true,
        }),
        react()
    ],
});
