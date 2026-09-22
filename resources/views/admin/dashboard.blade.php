@extends('admin.layouts.admin')

@section('cuerpo')

<div class="encabezado-panel">
    <div>
        <h1 class="titulo-panel">Mis personas</h1>
        <p class="detalle-panel">Cada persona tiene su ID y sus propias frases.</p>
    </div>
    <a class="btn-primario" href="{{ route('admin.persona.crear') }}">+ Nueva persona</a>
</div>

@if ($personas->isEmpty())
    <div class="vacio">
        <p>🌷 Todavía no hay personas registradas.</p>
        <a class="btn-primario" href="{{ route('admin.persona.crear') }}">Crear la primera persona</a>
    </div>
@endif

<div class="grid-personas">
    @foreach ($personas as $persona)
        <section class="tarjeta-persona-admin">
            <header class="cabecera-tarjeta">
                <h2>{{ $persona->nombre }}</h2>
                <span class="chip-id">ID {{ $persona->codigo }}</span>
            </header>

            <p class="resumen-frases">
                {{ $persona->frases->count() }} frase{{ $persona->frases->count() === 1 ? '' : 's' }} ·
                <a href="{{ route('flor', $persona->codigo) }}" target="_blank" rel="noopener">Ver página ↗</a>
            </p>

            @if ($persona->frases->isNotEmpty())
                <ul class="mini-lista">
                    @foreach ($persona->frases->take(3) as $frase)
                        <li>“{{ \Illuminate\Support\Str::limit($frase->frase, 62) }}”</li>
                    @endforeach
                    @if ($persona->frases->count() > 3)
                        <li class="mas-frases">… y {{ $persona->frases->count() - 3 }} más.</li>
                    @endif
                </ul>
            @else
                <p class="sin-frases">Esta persona todavía no tiene frases.</p>
            @endif

            <div class="acciones">
                <a class="btn-secundario" href="{{ route('admin.persona.editar', $persona) }}">Editar / frases</a>

                <details class="confirmar">
                    <summary class="btn-peligro">Eliminar</summary>
                    <div class="confirmar-caja">
                        <p>¿Eliminar a <strong>{{ $persona->nombre }}</strong> y todas sus frases? Esta acción no se puede deshacer.</p>
                        <form method="POST" action="{{ route('admin.persona.eliminar', $persona) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-peligro">Sí, eliminar definitivamente</button>
                        </form>
                    </div>
                </details>
            </div>
        </section>
    @endforeach
</div>

@endsection