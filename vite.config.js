import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/css/forms.css',

                // React
                'resources/js/register.jsx'],
            refresh: true,
        }),
        react()
    ],
});
