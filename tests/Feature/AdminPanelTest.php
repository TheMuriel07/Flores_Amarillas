<?php

namespace Tests\Feature;

use App\Models\Frase;
use App\Models\Persona;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function entrarAlPanel(): void
    {
        $this->post(route('admin.login.enviar'), ['password' => config('app.admin_password')]);
    }

    public function test_el_panel_requiere_iniciar_sesion(): void
    {
        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_login_con_contraseña_incorrecta_muestra_error(): void
    {
        $this->from(route('admin.login'))
            ->post(route('admin.login.enviar'), ['password' => 'incorrecta'])
            ->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors('password');
    }

    public function test_login_correcto_y_cierre_de_sesion(): void
    {
        $this->entrarAlPanel();

        $this->get(route('admin.dashboard'))->assertOk()->assertSee('Mis personas');

        $this->post(route('admin.logout'));

        $this->get(route('admin.dashboard'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_crear_persona_y_agregarle_varias_frases(): void
    {
        $this->entrarAlPanel();

        $this->post(route('admin.persona.guardar'), [
            'nombre' => 'Valentina',
            'codigo' => '020',
            'frase_principal' => 'Mi flor favorita',
            'mensaje_especial' => 'Mensaje especial de Valentina',
        ])->assertRedirect();

        $persona = Persona::where('codigo', '020')->firstOrFail();
        $this->assertSame('Valentina', $persona->nombre);

        $this->post(route('admin.frase.guardar', $persona), ['frase' => 'Frase uno'])->assertRedirect();
        $this->post(route('admin.frase.guardar', $persona), ['frase' => 'Frase dos'])->assertRedirect();
        $this->post(route('admin.frase.guardar', $persona), ['frase' => 'Frase tres'])->assertRedirect();

        $this->assertSame(3, $persona->frases()->count());
    }

    public function test_el_id_debe_ser_unico(): void
    {
        Persona::create(['nombre' => 'Rosa', 'codigo' => '100']);

        $this->entrarAlPanel();

        $this->from(route('admin.persona.crear'))
            ->post(route('admin.persona.guardar'), [
                'nombre' => 'Otro',
                'codigo' => '100',
            ])
            ->assertRedirect(route('admin.persona.crear'))
            ->assertSessionHasErrors('codigo');
    }

    public function test_editar_datos_de_una_persona(): void
    {
        $persona = Persona::create(['nombre' => 'Antes', 'codigo' => '030']);

        $this->entrarAlPanel();

        $this->put(route('admin.persona.actualizar', $persona), [
            'nombre' => 'Después',
            'codigo' => '031',
            'frase_principal' => 'Frase nueva',
        ])->assertRedirect();

        $persona->refresh();

        $this->assertSame('Después', $persona->nombre);
        $this->assertSame('031', $persona->codigo);
    }

    public function test_editar_y_eliminar_una_frase_sin_afectar_otras(): void
    {
        $persona = Persona::create(['nombre' => 'Sofi', 'codigo' => '040']);
        $fraseUno = $persona->frases()->create(['frase' => 'Mantener']);
        $fraseDos = $persona->frases()->create(['frase' => 'Cambiar']);

        $this->entrarAlPanel();

        $this->put(route('admin.frase.actualizar', $fraseDos), ['frase' => 'Cambiada'])
            ->assertRedirect();

        $this->assertSame('Cambiada', Frase::find($fraseDos->id)->frase);
        $this->assertSame('Mantener', Frase::find($fraseUno->id)->frase);

        $this->delete(route('admin.frase.eliminar', $fraseDos))->assertRedirect();

        $this->assertDatabaseMissing('frases', ['id' => $fraseDos->id]);
        $this->assertDatabaseHas('frases', ['id' => $fraseUno->id]);
    }

    public function test_eliminar_persona_borra_sus_frases_en_cascada(): void
    {
        $persona = Persona::create(['nombre' => 'Nora', 'codigo' => '050']);
        $persona->frases()->create(['frase' => 'Única frase']);

        $this->entrarAlPanel();

        $this->delete(route('admin.persona.eliminar', $persona))->assertRedirect();

        $this->assertDatabaseMissing('personas', ['id' => $persona->id]);
        $this->assertDatabaseMissing('frases', ['persona_id' => $persona->id]);
    }
}