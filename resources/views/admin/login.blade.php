@extends('admin.layouts.admin')

@section('cuerpo')

<div class="tarjeta-login">
    <div class="logotipo-login" aria-hidden="true">
        <x-flor-sol clase="girasol-hero"/>
    </div>
    <h1 class="titulo-login">Acceso al panel</h1>
    <p class="subtitulo-login">Zona privada · escribe la contraseña para continuar.</p>

    <form method="POST" action="{{ route('admin.login.enviar') }}" class="form-id">
        @csrf
        <label class="etiqueta" for="password">Contraseña</label>
        <input
            class="entrada entrada-admin"
            type="password"
            id="password"
            name="password"
            placeholder="••••••••"
            autocomplete="current-password"
            required
        >
        <button type="submit" class="boton-flor">Entrar al panel</button>
    </form>

    @error('password')
        <p class="alerta-error"><span aria-hidden="true">🌺</span> {{ $message }}</p>
    @enderror
</div>

@endsection