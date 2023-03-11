<template lang="pug">
.section
    .level
        .level-left
            .level-item
                h1.title {{ user.full_name }}
            .level-item
                h2.subtitle ID de usuario: {{ user.id }}
        .level-right
            .level-item
                inertia-link.button.is-info(:href="$route('users.edit', { user: user.id })")
                    span.icon.is-small
                        font-awesome-icon(icon="pencil")
                    span Editar

    .columns
        .column
            .box
                .content
                    p.title.is-5 Información Basica
                    p #[strong Nombres:] {{ user.name }}
                    p #[strong Apellidos:] {{ user.surname }}
                    p #[strong Identificación:] {{ user.identifier }}

        .column
            .box
                .content
                    p.title.is-5 Información de Contacto
                    p #[strong Telefono:] {{ user.mobile }}
                    p #[strong Correo Electronico:] {{ user.email }}
        .column
            .box
                .content
                    p.title.is-5 Información de Ubicación
                    p #[strong País:] {{ user.country }}
                    p #[strong Dirección:] {{ user.address }}
</template>

<script>
import WebLayout from '@/layouts/web/web.vue';
import { Link as InertiaLink } from '@inertiajs/vue3';

export default {
    components: {
        InertiaLink,
    },
    layout: WebLayout,
    props: {
        user: Object,
    },
};
</script>
