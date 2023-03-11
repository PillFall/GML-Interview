<template lang="pug">
inertia-head(title="Crear un usuario")
.section
    .level
        .level-left
            .level-item
                h1.title Crear un usuario
        .level-right
            .level-item
                button.button.is-success(@click="submit")
                    span.icon.is-small
                        font-awesome-icon(icon="plus")
                    span Crear

    .columns
        .column
            .box
                p.title.is-5 Información Basica
                .field.is-horizontal
                    .field-label.is-normal
                        label.label Nombres
                    .field-body
                        .field
                            .control
                                input.input(v-model="form.name" :class="{'is-danger': form.errors.name}" type="text" placeholder="John")
                            p.help.is-danger(v-if="form.errors.name") {{ form.errors.name }}
                .field.is-horizontal
                    .field-label.is-normal
                        label.label Apellidos
                    .field-body
                        .field
                            .control
                                input.input(v-model="form.surname" :class="{'is-danger': form.errors.surname}" type="text" placeholder="Doe")
                            p.help.is-danger(v-if="form.errors.surname") {{ form.errors.surname }}
                .field.is-horizontal
                    .field-label.is-normal
                        label.label Identificacíon
                    .field-body
                        .field.is-expanded
                            .field.has-addons
                                .control
                                    a.button.is-static CC
                                .control.is-expanded
                                    input.input(v-model="form.identifier" :class="{'is-danger': form.errors.identifier}" type="text" placeholder="857-458-7944")
                            p.help.is-danger(v-if="form.errors.identifier") {{ form.errors.identifier }}
                .field.is-horizontal
                    .field-label.is-normal
                        label.label Categoría
                    .field-body
                        .field
                            .control.is-expanded
                                .select.is-fullwidth(:class="{'is-danger': form.errors.category}")
                                    select(v-model="form.category")
                                        option(selected disabled hidden)
                                        option(v-for="category in categories" :value="category.id") {{ category.name }}
                            p.help.is-danger(v-if="form.errors.category") {{ form.errors.category }}

        .column
            .box
                .field.is-horizontal
                    .field-label.is-normal
                        label.label Telefono
                    .field-body
                        .field
                            .control
                                input.input(v-model="form.mobile" :class="{'is-danger': form.errors.mobile}" type="tel" placeholder="3212542542")
                            p.help.is-danger(v-if="form.errors.mobile") {{ form.errors.mobile }}
                .field.is-horizontal
                    .field-label.is-normal
                        label.label Correo Electronico
                    .field-body
                        .field
                            .control
                                input.input(v-model="form.email" :class="{'is-danger': form.errors.email}" type="email" placeholder="johndoe@example.com")
                            p.help.is-danger(v-if="form.errors.email") {{ form.errors.email }}

        .column
            .box
                .field.is-horizontal
                    .field-label.is-normal
                        label.label País
                    .field-body
                        .field
                            .control.is-expanded
                                .select.is-fullwidth(:class="{'is-danger': form.errors.country}")
                                    select(v-model="form.country")
                                        option(selected disabled hidden)
                                        option(v-for="country in countries" :value="country.cca3") {{ country.translations.spa.official }}
                            p.help.is-danger(v-if="form.errors.country") {{ form.errors.country }}
                .field.is-horizontal
                    .field-label.is-normal
                        label.label Dirección
                    .field-body
                        .field
                            .control
                                input.input(v-model="form.address" :class="{'is-danger': form.errors.address}" type="text" placeholder="124 Daniella Greens Apt. 742 South Pasquale, OH 82547-0137")
                            p.help.is-danger(v-if="form.errors.address") {{ form.errors.address }}
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
        categories: Array,
        countries: Array,
    },
    data() {
        return {
            form: this.$inertia.form({
                name: null,
                surname: null,
                identifier: null,
                category: null,
                mobile: null,
                email: null,
                country: null,
                address: null,
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.$route('users.store'));
        },
    },
};
</script>
