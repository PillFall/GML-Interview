# Entrevista Tecnica GML

Hola, soy Joar,

Este aplicativo esta desarrollado utilizando:

- [Laravel](https://laravel.com)
- [InertiaJS](https://inertiajs.com)
- [VueJS](https://vuejs.org)
- [Bulma](https://bulma.io)
- [MeiliSearch](https://meilisearch.com) ([Scout](https://laravel.com/docs/scout))
- [Redis](https://redis.com)
- [Postgres](https://postgres.com)

Para ejecutarlo de manera sencilla este esta integrado con [Laravel Sail](https://laravel.com/docs/sail), lo cual permite generar rapidamente un entorno de desarrollo utilizando [Docker](https://docker.com).



### Instalación

Solamente se debe ejecutar los siguientes comandos

```sh
docker run --rm -it -v $(pwd):/app composer:latest install
docker run --rm -it -v $(pwd):/app node:alpine yarn install --cwd='/app'
./vendor/bin/sail up
```

Y listo, el sistema estará corriendo en varios contenedores de Docker.



### Datos de prueba

Ahora, para generar datos de prueba, puedes utilizar el comando

```sh
./vendor/bin/sail artisan migrate --seed --seeder='DevelopmentSeeder'
```

O si solo quieres generar los elementos por defecto

```sh
./vendor/bin/sail artisan migrate --seed
```

### Correos

Laravel Sail incluye [Mailpit](https://github.com/axllent/mailpit) como servidor de SMTP, si quieres ver los correos que se han generado, ingresa a [localhost:8025](http://localhost:8025), alli encontraras una lista con cada correo generado desde el momento en que se inicio la aplicación.
