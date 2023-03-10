import './bootstrap';

/**
 * Create an InertiaJS app using Vue3 as the frontend framework.
 * This allows us to use all the frontend scafflding without taking care of
 * creating API routes for the pages
 */

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob('./pages/**/*.vue');
        return pages[`./pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
