<?php

namespace App\Http\Controllers;

use App\Models\Frase;
use App\Models\Persona;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Muestra el formulario de acceso al panel de administración.
     */
    public function loginForm(): RedirectResponse|View
    {
        if (session('admin_autenticado')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Procesa el inicio de sesión del administrador.
     */
    public function login(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'password' => ['required', 'string'],
        ]);

        $claveCorrecta = hash_equals(
            (string) config('app.admin_password'),
            (string) $datos['password'],
        );

        if (! $claveCorrecta) {
            return back()->withErrors(['password' => 'Contraseña incorrecta.']);
        }

        $request->session()->regenerate();
        session(['admin_autenticado' => true]);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Cierra la sesión del administrador.
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget('admin_autenticado');

        return redirect()->route('admin.login');
    }

    /**
     * Panel principal: lista de personas con sus frases.
     */
    public function dashboard(): View
    {
        $personas = Persona::with('frases')->orderBy('codigo')->get();

        return view('admin.dashboard', compact('personas'));
    }

    /**
     * Formulario para crear una nueva persona.
     */
    public function crearForm(): View
    {
        return view('admin.persona-form');
    }

    /**
     * Guarda una nueva persona.
     */
    public function guardar(Request $request): RedirectResponse
    {
        $datos = $this->validarDatosPersona($request);

        $persona = Persona::create($datos);

        return redirect()
            ->route('admin.persona.editar', $persona)
            ->with('ok', 'Persona creada correctamente. Ahora puedes agregarle frases.');
    }

    /**
     * Formulario para editar una persona y gestionar sus frases.
     */
    public function editarForm(Persona $persona): View
    {
        $persona->load('frases');

        return view('admin.persona-form', compact('persona'));
    }

    /**
     * Actualiza los datos de una persona.
     */
    public function actualizar(Request $request, Persona $persona): RedirectResponse
    {
        $datos = $this->validarDatosPersona($request, $persona);

        if ($request->hasFile('foto')) {
            $datos['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $persona->update($datos);

        return back()->with('ok', 'Persona actualizada correctamente.');
    }

    /**
     * Elimina una persona junto con todas sus frases.
     */
    public function eliminar(Persona $persona): RedirectResponse
    {
        $persona->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('ok', 'La persona y sus frases fueron eliminadas.');
    }

    /**
     * Agrega una frase a una persona.
     */
    public function guardarFrase(Request $request, Persona $persona): RedirectResponse
    {
        $datos = $request->validate([
            'frase' => ['required', 'string', 'max:2000'],
        ]);

        $persona->frases()->create($datos);

        return back()->with('ok', 'Frase agregada correctamente.');
    }

    /**
     * Actualiza una frase existente.
     */
    public function actualizarFrase(Request $request, Frase $frase): RedirectResponse
    {
        $datos = $request->validate([
            'frase' => ['required', 'string', 'max:2000'],
        ]);

        $frase->update($datos);

        return back()->with('ok', 'Frase actualizada correctamente.');
    }

    /**
     * Elimina una frase.
     */
    public function eliminarFrase(Frase $frase): RedirectResponse
    {
        $frase->delete();

        return back()->with('ok', 'Frase eliminada correctamente.');
    }

    /**
     * Valida los datos comunes de una persona.
     *
     * @return array<string, mixed>
     */
    private function validarDatosPersona(Request $request, ?Persona $persona = null): array
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'codigo' => [
                'required',
                'string',
                'max:20',
                'regex:/^[A-Za-z0-9\-_]+$/',
                Rule::unique('personas', 'codigo')->ignore($persona),
            ],
            'frase_principal' => ['nullable', 'string', 'max:2000'],
            'mensaje_especial' => ['nullable', 'string', 'max:4000'],
            'foto' => ['nullable', 'image', 'max:4096'],
        ]);

        return $datos;
    }
}
