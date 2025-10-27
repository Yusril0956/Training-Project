});
>>>>>>> d0db4e63200e75ccbc4e58ab2af404ba1359a0d4
=======
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    build: {
        outDir: 'public/build',
    },
});
=======
});
>>>>>>> d0db4e63200e75ccbc4e58ab2af404ba1359a0d4
