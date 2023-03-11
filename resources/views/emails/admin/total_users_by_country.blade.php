<x-mail::message>
# Hola

Se ha registrado un nuevo usuario en la aplicación.

Ahora la cantidad de usuarios por país es la siguiente.

<x-mail::table>
| País | Cantidad |
| ---- | -------: |
@foreach ($usersByCountry as $country => $count)
| {{ $country }} | {{ $count }} |
@endforeach
</x-mail::table>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
