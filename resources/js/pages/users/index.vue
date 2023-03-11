<template lang="pug">
inertia-head(title="Listado de Usuarios")
.section
    .level
        .level-left
            .level-item
                h1.title Listado de Usuarios
        .level-right
            .level-item
                inertia-link.button.is-success(:href="$route('users.create')")
                    span.icon.is-small
                        font-awesome-icon(icon="plus")
                    span Crear Usuario

    .table-container
        table.table.is-striped.is-hoverable.is-fullwidth
            thead
                tr
                    th Nombre
                    th Identificacíon
                    th Correo Electrónico
                    th País
                    th Dirección
                    th Télefono
                    th Categoría
                    th
            tbody
                tr(v-for="user in users.data")
                    td {{ user.full_name }}
                    td {{ user.identifier_display }}
                    td {{ user.email }}
                    td {{ user.country_display }}
                    td {{ user.address }}
                    td {{ user.mobile }}
                    td {{ user.category.name }}
                    td
                        .buttons.are-small
                            inertia-link.button.is-link(:href="$route('users.show', { user: user.id })")
                                span.icon.is-small
                                    font-awesome-icon(icon="eye")

    nav.pagination
        inertia-link.pagination-previous(:href="users.prev_page_url" v-if="users.prev_page_url")
            span.icon.is-small
                font-awesome-icon(icon="arrow-left")
        inertia-link.pagination-next(:href="users.next_page_url" v-if="users.next_page_url")
            span.icon.is-small
                font-awesome-icon(icon="arrow-right")
        .pagination-list
            li(v-for="link in users.links")
                inertia-link.pagination-link(:href="link.url" :class="{'is-current': link.active}") {{ link.label }}
</template>

<script>
import WebLayout from '@/layouts/web/web.vue';
import {
    Link as InertiaLink,
    Head as InertiaHead,
} from '@inertiajs/vue3';

export default {
    components: {
        InertiaLink,
        InertiaHead,
    },
    layout: WebLayout,
    props: {
        users: Object,
    },
    created() {
        this.users.links.shift();
        this.users.links.pop();
    }
};
</script>
