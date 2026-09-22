<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PublicoController extends Controller
{
    /**
     * Pantalla principal de bienvenida con el formulario de ID.
     */
    public function inicio()
    {
        return view('public.home');
    }

    /**
     * Verifica el ID ingresado y redirige al contenido de la persona.
     */
    public function verificar(Request $request)
    {
        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:20'],
        ]);

        $persona = Persona::where('codigo', $datos['codigo'])->first();

        if (! $persona) {
            return back()
                ->withErrors(['codigo' => 'Ese ID no es válido o no existe. Revísalo e inténtalo de nuevo.'])
                ->withInput();
        }

        return redirect()->route('flor', $persona->codigo);
    }

    /**
     * Muestra el contenido personalizado de una persona.
     */
    public function flor(string $codigo)
    {
        $persona = Persona::where('codigo', $codigo)->with('frases')->firstOrFail();

        return view('public.flor', [
            'persona' => $persona,
        ]);
    }
}
