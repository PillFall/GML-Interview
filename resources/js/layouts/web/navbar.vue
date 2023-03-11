<template lang="pug">
nav.navbar.is-primary
    .navbar-brand
        inertia-link.navbar-item(:href="$route('home')") GML Interview by Joar Buitrago

        a.navbar-burger(:class="{'is-active': navbarOpen}" @click="navbarOpen = !navbarOpen")
            span
            span
            span

    .navbar-menu(:class="{'is-active': navbarOpen}")
        .navbar-start
            inertia-link.navbar-item(:href="$route('users.index')") Usuarios
        .navbar-end
            a.navbar-item(href="https://github.com/PillFall/GML-Interview" target="_blank")
                span.icon.is-medium.is-hidden-touch
                    font-awesome-icon(icon="fa-brands fa-github" size="2x")
                span.is-hidden-desktop GitHub
</template>

<script>
import { Link as InertiaLink } from '@inertiajs/vue3';

export default {
    components: {
        InertiaLink,
    },
    data() {
        return {
            navbarOpen: false,
        };
    },
};
</script>
