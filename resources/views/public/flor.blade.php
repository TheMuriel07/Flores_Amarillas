@extends('layouts.public')

@section('titulo', 'Una flor para ' . $persona->nombre)
@section('body-class', 'pagina-flor')

@section('contenido')

<div class="intro-flor" aria-hidden="true">
    <div class="intro-nube">
        @for ($i = 1; $i <= 12; $i++)
            <span class="intro-petalo ip-{{ $i }}"></span>
        @endfor
        <x-hoja clase="intro-hoja"/>
        <x-flor-tulipan clase="intro-tulipan"/>
        <x-flor-sol clase="intro-girasol"/>
        <x-flor-margarita clase="intro-margarita"/>
        <x-flor-margarita clase="intro-margarita-b"/>
        <x-flor-tulipan clase="intro-tulipan-b"/>
        <x-hoja clase="intro-hoja-b"/>
    </div>
    <p class="intro-texto">Abriendo tu mensaje…</p>
</div>

<section class="contenido-personal">

    <nav class="nav-flor">
        <a class="enlace-volver" href="{{ route('inicio') }}">← Volver al inicio</a>
    </nav>

    <article class="tarjeta-persona aparecer">
        <div class="flor-emblematica" aria-hidden="true">
            <x-flor-sol clase="girasol-hero"/>
            <x-flor-margarita clase="margarita-hero peque"/>
        </div>

        <p class="saludo">Para</p>
        <h1 class="nombre-persona">{{ $persona->nombre }}</h1>
        <p class="codigosito">ID {{ $persona->codigo }}</p>

        @if ($persona->foto)
            <div class="foto-persona">
                <img src="{{ asset('storage/' . $persona->foto) }}" alt="Foto de {{ $persona->nombre }}">
            </div>
        @endif

        @if ($persona->frase_principal)
            <p class="frase-principal">{{ $persona->frase_principal }}</p>
        @endif

        <div class="divisor" aria-hidden="true"><span>❦</span></div>

        @if ($persona->mensaje_especial)
            <div class="caja-especial aparecer">
                <p class="titulo-especial">💛 Un mensaje especial para ti</p>
                <p>{{ $persona->mensaje_especial }}</p>
            </div>
        @endif

        @if ($persona->frases->isNotEmpty())
            <h2 class="titulo-frases con-flores">
                <span class="titulo-flor" aria-hidden="true"><x-flor-margarita clase="tfn"/></span>
                <span class="titulo-frases-texto">Frases para ti</span>
                <span class="titulo-flor" aria-hidden="true"><x-flor-margarita clase="tfn"/></span>
            </h2>
            <div class="lista-frases">
                @foreach ($persona->frases as $frase)
                    <p class="frase" style="--d: {{ $loop->iteration }}">
                        <span class="flor-marcador" aria-hidden="true">✿</span>
                        <x-flor-tulipan clase="frase-flor ff-izq"/>
                        <x-flor-sol clase="frase-flor ff-der"/>
                        {{ $frase->frase }}
                    </p>
                @endforeach
            </div>
            <div class="ramo-decorativo" aria-hidden="true">
                <x-hoja clase="rd-h"/>
                <x-flor-margarita clase="rd-fl r-1"/>
                <x-flor-sol clase="rd-fl r-2"/>
                <x-flor-tulipan clase="rd-fl r-3"/>
                <x-flor-margarita clase="rd-fl r-4"/>
                <x-flor-sol clase="rd-fl r-5"/>
                <x-hoja clase="rd-h"/>
            </div>
        @endif
    </article>

</section>

@endsection