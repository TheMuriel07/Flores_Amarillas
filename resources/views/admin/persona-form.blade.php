@extends('admin.layouts.admin')

@section('cuerpo')

<div class="encabezado-panel">
    <h1 class="titulo-panel">{{ isset($persona) ? 'Editar: ' . $persona->nombre : 'Nueva persona' }}</h1>
    <a class="btn-secundario" href="{{ route('admin.dashboard') }}">← Volver al panel</a>
</div>

<form
    method="POST"
    action="{{ isset($persona) ? route('admin.persona.actualizar', $persona) : route('admin.persona.guardar') }}"
    enctype="multipart/form-data"
    class="formulario-admin"
>
    @csrf
    @if (isset($persona))
        @method('PUT')
    @endif

    <div class="campo">
        <label for="nombre">Nombre <span class="obligatorio">*</span></label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $persona->nombre ?? '') }}" required>
        @error('nombre')
            <p class="error-campo">{{ $message }}</p>
        @enderror
    </div>

    <div class="campo">
        <label for="codigo">ID / Código único <span class="obligatorio">*</span></label>
        <input type="text" id="codigo" name="codigo" value="{{ old('codigo', $persona->codigo ?? '') }}" placeholder="Ejemplo: 001" required>
        <p class="ayuda">Letras, números, guiones. Debe ser diferente para cada persona.</p>
        @error('codigo')
            <p class="error-campo">{{ $message }}</p>
        @enderror
    </div>

    <div class="campo">
        <label for="frase_principal">Frase principal</label>
        <textarea id="frase_principal" name="frase_principal" rows="2">{{ old('frase_principal', $persona->frase_principal ?? '') }}</textarea>
    </div>

    <div class="campo">
        <label for="mensaje_especial">Mensaje o declaración especial</label>
        <textarea id="mensaje_especial" name="mensaje_especial" rows="4">{{ old('mensaje_especial', $persona->mensaje_especial ?? '') }}</textarea>
    </div>

    <div class="campo">
        <label for="foto">Foto (opcional)</label>
        <input type="file" id="foto" name="foto" accept="image/*">
        @if (isset($persona) && $persona->foto)
            <p class="ayuda">Foto actual: <a href="{{ asset('storage/' . $persona->foto) }}" target="_blank" rel="noopener">{{ basename($persona->foto) }}</a></p>
        @endif
        @error('foto')
            <p class="error-campo">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="btn-primario">{{ isset($persona) ? 'Guardar cambios' : 'Crear persona' }}</button>
</form>

@if (isset($persona))

    <hr class="separador">

    <section class="seccion-frases">
        <h2 class="titulo-panel">Frases de {{ $persona->nombre }}</h2>
        <p class="detalle-panel">Puedes agregar tantas frases como quieras. Cada una pertenece solo a esta persona.</p>

        @foreach ($persona->frases as $frase)
            <div class="fila-frase">
                <form
                    method="POST"
                    action="{{ route('admin.frase.actualizar', $frase) }}"
                    class="form-editar-frase"
                >
                    @csrf
                    @method('PUT')
                    <textarea name="frase" rows="2" required>{{ $frase->frase }}</textarea>
                    <button type="submit" class="btn-secundario">Guardar frase</button>
                </form>

                <details class="confirmar">
                    <summary class="btn-peligro">Eliminar frase</summary>
                    <div class="confirmar-caja">
                        <p>¿Eliminar esta frase?</p>
                        <form method="POST" action="{{ route('admin.frase.eliminar', $frase) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-peligro">Sí, eliminar</button>
                        </form>
                    </div>
                </details>
            </div>
        @endforeach

        <div class="nueva-frase">
            <h3>+ Agregar otra frase</h3>
            <form method="POST" action="{{ route('admin.frase.guardar', $persona) }}" class="form-editar-frase">
                @csrf
                <textarea name="frase" rows="2" placeholder="Escribe aquí una frase nueva para {{ $persona->nombre }}…" required></textarea>
                @error('frase')
                    <p class="error-campo">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn-primario">+ Agregar frase</button>
            </form>
        </div>
    </section>

@endif

@endsection