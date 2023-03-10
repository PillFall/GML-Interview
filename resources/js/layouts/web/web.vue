<template lang="pug">
navbar-component
.container
    slot
</template>

<script>
import NavbarComponent from './navbar.vue';

export default {
    components: {
        NavbarComponent,
    },
};
</script>
