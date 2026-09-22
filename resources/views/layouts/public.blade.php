<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Un rincón de flores amarillas lleno de mensajes para personas especiales.">
    <title>@yield('titulo', 'Flores Amarillas')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="@yield('body-class', '')">

    {{-- Flores ornamentales fijas del fondo --}}
    <div class="decor" aria-hidden="true">
        <x-flor-sol clase="flor-fija f1 sway-uno"/>
        <x-flor-margarita clase="flor-fija f2 sway-dos"/>
        <x-flor-tulipan clase="flor-fija f3 sway-tres"/>
        <x-flor-sol clase="flor-fija f4 sway-uno"/>
        <x-flor-margarita clase="flor-fija f5 sway-dos"/>
        <x-hoja clase="hoja-fija h1 sway-uno"/>
        <x-hoja clase="hoja-fija h2 sway-dos"/>
    </div>

    {{-- Pétalos cayendo (animación 100% CSS) --}}
    <div class="petalos" aria-hidden="true">
        @for ($i = 1; $i <= 14; $i++)
            <span class="petalo petalo-{{ $i }}"></span>
        @endfor
    </div>

    {{-- Pequeñas luces que brillan --}}
    <div class="centellas" aria-hidden="true">
        @for ($i = 1; $i <= 10; $i++)
            <span class="centella c-{{ $i }}"></span>
        @endfor
    </div>

    <main class="contenido">
        @yield('contenido')
    </main>

    <footer class="pie">
        <p>Hecho con <span class="corazon">♥</span> para alguien muy especial</p>
    </footer>

</body>
</html>