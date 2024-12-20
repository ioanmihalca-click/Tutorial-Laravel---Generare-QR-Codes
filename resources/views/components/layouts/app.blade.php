<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Generator de Qr-Code' }}</title>
    </head>

    <body>
        {{ $slot }}
    </body>
    
</html>