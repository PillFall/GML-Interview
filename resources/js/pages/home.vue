<template lang="pug">
.section
    .content
        h1 Hola, Soy Joar
        p Esta es la aplicación que desarrolle como parte del requisito tecnico para aplicar a un cargo en GML.
        p Si estas viendo esto, significa que la aplicación se esta ejecutando de manera exitosa. Puedes avanzar y seguir analizando la aplicación utilizando el menu superior. Asi como acceder a mi repositorio de GitHub.
        p Es posible que las cargas iniciales del indice de pacientes sean un poco lentas. Esto sucede porque aun no se ha generado la cache de los elementos que se van a mostrar.
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
