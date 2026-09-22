@extends('layouts.public')

@section('titulo', 'Flores Amarillas · Bienvenida')
@section('body-class', 'pagina-inicio')

@section('contenido')

<section class="hero">
    <div class="hero-interior">

        <div class="flor-hero" aria-hidden="true">
            <x-flor-tulipan clase="tulipan-hero"/>
            <x-flor-sol clase="girasol-hero"/>
            <x-flor-margarita clase="margarita-hero"/>
        </div>

        <h1 class="titulo-grande">Flores <span>Amarillas</span></h1>

        <p class="decorativo-divisor" aria-hidden="true">❦</p>

        <p class="subtitulo">Para ti, que iluminas mis días con tu sonrisa.</p>
        <p class="invitacion">Escribe tu código especial y descubre las flores y los mensajes que guardo para ti.</p>

        <div class="tarjeta-id {{ $errors->any() ? 'shake' : '' }}">
            <form method="POST" action="{{ route('verificar') }}" class="form-id" autocomplete="off">
                @csrf
                <label class="etiqueta" for="codigo">Tu ID</label>
                <input
                    class="entrada"
                    type="text"
                    id="codigo"
                    name="codigo"
                    inputmode="text"
                    placeholder="Escribe aquí tu ID…"
                    value="{{ old('codigo') }}"
                    required
                >
                <button type="submit" class="boton-flor">Abrir mi mensaje</button>
            </form>

            @error('codigo')
                <p class="alerta-error"><span aria-hidden="true">🌺</span> {{ $message }}</p>
            @enderror
        </div>

        <div class="flores-bajeras" aria-hidden="true">
            <x-flor-margarita clase="mini mini-a sway-dos"/>
            <x-flor-sol clase="mini mini-b sway-uno"/>
            <x-flor-tulipan clase="mini mini-c sway-tres"/>
        </div>
    </div>
</section>

@endsection