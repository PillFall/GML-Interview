<template lang="pug">
inertia-head(:title="user.full_name")
.modal(:class="{'is-active': deleteConfirm}")
    .modal-background
    .modal-card.is-danger
        header.modal-card-head
            p.modal-card-title ¿Eliminar el usuario {{ user.full_name }}?
            button.delete(@click="deleteConfirm = false")
        section.modal-card-body
            .content
                p Esta apunto de eliminar el usuario #[strong {{ user.full_name }}].
                p Tenga en cuenta que esta acción es inreversible.
        footer.modal-card-foot
            button.button.is-danger(@click="deleteUser") Confirmar

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
            .level-item
                a.button.is-danger(@click="deleteConfirm = true")
                    span.icon.is-small
                        font-awesome-icon(icon="trash")
                    span Eliminar

    .columns
        .column
            .box
                .content
                    p.title.is-5 Información Basica
                    p #[strong Nombres:] {{ user.name }}
                    p #[strong Apellidos:] {{ user.surname }}
                    p #[strong Identificación:] {{ user.identifier }}
                    p #[strong Categoría:] {{ user.category.name }}

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
        user: Object,
    },
    data() {
        return {
            deleteConfirm: false,
        };
    },
    methods: {
        deleteUser() {
            return this.$inertia.delete(this.$route('users.destroy', {
                user: this.user.id,
            }));
        },
    },
};
</script>
