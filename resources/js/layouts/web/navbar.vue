<template lang="pug">
nav.navbar.is-primary
    .navbar-brand
        inertia-link.navbar-item(:href="$route('home')") GML Interview by Joar Buitrago

        a.navbar-burger
            span
            span
            span

    .navbar-menu(ref="navbarMenu")
        .navbar-start
            a.navbar-item Usuarios
        .navbar-end
            a.navbar-item
                span.icon.is-medium
                    font-awesome-icon(icon="fa-brands fa-github" size="2x")
</template>

<script>
import { Link as InertiaLink } from '@inertiajs/vue3';

export default {
    components: {
        InertiaLink,
    },
};
</script>
