<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Panel · Flores Amarillas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="cuerpo-admin">

    <header class="cabecera-admin">
        <div class="cabecera-interior">
            <a href="{{ route('admin.dashboard') }}" class="marca-admin">🌻 Flores Amarillas <span>· Panel</span></a>

            @if (session('admin_autenticado'))
                <nav class="nav-admin">
                    <a href="{{ route('admin.dashboard') }}">Personas</a>
                    <a href="{{ route('admin.persona.crear') }}">Nueva persona</a>
                    <a href="{{ route('inicio') }}" target="_blank" rel="noopener">Ver página ↗</a>
                    <form method="POST" action="{{ route('admin.logout') }}" class="en-linea">
                        @csrf
                        <button type="submit" class="btn-enlace">Salir</button>
                    </form>
                </nav>
            @endif
        </div>
    </header>

    <main class="cuerpo-admin-contenido">
        @if (session('ok'))
            <div class="alerta-ok">✔ {{ session('ok') }}</div>
        @endif

        @yield('cuerpo')
    </main>

    <footer class="pie-admin">Panel de administración · {{ now()->format('d/m/Y') }}</footer>

</body>
</html>