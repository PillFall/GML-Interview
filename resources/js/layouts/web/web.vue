<template lang="pug">
navbar-component
.container
    .section(v-if="$page.props.flash.status")
        .notification(:class="`is-${$page.props.flash.status.level}`")
            button.delete(@click="$page.props.flash.status = undefined")
            span {{ $page.props.flash.status.message }}

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
