import './bootstrap';

/**
 * As we probably need some icons, use FontAwesome as our icon provider in this
 * application.
 */

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';

library.add(far);
library.add(fas);
library.add(fab);
dom.watch();

/**
 * Create an InertiaJS app using Vue3 as the frontend framework.
 * This allows us to use all the frontend scafflding without taking care of
 * creating API routes for the pages
 */

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const vue = createApp({
            render: () => h(App, props),
        });
        vue.use(plugin);
        vue.component('FontAwesomeIcon', FontAwesomeIcon);
        vue.config.globalProperties.$route = window.route;
        vue.mount(el);
    },
    progress: {
        includeCSS: false,
    },
});
