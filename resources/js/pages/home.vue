<template lang="pug">
.section
    .content
        h1 Hola, Soy Joar
        p Esta es la aplicación que desarrolle como parte del requisito tecnico para aplicar a un cargo en GML.
        p Si estas viendo esto, significa que la aplicación se esta ejecutando de manera exitosa. Puedes avanzar y seguir analizando la aplicación utilizando el menu superior. Asi como acceder a mi repositorio de GitHub.
        p Muchas Gracias por esta oportunidad.

    .level
        .level-item
            a(href="https://github.com/PillFall" target="_blank")
                figure.image.is-128x128
                    img(src="https://avatars.githubusercontent.com/u/30298743")

</template>

<script>
import WebLayout from '../layouts/web/web.vue';

export default {
    layout: WebLayout,
};
</script>
